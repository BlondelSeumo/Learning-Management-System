<?php

namespace Modules\PaymentMethodSetting\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;
use Modules\ModuleManager\Entities\InfixModuleManager;
use Modules\ModuleManager\Entities\Module;
use Modules\PaymentMethodSetting\Entities\PaymentGatewaySetting;
use Modules\PaymentMethodSetting\Entities\PaymentMethod;
use Twilio\TwiML\Voice\Redirect;

class PaymentMethodSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $payment_methods = PaymentMethod::where('module_status', '=', 1)->get();
        return view('paymentmethodsetting::index', compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('paymentmethodsetting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('paymentmethodsetting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('paymentmethodsetting::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }


        try {


            $method = PaymentMethod::find($request->payment_method_id);

            if ($request->hasFile('logo')) {
                $name = md5(time() . rand(0, 1000)) . '.' . 'png';
                $img = Image::make($request->logo);

                $upload_path = 'public/uploads/gateway/';
                $img->save($upload_path . $name);
                $method->logo = 'public/uploads/gateway/' . $name;
            }
            $method->save();


            if ($method->method == 'Sslcommerz') {
                $key1 = 'STORE_ID';
                $key2 = 'STORE_PASSWORD';
                $key3 = 'IS_LOCALHOST';
                $value1 = trim($request->ssl_store_id);
                $value2 = trim($request->ssl_store_password);
                if ($request->ssl_mode == 2) {
                    $value3 = "false";
                } else {
                    $value3 = "true";
                }
                $resultStoreId = putEnvConfigration($key1, $value1);

                $resultStorePass = putEnvConfigration($key2, $value2);

                $resultStoreIsLocal = putEnvConfigration($key3, $value3);

                if (!$resultStoreId || !$resultStorePass || !$resultStoreIsLocal) {
                    Toastr::error("Something went wrong", 'Failed');
                    return redirect()->back();
                }
            } elseif ($method->method == 'PayPal') {
                $key1 = 'PAYPAL_CLIENT_ID';
                $key2 = 'PAYPAL_CLIENT_SECRET';
                $key3 = 'IS_PAYPAL_LOCALHOST';
                $value1 = trim($request->paypal_client_id);
                $value2 = trim($request->paypal_client_secret);
                if ($request->paypal_mode == 2) {
                    $value3 = "false";
                } else {
                    $value3 = "true";
                }
                $clientId = putEnvConfigration($key1, $value1);

                $clientSecret = putEnvConfigration($key2, $value2);

                $resultIsLocal = putEnvConfigration($key3, $value3);

                if (!$clientId || !$clientSecret || !$resultIsLocal) {
                    Toastr::error("Something went wrong", 'Failed');
                    return redirect()->back();
                }
            } elseif ($method->method == 'Stripe') {


                $key1 = 'STRIPE_SECRET';
                $key2 = 'STRIPE_KEY';


                $value1 = trim($request->client_secret);
                $value2 = trim($request->client_publisher_key);


                $secret = putEnvConfigration($key1, $value1);

                $key = putEnvConfigration($key2, $value2);

                if (!$secret || !$key) {
                    Toastr::error("Something went wrong", 'Failed');
                    return redirect()->back();
                }
            } elseif ($method->method == 'RazorPay') {


                $key1 = 'RAZOR_KEY';
                $key2 = 'RAZOR_SECRET';


                $value1 = trim($request->razor_key);
                $value2 = trim($request->razor_secret);


                $secret = putEnvConfigration($key1, $value1);

                $key = putEnvConfigration($key2, $value2);

                if (!$secret || !$key) {
                    Toastr::error("Something went wrong", 'Failed');
                    return redirect()->back();
                }
            } elseif ($method->method == 'PayStack') {
                $key1 = 'PAYSTACK_PUBLIC_KEY';
                $key2 = 'PAYSTACK_SECRET_KEY';
                $key3 = 'PAYSTACK_PAYMENT_URL';
                $key4 = 'MERCHANT_EMAIL';


                $value1 = trim($request->paystack_key);
                $value2 = trim($request->paystack_secret);
                $value3 = trim($request->paystack_payment_url);
                $value4 = trim($request->merchant_email);


                $key = putEnvConfigration($key1, $value1);
                $secret = putEnvConfigration($key2, $value2);
                $url = putEnvConfigration($key3, $value3);
                $email = putEnvConfigration($key4, $value4);
                if (!$secret || !$key || !$url || !$email) {
                    Toastr::error("Something went wrong", 'Failed');
                    return redirect()->back();
                }
            } elseif ($method->method == 'PayTM') {
                $key1 = 'PAYTM_ENVIRONMENT';
                $key2 = 'PAYTM_MERCHANT_ID';
                $key3 = 'PAYTM_MERCHANT_KEY';
                $key4 = 'PAYTM_MERCHANT_WEBSITE';
                $key5 = 'PAYTM_CHANNEL';
                $key6 = 'PAYTM_INDUSTRY_TYPE';


                $value1 = trim($request->paytm_mode);
                $value2 = trim($request->paytm_merchant_id);
                $value3 = trim($request->paytm_merchant_key);
                $value4 = trim($request->paytm_merchant_website);
                $value5 = trim($request->paytm_channel);
                $value6 = trim($request->industry_type);


                $mode = putEnvConfigration($key1, $value1);
                $id = putEnvConfigration($key2, $value2);
                $key = putEnvConfigration($key3, $value3);
                $website = putEnvConfigration($key4, $value4);
                $channel = putEnvConfigration($key5, $value5);
                $type = putEnvConfigration($key6, $value6);
                if (!$mode || !$id || !$key || !$website || !$channel || !$type) {
                    Toastr::error("Something went wrong", 'Failed');
                    return redirect()->back();
                }
            } elseif ($method->method == 'Bank Payment') {
                $key1 = 'BANK_NAME';
                $key2 = 'BRANCH_NAME';
                $key3 = 'ACCOUNT_NUMBER';
                $key4 = 'ACCOUNT_HOLDER';
                $key5 = 'ACCOUNT_TYPE';


                $value1 = trim($request->bank_name);
                $value2 = trim($request->branch_name);
                $value3 = trim($request->account_number);
                $value4 = trim($request->account_holder);
                $value5 = trim($request->type);


                $bank_name = putEnvConfigration($key1, $value1);
                $branch_name = putEnvConfigration($key2, $value2);
                $account_name = putEnvConfigration($key3, $value3);
                $account_holder = putEnvConfigration($key4, $value4);
                $account_type = putEnvConfigration($key5, $value5);

                if (!$bank_name || !$branch_name || !$account_name || !$account_holder || !$account_type) {
                    Toastr::error("Something went wrong", 'Failed');
                    return redirect()->back();
                }
            }

            Toastr::success("Operation Successful", 'Success');
            return redirect()->back();


        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function changePaymentGatewayStatus(Request $request)
    {
        try {
            $gateway_ids = $request->gateways;
            $allGateways = PaymentMethod::all();

            foreach ($allGateways as $gateway) {

//                $hasModule =

                if (in_array($gateway->id, $gateway_ids)) {

                    if ($gateway->type != "System") {
                        $valid = InfixModuleManager::where('name', $gateway->method)->first();
                        if (!empty($valid)) {
                            $active = Module::where('name', $gateway->name)->first();
                            if (!empty($active) && $active->status == 1) {
                                $gateway->active_status = 1;
                            } else {
                                Toastr::error($gateway->method . ' Not Active', "error");
                                return redirect()->back();
                            }
                        } else {
                            Toastr::error($gateway->method . ' Not Verified yet', "error");
                            return redirect()->back();
                        }
                    } else {
                        $gateway->active_status = 1;

                    }


                } else {
                    $gateway->active_status = 0;
                }
                $gateway->save();

            }
            Toastr::success("Status Updated", "Success");
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error("Operation Failed", "error");
            return redirect()->back();
        }

    }
}
