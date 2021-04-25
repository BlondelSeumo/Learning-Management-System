<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscription;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseEnrolled;
use Modules\Payment\Entities\InstructorPayout;
use Modules\Payment\Entities\Withdraw;
use Modules\Subscription\Entities\SubscriptionCheckout;
use Modules\Subscription\Entities\SubscriptionCourse;

class AdminController extends Controller
{
    public function enrollLogs()
    {
        try {
            $enrolls = CourseEnrolled::with('user', 'course')->latest()->get();
            $courses = Course::all();
            $students = User::where('role_id', 3)->get();
            return view('backend.student.enroll_student', compact('enrolls', 'courses', 'students'));

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function enrollFilter(Request $request)
    {

        try {
            if (!empty($request->course)) {
                $courseId = $request->course;
            } else {
                $courseId = '';
            }
            if (!empty($request->start_date)) {
                $start = date('Y-m-d', strtotime($request->start_date));
            } else {
                $start = '';
            }
            if (!empty($request->end_date)) {
                $end = date('Y-m-d', strtotime($request->end_date));
            } else {
                $end = '';
            }


            if (is_null($request->start_date) && is_null($request->end_date) && (is_null($courseId))) {

                return $this->enrollLogs();

            } elseif ((!is_null($request->start_date)) && (!is_null($request->end_date)) && (!is_null($courseId))) {

                $enrolls = CourseEnrolled::where('course_id', $courseId)->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->with('user', 'course')->latest()->get();
            } elseif (!is_null($request->start_date)) {

                $enrolls = CourseEnrolled::whereDate('created_at', '>=', $start)->with('user', 'course')->latest()->get();
            } elseif (!is_null($request->end_date)) {

                $enrolls = CourseEnrolled::whereDate('created_at', '<=', $end)->with('user', 'course')->latest()->get();
            } elseif (!is_null($courseId)) {

                $enrolls = CourseEnrolled::where('course_id', $courseId)->with('user', 'course')->latest()->get();
            }
            $courses = Course::all();
            $students = User::where('role_id', 3)->get();
            return view('backend.student.enroll_student', compact('courseId', 'start', 'end', 'enrolls', 'courses', 'students'));


        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();


        }
    }

    public function reveuneList()
    {
        try {
            $courses = Course::with('enrolls', 'user')->withCount('enrolls')->get();

            return view('payment::admin_revenue', compact('courses'));
        } catch (\Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);


        }
    }

    public function reveuneListInstructor(Request $request)
    {
        try {
            if (empty($request->instructor)) {
                $search_instructor = '';
            } else {
                $search_instructor = $request->instructor;

            }
            if (empty($request->month)) {
                $search_month = '';
            } else {
                $search_month = $request->month;
            }
            if (empty($request->year)) {
                $search_year = date('Y');
            } else {
                $search_year = $request->year;

            }


            $query = CourseEnrolled::with('course', 'user', 'course.user');

            if (!empty($search_month)) {
                $from = date($search_year . '-' . $search_month . '-30');
                $to = date('Y-m-d');
                $query->whereBetween('created_at', [$from, $to]);
            }

            if (Auth::user()->role_id == 3) {
                $query->where('user_id', '=', Auth::user()->id);
            }

            $enrolls = $query->whereHas('course.user', function ($query) {
                $query->where('id', '!=', 1);
            })->latest()->get();


            $query2 = DB::table('subscription_courses')
                ->select('subscription_courses.*')
                ->selectRaw("SUM(revenue) as total_price");
            if (Auth::user()->role_id == 3) {
                $query2->where('user_id', '=', Auth::user()->id);
            }


            if (moduleStatusCheck('Subscription')) {
                $subscriptionsData = $query2->groupBy('checkout_id')
                    ->latest()->get();;
                $subscriptions = [];
                foreach ($subscriptionsData as $key => $data) {
                    $subscriptions[$key]['checkout_id'] = $data->checkout_id;
                    $subscriptions[$key]['date'] = $data->date;
                    $subscriptions[$key]['price'] = $data->total_price;
                    $user = User::where('id', $data->instructor_id)->first();
                    $subscriptions[$key]['instructor'] = $user->name ?? '';

                    $plan = SubscriptionCheckout::where('id', $data->checkout_id)->first();

                    $subscriptions[$key]['plan'] = $plan->plan->title ?? '';
                }


            } else {
                $subscriptions = [];
            }
            $instructors = User::where('role_id', 2)->get();
            return view('payment::instructor_revenue_report', compact('search_instructor', 'search_month', 'search_year', 'instructors', 'enrolls', 'subscriptions'));
        } catch
        (\Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);
        }

    }

    public function sortByDiscount(Request $request)
    {

        $request->validate([
            'discount' => 'required',
            'id' => 'required'
        ]);
        try {
            $id = $request->id;
            $val = $request->discount;
            $start = date('Y-m-d', strtotime($request->start_date));
            $end = date('Y-m-d', strtotime($request->end_date));
            $method = $request->methods;
            if ((isset($request->end_date)) && (isset($request->start_date))) {

                if ($val == 10) {

                    $logs = CourseEnrolled::where('course_id', $id)->where('discount_amount', '>', 0)->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->latest()->with('user')->get();
                } else {

                    $logs = CourseEnrolled::where('course_id', $id)->where('discount_amount', '=', 0)->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end)->latest()->with('user')->get();

                }
            } elseif (is_null($request->start_date) && is_null($request->end_date)) {

                if ($val == 10) {

                    $logs = CourseEnrolled::where('course_id', $id)->where('discount_amount', '>', 0)->with('user', 'course')->latest()->get();
                } else {

                    $logs = CourseEnrolled::where('course_id', $id)->where('discount_amount', '=', 0)->with('user', 'course')->latest()->get();

                }
            } elseif (isset($request->start_date) && is_null($request->end_date)) {


                if ($val == 10) {

                    $logs = CourseEnrolled::where('course_id', $id)->where('discount_amount', '>', 0)->with('user', 'course')->whereDate('created_at', '>=', $start)->latest()->get();
                } else {

                    $logs = CourseEnrolled::where('course_id', $id)->where('discount_amount', '=', 0)->with('user', 'course')->whereDate('created_at', '>=', $start)->latest()->get();

                }

            } elseif (isset($request->end_date) && is_null($start)) {

                if ($val == 10) {

                    $logs = CourseEnrolled::where('course_id', $id)->where('discount_amount', '>', 0)->with('user', 'course')->whereDate('created_at', '<=', $end)->latest()->get();
                } else {

                    $logs = CourseEnrolled::where('course_id', $id)->where('discount_amount', '=', 0)->with('user', 'course')->whereDate('created_at', '<=', $end)->latest()->get();

                }
            }
            $course_id = $request->id;
            return view('payment::enroll_log', compact('logs', 'course_id'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    public function subscriberMailSingle(Request $request)
    {

        $this->validate($request, [
            'subject' => 'required',
            'body' => 'required',
        ]);

        try {
            $subscriber = Subscription::find($request->id);
            $receiver_name = explode('@', $subscriber->email)[0];
            send_general_email($subscriber->email, $request->subject, $request->body, $receiver_name);

            Toastr::success('Email will be sent to subscribers', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function courseEnrolls($id)
    {

        try {
            $logs = CourseEnrolled::where('course_id', $id)->with('user', 'course')->latest()->get();
            $course_id = $id;
            return view('payment::enroll_log', compact('logs', 'course_id'));
        } catch (\Exception $e) {
            return response()->json(['error' => trans("lang.Oops, Something Went Wrong")]);


        }
    }

    public function instructorPayout(Request $request)
    {

        $instructors = User::where('role_id', 2)->get();
        if (auth()->user()->role_id == 1) {


            $query = Withdraw::latest();

            if (isset($request->month)) {
                $query->whereMonth('created_at', '=', $request->month);
            }
            if (isset($request->year)) {
                $query->whereYear('created_at', '=', $request->year);
            }
            if (isset($request->instructor)) {
                $query->whereYear('instructor_id', '=', $request->instructor);
            }

            $withdraws = $query->with('user')->latest()->get();

        } else {
            $withdraws = Withdraw::with('user')->where('instructor_id', auth()->id())->latest()->get();

        }
        $next_pay = InstructorPayout::where('instructor_id', Auth::user()->id)->whereStatus('0')->sum('reveune');
        if (moduleStatusCheck('Subscription')) {
            $subscriptionPay = SubscriptionCourse::where('instructor_id', Auth::user()->id)->whereStatus('0')->sum('revenue');
            $next_pay = $next_pay + $subscriptionPay;
        }


        return view('payment::instructor_payout', compact('next_pay', 'withdraws', 'instructors'));
    }

    public function instructorRequestPayout()
    {

        try {
            $user = Auth::user();
            $amount = InstructorPayout::where('instructor_id', $user->id)->whereStatus('0')->sum('reveune');
            if (moduleStatusCheck('Subscription')) {
                $subscriptionPay = SubscriptionCourse::where('instructor_id', $user->id)->whereStatus('0')->sum('revenue');
                $amount = $amount + $subscriptionPay;
            }
            $withdraw = new Withdraw();
            $withdraw->instructor_id = Auth::user()->id;
            $withdraw->amount = $amount;
            $withdraw->method = Auth::user()->payout;
            $withdraw->save();

            InstructorPayout::where('instructor_id', $user->id)->whereStatus('0')->update(['status' => 1]);
            if (moduleStatusCheck('Subscription')) {
                SubscriptionCourse::where('instructor_id', $user->id)->whereStatus('0')->update(['status' => 1]);
            }

            Toastr::success('Payment request has been successfully submitted', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function instructorCompletePayout(Request $request)
    {

        try {
            DB::beginTransaction();
            $withdraw = Withdraw::whereId($request->withdraw_id)->whereInstructorId($request->instructor_id)->first();
            $instractor = User::find($request->instructor_id);
            $withdraw->status = 1;
            $withdraw->save();
            $instractor->balance += $withdraw->amount;
            $instractor->save();
            DB::commit();
            Toastr::success('Payment request has been Approved', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
}
