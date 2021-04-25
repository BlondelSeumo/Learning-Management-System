<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\CourseSetting\Entities\Course;
use Modules\PaymentMethodSetting\Entities\PaymentMethod;
use Modules\SystemSetting\Entities\GeneralSettings;


class PaymentController extends Controller
{

    public function setCommission()
    {
        try {

            $courses = Course::whereNotNull('special_commission')->with('user', 'enrolls')->paginate(10);
            $allcourses = Course::all();
            $commission = GeneralSettings::first();
            $instructors = User::whereNotNull('special_commission')->whereIn('role_id', [1, 2])->paginate(10);
            $instructor_commission = 100 - $commission->commission;
            $users = User::whereIn('role_id', [1, 2])->get();


            return view('payment::commission', compact('users', 'allcourses', 'courses', 'commission', 'users', 'instructor_commission', 'instructors'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    public function courseFees()
    {
        try {

            $courses = Course::whereNotNull('special_commission')->with('user', 'enrolls')->paginate(10);
            $allcourses = Course::all();
            $commission = GeneralSettings::first();
            $users = User::where('role_id', 2)->get();
            $instructors = User::whereNotNull('special_commission')->wherehas('courses')->paginate(10);
            $instructor_commission = 100 - $commission->commission;

            return view('payment::flat_commission', compact('allcourses', 'courses', 'commission', 'users', 'instructor_commission', 'instructors'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }

    }

    public function instructorCommission()
    {
        try {

            $courses = Course::whereNotNull('special_commission')->with('user', 'enrolls')->paginate(10);
            $allcourses = Course::all();
            $commission = GeneralSettings::first();
            $users = User::where('role_id', 2)->get();
            $instructors = User::where('role_id', 2)->get();
            $instructor_commission = 100 - $commission->commission;
            // return $courses;
            return view('payment::instructor_commission', compact('allcourses', 'courses', 'commission', 'users', 'instructor_commission', 'instructors'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }

    }

    public function courseCommissionView()
    {
        try {

            $courses = Course::whereNotNull('special_commission')->with('user', 'enrolls')->paginate(10);
            $allcourses = Course::all();
            $commission = GeneralSettings::first();
            $users = User::where('role_id', 2)->get();
            $instructors = User::whereNotNull('special_commission')->wherehas('courses')->paginate(10);
            $instructor_commission = 100 - $commission->commission;
            // return $courses;
            return view('payment::course_commission', compact('allcourses', 'courses', 'commission', 'users', 'instructor_commission', 'instructors'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }

    }


    public function courseCommission(Request $request)
    {


        $request->validate([
            'course_commission' => 'required|numeric|min:0|max:100',
            'course' => 'required',
        ]);
        try {
            $course = Course::find($request->course);
            $course->special_commission = $request->course_commission;
            $course->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back()->with(['course' => 'course', 'course_id' => $request->course, 'amount' => $request->course_commission]);


        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }

    }

    public function saveFlat(Request $request)
    {
        $request->validate([
            'commission' => 'required|numeric|min:0|max:100',
        ]);
        try {
            // $success = trans('lang.Flat Commission').' '.trans('Updated').' '.trans('lang.Successfully');
            $gnl = GeneralSettings::first();
            $gnl->commission = $request->commission;
            $gnl->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }

    }

    public function instructor_commission(Request $request)
    {


        $request->validate([
            'special_commission' => 'required|numeric|min:0|max:100',
            'user_id' => 'required',
        ]);


        try {

            $user = User::where('id', $request->user_id)->first();
            $user->special_commission = $request->special_commission;
            $user->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back()->with(['instructor' => 'instructor', 'user_id' => $request->user_id, 'amount' => $request->special_commission]);
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }


    public function setPayout()
    {
        $user = Auth::user();
        $payment_methods = PaymentMethod::where('active_status', 1)->where('module_status', 1)
            ->where('method', '!=', 'Offline Payment')->where('method', '!=', 'Wallet')->get();
        return view('payment::set_payout', compact('payment_methods', 'user'));
    }

    public function savePayout(Request $request)
    {

        if ($request->payout == "Bank Payment") {
            $request->validate([
                'bank_name' => 'required',
                'branch_name' => 'required',
                'bank_account_number' => 'required',
                'account_holder_name' => 'required',
                'bank_type' => 'required',
            ]);
        } else {
            $request->validate([
                'payout_email' => 'required|email'
            ]);
        }


        $user = User::find(auth()->id());
        $user->payout = $request->payout;
        if ($request->payout == "Bank Payment") {
            $user->bank_name = $request->bank_name;
            $user->branch_name = $request->branch_name;
            $user->bank_account_number = $request->bank_account_number;
            $user->account_holder_name = $request->account_holder_name;
            $user->bank_type = $request->bank_type;
            $user->payout_icon = '';
            $user->payout_email = '';
        } else {

            $user->bank_name = '';
            $user->branch_name = '';
            $user->bank_account_number = '';
            $user->account_holder_name = '';
            $user->bank_type = '';
            $user->payout_icon = $request->payout_icon;
            $user->payout_email = $request->payout_email;
        }

        $user->save();

        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
        return redirect()->route('admin.instructor.payout');
    }
}
