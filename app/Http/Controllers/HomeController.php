<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseEnrolled;
use Modules\Payment\Entities\Withdraw;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {


        if (Auth::user()->role_id == 1) {
            return redirect()->route('dashboard');

        } else if (Auth::user()->role_id == 2) {

            return redirect()->route('dashboard');

        } else if (Auth::user()->role_id == 3) {
            return redirect()->route('studentDashboard');

        } else {
            return redirect('/');
        }
    }


    //dashboard
    public function dashboard()
    {
        $rev = CourseEnrolled::all()->sum('purchase_price') - CourseEnrolled::all()->sum('reveune');
        $info['allCourse'] = Course::all()->count();
        $info['totalEnroll'] = CourseEnrolled::all()->count();
        $info['thisMonthEnroll'] = CourseEnrolled::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->format('F'))->sum('purchase_price');
        $info['thisMonthEnroll'] = number_format($info['thisMonthEnroll'], 2, '.', '');
        $info['today'] = CourseEnrolled::whereDate('created_at', Carbon::today())->sum('purchase_price');
        $info['today'] = number_format($info['today'], 2, '.', '');

        $info['student'] = User::where('role_id', 3)->count();
        $info['instructor'] = User::where('role_id', 2)->count();
        $info['totalSell'] = CourseEnrolled::all()->sum('purchase_price');
        $info['totalSell'] = number_format($info['totalSell'], 2, '.', '');

        $info['adminRev'] = number_format($rev, 2, '.', '');
        $info['recentEnroll'] = CourseEnrolled::latest()->take(4)->select(
            DB::raw('FORMAT(reveune,2) as reveune'), 'course_id', 'user_id', 'purchase_price'
        )->with('course', 'course.user', 'user')->get();
// return $info['recentEnroll'];
        $info['month'] = CourseEnrolled::select(
            DB::raw('sum(purchase_price) as totalSell'),
            DB::raw("DATE_FORMAT(created_at,'%m') as months")
        )->groupBy('months')->get();

        //=================================Course Earning============================================

        $coursesEarnings = CourseEnrolled::select(
            DB::raw('Month(created_at) as month_number'),
            DB::raw('DATE_FORMAT(created_at , "%b") as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('ROUND(sum(purchase_price - reveune),2) as earning'))
            ->groupBy('month_number', 'year', 'month')
            ->whereYear('created_at', Carbon::now()->year)
            ->get();
        $courshEarningM_onth_name = [];
        foreach ($coursesEarnings as $key => $earning) {
            $courshEarningM_onth_name[] = $earning->month;
        }
        $courshEarningMonthly = [];
        foreach ($coursesEarnings as $key => $earn) {
            $courshEarningMonthly[] = $earn->earning;
        }
        // return $coursesEarnings;
        //====================================Payment Statistics====================================
        $withdraws_paid = Withdraw::selectRaw('monthname(issueDate) as month')
            ->selectRaw('YEAR(issueDate) as year')
            ->whereYear('issueDate', '=', date('Y'))
            ->whereMonth('issueDate', '=', date('m'))
            ->where('status', 1)
            ->get();
        $withdraws_unpaid = Withdraw::selectRaw('monthname(issueDate) as month')
            ->selectRaw('YEAR(issueDate) as year')
            ->whereYear('issueDate', '=', date('Y'))
            ->whereMonth('issueDate', '=', date('m'))
            ->where('status', 0)
            ->get();

        $payment_statistics['paid'] = $withdraws_paid;
        $payment_statistics['unpaid'] = $withdraws_unpaid;
        $payment_statistics['month'] = Carbon::now()->format('F');
        //============================Course Overview===============================
        $allCourses = Course::all();
        $enable_courses = $allCourses->where('status', 1)->count();
        $disable_courses = $allCourses->where('status', 0)->count();

        $courses = $allCourses->where('type', 1)->count();
        $quizzes = $allCourses->where('type', 2)->count();
        $classes = $allCourses->where('type', 3)->count();

        $course_overview['active'] = $enable_courses;
        $course_overview['pending'] = $disable_courses;
        $course_overview['courses'] = $courses;
        $course_overview['quizzes'] = $quizzes;
        $course_overview['classes'] = $classes;

        //====================================Course Enroll===================================
        $enrolls = [];
        $courses_enrolle = CourseEnrolled::select(
            DB::raw('MONTHNAME(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('DAY(created_at) as day'), DB::raw('count(*) as count'))->groupBy('year', 'month', 'day')->get();
        foreach ($courses_enrolle as $course) {
            if (date('Y') == $course->year && date('F') == $course->month)
                $enrolls[] = $course;
        }
        $enroll_day = [];
        foreach ($enrolls as $key => $enroll) {
            $enroll_day[] = $enroll->day;
        }
        $enroll_count = [];
        foreach ($enrolls as $key => $enroll) {
            $enroll_count[] = $enroll->count;
        }
        return view('dashboard', compact('info', 'rev', 'courshEarningM_onth_name', 'courshEarningMonthly', 'payment_statistics', 'enroll_day', 'enroll_count', 'course_overview'));
    }
}
