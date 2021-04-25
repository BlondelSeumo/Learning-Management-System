<?php

namespace App\Http\Controllers;

use App\BillingDetails;
use App\Http\Controllers\Frontend\WebsiteController;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\PaymentMethodSetting\Entities\PaymentMethod;
use Modules\Paytm\Http\Controllers\PaytmController;
use Modules\Razorpay\Http\Controllers\RazorpayController;
use Modules\Subscription\Entities\CourseSubscription;
use Modules\Subscription\Entities\SubscriptionCart;
use Modules\Subscription\Entities\SubscriptionCheckout;
use Modules\Wallet\Http\Controllers\WalletController;
use Omnipay\Omnipay;
use Unicodeveloper\Paystack\Facades\Paystack;

class SubscriptionPaymentController extends Controller
{
    public $payPalGateway;
    public $allow;

    public function __construct()
    {
        $this->allow = true;

        $this->payPalGateway = Omnipay::create('PayPal_Rest');
        $this->payPalGateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->payPalGateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->payPalGateway->setTestMode(env('IS_PAYPAL_LOCALHOST')); //set it to 'false' when go live


    }


    public function payment(Request $request)
    {

        try {

            $plan = CourseSubscription::where('id', $request->plan_id)->first();
            if (!$plan) {
                Toastr::error('Invalid Request', 'Error');
                return \redirect()->route('courseSubscription');
            }

            $cart = SubscriptionCart::where('user_id', Auth::user()->id)->with('plan')->first();

            if (!$cart) {
                Toastr::error('Invalid Request', 'Error');
                return \redirect()->route('courseSubscription');
            }


            $request->validate([
                'old_billing' => 'required_if:billing_address,previous',
                'first_name' => 'required_if:billing_address,new',
                'last_name' => 'required_if:billing_address,new',
                'country' => 'required_if:billing_address,new',
                'address1' => 'required_if:billing_address,new',
                'city' => 'required_if:billing_address,new',
                'phone' => 'required_if:billing_address,new',
                'email' => 'required_if:billing_address,new',
            ]);

            if ($request->billing_address == 'new') {
                $bill = BillingDetails::where('tracking_id', $request->tracking_id)->first();

                if (empty($bill)) {
                    $bill = new BillingDetails();
                    $bill->tracking_id = $cart->tracking;
                    $bill->user_id = Auth::id();
                }


                $bill->first_name = $request->first_name;
                $bill->last_name = $request->last_name;
                $bill->company_name = $request->company_name;
                $bill->country = $request->country;
                $bill->address1 = $request->address1;
                $bill->address2 = $request->address2;
                $bill->city = $request->city;
                $bill->zip_code = $request->zip_code;
                $bill->phone = $request->phone;
                $bill->email = $request->email;
                $bill->details = $request->details;
                $bill->payment_method = null;
                $bill->save();
            } else {
                $bill = BillingDetails::where('id', $request->old_billing)->first();
            }

            $webController = new WebsiteController();
            $data = $webController->common();

            $profile = Auth::user();
            $bills = BillingDetails::with('country')->where('user_id', Auth::id())->get();

            $countries = DB::table('countries')->select('id', 'name')->get();
            $cities = DB::table('spn_cities')->where('country_id', $profile->country)->select('id', 'name')->get();
            $cart->billing_detail_id = $bill->id;
            $cart->save();

            $methods = PaymentMethod::where('active_status', 1)->where('module_status', 1)->where('method', '!=', 'Bank Payment')->where('method', '!=', 'Offline Payment')->get(['method', 'logo']);


            return view(theme('subscriptionPayment'), $data, compact('plan', 'methods', 'bill', 'bills', 'profile', 'countries', 'cities', 'cart'));
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function subscriptionSubmit(Request $request)
    {

        if (!Auth::check()) {
            Toastr::error('You must login', 'Failed');
            $this->allow = false;
            return redirect()->back();
        }

        if (demoCheck()) {
            return redirect()->back();
        }
        if (!$this->allow) {
            return redirect()->back();
        }
        $cart = SubscriptionCart::where('user_id', Auth::user()->id)->first();
        if (!$cart) {
            Toastr::error('Something went wrong.', 'Failed');
            return redirect()->route('courseSubscription');
        }
        try {
            if ($request->payment_method == "Sslcommerz") {

                /*
                                $post_data = array();
                                $post_data['total_amount'] = $plan->price; # You cant not pay less than 10
                                $post_data['currency'] = getSetting()->currency->code ?? 'USD';
                                $post_data['tran_id'] = uniqid(); // tran_id must be unique

                                # CUSTOMER INFORMATION
                                $post_data['cus_name'] = $request->first_name ?? 'Customer Name';
                                $post_data['cus_email'] = $request->email ?? 'customer@mail.com';
                                $post_data['cus_add1'] = $request->address1 ?? 'Customer Address';
                                $post_data['cus_add2'] = $request->address2 ?? '';
                                $post_data['cus_city'] = $request->city ?? 'Dhaka';
                                $post_data['cus_state'] = "";
                                $post_data['cus_postcode'] = $request->zip_code ?? '';
                                $post_data['cus_country'] = $request->country ?? '';
                                $post_data['cus_phone'] = $request->phone ?? '8801XXXXXXXXX';
                                $post_data['cus_fax'] = "";


                                # SHIPMENT INFORMATION
                                $post_data['ship_name'] = "Store Test";
                                $post_data['ship_add1'] = "Dhaka";
                                $post_data['ship_add2'] = "Dhaka";
                                $post_data['ship_city'] = "Dhaka";
                                $post_data['ship_state'] = "Dhaka";
                                $post_data['ship_postcode'] = "1000";
                                $post_data['ship_phone'] = "";
                                $post_data['ship_country'] = "Bangladesh";

                                $post_data['shipping_method'] = "NO";
                                $post_data['product_name'] = "Computer";
                                $post_data['product_category'] = "Goods";
                                $post_data['product_profile'] = "physical-goods";

                                # OPTIONAL PARAMETERS
                                $post_data['value_a'] = $plan->id;
                                $post_data['value_b'] = $plan->title;
                                $post_data['value_c'] = "ref003";
                                $post_data['value_d'] = "ref004";


                                #Before  going to initiate the payment order status need to update as Pending.
                                $update_product = DB::table('orders')
                                    ->where('transaction_id', $post_data['tran_id'])
                                    ->updateOrInsert([
                                        'user_id' => $checkout_info->user->id,
                                        'tracking' => $checkout_info->tracking,
                                        'name' => $post_data['cus_name'] ?? '',
                                        'email' => $post_data['cus_email'] ?? '',
                                        'phone' => $post_data['cus_phone'] ?? '',
                                        'amount' => $post_data['total_amount'] ?? '',
                                        'status' => 'Pending',
                                        'address' => $post_data['cus_add1'] ?? '',
                                        'transaction_id' => $post_data['tran_id'],
                                        'currency' => $post_data['currency']
                                    ]);
                                $sslc = new SslCommerzNotification();
                                # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
                                $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');
                                $payment_options = \GuzzleHttp\json_decode($payment_options);

                                if ($payment_options->status == "success") {
                                    return Redirect::to($payment_options->data);
                                } else {
                                    Toastr::error('Something went wrong', 'Failed');
                                    return Redirect::back();
                                }*/

            } elseif ($request->payment_method == "PayPal") {

                try {
                    $response = $this->payPalGateway->purchase(array(
                        'amount' => convertCurrency(getSetting()->currency->code ?? 'BDT', 'USD', $cart->price),
                        'currency' => 'USD',
                        'returnUrl' => route('paypalSubscriptionSuccess'),
                        'cancelUrl' => route('paypalSubscriptionFailed'),

                    ))->send();

                    if ($response->isRedirect()) {
                        $response->redirect(); // this will automatically forward the customer
                    } else {
                        Toastr::error($response->getMessage(), trans('common.Failed'));
                        return redirect()->route('courseSubscriptionCheckout');
                    }
                } catch (\Exception $e) {
                    Toastr::error("Something Went Wrong", 'Failed');
                    return redirect()->route('courseSubscriptionCheckout');
                }

            } //paypel payment getaway
            elseif ($request->payment_method == "Stripe") {

                $request->validate([
                    'stripeToken' => 'required'
                ]);
                $token = $request->stripeToken ?? '';
                $gatewayStripe = Omnipay::create('Stripe');
                $gatewayStripe->setApiKey(env('STRIPE_SECRET'));

                $response = $gatewayStripe->purchase(array(
                    'amount' => convertCurrency(getSetting()->currency->code ?? 'BDT', 'USD', $cart->price),
                    'currency' => 'USD',
                    'token' => $token,
                ))->send();

                if ($response->isRedirect()) {
                    // redirect to offsite payment gateway
                    $response->redirect();
                } elseif ($response->isSuccessful()) {
                    // payment was successful: update database

                    $payWithStripe = $this->payWithGateWay($response->getData(), "Stripe");
                    if ($payWithStripe) {
                        Toastr::success('Payment done successfully', 'Success');
                        return redirect(route('studentDashboard'));
                    } else {
                        Toastr::error('Something Went Wrong', 'Error');
                        return redirect()->route('courseSubscriptionCheckout');
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


            } //payment getway
            elseif ($request->payment_method == "RazorPay") {

                if (empty($request->razorpay_payment_id)) {
                    Toastr::error('Something Went Wrong', 'Error');
                    return redirect()->route('courseSubscriptionCheckout');
                }

                $payment = new RazorpayController();
                $response = $payment->payment($request->razorpay_payment_id);

                if ($response['type'] == "error") {
                    Toastr::error($response['message'], 'Error');
                    return redirect()->route('courseSubscriptionCheckout');
                }

                $payWithRazorPay = $this->payWithGateWay($response['response'], "RazorPay");

                if ($payWithRazorPay) {
                    Toastr::success('Payment done successfully', 'Success');
                    return redirect(route('studentDashboard'));
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return redirect()->route('courseSubscriptionCheckout');
                }


            } //payment getway
            elseif ($request->payment_method == "PayTM") {


                $userData = [
                    'user' => Auth::user()->name,
                    'mobile' => Auth::user()->phone,
                    'email' => Auth::user()->email,
                    'amount' => convertCurrency(getSetting()->currency->code ?? 'BDT', 'INR', $cart->price),
                    'order' => uniqid() . "_" . rand(1, 1000),
                ];

                $payment = new PaytmController();
                return $payment->subscription($userData);


            } //payment getway


            elseif ($request->payment_method == "PayStack") {


                try {
                    return Paystack::getAuthorizationUrl()->redirectNow();

                } catch (\Exception $e) {

                    Toastr::error($e->getMessage(), trans('common.Failed'));
                    return redirect()->route('courseSubscriptionCheckout');
                }


            } //payment getway

            elseif ($request->payment_method == "Wallet") {


                $payment = new WalletController();
                $response = $payment->subscription($request);

                if ($response['type'] == "error") {
                    Toastr::error($response['message'], 'Error');
                    return redirect()->route('courseSubscriptionCheckout');
                }

                $payWithWallet = $this->payWithGateWay($response['response'], "Wallet");

                if ($payWithWallet) {
                    Toastr::success('Payment done successfully', 'Success');
                    return redirect(route('studentDashboard'));
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return redirect()->route('courseSubscriptionCheckout');
                }

            }
        } catch (\Exception $e) {

            Toastr::error('Something went wrong.', 'Failed');
            return redirect()->route('courseSubscriptionCheckout');
        }


    }

    public function paypalSubscriptionSuccess(Request $request)
    {


        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->payPalGateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // The customer has successfully paid.
                $arr_body = $response->getData();
                $payWithPapal = $this->payWithGateWay($arr_body, "PayPal");
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

    public function paypalSubscriptionFailed()
    {
        Toastr::error('User is canceled the payment.', 'Failed');
        return redirect()->back();
    }

    public static function payWithGateWay($response, $gateWayName)
    {
        try {

            if (Auth::check()) {
                $user = Auth::user();
                $cart = SubscriptionCart::where('user_id', $user->id)->first();

                if ($cart) {
                    $plan = SubscriptionCart::where('plan_id', $cart->plan_id)->first();
                    $bill = BillingDetails::where('id', $cart->billing_detail_id)->first();

                    if (!$bill) {
                        Toastr::error('Billing address not found', 'Error');
                        return false;
                    }
                    if ($plan) {
                        $start_date = Carbon::now();
                        $end_date = $start_date->addDays($plan->days);
                        $subCheckout = SubscriptionCheckout::where('tracking', $cart->tracking)->first();

                        if (!$subCheckout) {
                            $subCheckout = new SubscriptionCheckout();
                        }
                        $subCheckout->user_id = $user->id;
                        $subCheckout->plan_id = $plan->plan_id;
                        $subCheckout->price = $plan->price;
                        $subCheckout->billing_detail_id = $bill->id;
                        $subCheckout->tracking = $bill->tracking_id;
                        $subCheckout->start_date = Carbon::now();
                        $subCheckout->end_date = $end_date;
                        $subCheckout->days = $plan->days;
                        $subCheckout->payment_method = $gateWayName;
                        $subCheckout->status = 1;
                        $subCheckout->response = json_encode($response);
                        $subCheckout->save();

                        Toastr::success('Checkout Successfully Done', 'Success');

                        $user->subscription_validity_date = $end_date;
                        $user->save();
                        $plan->delete();

                        DB::table('course_enrolleds')
                            ->where('subscription', '=', 1)
                            ->where('user_id', $user->id)
                            ->update(['subscription_validity_date' => $end_date]);


                        return true;


                        /*send_email($instractor, 'Enroll_notify_Instructor', [
                            'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                            'course' => $course->title,
                            'currency' => $instractor->currency->symbol ?? '$',
                            'price' => ($instractor->currency->conversion_rate * $cart->price),
                            'rev' => @$reveune,
                        ]);*/
                    } else {
                        Toastr::error('Something Went Wrong', 'Error');
                        return false;
                    }
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return false;
                }


            } else {
                Toastr::error('You must login', 'Error');
                return false;
            }


        } catch (\Exception $e) {

            Toastr::error('Something Went Wrong', 'Error');
            return false;

        }
    }


}
