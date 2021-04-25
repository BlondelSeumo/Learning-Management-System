<?php

namespace App\Http\Controllers;

use App\DepositRecord;
use App\Http\Controllers\Frontend\WebsiteController;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Modules\BankPayment\Http\Controllers\BankPaymentController;
use Modules\PaymentMethodSetting\Entities\PaymentMethod;
use Modules\Paytm\Http\Controllers\PaytmController;
use Modules\Razorpay\Http\Controllers\RazorpayController;
use Modules\Sslcommerz\Http\Controllers\SslcommerzController;
use Omnipay\Omnipay;
use Unicodeveloper\Paystack\Facades\Paystack;

class DepositController extends Controller
{
    public $payPalGateway;

    public function __construct()
    {
        $this->payPalGateway = Omnipay::create('PayPal_Rest');
        $this->payPalGateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->payPalGateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->payPalGateway->setTestMode(env('IS_PAYPAL_LOCALHOST')); //set it to 'false' when go live
    }

    public function depositSelectOption(Request $request)
    {
        $data = $request->validate([
            'deposit_amount' => 'required|numeric',
        ]);
        $web = new WebsiteController();
        $amount = $request->deposit_amount;
        $data = $web->common();
        $records = DepositRecord::where('user_id', Auth::user()->id)->paginate(5);
        $methods = PaymentMethod::where('active_status', 1)->where('method', '!=', 'Wallet')->get(['method', 'logo']);
        return view(theme('depositSelect'), $data, compact('records', 'methods', 'amount'));
    }

    public function depositSubmit(Request $request)
    {
        $data = $request->validate([
            'deposit_amount' => 'required|numeric',
            'method' => 'required',
        ]);

        if (demoCheck()) {
            return redirect()->back();
        }

        if ($data['method'] == "Sslcommerz") {
            $ssl = new SslcommerzController();
            $ssl->deposit($data['deposit_amount']);

        } elseif ($data['method'] == "PayPal") {

            $response = $this->payPalGateway->purchase(array(
                'amount' => convertCurrency(getSetting()->currency->code ?? 'BDT', 'USD', $data['deposit_amount']),
                'currency' => 'USD',
                'returnUrl' => route('paypalDepositSuccess'),
                'cancelUrl' => route('paypalDepositFailed'),

            ))->send();

            if ($response->isRedirect()) {
                $response->redirect(); // this will automatically forward the customer
            } else {
                Toastr::error($response->getMessage(), trans('common.Failed'));
                return \redirect()->back();
            }
        } elseif ($data['method'] == "Stripe") {

            if (empty($request->get('stripeToken'))) {
                Toastr::error('Something went wrong', 'Failed');
                return redirect(route('studentDashboard'));
            }

            $token = $request->stripeToken;
            $gatewayStripe = Omnipay::create('Stripe');
            $gatewayStripe->setApiKey(env('STRIPE_SECRET'));


            $response = $gatewayStripe->purchase(array(
                'amount' => convertCurrency(getSetting()->currency->code ?? 'BDT', 'USD', $data['deposit_amount']),
                'currency' => 'USD',
                'token' => $token,
            ))->send();

            if ($response->isRedirect()) {
                // redirect to offsite payment gateway
                $response->redirect();
            } elseif ($response->isSuccessful()) {
                // payment was successful: update database

                $amount = round(convertCurrency(strtoupper($response->getData()['currency'],), strtoupper(getSetting()->currency->code ?? 'BDT'), $response->getData()['amount'] / 100));

                $payWithStripe = $this->depositWithGateWay($amount, $response, "Stripe");
                if ($payWithStripe) {
                    Toastr::success('Payment done successfully', 'Success');
                    return redirect(route('studentDashboard'));
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return redirect(route('studentDashboard'));
                }

            } else {

                if ($response->getCode() == "amount_too_small") {
                    $amount = round(convertCurrency('USD', strtoupper(getSetting()->currency->code ?? 'BDT'), 0.5));
                    $message = "Amount must be at least " . getSetting()->currency->symbol . ' ' . $amount;
                    Toastr::error($message, 'Error');
                } else {
                    Toastr::error($response->getMessage(), 'Error');
                }
                return redirect()->back();

            }
        } elseif ($data['method'] == "RazorPay") {

            if (empty($request->razorpay_payment_id)) {
                Toastr::error('Something Went Wrong', 'Error');
                return \redirect()->back();
            }

            $payment = new RazorpayController();
            $response = $payment->payment($request->razorpay_payment_id);
            if ($response['type'] == "error") {
                Toastr::error($response['message'], 'Error');
                return \redirect()->back();
            }


            $amount = round(convertCurrency(strtoupper($response['response']['currency'],), strtoupper(getSetting()->currency->code ?? 'BDT'), $response['response']['amount'] / 100));

            $payWithRazorPay = $this->depositWithGateWay($amount, $response['response'], "RazorPay");

            if ($payWithRazorPay) {
                Toastr::success('Payment done successfully', 'Success');
                return redirect(route('studentDashboard'));
            } else {
                Toastr::error('Something Went Wrong', 'Error');
                return redirect(route('studentDashboard'));
            }
        } elseif ($data['method'] == "PayTM") {

            $phone = Auth::user()->phone;
            $email = Auth::user()->email;
            if (empty($phone)) {
                Toastr::error('Phone number is required. Please update your profile ', 'Error');
                return redirect()->back();
            }

            $payment = new PaytmController();
            $userData = [
                'user' => Auth::user()->id,
                'mobile' => $phone,
                'email' => $email,
                'amount' => convertCurrency(getSetting()->currency->code ?? 'BDT', 'INR', $data['deposit_amount']),
                'order' => Auth::user()->phone . "_" . rand(1, 1000),
            ];
            return $payment->deposit($userData);
        } elseif ($data['method'] == "PayStack") {
            try {
                return Paystack::getAuthorizationUrl()->redirectNow();
            } catch (\Exception $e) {
                Toastr::error($e->getMessage(), trans('common.Failed'));
                return Redirect::back();
            }
        } elseif ($data['method'] == "Bank Payment") {
            try {

                $request->validate([
                    'bank_name' => 'required',
                    'branch_name' => 'required',
                    'type' => 'required',
                    'account_number' => 'required',
                    'account_holder' => 'required',
                    'image' => 'mimes:jpeg,jpg,png,gif|required',
                ]);

                $payment = new BankPaymentController();
                $result = $payment->store($request);

                if ($result) {
                    return redirect(route('studentDashboard'));
                } else {
                    return redirect()->back();
                }

            } catch (\Exception $e) {
                Toastr::error($e->getMessage(), trans('common.Failed'));
                return Redirect::back();
            }
        }



    }


    public static function depositWithGateWay($amount, $response, $gateWayName)
    {
        try {


            if (Auth::check()) {
                $user = Auth::user();
                DB::beginTransaction();
                $user->balance += $amount;
                $user->save();

                $depositRecord = new DepositRecord();
                $depositRecord->user_id = Auth::user()->id;
                $depositRecord->method = $gateWayName;
                $depositRecord->amount = $amount;
                $depositRecord->response = json_encode($response);
                $depositRecord->save();
                Toastr::success('Deposit done successfully', 'Success');
                DB::commit();
                return true;

            } else {
                Toastr::error('Something Went Wrong', 'Error');
                return false;
            }


        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong', 'Error');
            return false;

        }
    }

    public function paypalDepositSuccess(Request $request)
    {

        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->payPalGateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // The customer has successfully paid.
                $arr_body = $response->getData();
                $paymentAmount = $arr_body['transactions'][0]['amount'];

                $amount = round(convertCurrency($paymentAmount['currency'], getSetting()->currency->code ?? 'BDT', $paymentAmount['total']));


                $payWithPapal = $this->depositWithGateWay($amount, $arr_body, "PayPal");
                if ($payWithPapal) {
                    Toastr::success('Payment done successfully', 'Success');
                    return redirect(route('studentDashboard'));
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return redirect(route('studentDashboard'));
                }

            } else {
                $msg = str_replace("'", " ", $response->getMessage());
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } else {
            Toastr::error('Transaction is declined');
            return redirect()->back();
        }


    }

    public
    function paypalDepositFailed()
    {
        Toastr::error('User is canceled the payment.', 'Failed');
        return redirect()->back();
    }
}
