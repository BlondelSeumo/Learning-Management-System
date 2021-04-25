<?php

namespace Modules\Paytm\Http\Controllers;

use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionPaymentController;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class PaytmController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('paytm::index');
    }


    public function payment($data)
    {

        $payment = PaytmWallet::with('receive');
        $payment->prepare([
            'order' => $data['order'],
            'user' => $data['user'],
            'mobile_number' => $data['mobile'],
            'email' => $data['email'],
            'amount' => $data['amount'],
            'callback_url' => route('paytmStatus'),
        ]);

        return $response = $payment->receive();

    }

    public function paymentCallback()
    {
        try {

            $transaction = PaytmWallet::with('receive');

            $response = $transaction->response();


            if ($transaction->isSuccessful()) {
                $payment = new PaymentController();
                $payWithPayTM = $payment->payWithGateWay($response, "PayTM");
                if ($payWithPayTM) {
                    Toastr::success('Payment done successfully', 'Success');
                    return redirect(route('studentDashboard'));
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return Redirect::back();
                }

            } else if ($transaction->isFailed()) {
                Toastr::error('Your payment is failed', 'Error');
                return Redirect::back();

            } else {

                Toastr::error($transaction->getResponseMessage(), 'Error');
                return redirect(route('studentDashboard'));
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect(route('studentDashboard'));
        }


    }


    public function deposit($data)
    {

        $payment = PaytmWallet::with('receive');
        $payment->prepare([
            'order' => $data['order'],
            'user' => $data['user'],
            'mobile_number' => $data['mobile'],
            'email' => $data['email'],
            'amount' => $data['amount'],
            'callback_url' => route('paytmDepositStatus'),
        ]);

        return $response = $payment->receive();

    }

    public function depositCallback()
    {
        try {

            $transaction = PaytmWallet::with('receive');

            $response = $transaction->response();


            if ($transaction->isSuccessful()) {
                $payment = new DepositController();
                $amount = round(convertCurrency($response['CURRENCY'], strtoupper(getSetting()->currency->code ?? 'BDT'), $response['TXNAMOUNT']));

                $payWithPayTM = $payment->depositWithGateWay($amount, $response, "PayTM");
                if ($payWithPayTM) {
                    Toastr::success('Payment done successfully', 'Success');
                    return redirect(route('studentDashboard'));
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return Redirect::back();
                }

            } else if ($transaction->isFailed()) {
                Toastr::error('Your payment is failed', 'Error');
                return Redirect::back();

            } else {

                Toastr::error($transaction->getResponseMessage(), 'Error');
                return redirect(route('studentDashboard'));
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect(route('studentDashboard'));
        }


    }


    public function subscription($data)
    {

        $payment = PaytmWallet::with('receive');
        $payment->prepare([
            'order' => $data['order'],
            'user' => $data['user'],
            'mobile_number' => $data['mobile'],
            'email' => $data['email'],
            'amount' => $data['amount'],
            'callback_url' => route('paytmSubscriptionStatus'),
        ]);

        return $response = $payment->receive();

    }

    public function subscriptionCallback()
    {
        try {
            $transaction = PaytmWallet::with('receive');

            $response = $transaction->response();


            if ($transaction->isSuccessful()) {
                $payment = new SubscriptionPaymentController();

                $payWithPayTM = $payment->payWithGateWay($response, "PayTM");
                if ($payWithPayTM) {
                    Toastr::success('Payment done successfully', 'Success');
                    return redirect(route('studentDashboard'));
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return Redirect::back();
                }

            } else if ($transaction->isFailed()) {
                Toastr::error('Your payment is failed', 'Error');
                return Redirect::back();

            } else {

                Toastr::error($transaction->getResponseMessage(), 'Error');
                return redirect(route('studentDashboard'));
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect(route('studentDashboard'));
        }


    }

}
