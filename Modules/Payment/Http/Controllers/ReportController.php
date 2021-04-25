<?php

namespace Modules\Payment\Http\Controllers;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\CourseSetting\Entities\Course;
use Modules\Payment\Entities\Checkout;
use Modules\Payment\Entities\Withdraw;
use Modules\PaymentMethodSetting\Entities\PaymentMethod;


class ReportController extends Controller
{
    public function instructorReveune()
    {

        try {
            $enrolls = Course::withCount('enrolls')->where('user_id', Auth::id())->with('enrolls', 'category', 'subcategory')->
            orderBy('enrolls_count', 'desc')->paginate(10);
            $user = User::with('currency')->where('id', Auth::user()->id)->first();
            return view('payment::instructor_revenue', compact('enrolls', 'user'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }


    public function withdraws()
    {

        try {
            $logs = Withdraw::with('user')->orderBy('status', 'asc')->latest()->get();
            return view('payment::fund.instructor_payout', compact('logs'));

        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }


    public function onlineLog()
    {
        try {
            $gateways = PaymentMethod::where('method', '!=', 'Offline Payment')->get();
            $onlineLogs = Checkout::where('payment_method', '!=', 'Offline Payment')
                ->with('user')->paginate(15);
            return view('payment::fund.online_log', compact('gateways', 'onlineLogs'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }


    public function filterSearch(Request $request)
    {

        try {
            $gateways = PaymentMethod::where('method', '!=', 'Offline Payment')->get();
            $start = date('Y-m-d', strtotime($request->start_date));
            $end = date('Y-m-d', strtotime($request->end_date));
            $method = $request->methods;

            if ((isset($request->end_date)) && (isset($request->start_date))) {

                if ($method == "all") {

                    $onlineLogs = Checkout::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->where('payment_method', '!=', 'Offline Payment')->latest()->with('user')->get();
                } else {

                    $onlineLogs = Checkout::whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->where('payment_method', $method)->latest()->with('user')->get();

                }
            } elseif (is_null($request->start_date) && is_null($request->end_date)) {

                if ($method == "all") {

                    $onlineLogs = Checkout::where('payment_method', '!=', 'Offline Payment')->with('user')->get();
                } else {

                    $onlineLogs = Checkout::where('payment_method', $method)->latest()->with('user')->get();

                }
            } elseif (isset($request->start_date) && is_null($request->end_date)) {


                if ($method == "all") {

                    $onlineLogs = Checkout::whereDate('created_at', '>=', $start)->where('payment_method', '!=', 'Offline Payment')->latest()->with('user')->get();
                } else {

                    $onlineLogs = Checkout::whereDate('created_at', '>=', $start)->where('payment_method', $method)->latest()->with('user')->get();

                }

            } elseif (isset($request->end_date) && is_null($start)) {

                if ($method == "all") {

                    $onlineLogs = Checkout::whereDate('created_at', '<=', $end)->where('payment_method', '!=', 'Offline Payment')->latest()->with('user')->get();
                } else {

                    $onlineLogs = Checkout::whereDate('created_at', '<=', $end)->where('payment_method', $method)->latest()->with('user')->get();

                }
            }
            return view('payment::fund.online_Log', compact('gateways', 'onlineLogs'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }


    }

}







