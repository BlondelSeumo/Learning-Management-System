<?php

namespace App\Http\Controllers;

use App\BillingDetails;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Library\SslCommerz\SslCommerzNotification;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Modules\Coupons\Entities\UserWiseCoupon;
use Modules\Coupons\Entities\UserWiseCouponSetting;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseEnrolled;
use Modules\CourseSetting\Entities\Notification;
use Modules\Payment\Entities\Cart;
use Modules\Payment\Entities\Checkout;
use Modules\Payment\Entities\InstructorPayout;
use Modules\PaymentMethodSetting\Entities\PaymentMethod;
use Modules\Paytm\Http\Controllers\PaytmController;
use Modules\Razorpay\Http\Controllers\RazorpayController;
use Modules\SystemSetting\Entities\GeneralSettings;
use Modules\Wallet\Http\Controllers\WalletController;
use Omnipay\Omnipay;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    public $payPalGateway;

    public function __construct()
    {
        $this->payPalGateway = Omnipay::create('PayPal_Rest');
        $this->payPalGateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->payPalGateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->payPalGateway->setTestMode(env('IS_PAYPAL_LOCALHOST')); //set it to 'false' when go live
    }


    public function makePlaceOrder(Request $request)
    {
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
            }

            $bill->user_id = Auth::id();
            $bill->tracking_id = $request->tracking_id;
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


        $checkout_info = Checkout::where('id', $request->id)->where('tracking', $request->tracking_id)->with('user')->first();
        $carts = Cart::where('tracking', $checkout_info->tracking)->get();
        if ($checkout_info) {
            $checkout_info->billing_detail_id = $bill->id;
            $checkout_info->save();

            if ($checkout_info->purchase_price == 0) {
                $checkout_info->payment_method = 'None';
                $bill->payment_method = 'None';
                $checkout_info->save();
                foreach ($carts as $cart) {
                    $this->directEnroll($cart->course_id, $checkout_info->tracking);
                    $cart->delete();
                }

                Toastr::success('Checkout Successfully Done', 'Success');
                return redirect(route('studentDashboard'));
            } else {
                return redirect()->route('orderPayment');

            }
        } else {
            Toastr::error("Something Went Wrong", 'Failed');
            return \redirect()->back();
        }
//        payment method start skip for now


    }


    public function payment()
    {
        try {
            $profile = Auth::user();
            $bills = BillingDetails::with('country')->where('user_id', Auth::id())->get();

            $countries = DB::table('countries')->select('id', 'name')->get();
            $cities = DB::table('spn_cities')->where('country_id', $profile->country)->select('id', 'name')->get();
            $webController = new WebsiteController();
            $data = $webController->common();

            $tracking = Cart::where('user_id', Auth::id())->first()->tracking;
            $total = Cart::where('user_id', Auth::user()->id)->sum('price');
            $checkout = Checkout::where('tracking', $tracking)->where('user_id', Auth::id())->latest()->first();
            if (empty($checkout->billing_detail_id)) {
                Toastr::error('Billing Details ', 'Failed');
                return redirect()->route('CheckOut');
            }


            $methods = PaymentMethod::where('active_status', 1)->where('module_status', 1)->where('method', '!=', 'Offline Payment')->get(['method', 'logo']);

            $carts = Cart::where('user_id', Auth::id())->with('course', 'course.user')->get();

            return view(theme('payment'), $data, compact('methods', 'bills', 'checkout', 'profile', 'countries', 'cities', 'carts'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function paymentSubmit(Request $request)
    {

        if (demoCheck()) {
            return redirect()->back();
        }

        $checkout_info = Checkout::where('id', $request->id)->where('tracking', $request->tracking_id)->with('user')->first();

        if (!empty($checkout_info)) {
            if ($request->payment_method == "Sslcommerz") {


                $post_data = array();
                $post_data['total_amount'] = $checkout_info->purchase_price; # You cant not pay less than 10
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
                $post_data['value_a'] = $checkout_info->id;
                $post_data['value_b'] = $checkout_info->tracking;
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
                }

            } elseif ($request->payment_method == "PayPal") {

                try {
                    $response = $this->payPalGateway->purchase(array(
                        'amount' => convertCurrency(getSetting()->currency->code ?? 'BDT', 'USD', $checkout_info->purchase_price),
                        'currency' => 'USD',
                        'returnUrl' => route('paypalSuccess'),
                        'cancelUrl' => route('paypalFailed'),

                    ))->send();

                    if ($response->isRedirect()) {
                        $response->redirect(); // this will automatically forward the customer
                    } else {
                        Toastr::error($response->getMessage(), trans('common.Failed'));
                        return \redirect()->back();
                    }
                } catch (\Exception $e) {
                    Toastr::error("Something Went Wrong", 'Failed');
                    return \redirect()->back();
                }

            } //paypel payment getaway
            elseif ($request->payment_method == "Stripe") {

                $request->validate([
                    'stripeToken' => 'required'
                ]);
                $token = $request->stripeToken ?? '';
                $gatewayStripe = Omnipay::create('Stripe');
                $gatewayStripe->setApiKey(env('STRIPE_SECRET'));

//            $formData = array('number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2030', 'cvv' => '123');
                $response = $gatewayStripe->purchase(array(
                    'amount' => convertCurrency(getSetting()->currency->code ?? 'BDT', 'USD', $checkout_info->purchase_price),
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
                        return \redirect()->back();
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
                    return \redirect()->back();
                }

                $payment = new RazorpayController();
                $response = $payment->payment($request->razorpay_payment_id);

                if ($response['type'] == "error") {
                    Toastr::error($response['message'], 'Error');
                    return \redirect()->back();
                }

                $payWithRazorPay = $this->payWithGateWay($response['response'], "RazorPay");

                if ($payWithRazorPay) {
                    Toastr::success('Payment done successfully', 'Success');
                    return redirect(route('studentDashboard'));
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return \redirect()->back();
                }


            } //payment getway
            elseif ($request->payment_method == "PayTM") {


                $userData = [
                    'user' => $checkout_info['tracking'],
                    'mobile' => $checkout_info->billing->phone,
                    'email' => $checkout_info->billing->email,
                    'amount' => convertCurrency(getSetting()->currency->code ?? 'BDT', 'INR', $checkout_info->purchase_price),
                    'order' => $checkout_info->billing->phone . "_" . rand(1, 1000),
                ];

                $payment = new PaytmController();
                return $payment->payment($userData);


            } //payment getway


            elseif ($request->payment_method == "PayStack") {

                try {
                    return Paystack::getAuthorizationUrl()->redirectNow();

                } catch (\Exception $e) {
                    Toastr::error($e->getMessage(), trans('common.Failed'));
                    return Redirect::back();
                }


            } //payment getway

            elseif ($request->payment_method == "Wallet") {


                $payment = new WalletController();
                $response = $payment->payment($request);

                if ($response['type'] == "error") {
                    Toastr::error($response['message'], 'Error');
                    return \redirect()->back();
                }

                $payWithWallet = $this->payWithGateWay($response['response'], "Wallet");

                if ($payWithWallet) {
                    Toastr::success('Payment done successfully', 'Success');
                    return redirect(route('studentDashboard'));
                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return \redirect()->back();
                }

            }

        } else {
            Toastr::error('Something went wrong', 'Failed');
            return Redirect::back();
        }


    }


    public function directEnroll($id, $tracking = null)
    {
        try {
            $success = trans('lang.Enrolled') . ' ' . trans('lang.Successfully');
            $course = Course::find($id);
            $user = Auth::user();


            $enrolled = $course->total_enrolled;
            $course->total_enrolled = ($enrolled + 1);

            $enroll = new CourseEnrolled();
            $instractor = User::find($course->user_id);
            $enroll->user_id = $user->id;
            $enroll->course_id = $course->id;
            $enroll->purchase_price = $course->price;
            $enroll->coupon = null;
            $enroll->discount_amount = 0.00;
            if (!empty($tracking))
                $enroll->tracking = $tracking;
            $enroll->status = 1;

            if (!is_null($course->special_commission)) {
                $commission = $course->special_commission;
                $reveune = ($course->price * $commission) / 100;
                $enroll->reveune = $reveune;
            } elseif (!is_null($instractor->special_commission)) {
                $commission = $instractor->special_commission;
                $reveune = ($course->price * $commission) / 100;
                $enroll->reveune = $reveune;
            } else {
                $commission = GeneralSettings::first()->commission;
                $reveune = ($course->price * $commission) / 100;
                $enroll->reveune = $reveune;
            }
            if (moduleStatusCheck('Subscription')) {
                if (isSubscribe()) {
                    $enroll->subscription = 1;

                    $enroll->subscription_validity_date = $user->subscription_validity_date;
                }
            }


            send_email($user, 'Course_Enroll_Payment', [
                'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                'course' => $course->title,
                'price' => getPriceFormat($course->price),
                'instructor' => $course->user->name,
                'gateway' => 'None',
            ]);

            send_email($user, 'Enroll_notify_Instructor', [
                'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                'course' => $course->title,
                'price' => getPriceFormat($course->price),
                'rev' => getPriceFormat($reveune ?? 0)
            ]);


            $enroll->save();
            $course->reveune = (($course->reveune) + ($enroll->reveune));
            $course->save();

            return response()->json([
                'success' => $success
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => trans("lang.Operation Failed")]);
        }

    }


    public function paypalSuccess(Request $request)
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

    public function paypalFailed()
    {
        // return 'User is canceled the payment.';
        Toastr::error('User is canceled the payment.', 'Failed');
        return redirect()->back();
    }

    public static function payWithGateWay($response, $gateWayName)
    {
        try {


            if (Auth::check()) {
                $user = Auth::user();
                $track = Cart::where('user_id', $user->id)->first()->tracking;
                $total = Cart::where('user_id', Auth::user()->id)->sum('price');
                $checkout_info = Checkout::where('tracking', $track)->where('user_id', $user->id)->latest()->first();


                if (isset($checkout_info)) {

                    $discount = $checkout_info->discount;

                    $carts = Cart::where('tracking', $track)->get();

                    foreach ($carts as $cart) {


                        $course = Course::find($cart->course_id);
                        $enrolled = $course->total_enrolled;
                        $course->total_enrolled = ($enrolled + 1);

                        //==========================Start Referral========================
                        $purchase_history = CourseEnrolled::where('user_id', Auth::user()->id)->first();
                        $referral_check = UserWiseCoupon::where('invite_accept_by', Auth::user()->id)->where('category_id', null)->where('course_id', null)->first();
                        $referral_settings = UserWiseCouponSetting::where('role_id', Auth::user()->role_id)->first();

                        if ($purchase_history == null && $referral_check != null) {
                            $referral_check->category_id = $course->category_id;
                            $referral_check->subcategory_id = $course->subcategory_id;
                            $referral_check->course_id = $course->id;
                            $referral_check->save();
                            $percentage_cal = ($referral_settings->amount / 100) * $checkout_info->price;

                            if ($referral_settings->type == 1) {
                                if ($checkout_info->price > $referral_settings->max_limit) {
                                    $bonus_amount = $referral_settings->max_limit;
                                } else {
                                    $bonus_amount = $referral_settings->amount;
                                }
                            } else {
                                if ($percentage_cal > $referral_settings->max_limit) {
                                    $bonus_amount = $referral_settings->max_limit;
                                } else {
                                    $bonus_amount = $percentage_cal;
                                }
                            }

                            $referral_check->bonus_amount = $bonus_amount;
                            $referral_check->save();

                            $invite_by = User::find($referral_check->invite_by);
                            $invite_by->balance += $bonus_amount;
                            $invite_by->save();

                            $invite_accept_by = User::find($referral_check->invite_accept_by);
                            $invite_accept_by->balance += $bonus_amount;
                            $invite_accept_by->save();
                        }
                        //==========================End Referral========================
                        if ($discount != 0 || !empty($discount)) {
                            $itemPrice = $cart->price - ($discount / count($carts));
                            $discount_amount = $cart->price - $itemPrice;
                        } else {
                            $itemPrice = $cart->price;
                            $discount_amount = 0.00;
                        }
                        $enroll = new CourseEnrolled();
                        $instractor = User::find($cart->instructor_id);
                        $enroll->user_id = $user->id;
                        $enroll->tracking = $track;
                        $enroll->course_id = $course->id;
                        $enroll->purchase_price = $itemPrice;
                        $enroll->coupon = null;
                        $enroll->discount_amount = $discount_amount;
                        $enroll->status = 1;


                        if (!is_null($course->special_commission)) {
                            $commission = $course->special_commission;
                            $reveune = ($cart->price * $commission) / 100;
                            $enroll->reveune = $reveune;
                        } elseif (!is_null($instractor->special_commission)) {
                            $commission = $instractor->special_commission;
                            $reveune = ($cart->price * $commission) / 100;
                            $enroll->reveune = $reveune;
                        } else {

                            $commission = GeneralSettings::first()->commission;
                            $reveune = ($cart->price * $commission) / 100;
                            $enroll->reveune = $reveune;
                        }

                        $payout = new InstructorPayout();
                        $payout->instructor_id = $course->user_id;
                        $payout->reveune = $reveune;
                        $payout->status = 0;
                        $payout->save();


                        send_email($checkout_info->user, 'Course_Enroll_Payment', [
                            'time' => \Illuminate\Support\Carbon::now()->format('d-M-Y ,s:i A'),
                            'course' => $course->title,
                            'currency' => $checkout_info->user->currency->symbol ?? '$',
                            'price' => ($checkout_info->user->currency->conversion_rate * $cart->price),
                            'instructor' => $course->user->name,
                            'gateway' => 'Sslcommerz',
                        ]);;
                        send_email($instractor, 'Enroll_notify_Instructor', [
                            'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                            'course' => $course->title,
                            'currency' => $instractor->currency->symbol ?? '$',
                            'price' => ($instractor->currency->conversion_rate * $cart->price),
                            'rev' => @$reveune,
                        ]);


                        $enroll->save();

                        $course->reveune = (($course->reveune) + ($enroll->reveune));

                        $course->save();

                        $notification = new Notification();
                        $notification->author_id = $course->user_id;
                        $notification->user_id = $checkout_info->user->id;
                        $notification->course_id = $course->id;
                        $notification->course_enrolled_id = $enroll->id;
                        $notification->status = 0;

                        $notification->save();

                    }

                    $checkout_info->payment_method = $gateWayName;
                    $checkout_info->status = 1;
                    $checkout_info->response = json_encode($response);
                    $checkout_info->save();

                    //            $user->save();


                    if ($checkout_info->user->status == 1) {

                        foreach ($carts as $old) {
                            $old->delete();
                        }
                    }
                    Toastr::success('Checkout Successfully Done', 'Success');
                    return true;

                } else {
                    Toastr::error('Something Went Wrong', 'Error');
                    return false;
                }

            } else {
                Toastr::error('Something Went Wrong', 'Error');
                return false;
            }


        } catch (\Exception $e) {
            Toastr::error('Something Went Wrong', 'Error');
            return false;

        }
    }


}
