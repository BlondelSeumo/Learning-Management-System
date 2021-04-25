<?php

namespace Modules\Razorpay\Http\Controllers;

use Brian2694\Toastr\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function create()
    {

        return view('razorpay::create');
    }

    public function payment($razorpay_payment_id)
    {


        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($razorpay_payment_id);


        try {
            $response['type'] = 'success';
            $response['response'] = $api->payment->fetch($razorpay_payment_id)->capture(array('amount' => $payment['amount']));
            return $response;
        } catch (\Exception $e) {
            $response['type'] = 'error';
            $response['message'] = $e->getMessage();
        }
        return $response;


    }
}
