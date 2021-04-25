<?php

namespace Modules\PayStack\Http\Controllers;

use App\Http\Controllers\DepositController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionPaymentController;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PayStackController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('paystack::index');
    }

    public function create()
    {
        return view('paystack::create');
    }

    public function redirectToGateway(Request $request)
    {

        try {
            return Paystack::getAuthorizationUrl()->redirectNow();

        } catch (\Exception $e) {

            return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGatewayCallback()
    {


        try {

            $paymentDetails = Paystack::getPaymentData();
            $payWithPayStack = false;
            if ($paymentDetails['status']) {
                $response = $paymentDetails['data'];

                if ($response['metadata']['type'] == "Payment") {
                    $payment = new PaymentController();
                    $payWithPayStack = $payment->payWithGateWay($response, "PayStack");
                } elseif ($response['metadata']['type'] == "Deposit") {
                    $payment = new DepositController();
                    $amount = round(convertCurrency($response['currency'], strtoupper(getSetting()->currency->code ?? 'BDT'), $response['amount'] / 100));

                    $payWithPayStack = $payment->depositWithGateWay($amount, $response, "PayStack");
                } elseif ($response['metadata']['type'] == "Subscription") {
                    $payment = new SubscriptionPaymentController();
                    $amount = round(convertCurrency($response['currency'], strtoupper(getSetting()->currency->code ?? 'BDT'), $response['amount'] / 100));

                    $payWithPayStack =   $payment->payWithGateWay($response, "PayStack");
//                    dd($payWithPayStack);
                }

                if ($payWithPayStack) {
                    Toastr::success('Payment done successfully', 'Success');
                    return redirect(route('studentDashboard'));
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return Redirect::back();
                }

            } else {

                Toastr::error('Something Went Wrong', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error');
            return redirect(route('studentDashboard'));
        }

    }
}
