<?php

namespace App\Http\Controllers\Frontend;

use App\AboutPage;
use App\BillingDetails;
use App\DepositRecord;
use App\Http\Controllers\Controller;
use App\LessonComplete;
use App\Subscription;
use App\TopicReport;
use App\User;
use App\UserLogin;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Modules\BBB\Entities\BbbMeeting;
use Modules\Blog\Entities\Blog;
use Modules\Certificate\Entities\Certificate;
use Modules\Certificate\Http\Controllers\CertificateController;
use Modules\Coupons\Entities\Coupon;
use Modules\Coupons\Entities\UserWiseCoupon;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseComment;
use Modules\CourseSetting\Entities\CourseCommentReply;
use Modules\CourseSetting\Entities\CourseEnrolled;
use Modules\CourseSetting\Entities\CourseExercise;
use Modules\CourseSetting\Entities\Lesson;
use Modules\CourseSetting\Entities\Notification;
use Modules\CourseSetting\Entities\SubCategory;
use Modules\FooterSetting\Entities\FooterWidget;
use Modules\FrontendManage\Entities\BecomeInstructor;
use Modules\FrontendManage\Entities\FrontPage;
use Modules\FrontendManage\Entities\HeaderMenu;
use Modules\FrontendManage\Entities\PrivacyPolicy;
use Modules\FrontendManage\Entities\Sponsor;
use Modules\FrontendManage\Entities\WorkProcess;
use Modules\Jitsi\Entities\JitsiMeeting;
use Modules\Localization\Entities\Language;
use Modules\Payment\Entities\Cart;
use Modules\Payment\Entities\Checkout;
use Modules\PaymentMethodSetting\Entities\PaymentMethod;
use Modules\Quiz\Entities\OnlineQuiz;
use Modules\Quiz\Entities\QuestionBankMuOption;
use Modules\Quiz\Entities\QuizeSetup;
use Modules\Quiz\Entities\QuizTest;
use Modules\Quiz\Entities\QuizTestDetails;
use Modules\Setting\Entities\CookieSetting;
use Modules\StudentSetting\Entities\BookmarkCourse;
use Modules\Subscription\Entities\CourseSubscription;
use Modules\Subscription\Entities\Faq;
use Modules\Subscription\Entities\PlanFeature;
use Modules\Subscription\Entities\SubscriptionCart;
use Modules\Subscription\Entities\SubscriptionCheckout;
use Modules\Subscription\Http\Controllers\CourseSubscriptionController;
use Modules\SystemSetting\Entities\GeneralSettings;
use Modules\Zoom\Entities\ZoomMeeting;
use PDF;

class WebsiteController extends Controller
{
    public function __construct()
    {
        //
    }

    public function common()
    {
        $data = [];
        $data['social_links'] = DB::table('social_links')
            ->select('link', 'icon', 'name')
            ->where('status', '=', 1)
            ->get();

        $data['sectionWidgets'] = FooterWidget::where('status', 1)->get();

        $data['languages'] = DB::table('languages')
            ->select('name', 'code')
            ->where('status', '=', 1)
            ->get();

        $data['categories'] = Category::select('id', 'name', 'title', 'description', 'image', 'thumbnail')
            ->with('activeSubcategories')->where('status', 1)
            ->orderBy('position_order', 'ASC')->get();
        if (Auth::check()) {
            $data['total_purchase'] = CourseEnrolled::where('user_id', Auth::user()->id)->count() ?? 0;

        } else {
            $data['total_purchase'] = '';
        }


        $data['frontendContent'] = DB::table('home_contents')->where('active_status', '=', 1)
            ->first();

        $data['menus'] = HeaderMenu::orderBy('position', 'asc')->get();
        $data['cookie'] = CookieSetting::first();

        return $data;
    }

    //speedup
    public function index()
    {

        try {

            $data = $this->common();
            $sections = DB::table('frontend_settings')
                ->select('section', 'title', 'description', 'icon', 'url')
                ->where('section', '=', 'course_detail_left')
                ->orWhere('section', '=', 'course_detail_mid')
                ->orWhere('section', '=', 'course_detail_right')
                ->get();

            $galleries = DB::table('image_galleries')
                ->select('image')
                ->where('status', '=', 1)
                ->get();


            $testimonials = DB::table('testimonials')
                ->select('body', 'image', 'author', 'profession', 'star')
                ->where('status', '=', 1)
                ->get();


            $homeContent = DB::table('home_contents')->where('active_status', '=', 1)
                ->first();
            $homeContent->feature_link1 = "";
            if (isset($homeContent->key_feature_link1)) {
                $page = FrontPage::where('id', $homeContent->key_feature_link1)->first();
                if ($page) {
                    $homeContent->feature_link1 = route('frontPage', [$page->id, $page->slug]);
                }
            }

            $homeContent->feature_link2 = "";
            if (isset($homeContent->key_feature_link2)) {
                $page = FrontPage::where('id', $homeContent->key_feature_link2)->first();
                if ($page) {
                    $homeContent->feature_link2 = route('frontPage', [$page->id, $page->slug]);
                }
            }

            $homeContent->feature_link3 = "";
            if (isset($homeContent->key_feature_link3)) {
                $page = FrontPage::where('id', $homeContent->key_feature_link3)->first();
                if ($page) {
                    $homeContent->feature_link3 = route('frontPage', [$page->id, $page->slug]);
                }
            }


            $sponsors = Sponsor::where('status', 1)->get();
            $top_courses = Course::orderBy('total_enrolled', 'desc')->where('status', 1)->where('type', 1)->take(4)->get();
            $top_quizzes = Course::orderBy('total_enrolled', 'desc')->where('status', 1)->where('type', 2)->take(4)->get();

            $blogs = Blog::where('status', 1)->with('user')->latest()->take(4)->get();
            return view(theme('index'), $data, compact('blogs', 'sponsors', 'top_quizzes', 'top_courses', 'sections', 'galleries', 'testimonials', 'homeContent'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);

        }
    }


    //speedup
    //About Page Info
    public function aboutData()
    {
        try {
            $data = $this->common();

            $courses = Course::where('status', 1)->count();
            $students = User::where('role_id', 3)->count();
            $instructors = User::where('role_id', 2)->count();

            $about = DB::table('about_pages')->first();


            $testimonials = DB::table('testimonials')
                ->select('body', 'image', 'author', 'profession', 'star')
                ->where('status', '=', 1)
                ->get();

            $sponsors = Sponsor::where('status', 1)->get();

            return view(theme('about'), $data, compact('testimonials', 'sponsors', 'courses', 'students', 'instructors', 'about'));
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    //speedup
    // start myDashboard
    public function myDashboard()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        try {
            /*date_default_timezone_set(\config('app.timezone'));
            date_default_timezone_set(env('TIME_ZONE'));*/
            $data = $this->common();


            $data['studentDetails'] = Auth::user();
            $total_spent = CourseEnrolled::where('user_id', Auth::user()->id)->sum('purchase_price');


            // 24-hour format of an hour without leading zeros (0 through 23)
            $Hour = date('G');

            if ($Hour >= 5 && $Hour <= 11) {
                $wish_string = trans("student.Good Morning");
            } else if ($Hour >= 12 && $Hour <= 18) {
                $wish_string = trans("student.Good Afternoon");
            } else if ($Hour >= 19 || $Hour <= 4) {
                $wish_string = trans("student.Good Evening");
            }
            $date = Carbon::now(env('TIME_ZONE'))->format("jS F Y \, l");


            $lastViewCourses = DB::table('recentview_courses')
                ->select(
                    'courses.id',
                    'courses.type',
                    'courses.slug',
                    'courses.title',
                    'courses.duration',
                    'courses.thumbnail',
                    'courses.slug',
                    'users.name as userName',
                    'courses.total_enrolled'
                )
                ->join('courses', 'courses.id', '=', 'recentview_courses.course_id')
                ->join('users', 'users.id', '=', 'courses.user_id')
                ->where('recentview_courses.user_id', Auth::id())
                ->orderBy('recentview_courses.created_at', 'desc')->take(4)->get();

            $mycourses = DB::table('course_enrolleds')
                ->select(
                    'courses.id',
                    'courses.type',
                    'courses.slug',
                    'courses.about',
                    'courses.quiz_id',
                    'courses.thumbnail',
                    'course_enrolleds.purchase_price as price',
                    'courses.title',
                    'courses.duration',
                    'courses.slug',
                    'users.id as userId',
                    'users.name as userName',
                    'courses.total_enrolled'
                )
                ->join('courses', 'courses.id', '=', 'course_enrolleds.course_id')
                ->join('users', 'users.id', '=', 'courses.user_id')
                ->whereIn('courses.type', [1])
                ->where('course_enrolleds.user_id', Auth::id())
                ->orderBy('course_enrolleds.created_at', 'desc')->take(4)->get();
            $percentage = 0;
            $courses = Course::where('type', 1)->where('status', 1)->inRandomOrder()->limit(3)->get();
            $quizzes = Course::where('type', 2)->where('status', 1)->inRandomOrder()->limit(3)->get();
            if (count($mycourses) != 0) {
                $course_reviews = DB::table('course_reveiws')->select('user_id')->where('course_id', $mycourses[0]->id)->get();
                $course = Course::find($mycourses[0]->id);
                $countCourse = count($course->completeLessons->where('status', 1));
                if ($countCourse != 0) {
                    $percentage = ceil($countCourse / count($course->lessons) * 100);
                } else {
                    $percentage = 0;
                }


            } else {
                $course_reviews = [];
            }
            $reviewer_user_ids = [];
            foreach ($course_reviews as $key => $review) {
                $reviewer_user_ids[] = $review->user_id;
            }
            return view(theme('myDashboard'), $data, compact('percentage', 'reviewer_user_ids', 'quizzes', 'courses', 'data', 'lastViewCourses', 'mycourses', 'wish_string', 'date', 'total_spent'));
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return back();
        }
    }

    public function referral()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $data = $this->common();


        $referrals = UserWiseCoupon::where('invite_by', Auth::user()->id)
            ->where('course_id', '!=', null)
            ->leftjoin('users', 'users.id', '=', 'user_wise_coupons.invite_accept_by')
            ->get();
        // return $referrals;
        return view(theme('referal'), $data, compact('referrals'));
    }

    public function myClasses()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        try {
            $data = $this->common();


            $courses = DB::table('course_enrolleds')
                ->select(
                    'courses.id',
                    'courses.type',
                    'courses.class_id',
                    'courses.slug',
                    'courses.thumbnail',
                    'course_enrolleds.purchase_price as price',
                    'courses.title',
                    'courses.duration',
                    'courses.slug',
                    'users.name as userName',
                    'users.id as userId',
                    'courses.total_enrolled',
                    'virtual_classes.start_date',
                )
                ->join('courses', 'courses.id', '=', 'course_enrolleds.course_id')
                ->join('users', 'users.id', '=', 'courses.user_id')
                ->join('virtual_classes', 'virtual_classes.id', '=', 'courses.class_id')
                ->where('courses.type', 3)
                ->where('course_enrolleds.user_id', Auth::id())
                ->orderBy('course_enrolleds.created_at')->get();

            return view(theme('myCourses'), $data, compact('courses'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

//speedup
    public function myCourses()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        try {
            $data = $this->common();


            $courses = DB::table('course_enrolleds')
                ->select(
                    'courses.id',
                    'courses.type',
                    'courses.slug',
                    'courses.quiz_id',
                    'courses.thumbnail',
                    'course_enrolleds.purchase_price as price',
//                    'courses.discount_price',
                    'courses.title',
                    'courses.duration',
                    'courses.slug',
                    'users.id as userId',
                    'users.name as userName',
                    'courses.total_enrolled'
                )
                ->join('courses', 'courses.id', '=', 'course_enrolleds.course_id')
                ->join('users', 'users.id', '=', 'courses.user_id')
                ->whereIn('courses.type', [1])
                ->where('course_enrolleds.user_id', Auth::id())
                ->orderBy('course_enrolleds.created_at', 'desc')->get();


            return view(theme('myCourses'), $data, compact('courses'));
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function myQuizzes()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        try {
            $data = $this->common();


            $courses = DB::table('course_enrolleds')
                ->select(
                    'courses.id',
                    'courses.type',
                    'courses.slug',
                    'courses.quiz_id',
                    'courses.thumbnail',
                    'course_enrolleds.purchase_price as price',
//                    'courses.discount_price',
                    'courses.title',
                    'courses.duration',
                    'courses.slug',
                    'users.id as userId',
                    'users.name as userName',
                    'courses.total_enrolled'
                )
                ->join('courses', 'courses.id', '=', 'course_enrolleds.course_id')
                ->join('users', 'users.id', '=', 'courses.user_id')
                ->whereIn('courses.type', [2])
                ->where('course_enrolleds.user_id', Auth::id())
                ->orderBy('course_enrolleds.created_at', 'desc')->get();


            return view(theme('myCourses'), $data, compact('courses'));
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
//speedup
    // myWishlists Page
    public function myWishlists()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        try {

            $data = $this->common();

            $bookmarks = BookmarkCourse::where('user_id', Auth::id())
                ->with('course', 'user', 'course.user', 'course.subCategory', 'course.lessons')->get();

            return view(theme('myWishlists'), $data, compact('bookmarks'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
//speedup
    // myPurchases Page
    public function myPurchases()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        try {

            $data = $this->common();
            $enrolls = Checkout::where('user_id', Auth::id())->where('status', 1)->with('coupon', 'courses')->latest()->paginate(5);
            $checkouts = SubscriptionCheckout::where('user_id', Auth::id())->with('plan')->latest()->paginate(5);

            return view(theme('myPurchases'), $data, compact('enrolls', 'checkouts'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function removeProfilePic()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        try {
            $user = User::find(Auth::user()->id);
            $user->image = '';
            $user->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();

        } catch (\Exception $e) {
            //  dd($e);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    //speedup
    // myProfile Page
    public function myProfile()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        try {
            $profile = Auth::user();
            $countries = DB::table('countries')->select('id', 'name')->get();
            $cities = DB::table('spn_cities')->where('country_id', $profile->country)->select('id', 'name')->get();

            $data = $this->common();
            $langs = DB::table('languages')
                ->select('id', 'native', 'code')
                ->where('status', '=', 1)
                ->get();


            return view(theme('myProfile'), $data, compact('profile', 'countries', 'cities', 'langs'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function ajaxCounterCity(Request $request)
    {
        try {
            $cities = DB::table('spn_cities')->where('country_id', '=', $request->id)->get();
            return response()->json([$cities]);
        } catch (\Exception $e) {
            return response()->json("", 404);
        }
    }

    // myProfileUpdate

    public function myProfileUpdate(Request $request)
    {
        if (Auth::user()->role_id == 1) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',

            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'username' => 'required|unique:users,username,' . Auth::id(),
                'phone' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|unique:users,phone,' . Auth::id(),
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'zip' => 'required',
            ]);
        }


        try {

            if (demoCheck()) {
                return redirect()->back();
            }

            $lang = explode('|', $request->language ?? '');

            $user = Auth::user();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->language_id = $lang[0] ?? 19;
            $user->language_code = $lang[1] ?? 'en';
            $user->language_name = $lang[2] ?? 'English';
            $user->city = $request->city;
            $user->country = $request->country;
            $user->zip = $request->zip;
            $user->currency_id = getSetting()->currency_id;
            $user->facebook = $request->facebook;
            $user->twitter = $request->twitter;
            $user->linkedin = $request->linkedin;
            $user->instagram = $request->instagram;
            $user->youtube = $request->youtube;
            $user->headline = $request->headline;
            $user->about = $request->about;
            $fileName = "";
            if ($request->file('image') != "") {
                $file = $request->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/profile/', $fileName);
                $fileName = 'public/profile/' . $fileName;
                $user->image = $fileName;
            }
            $user->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function MyUpdatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required_with:new_password|same:new_password|min:8'
        ]);
        try {
            if (demoCheck()) {
                return redirect()->back();
            }

            $user = Auth::user();


            if (!Hash::check($request->old_password, $user->password)) {
                Toastr::error('Password Do not match !', 'Failed');
                return redirect()->back();
            }

            $user->update([
                'password' => bcrypt($request->new_password)
            ]);

            $login = UserLogin::where('user_id', Auth::id())->where('status', 1)->latest()->first();
            if ($login) {
                $login->status = 0;
                $login->logout_at = Carbon::now(env('TIME_ZONE'));
                $login->save();
            }

            Auth::logout();

            send_email($user, 'PASS_UPDATE', [
                'time' => Carbon::now()->format('d-M-Y ,s:i A')
            ]);

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return back();


        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    public function MyEmailUpdate(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email,' . Auth::id(),
            'password' => 'required',
        ]);
        try {

            $user = Auth::user();

            if (Config::get('app.app_sync')) {
                Toastr::error('For demo version you can not change this !', 'Failed');
                return redirect()->back();
            } else {
                // $success = trans('lang.Password').' '.trans('lang.Saved').' '.trans('lang.Successfully');


                if (!Hash::check($request->password, $user->password)) {
                    Toastr::error('Password Do not match !', 'Failed');
                    return redirect()->back();
                }

                $user->update([
                    'email' => $request->email
                ]);
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();

            }


        } catch (\Exception $e) {
            //  dd($e);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }


    //speedup
    // myProfile Page
    public function myAccount()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        try {
            $account = Auth::user();
            $data = $this->common();
            return view(theme('myAccount'), $data, compact('account'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    // my Invoice Page myInvoices
    public function myInvoices()
    {
        try {
            $data = $this->common();
            $account = Auth::user();
            return view(theme('myInvoices'), $data, compact('account'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function privacy()
    {
        try {
            $privacy_policy = PrivacyPolicy::findOrFail(1);

            $data = $this->common();

            return view(theme('privacy'), $data, compact('privacy_policy'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function categoryPage()
    {
        try {
            $data = $this->common();
            return view('frontend.default.category', $data);
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function saveComment(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'comment' => 'required',
        ]);


        try {
            $course = Course::where('id', $request->course_id)->where('status', 1)->first();

            if (isset($course)) {
                $settings = GeneralSettings::first();
                $comment = new CourseComment();
                $comment->user_id = Auth::user()->id;
                $comment->course_id = $request->course_id;
                $comment->instructor_id = $course->user_id;
                $comment->comment = $request->comment;
                $comment->status = 1;
                $comment->save();

                $notification = new Notification();
                $notification->author_id = Auth::user()->id;
                $notification->user_id = $course->user_id;
                $notification->course_id = $course->id;
                $notification->course_comment_id = $comment->id;
                $notification->save();


                send_email($course->user, 'Course_comment', [
                    'time' => Carbon::now()->format('d-M-Y, s:i A'),
                    'course' => $course->title,
                    'comment' => $comment->comment,
                ]);

                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            } else {
                Toastr::error('Invalid Action !', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function submitCommnetReply(Request $request)
    {

        $request->validate([
            'comment_id' => 'required',
            'reply' => 'required'
        ]);
        try {
            $comment = CourseComment::find($request->comment_id);
            $course = $comment->course;


            if (isset($course)) {
                $settings = GeneralSettings::first();

                $comment = new CourseCommentReply();
                $comment->user_id = Auth::user()->id;
                $comment->course_id = $course->id;
                if (!empty($request->reply_id)) {
                    $comment->reply_id = $request->reply_id;
                } else {
                    $comment->reply_id = null;
                }
                $comment->comment_id = $request->comment_id;
                $comment->reply = $request->reply;
                $comment->status = 1;
                $comment->save();


                send_email($course->user, 'Course_comment_Reply', [
                    'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                    'course' => $course->title,
                    'comment' => $comment->comment,
                    'reply' => $comment->reply,
                ]);


                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            } else {
                Toastr::error('Invalid Action !', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            dd($e);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function fullScreenView($course_id, $lesson_id)
    {

        $data = $this->common();

        $course = Course::findOrFail($course_id);

        $lesson = Lesson::where('id', $lesson_id)->first();
        //$lesson->is_lock;
        $isEnrolled = false;

        if (!isEnrolled($course_id, Auth::id())) {
            if ($lesson->is_lock == 1) {
                Toastr::error('You are not enrolled for this course !', 'Failed');
                return redirect()->back();
            }
        } else {
            $isEnrolled = true;
        }


        if ($course->type == 1)
            $certificate = Certificate::where('for_course', 1)->first();
        else
            $certificate = Certificate::where('for_quiz', 1)->first();

        //drop content  start
        date_default_timezone_set(\config('app.timezone'));
        $today = Carbon::now()->toDateString();
        $showDrip = getSetting()->show_drip ?? 0;
        $all = Lesson::where('course_id', $course->id)->get();;

        $lessons = [];
        if ($course->drip == 1) {
            if ($showDrip == 1) {
                foreach ($all as $key => $data) {
                    $show = false;
                    $unlock_date = $data->unlock_date;
                    $unlock_days = $data->unlock_days;

                    if (!empty($unlock_days) || !empty($unlock_date)) {

                        if (!empty($unlock_date)) {
                            if (strtotime($unlock_date) == strtotime($today)) {
                                $show = true;
                            }
                        }
                        if (!empty($unlock_days)) {
                            if (Auth::check()) {
                                $enrolled = DB::table('course_enrolleds')->where('user_id', Auth::user()->id)->where('course_id', $course->id)->where('status', 1)->first();
                                if (!empty($enrolled)) {
                                    $unlock = Carbon::parse($enrolled->created_at);
                                    $unlock->addDays($data->unlock_days);
                                    $unlock = $unlock->toDateString();

                                    if (strtotime($unlock) <= strtotime($today)) {
                                        $show = true;
                                    }
                                }

                            }
                        }

                        if ($show) {
                            $lessons[] = $data;
                        }
                    } else {
                        $lessons[] = $data;
                    }


                }


            } else {
                $lessons = $all;
            }
        } else {
            $lessons = $all;
        }

        $total = count($lessons);
        // drop content end


        $lessonShow = false;
        $unlock_lesson_date = $lesson->unlock_date;
        $unlock_lesson_days = $lesson->unlock_days;
        if (!empty($unlock_lesson_days) || !empty($unlock_lesson_date)) {
            if (!empty($unlock_lesson_date)) {
                if (strtotime($unlock_lesson_date) == strtotime($today)) {
                    $lessonShow = true;
                }

            }

            if (!empty($unlock_lesson_days)) {
                if (!Auth::check()) {
                    $lessonShow = false;
                } else {
                    $enrolled = DB::table('course_enrolleds')->where('user_id', Auth::user()->id)->where('course_id', $course_id)->where('status', 1)->first();
                    $unlock_lesson = Carbon::parse($enrolled->created_at);
                    $unlock_lesson->addDays($lesson->unlock_days);
                    $unlock_lesson = $unlock_lesson->toDateString();

                    if (strtotime($unlock_lesson) <= strtotime($today)) {
                        $lessonShow = true;

                    }
                }

            }
        } else {
            $lessonShow = true;
        }

        if (!$lessonShow) {
            Toastr::error('Lesson currently unavailable!', 'Failed');
            return redirect()->back();
        }

        $countCourse = count($course->completeLessons->where('status', 1));
        if ($countCourse != 0) {
            $percentage = ceil($countCourse / count($course->lessons) * 100);
        } else {
            $percentage = 0;
        }

        $course_reviews = DB::table('course_reveiws')->select('user_id')->where('course_id', $course->id)->get();

        $reviewer_user_ids = [];
        foreach ($course_reviews as $key => $review) {
            $reviewer_user_ids[] = $review->user_id;
        }

        return view(theme('fullscreen_video'), $data, compact('reviewer_user_ids','percentage', 'isEnrolled', 'total', 'certificate', 'course', 'lesson', 'lessons'));

    }

    public function courseDetails($id, $slug)
    {

        try {
            $data = $this->common();
            $is_cart = 0;
            $course = Course::with('user', 'enrolls', 'reviews', 'comments')
                ->select(
                    'courses.id',
                    'courses.type',
                    'courses.slug',
                    'courses.image',
                    'courses.category_id',
                    'courses.trailer_link',
                    'courses.thumbnail',
                    'courses.title',
                    'courses.level',
                    'courses.host',
                    'courses.host',
                    'courses.status',
                    'courses.about',
                    'courses.requirements',
                    'courses.outcomes',
                    'courses.reveiw',
                    'courses.type',
                    'courses.total_enrolled',
                    'courses.special_commission',
                    'courses.duration',
                    'courses.slug',
                    'courses.user_id',
                    'courses.price',
                    'courses.discount_price',
                )
                ->where('id', $id)->first();

            $related = Course::where('category_id', $course->category_id)->where('id', '!=', $course->id)->take(2)->get();
            $reviews = DB::table('course_reveiws')
                ->select(
                    'course_reveiws.id',
                    'course_reveiws.star',
                    'course_reveiws.comment',
                    'course_reveiws.created_at',
                    'users.id as userId',
                    'users.name as userName',
                )
                ->join('users', 'users.id', '=', 'course_reveiws.user_id')
                ->where('course_reveiws.course_id', $id)->get();


            $course_exercises = DB::table('course_exercises')
                ->select('file', 'fileName', 'lock')->where('course_id', $id)->get();
            $course_reviews = DB::table('course_reveiws')->select('user_id')->where('course_id', $id)->get();
            $course_enrolls = DB::table('course_enrolleds')->select('user_id')->where('course_id', $id)->get();

            if (Auth::check()) {
                $isEnrolled = isEnrolled($course->id, Auth::user()->id);
            } else {
                $isEnrolled = false;
            }
            $bookmarked = BookmarkCourse::where('user_id', Auth::id())->where('course_id', $id)->count();
            if ($bookmarked == 0) {
                $isBookmarked = false;
            } else {
                $isBookmarked = true;

            }
            $cart = Cart::where('user_id', Auth::id())->where('course_id', $id)->first();
            if ($cart)
                $is_cart = 1;


            if ($course->price == 0) {
                $isFree = true;
            } else {
                $isFree = false;
            }

            if ($isEnrolled) {
                $enroll = CourseEnrolled::where('user_id', Auth::id())->where('course_id', $course->id)->first();
                if ($enroll) {
                    if ($enroll->subscription == 1) {

                        if (!isSubscribe()) {
                            Toastr::error('Subscription has expired, Please Subscribe again.', 'Failed');
                            return redirect()->route('courseSubscription');
                        }
                    }
                }
            }

            $reviewer_user_ids = [];
            foreach ($course_reviews as $key => $review) {
                $reviewer_user_ids[] = $review->user_id;
            }

            $course_enrolled_std = [];
            foreach ($course_enrolls as $key => $enroll) {
                $course_enrolled_std[] = $enroll->user_id;
            }


            //drop content  start
            date_default_timezone_set(\config('app.timezone'));
            $today = Carbon::now()->toDateString();
            $showDrip = getSetting()->show_drip ?? 0;
            $all = Lesson::where('course_id', $course->id)->get();;
            $lessons = [];
            if ($course->drip == 1) {
                if ($showDrip == 1) {
                    foreach ($all as $key => $data) {
                        $show = false;
                        $unlock_date = $data->unlock_date;
                        $unlock_days = $data->unlock_days;

                        if (!empty($unlock_days) || !empty($unlock_date)) {

                            if (!empty($unlock_date)) {
                                if (strtotime($unlock_date) == strtotime($today)) {
                                    $show = true;
                                }
                            }
                            if (!empty($unlock_days)) {
                                if (Auth::check()) {
                                    $enrolled = DB::table('course_enrolleds')->where('user_id', Auth::user()->id)->where('course_id', $course->id)->where('status', 1)->first();
                                    if (!empty($enrolled)) {
                                        $unlock = Carbon::parse($enrolled->created_at);
                                        $unlock->addDays($data->unlock_days);
                                        $unlock = $unlock->toDateString();

                                        if (strtotime($unlock) <= strtotime($today)) {
                                            $show = true;
                                        }
                                    }

                                }
                            }

                            if ($show) {
                                $lessons[] = $data;
                            }
                        } else {
                            $lessons[] = $data;
                        }


                    }


                } else {
                    $lessons = $all;
                }
            } else {
                $lessons = $all;

            }

            $total = count($lessons);
            // drop content end

            if ($course->type == 1) {
                return view(theme('courseDetails'), $data, compact('related', 'is_cart', 'lessons', 'total', 'isFree', 'reviews', 'isBookmarked', 'isEnrolled', 'course', 'course_exercises', 'reviewer_user_ids', 'course_enrolled_std'));
            } elseif ($course->type == 2) {
                $quizzes = Course::where('id', $id)->with('lessons')->get();
                // return $quizzes;
                return view(theme('QuizDetails'), $data, compact('related', 'is_cart', 'lessons', 'total', 'isFree', 'reviews', 'isBookmarked', 'isEnrolled', 'categories', 'course', 'course_exercises', 'reviewer_user_ids'));
            } elseif ($course->type == 3)
                return view(theme('class_details'), $data, compact('related', 'is_cart', 'lessons', 'total', 'isFree', 'reviews', 'isBookmarked', 'isEnrolled', 'course', 'course_exercises', 'reviewer_user_ids'));

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function courseQuizDetails($course_id, $quiz_id, $slug)
    {

        try {
            $data = $this->common();
            $course = Course::with('user', 'enrolls', 'lessons', 'reviews', 'comments')->where('id', $course_id)->first();

            if (Auth::check()) {
                $isEnrolled = isEnrolled($course->id, Auth::user()->id);
            } else {
                $isEnrolled = false;
            }

            $bookmarked = BookmarkCourse::where('user_id', Auth::id())->where('course_id', $course_id)->count();
            if ($bookmarked == 0) {
                $isBookmarked = false;
            } else {
                $isBookmarked = true;

            }


            if ($course->price == 0) {
                $isFree = true;
            } else {
                $isFree = false;
            }

            $course_exercises = CourseExercise::where('course_id', $course_id)->get();
            $reviewer_user_ids = [];
            foreach ($course->reviews as $key => $review) {
                $reviewer_user_ids[] = $review['user_id'];
            }

            $course_enrolled_std = [];
            foreach ($course->enrolls as $key => $enroll) {
                $course_enrolled_std[] = $enroll['user_id'];
            }


            //drop content  start
            date_default_timezone_set(\config('app.timezone'));
            $today = Carbon::now()->toDateString();
            $showDrip = getSetting()->show_drip ?? 0;
            $all = Lesson::where('course_id', $course->id)->get();;


            $lessons = [];
            if ($course->drip == 1) {
                if ($showDrip == 1) {
                    foreach ($all as $key => $data) {
                        $show = false;
                        $unlock_date = $data->unlock_date;
                        $unlock_days = $data->unlock_days;

                        if (!empty($unlock_days) || !empty($unlock_date)) {

                            if (!empty($unlock_date)) {
                                if (strtotime($unlock_date) == strtotime($today)) {
                                    $show = true;
                                }
                            }
                            if (!empty($unlock_days)) {
                                if (Auth::check()) {
                                    $enrolled = DB::table('course_enrolleds')->where('user_id', Auth::user()->id)->where('course_id', $course->id)->where('status', 1)->first();
                                    if (!empty($enrolled)) {
                                        $unlock = Carbon::parse($enrolled->created_at);
                                        $unlock->addDays($data->unlock_days);
                                        $unlock = $unlock->toDateString();

                                        if (strtotime($unlock) <= strtotime($today)) {
                                            $show = true;
                                        }
                                    }

                                }
                            }

                            if ($show) {
                                $lessons[] = $data;
                            }
                        } else {
                            $lessons[] = $data;
                        }


                    }


                } else {
                    $lessons = $all;
                }
            } else {
                $lessons = $all;
            }

            $total = count($lessons);
            // drop content end


            $lesson = Lesson::where('quiz_id', $quiz_id)->first();

            $lessonShow = false;
            $unlock_lesson_date = $lesson->unlock_date;
            $unlock_lesson_days = $lesson->unlock_days;
            if (!empty($unlock_lesson_days) || !empty($unlock_lesson_date)) {
                if (!empty($unlock_lesson_date)) {
                    if (strtotime($unlock_lesson_date) == strtotime($today)) {
                        $lessonShow = true;
                    }

                }

                if (!empty($unlock_lesson_days)) {
                    $enrolled = DB::table('course_enrolleds')->where('user_id', Auth::user()->id)->where('course_id', $course_id)->where('status', 1)->first();
                    $unlock_lesson = Carbon::parse($enrolled->created_at);
                    $unlock_lesson->addDays($lesson->unlock_days);
                    $unlock_lesson = $unlock_lesson->toDateString();

                    if (strtotime($unlock_lesson) <= strtotime($today)) {
                        $lessonShow = true;

                    }
                }
            } else {
                $lessonShow = true;
            }
            if (!$lessonShow) {
                Toastr::error('Quiz currently unavailable!', 'Failed');
                return redirect()->back();
            }

            $related = Course::where('category_id', $course->category_id)->where('id', '!=', $course->id)->take(2)->get();
            $reviews = DB::table('course_reveiws')
                ->select(
                    'course_reveiws.id',
                    'course_reveiws.star',
                    'course_reveiws.comment',
                    'course_reveiws.created_at',
                    'users.id as userId',
                    'users.name as userName',
                )
                ->join('users', 'users.id', '=', 'course_reveiws.user_id')
                ->where('course_reveiws.course_id', $course->id)->get();
//            $quizzes = Course::where('id', $course_id)->with('lessons')->get();
            $quizSetup = QuizeSetup::first();
            $quiz = OnlineQuiz::findOrFail($quiz_id);
            $check = $this->getResult($course_id, $quiz_id);
            return view(theme('courseQuizDetails'), $data, compact('reviews', 'related', 'lessons', 'total', 'isEnrolled', 'isBookmarked', 'isFree', 'check', 'quizSetup', 'quiz', 'course', 'course_exercises', 'reviewer_user_ids', 'course_enrolled_std'));

        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function quizDetails($id, $slug)
    {


        try {
            $data = $this->common();

            $course = Course::with('enrolls', 'lessons', 'reviews', 'comments')
                ->select(
                    'courses.id',
                    'courses.type',
                    'courses.slug',
                    'courses.image',
                    'courses.trailer_link',
                    'courses.thumbnail',
                    'courses.title',
                    'courses.level',
                    'courses.host',
                    'courses.host',
                    'courses.status',
                    'courses.about',
                    'courses.quiz_id',
                    'courses.reveiw',
                    'courses.duration',
                    'courses.type',
                    'courses.total_enrolled',
                    'courses.special_commission',
                    'courses.duration',
                    'courses.slug',
                    'courses.user_id',
                    'courses.price',
                    'courses.discount_price',
                    'users.name as userName'
                )->leftJoin('users', 'courses.user_id', 'users.id')
                ->where('courses.id', $id)->first();

            $certificate = Certificate::where('for_quiz', 1)->first();


            if (Auth::check()) {
                $isEnrolled = isEnrolled($course->id, Auth::user()->id);
            } else {
                $isEnrolled = false;
            }

            $bookmarked = BookmarkCourse::where('user_id', Auth::id())->where('course_id', $id)->count();
            if ($bookmarked == 0) {
                $isBookmarked = false;
            } else {
                $isBookmarked = true;

            }
            if ($isEnrolled) {
                $enroll = CourseEnrolled::where('user_id', Auth::id())->where('course_id', $course->id)->first();
                if ($enroll) {
                    if ($enroll->subscription == 1) {

                        if (!isSubscribe()) {
                            Toastr::error('Subscription has expired, Please Subscribe again.', 'Failed');
                            return redirect()->route('courseSubscription');
                        }
                    }
                }
            }

            if ($course->price == 0) {
                $isFree = true;
            } else {
                $isFree = false;
            }
            $is_cart = 0;
            $cart = Cart::where('user_id', Auth::id())->where('course_id', $id)->first();
            if ($cart)
                $is_cart = 1;


            $reviewer_user_ids = [];
            foreach ($course->reviews as $key => $review) {
                $reviewer_user_ids[] = $review['user_id'];
            }

            $course_enrolled_std = [];
            foreach ($course->enrolls as $key => $enroll) {
                $course_enrolled_std[] = $enroll['user_id'];
            }
            $related = Course::where('category_id', $course->category_id)->where('id', '!=', $course->id)->take(2)->get();
            $reviews = DB::table('course_reveiws')
                ->select(
                    'course_reveiws.id',
                    'course_reveiws.star',
                    'course_reveiws.comment',
                    'course_reveiws.created_at',
                    'users.id as userId',
                    'users.name as userName',
                )
                ->join('users', 'users.id', '=', 'course_reveiws.user_id')
                ->where('course_reveiws.course_id', $id)->get();
            if (empty($course->quiz->id)) {
                Toastr::error('No Quiz Assign', trans('common.Failed'));
                return \redirect()->back();
            }


            $quizSetup = QuizeSetup::first();
            $alreadyJoin = 0;
            $givenQuiz = QuizTest::where('user_id', Auth::id())->where('course_id', $course->id)->where('quiz_id', $course->quiz->id)->first();
            if ($givenQuiz)
                $alreadyJoin = 1;
            // return $quizzes;
            return view(theme('quizDetails'), $data, compact('related', 'certificate', 'alreadyJoin', 'is_cart', 'reviews', 'isFree', 'isBookmarked', 'isEnrolled', 'quizSetup', 'course', 'reviewer_user_ids'));

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function classDetails($id, $slug)
    {

        try {
            $data = $this->common();

            $course = Course::with('user', 'enrolls', 'lessons', 'reviews', 'comments', 'virtualClass')->where('id', $id)->first();

            if (Auth::check()) {
                $total_purchase = CourseEnrolled::where('user_id', Auth::user()->id)->count() ?? 0;

            } else {
                $total_purchase = '';
            }
            $course_reviews = DB::table('course_reveiws')->select('user_id')->where('course_id', $id)->get();

            if (Auth::check()) {
                $isEnrolled = isEnrolled($course->id, Auth::user()->id);
            } else {
                $isEnrolled = false;
            }

            $bookmarked = BookmarkCourse::where('user_id', Auth::id())->where('course_id', $id)->count();
            if ($bookmarked == 0) {
                $isBookmarked = false;
            } else {
                $isBookmarked = true;

            }


            if ($course->price == 0) {
                $isFree = true;
            } else {
                $isFree = false;
            }

            if ($isEnrolled) {
                $enroll = CourseEnrolled::where('user_id', Auth::id())->where('course_id', $course->id)->first();
                if ($enroll) {
                    if ($enroll->subscription == 1) {

                        if (!isSubscribe()) {
                            Toastr::error('Subscription has expired, Please Subscribe again.', 'Failed');
                            return redirect()->route('courseSubscription');
                        }
                    }
                }
            }

            if (Auth::check() && isEnrolled($course->id, Auth::user()->id)) {


                if ($course->class->host == "Zoom") {
                    if ($course->class->type == 0) {
                        if (count($course->class->zoomMeetings) != 0) {
                            $localMeetingData = $course->class->zoomMeetings[0];

                        } else {
                            $localMeetingData = '';

                        }

                        if ($localMeetingData) {
                            return redirect()->route('zoom.meeting.join', $localMeetingData->meeting_id);

                        } else {
                            Toastr::error('No Class Assigned', 'Failed');
                        }
                    } else {
                        $nextMeeting = ZoomMeeting::where('class_id', $course->class->id)->where('date_of_meeting', date('m/d/Y'))->first();
                        $course->nextMeeting = $nextMeeting;
                    }
                } elseif ($course->class->host == "BBB") {
                    if (moduleStatusCheck("BBB")) {
                        if ($course->class->type == 0) {
                            if (count($course->class->bbbMeetings) != 0) {
                                $localMeetingData = $course->class->bbbMeetings[0];
                            } else {
                                $localMeetingData = '';
                            }
                            if ($localMeetingData) {
                                return redirect()->to('bbb/meeting-start-attendee/' . $course->id . '/' . $localMeetingData->meeting_id);
                            } else {
                                Toastr::error('No Class Assigned', 'Failed');
                            }
                        } else {
                            $nextMeeting = BbbMeeting::where('class_id', $course->class->id)->where('date', date('m/d/Y'))->first();
                            $course->nextMeeting = $nextMeeting;
                        }
                    } else {
                        Toastr::error('Module is not activated', 'Failed');
                    }

                } elseif ($course->class->host == "Jitsi") {
                    if (moduleStatusCheck("Jitsi")) {
                        if ($course->class->type == 0) {
                            if (count($course->class->jitsiMeetings) != 0) {
                                $localMeetingData = $course->class->jitsiMeetings[0];
                            } else {
                                $localMeetingData = '';
                            }
                            if ($localMeetingData) {
                                return redirect()->to('jitsi/meeting-start/' . $course->id . '/' . $localMeetingData->meeting_id);
                            } else {
                                Toastr::error('No Class Assigned', 'Failed');
                            }
                        } else {
                            $nextMeeting = JitsiMeeting::where('class_id', $course->class->id)->where('date', date('m/d/Y'))->first();
                            $nextMeeting->isRunning = true;
                            $course->nextMeeting = $nextMeeting;

                        }
                    } else {
                        Toastr::error('Module is not activated', 'Failed');
                    }

                }

            }
            $reviewer_user_ids = [];
            foreach ($course_reviews as $key => $review) {
                $reviewer_user_ids[] = $review->user_id;
            }


            $course_enrolled_std = [];
            foreach ($course->enrolls as $key => $enroll) {
                $course_enrolled_std[] = $enroll['user_id'];
            }


            $related = Course::where('category_id', $course->category_id)->where('id', '!=', $course->id)->take(2)->get();
            $reviews = DB::table('course_reveiws')
                ->select(
                    'course_reveiws.id',
                    'course_reveiws.star',
                    'course_reveiws.comment',
                    'course_reveiws.created_at',
                    'users.id as userId',
                    'users.name as userName',
                )
                ->join('users', 'users.id', '=', 'course_reveiws.user_id')
                ->where('course_reveiws.course_id', $course->id)->get();
            $is_cart = 0;
            $cart = Cart::where('user_id', Auth::id())->where('course_id', $course->id)->first();
            if ($cart) {
                $is_cart = 1;
            }

            return view(theme('class_details'), $data, compact('is_cart', 'reviewer_user_ids', 'related', 'reviews', 'isFree', 'isBookmarked', 'isEnrolled', 'course'));

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:subscriptions,email'
        ]);

        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $check = Subscription::where('email', '=', $request->email)->first();
            if (empty($check)) {
                $subscribe = new Subscription();
                $subscribe->email = $request->email;
                $subscribe->save();

                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            } else {
                Toastr::error('Already subscribe!', 'Failed');
            }

            return Redirect::back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return Redirect::back();
        }

    }

    public function InstructorProfileView($id)
    {

        try {
            $instructor = User::where('id', $id)->first();
            $instructor_courses = Course::where('user_id', $id)->paginate(8);
            return view('frontend.default.instructorProfile', compact('instructor', 'instructor_courses'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function InstructorProfileViewDuration($id)
    {

        try {
            $instructor = User::where('id', $id)->first();
            $instructor_courses = Course::where('user_id', $id)->orderBy('duration', 'DESC')->paginate(8);
            // return $instructor_courses;
            return view('frontend.default.instructorProfile', compact('instructor', 'instructor_courses'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function myCart()
    {
        try {
            $data = $this->common();

            $carts = Cart::where('user_id', Auth::id())->with('course', 'course.user')->get();
            // $carts=session()->get('cart');
            // return $carts;
            if (Auth::check()) {
                return view(theme('myCart'), $data, compact('carts'));
            } else {
                return view(theme('myCart2'), $data, compact('carts'));
            }

            // return view('frontend.default.myCart', compact('carts'));
        } catch (\Throwable $th) {
            $errorMessage = $th->getMessage();
            Log::error($errorMessage);

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function addToCart($id)
    {
        try {
            $user = Auth::user();
            if (Auth::check() && ($user->role_id != 1)) {

                $exist = Cart::where('user_id', $user->id)->where('course_id', $id)->first();
                $oldCart = Cart::where('user_id', $user->id)->first();
                $course = Course::find($id);

                if (isset($exist)) {
                    Toastr::error('Course already added in your cart', 'Failed');
                    return redirect()->back();
                } elseif (Auth::check() && ($user->role_id == 1)) {
                    Toastr::error('You logged in as admin so can not add cart !', 'Failed');
                    return redirect()->back();
                } else {

                    if (isset($oldCart)) {
                        $course = Course::find($id);
                        $cart = new Cart();
                        $cart->user_id = $user->id;
                        $cart->instructor_id = $course->user_id;
                        $cart->course_id = $id;
                        $cart->tracking = $oldCart->tracking;
                        if ($course->discount_price != null) {
                            $cart->price = $course->discount_price;
                        } else {
                            $cart->price = $course->price;
                        }
                        $cart->save();

                    } else {

                        $course = Course::find($id);
                        $cart = new Cart();
                        $cart->user_id = $user->id;
                        $cart->instructor_id = $course->user_id;
                        $cart->course_id = $id;
                        $cart->tracking = getTrx();
                        if ($course->discount_price != null) {
                            $cart->price = $course->discount_price;
                        } else {
                            $cart->price = $course->price;
                        }
                        $cart->save();
                    }


                    Toastr::success('Course Added to your cart', 'Success');
                    return redirect()->back();
                }

            } //If user not logged in then cart added into session

            else {
                $price = 0;
                $course = Course::find($id);
                if (!$course) {
                    Toastr::error('Course not found', 'Failed');
                    return redirect()->back();
                }

                if ($course->discount_price > 0) {
                    $price = $course->discount_price;
                } else {
                    $price = $course->price;
                }


                $cart = session()->get('cart');
                if (!$cart) {
                    $cart = [
                        $id => [
                            "id" => $course->id,
                            "course_id" => $course->id,
                            "instructor_id" => $course->user_id,
                            "instructor_name" => $course->user->name,
                            "title" => $course->title,
                            "image" => $course->image,
                            "slug" => $course->slug,
                            "price" => $price,
                        ]
                    ];
                    session()->put('cart', $cart);
                    Toastr::success('Course Added to your cart1', 'Success');
                    return redirect()->back();
                } elseif (isset($cart[$id])) {
                    Toastr::error('Course already added in your cart', 'Failed');
                    return redirect()->back();
                } else {

                    $cart[$id] = [

                        "id" => $course->id,
                        "course_id" => $course->id,
                        "instructor_id" => $course->user_id,
                        "instructor_name" => $course->user->name,
                        "title" => $course->title,
                        "image" => $course->image,
                        "slug" => $course->slug,
                        "price" => $price,
                    ];

                    session()->put('cart', $cart);

                    Toastr::success('Course Added to your cart', 'Success');
                    return redirect()->back();

                }


            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function buyNow($id)
    {
        try {
            $user = Auth::user();
            if (Auth::check() && ($user->role_id != 1)) {

                $exist = Cart::where('user_id', $user->id)->where('course_id', $id)->first();
                $oldCart = Cart::where('user_id', $user->id)->first();
                $course = Course::find($id);

                if (isset($exist)) {
                    Toastr::error('Course already added in your cart', 'Failed');
                    return redirect()->back();
                } elseif (Auth::check() && ($user->role_id == 1)) {
                    Toastr::error('You logged in as admin so can not add cart !', 'Failed');
                    return redirect()->back();
                } else {

                    if (isset($oldCart)) {
                        $course = Course::find($id);
                        $cart = new Cart();
                        $cart->user_id = $user->id;
                        $cart->instructor_id = $course->user_id;
                        $cart->course_id = $id;
                        $cart->tracking = $oldCart->tracking;
                        if ($course->discount_price != null) {
                            $cart->price = $course->discount_price;
                        } else {
                            $cart->price = $course->price;
                        }
                        $cart->save();

                    } else {

                        $course = Course::find($id);
                        $cart = new Cart();
                        $cart->user_id = $user->id;
                        $cart->instructor_id = $course->user_id;
                        $cart->course_id = $id;
                        $cart->tracking = getTrx();
                        if ($course->discount_price != null) {
                            $cart->price = $course->discount_price;
                        } else {
                            $cart->price = $course->price;
                        }
                        $cart->save();
                    }


                    Toastr::success('Course Added to your cart', 'Success');
                    return redirect(route('CheckOut'));
                }

            } //If user not logged in then cart added into session

            else {
                $price = 0;
                $course = Course::find($id);
                if (!$course) {
                    Toastr::error('Course not found', 'Failed');
                    return redirect()->back();
                }

                if ($course->discount_price > 0) {
                    $price = $course->discount_price;
                } else {
                    $price = $course->price;
                }


                $cart = session()->get('cart');
                if (!$cart) {
                    $cart = [
                        $id => [
                            "id" => $course->id,
                            "course_id" => $course->id,
                            "instructor_id" => $course->user_id,
                            "instructor_name" => $course->user->name,
                            "title" => $course->title,
                            "image" => $course->image,
                            "slug" => $course->slug,
                            "price" => $price,
                        ]
                    ];
                    session()->put('cart', $cart);
                    Toastr::success('Course Added to your cart1', 'Success');
                    return redirect()->back();
                } elseif (isset($cart[$id])) {
                    Toastr::error('Course already added in your cart', 'Failed');
                    return redirect()->back();
                } else {

                    $cart[$id] = [

                        "id" => $course->id,
                        "course_id" => $course->id,
                        "instructor_id" => $course->user_id,
                        "instructor_name" => $course->user->name,
                        "title" => $course->title,
                        "image" => $course->image,
                        "slug" => $course->slug,
                        "price" => $price,
                    ];

                    session()->put('cart', $cart);

                    Toastr::success('Course Added to your cart', 'Success');
                    return redirect()->back();

                }


            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function enrollNow($id)
    {
        if (!isFree($id)) {
            Toastr::error('This Course is not free', 'Failed');
            return redirect()->back();
        }
//        directEnroll
        try {
            $user = Auth::user();
            if (Auth::check() && ($user->role_id != 1)) {

                $checkout = new Checkout();
                $checkout->discount = 0.00;
                $checkout->purchase_price = 0;
                $checkout->tracking = getTrx();
                $checkout->user_id = Auth::user()->id;
                $checkout->price = 0;
                $checkout->status = 0;
                $checkout->save();
                $this->directEnroll($id, $checkout->tracking);
                Toastr::success('Course Enrolled Successfully', 'Success');
                return redirect()->back();
//                }

            } else {
                Toastr::error('Please Login as a student', 'Failed');
                return redirect()->back();

            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function CheckOut(Request $request)
    {

        try {
            $type = $request->type;
            if (!empty($type)) {
                $current = BillingDetails::where('user_id', Auth::id())->latest()->first();
            } else {
                $current = '';
            }

            $profile = Auth::user();
            $bills = BillingDetails::with('country')->where('user_id', Auth::id())->latest()->get();

            $countries = DB::table('countries')->select('id', 'name')->get();
            $cities = DB::table('spn_cities')->where('country_id', $profile->country)->select('id', 'name')->get();
            $data = $this->common();

            $tracking = Cart::where('user_id', Auth::id())->first()->tracking;
            if ($profile->role_id == 3) {
                if (isSubscribe()) {
                    $total = 0;
                } else {
                    $total = Cart::where('user_id', Auth::user()->id)->sum('price');

                }

            }
            $checkout = Checkout::where('tracking', $tracking)->where('user_id', Auth::id())->latest()->first();
            if (!$checkout)
                $checkout = new Checkout();

            $checkout->discount = 0.00;
            $checkout->purchase_price = $total;
            $checkout->tracking = $tracking;
            $checkout->user_id = Auth::id();
            $checkout->price = $total;
            $checkout->status = 0;
            $checkout->save();
            $methods = PaymentMethod::where('active_status', 1)->get(['method', 'logo']);

            $carts = Cart::where('user_id', Auth::id())->with('course', 'course.user')->get();


            return view(theme('checkout'), $data, compact('current', 'methods', 'bills', 'checkout', 'profile', 'countries', 'cities', 'carts'));
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->route('studentDashboard');
        }
    }

    public function removeItem($id)
    {
        try {
            $success = trans('lang.Cart has been Removed Successfully');
            if (Auth::check()) {

                $item = Cart::find($id);
                if ($item) {
                    $item->delete();
                }
                Toastr::success('Course removed from your cart', 'Success');
                return redirect()->back();
            } else {

                $cart = session()->get('cart');

                if (isset($cart[$id])) {
                    if (count($cart) == 1) {
                        unset($cart[$id]);
                        session()->forget('cart');
                    } else {
                        unset($cart[$id]);
                    }


                    session()->put('cart', $cart);
                    Toastr::success('Course removed from your cart', 'Success');
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function referralCode($code)
    {
        Session::put('referral', $code);
        return redirect()->route('register');
    }

    public function userPayoutInfo()
    {

        try {
            if (Auth::check()) {

                $user = Auth::user();
                $info['payout'] = $user->payout;

                if ($info['payout'] == "Paypal") {

                    return view('backend.instructor.payout_method', compact('info', 'user'));
                }

                if ($info['payout'] == "PayTm") {

                    return view('backend.instructor.payout_method', compact('info', 'user'));
                }

                if ($info['payout'] == "Stripe") {

                    return view('backend.instructor.payout_method', compact('info', 'user'));
                }
            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

        }
    }

    public function savePayOutEmail(Request $request)
    {

        try {
            $success = trans('lang.Updated') . ' ' . trans('lang.Successfully');
            $user = Auth::user();
            if (!is_null($request->paypal_email)) {
                $user->payout = 'Paypal';
                $user->payout_icon = "/public/uploads/payout/pay_1.png";
                $user->payout_email = $request->paypal_email;
            }
            if (!is_null($request->paytmEmail)) {
                $user->payout = 'PayTm';
                $user->payout_icon = "/public/uploads/payout/pay_4.png";
                $user->payout_email = $request->paytmEmail;
            }
            if (!is_null($request->stripeEmail)) {
                $user->payout = 'Stripe';
                $user->payout_icon = "/public/uploads/payout/stripe.png";
                $user->payout_email = $request->stripeEmail;
            }
            $user->save();

            Toastr::success('Method set as default', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();

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

            send_email($user, 'Course_Enroll_Payment', [
                'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                'course' => $course->title,
                'currency' => $user->currency->symbol ?? '$',
                'price' => ($user->currency->conversion_rate * $course->price),
                'instructor' => $course->user->name,
                'gateway' => 'Paypal',
            ]);

            send_email($user, 'Enroll_notify_Instructor', [
                'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                'course' => $course->title,
                'currency' => $user->currency->symbol ?? '$',
                'price' => ($user->currency->conversion_rate * $course->price),
                'rev' => @$reveune,
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

    public function categoryCourse($id, $name)
    {
        $category_info = Category::where('id', $id)->first();
        $courses = Course::where('category_id', $id)->with('user', 'category', 'subCategory', 'enrolls', 'comments', 'reviews', 'lessons')
            ->where('type', 1)
            ->where('status', 1)
            ->paginate(15);


        $data = $this->common();
        return view(theme('courses'), $data, compact('courses', 'category_info'));
    }

//todo work start here
    public function subCategoryCourse($id, $name)
    {


        $data = $this->common();
        $sub_category_info = SubCategory::with('category.subcategories')->where('id', $id)->first();
        $courses = Course::where('subcategory_id', $id)->with('user', 'category', 'subCategory', 'enrolls', 'comments', 'reviews', 'lessons')
            ->where('type', 1)
            ->where('status', 1)
            ->paginate(15);
        $sub_categories = $sub_category_info->category->subcategories;

        return view('frontend.default.sub_courses', $data, compact('sub_category_info', 'courses', 'sub_categories'));
    }

    public function about()
    {
        $about = '';
        return view('frontend.default.about', compact('about'));
    }

    public function categoryQuiz($id, $name)
    {
        $category_info = Category::where('id', $id)->first();
        $courses = Course::with('user', 'enrolls',)->whereHas('quiz', function ($query) use ($id) {
            $query->where('category_id', $id);
        })->where('status', 1)->where('type', 2)->get();

        $data = $this->common();


        return view(theme('quizzes'), $data, compact('courses', 'category_info'));
    }


    public function categoryClass($id, $name)
    {
        $data = $this->common();
        $category_info = Category::where('id', $id)->first();

        $courses = Course::with('enrolls', 'comments', 'reviews')
            ->whereHas('class', function ($query) use ($id) {
                $query->where('category_id', $id)
                    ->where('status', 1);
            })
            ->where('type', 3)
            ->get();

        return view(theme('lives'), $data, compact('courses', 'category_info'));
    }

    public function fetch_course(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('courses')
                ->where('title', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul>';

            foreach ($data as $row) {

                $output .= '
                        <li>
                            <a style="color:black" href="' . route('courseDetailsView', [$row->id, $row->slug]) . '">' . $row->title . '</a>
                        </li>
                        ';

            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function search_course(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $courses = Course::where('title', 'LIKE', "%{$query}%")
                ->with('user', 'category', 'subCategory', 'enrolls', 'comments', 'reviews', 'lessons')
                ->whereIn('type', [1, 2])
                ->where('status', 1)
                ->paginate(15);
            $data = $this->common();
            return view(theme('search'), $data, compact('courses', 'query'));

        } else {
            return redirect('/');
        }
    }

    public function topicReport($id)
    {

        try {
            $check = TopicReport::where('report_by', Auth::user()->id)->where('report_for', $id)->first();
            if ($check == null) {
                $report = new TopicReport();
                $report->report_by = Auth::user()->id;
                $report->report_for = $id;
                $report->save();
                Toastr::success('Report is under review', 'Success');
                return redirect()->back();
            } else {

                Toastr::error('You have already done report', 'Failed');
                return redirect()->back();
            }

        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function getQuizQusAns(Request $request)
    {
        $setting = QuizeSetup::first();

        $question_id = $request->get('questionId');
        $submit = $request->get('submit');
        $skip = $request->get('skip');
        $ans_id = $request->get('ansId');
        $numberOfQus = $request->get('numberOfQus');
        $quizId = $request->get('quizId');
        $courseId = $request->get('courseId');
        $user_id = Auth::id() ?? 1;


        $random_question = $setting->random_question;
        $mark_per_question = $setting->mark_per_question;
        $question_review = $setting->question_review;
        $show_result_each_submit = $setting->show_result_each_submit;

        if ($quizId) {


            $quiz = OnlineQuiz::find($quizId);


            if (!$submit) {


                if ($skip) {

                    $skipQuestion = $request->get('qusId');
                    $array = explode('|', $skipQuestion);
                    $qusId = $array[0];
                    $test = new QuizTest();
                    $test->user_id = $user_id;
                    $test->course_id = $courseId;
                    $test->quiz_id = $quizId;
                    $test->question_id = $qusId;
                    $test->ans_id = null;
                    $test->status = $question_review == 1 ? 0 : 1;
                    $test->save();
                }

                $alreadySubmitTest = QuizTest::select('question_id')->where('user_id', $user_id)->where('course_id', $courseId)->where('quiz_id', $quizId)->where('status', 1)->distinct()->get();

                $submitQusId = [];
                foreach ($alreadySubmitTest as $testQus) {
                    $submitQusId[] = $testQus->question_id;
                }


                $totalAssign = count($quiz->assign);
                if ($totalAssign != $numberOfQus) {
                    if ($random_question == 1) {
                        if (count($quiz->assign->whereNotIn('question_bank_id', $submitQusId)) != 0) {
                            foreach ($quiz->assign->whereNotIn('question_bank_id', $submitQusId)->random(1) as $questionAssign) {
                                $question['id'] = $questionAssign->questionBank->id;
                                $question['title'] = $questionAssign->questionBank->question;
                                foreach ($questionAssign->questionBank->questionMu as $k => $option) {
                                    $question['option'][$k]['title'] = $option->title;
                                    $question['option'][$k]['id'] = $option->id;
                                }
                            }
                        }

                    } else {
                        $questionAssign = $quiz->assign[$numberOfQus];
                        $question['id'] = $questionAssign->questionBank->id;
                        $question['title'] = $questionAssign->questionBank->question;
                        foreach ($questionAssign->questionBank->questionMu as $k => $option) {

                            $question['option'][$k]['title'] = $option->title;
                            $question['option'][$k]['id'] = $option->id;
                        }

                    }
                } else {

                }
                $output = '';
                if (!empty($question)) {

                    $output .= '   <div class="question">
                                                    <div class="multypol_qustion mb_30">
                                                    <input type="hidden" name="questionId" value="' . $question['id'] . '">
                                                        <h4 class="f_w_500">' . $question['title'] . '</h4>
                                                    </div>
                                                    <div class="question_select_box mb_80">';

                    foreach ($question['option'] as $option) {

                        $output .= '         <label class="primary_checkbox d-flex mr-12 ">
          <input name="ans" type="radio" value="' . $question['id'] . '|' . $option['id'] . '" class="ans">
                                                                <span class="checkmark"></span>' . $option['title'] . '
                                                            </label>';

                    }

                    $output .= '                     </div>
                                                </div>';
                    $numberOfQus++;
                } else {

                }


                return ['numberOfQus' => $numberOfQus, 'output' => $output];


            } else {

                $alreadySubmitTest = QuizTest::where('user_id', $user_id)->where('course_id', $courseId)->where('quiz_id', $quizId)->distinct()->get();

                $totalQus = totalQuizQus($quiz->id);
                $totalAns = count($alreadySubmitTest);
                $totalCorrect = 0;

                if ($totalAns != 0) {
                    foreach ($alreadySubmitTest as $test) {
                        $test->status = 1;
                        $test->save();
                        $ans = QuestionBankMuOption::find($test->ans_id);
                        if (!empty($ans))
                            if ($ans->status == 1) {
                                $score += $ans->question->marks ?? 1;
                                $totalCorrect++;
                            }
                    }
                }

                $output = '';

                $output .= 'Total Question ' . $totalQus . '<br>';
                $output .= 'Total Ans ' . $totalAns . '<br>';
                $output .= 'Total Correct ' . $totalCorrect . '<br>';
                return ['numberOfQus' => $numberOfQus, 'output' => $output];;
            }

        } else {
            return response()->json(['error' => 'Something Went Wrong'], 500);
        }
//        return $request->all();
    }

    public function submitAns(Request $request)
    {
        $setting = QuizeSetup::first();

        $qusAns = $request->get('qusAns');

        $array = explode('|', $qusAns);
        $ansId = $array[1];
        $qusId = $array[0];
        $userId = Auth::id() ?? 1;

        $question_review = $setting->question_review;
        $show_result_each_submit = $setting->show_result_each_submit;


        if ($request->get('courseId')) {
            $courseId = $request->get('courseId');


            if (!empty($qusAns)) {
                $totalQusSubmit = QuizTest::where('user_id', $userId)->count();
                $test = QuizTest::where('user_id', $userId)->where('course_id', $courseId)->where('question_id', $qusId)->first();

                if (empty($test)) {
                    $test = new QuizTest();
                    $test->user_id = $userId;
                    $test->course_id = $courseId;
                    $test->quiz_id = $request->get('quizId');
                    $test->question_id = $qusId;
                    $test->ans_id = $ansId;
                    $test->status = $question_review == 1 ? 0 : 1;
                    $test->count = $totalQusSubmit + 1;
                    $test->date = date('m/d/Y');
                    $test->save();
                } else {
                    if ($question_review == 1) {
                        $test->ans_id = $ansId;
                        $test->save();
                    } else {
                        return response()->json(['error' => 'Already Submitted'], 500);
                    }

                }

            }

            if ($show_result_each_submit == 1) {
                $ans = QuestionBankMuOption::find($ansId);

                if ($ans->status == 1) {
                    $result = true;
                } else {
                    $result = false;
                }

                return response()->json(['result' => $result], 200);
            } else {
                return response()->json(['submit' => true], 200);

            }


        } else {
            return response()->json(['error' => 'Something Went Wrong'], 500);
        }
//        return $request->all();
    }


    public function deposit(Request $request)
    {

        $data = $this->common();
        $records = DepositRecord::where('user_id', Auth::user()->id)->latest()->paginate(5);
        $methods = PaymentMethod::where('active_status', 1)->where('module_status', 1)->where('method', '!=', 'Wallet')->where('method', '!=', 'Offline Payment')->get(['method', 'logo']);

        $amount = $request->deposit_amount;

        return view(theme('deposit'), $data, compact('amount', 'records', 'methods'));
    }

    public function Invoice($id)
    {

        try {
            $data = $this->common();
            $enroll = Checkout::where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->with('courses', 'user')->first();

            if ($enroll == null) {
                Toastr::error('Invalid Invoice !', 'Failed');
                return redirect()->back();
            }
            return view(theme('myInvoices'), $data, compact('enroll'));
        } catch (\Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function subInvoice($id)
    {

        try {
            $data = $this->common();
            $enroll = SubscriptionCheckout::where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->with('plan', 'user')->first();

            if ($enroll == null) {
                Toastr::error('Invalid Invoice !', 'Failed');
                return redirect()->back();
            }
            return view(theme('mySubInvoices'), $data, compact('enroll'));
        } catch (\Throwable $th) {
            dd($th);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function getResult($courseId, $quizId)
    {
        $userId = Auth::id() ?? 1;
        $alreadySubmitTest = QuizTest::where('user_id', $userId)->where('course_id', $courseId)->where('quiz_id', $quizId)->distinct()->get();
        $quiz = OnlineQuiz::find($quizId);
        $totalQus = totalQuizQus($quiz->id);
        $totalAns = count($alreadySubmitTest);
        $totalCorrect = 0;
        $totalScore = totalQuizMarks($quizId);
        $score = 0;
        if ($totalAns != 0) {
            $hasResult = true;
            foreach ($alreadySubmitTest as $test) {
                $test->status = 1;
                $test->save();
                $ans = QuestionBankMuOption::find($test->ans_id);

                if (!empty($ans)) {
                    if ($ans->status == 1) {

                        $score += $ans->question->marks ?? 1;
                        $totalCorrect++;
//                        $totalScore +=$ans->
                    }
                }

            }
        } else {
            $hasResult = false;
        }

        $output = '';
//todo work
        $output .= ' Total Question ' . $totalQus . '<br>';
        $output .= ' Total Ans ' . $totalAns . '<br>';
        $output .= ' Total Correct ' . $totalCorrect . '<br>';
        $output .= ' Score ' . $score . ' out of ' . $totalScore . ' <br>';
        return ['hasResult' => $hasResult, 'output' => $output];;
    }

    public function contact()
    {
        try {
            $data = $this->common();
            $courses = Course::where('status', 1)->count();
            $enrolls = CourseEnrolled::where('status', 1)->count();
            $students = User::where('role_id', 3)->count();
            $instructors = User::where('role_id', 2)->count();
            $members = User::where('role_id', ' != ', 1)->count();
            $about = AboutPage::first();
            return view(theme('contact'), $data, compact('courses', 'enrolls', 'instructors', 'about', 'members', 'students'));
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back();
        }
    }

    public function contactMsgSubmit(Request $request)
    {
        if (appMode()) {
            echo '<button id = "successBtn" type = "button"   class="theme_btn small_btn submit-btn w-100 text-center" >
    For demo version you can not send message
    </button > ';
            return false;
        }
        $name = $request->get('name');
        $email = $request->get('email');
        $message = $request->get('message');

        $result = 'Name: ' . $name . ' < br> ';
        $result .= 'Email: ' . $email . ' < br> ';
        $result .= 'Message: ' . $message . ' < br> ';

        $setting = GeneralSettings::first();


        $to = $setting->email ?? '';
        $subject = $request->get('subject');

        $headers = 'From:$email' . "\r\n" .
            'Reply - To: $email' . "\r\n" .
            'X - Mailer: PHP / ' . phpversion();

        $send = mail($to, $subject, $result, $headers);

        if ($send) {
            echo '<button id = "successBtn" type = "button"   class="theme_btn small_btn submit-btn w-100 text-center" >
    Successfully Sent Message
    </button > ';
        } else {
            echo ' <button type = "button"    class="theme_btn small_btn submit-btn w-100 text-center" >
    Something went wrong
    </button > ';
        }
    }

    public function frontPage($id, $slug)
    {
        try {
            $data = $this->common();
            $courses = Course::where('status', 1)->count();
            $enrolls = CourseEnrolled::where('status', 1)->count();
            $students = User::where('role_id', 3)->count();
            $instructors = User::where('role_id', 2)->count();
            $members = User::where('role_id', ' != ', 1)->count();
            $about = AboutPage::first();
            $page = FrontPage::findOrFail($id);
            if ($page->status != 1) {
                Toastr::error('Sorry. Page is not active', trans('common.Failed'));
                return redirect()->back();
            }
            return view(theme('page'), $data, compact('courses', 'enrolls', 'instructors', 'about', 'members', 'students', 'page'));
        } catch (\Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function instructors()
    {
        try {
            $data = $this->common();
            $instructors = User::where('role_id', 2)->get();
//            $page = FrontPage::findOrFail($id);
            return view(theme('instructors'), $data, compact('instructors'));
        } catch (\Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function instructorDetails($id, $name)
    {
        try {
            $data = $this->common();
            $instructor = User::findOrFail($id);
            $courses = Course::where('user_id', $id)->get();
            $students = DB::table('course_enrolleds')
                ->join('courses', 'course_enrolleds.course_id', '=', 'courses.id')
                ->where('courses.user_id', $id)
                ->distinct('course_enrolleds.user_id')->count();


            $rating = DB::table('course_reveiws')
                ->select('course_reveiws.*', 'courses.user_id')
                ->join('courses', 'course_reveiws.course_id', '=', 'courses.id')
                ->where('courses.user_id', $id)
                ->sum('star');
            $totalRating = DB::table('course_reveiws')
                ->join('courses', 'course_reveiws.course_id', '=', 'courses.id')
                ->where('courses.user_id', $id)->count();

            return view(theme('instructor'), $data, compact('students', 'totalRating', 'rating', 'instructor', 'courses'));
        } catch (\Throwable $th) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function becomeInstructor()
    {
        try {
            $data = $this->common();
            $icon_left = BecomeInstructor::where('section', 'icon_left')->first(['id', 'title', 'description', 'icon']);
            $icon_mid = BecomeInstructor::where('section', 'icon_mid')->first(['id', 'title', 'description', 'icon']);
            $icon_right = BecomeInstructor::where('section', 'icon_right')->first(['id', 'title', 'description', 'icon']);
            $joining_part = BecomeInstructor::where('section', 'joining_part')->first(['id', 'title', 'description', 'btn_name']);
            $cta_part = BecomeInstructor::where('section', 'cta_part')->first(['id', 'title', 'description', 'btn_name']);
            $work = BecomeInstructor::where('section', 'How it Works')->first(['id', 'section', 'title', 'image', 'video']);
            $processes = WorkProcess::where('status', '1')->get();
            return view(theme('becomeInstructor'), $data, compact('cta_part', 'icon_left', 'icon_mid', 'icon_right', 'joining_part', 'work', 'processes'));
        } catch (\Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function allBlog()
    {
        try {
            $data = $this->common();
            $blogs = Blog::where('status', 1)->with('user')->latest()->paginate(10);

            return view(theme('blogs'), $data, compact('blogs'));

        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function blogDetails(Request $request, $id, $slug)
    {
        $data = $this->common();
        try {
            $blog = Blog::findOrFail($id);
            if ($blog->status == 0) {
                if ($request->preview != 1) {
                    Toastr::error('Blog status is not active', 'Failed');
                    return Redirect::route('studentDashboard');
                }
            }
            if (empty($request->preview)) {
                $blog->viewed = $blog->viewed + 1;
                $blog->save();
            }
            return view(theme('blogDetails'), $data, compact('blog'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function courses(Request $request)
    {
        $data = $this->common();
        $query = Course::with('user', 'category', 'subCategory', 'enrolls', 'comments', 'reviews', 'lessons');


        $type = $request->type;
        if (empty($type)) {
            $type = '';
        } else {
            $types = explode(',', $type);
            if (count($types) == 1) {
                foreach ($types as $t) {
                    if ($t == 'free') {
                        $query->where('price', ' == ', "0");

                    } elseif ($t == 'paid') {
                        $query->where('price', ' != ', "0");
                    }
                }
            }
        }

        $language = $request->language;
        if (empty($language)) {
            $language = '';
        } else {
            $row_languages = explode(',', $language);
            $languages = [];
            foreach ($row_languages as $l) {
                $lang = Language::where('code', $l)->first();
                if ($lang) {
                    $languages[] = $lang->id;
                }
            }
            $query->whereIn('lang_id', $languages);
        }


        $level = $request->level;
        if (empty($level)) {
            $level = '';
        } else {
            $levels = explode(',', $level);
            $query->whereIn('level', $levels);
        }


        $category = $request->category;
        if (empty($category)) {
            $category = '';
        } else {
            $categories = explode(',', $category);
            $query->whereIn('category_id', $categories);
        }


        $query->where('type', 1)->where('status', 1);

        $order = $request->order;
        if (empty($order)) {
            $order = '';
        } else {
            if ($order == "price") {
                $query->orderBy('price', 'asc');
            } else {
                $query->latest();
            }
        }

        $total = $query->count();
        $courses = $query->paginate(9);


        return view(theme('courses'), $data, compact('order', 'category', 'level', 'order', 'language', 'type', 'total', 'courses'));
    }

    public function quizzes(Request $request)
    {
        $data = $this->common();
        $query = Course::with('user', 'category', 'subCategory', 'enrolls', 'comments', 'reviews', 'lessons');


        $type = $request->type;
        if (empty($type)) {
            $type = '';
        } else {
            $types = explode(',', $type);
            if (count($types) == 1) {
                foreach ($types as $t) {
                    if ($t == 'free') {
                        $query->where('price', ' == ', "0");

                    } elseif ($t == 'paid') {
                        $query->where('price', ' != ', "0");
                    }
                }
            }


        }

        $language = $request->language;
        if (empty($language)) {
            $language = '';
        } else {
            $row_languages = explode(',', $language);
            $languages = [];
            foreach ($row_languages as $l) {
                $lang = Language::where('code', $l)->first();
                if ($lang) {
                    $languages[] = $lang->id;
                }
            }
            $query->whereIn('lang_id', $languages);
        }


        $level = $request->level;
        if (empty($level)) {
            $level = '';
        } else {
            $levels = explode(',', $level);
            $query->whereIn('level', $levels);
        }


        $category = $request->category;
        if (empty($category)) {
            $category = '';
        } else {
            $categories = explode(',', $category);

            $query->whereHas('quiz', function ($q) use ($categories) {
                $q->whereIn('category_id', $categories);
            });

        }


        $query->where('type', 2)->where('status', 1);

        $order = $request->order;
        if (empty($order)) {
            $order = '';
        } else {
            if ($order == "price") {
                $query->orderBy('price', 'asc');
            } else {
                $query->latest();
            }
        }

        $total = $query->count();
        $courses = $query->paginate(9);

        return view(theme('quizzes'), $data, compact('order', 'category', 'level', 'order', 'language', 'type', 'total', 'courses'));
    }

    public function classes(Request $request)
    {
        $data = $this->common();
        $query = Course::with('user', 'category', 'subCategory', 'enrolls', 'comments', 'reviews', 'lessons');


        $type = $request->type;
        if (empty($type)) {
            $type = '';
        } else {
            $types = explode(',', $type);
            if (count($types) == 1) {
                foreach ($types as $t) {
                    if ($t == 'free') {
                        $query->where('price', ' == ', "0");

                    } elseif ($t == 'paid') {
                        $query->where('price', ' != ', "0");
                    }
                }
            }


        }

        $language = $request->language;
        if (empty($language)) {
            $language = '';
        } else {
            $row_languages = explode(',', $language);
            $languages = [];
            foreach ($row_languages as $l) {
                $lang = Language::where('code', $l)->first();
                if ($lang) {
                    $languages[] = $lang->id;
                }
            }
            $query->whereIn('lang_id', $languages);
        }


        $level = $request->level;
        if (empty($level)) {
            $level = '';
        } else {
            $levels = explode(',', $level);
            $query->whereIn('level', $levels);
        }


        $category = $request->category;
        if (empty($category)) {
            $category = '';
        } else {
            $categories = explode(',', $category);

            $query->whereHas('quiz', function ($q) use ($categories) {
                $q->whereIn('category_id', $categories);
            });

        }


        $query->where('type', 3)->where('status', 1);

        $order = $request->order;
        if (empty($order)) {
            $order = '';
        } else {
            if ($order == "price") {
                $query->orderBy('price', 'asc');
            } else {
                $query->latest();
            }
        }

        $total = $query->count();
        $courses = $query->paginate(9);

        return view(theme('classes'), $data, compact('order', 'category', 'level', 'order', 'language', 'type', 'total', 'courses'));
    }


    public function search(Request $request)
    {
        $data = $this->common();
        $query = Course::with('user', 'category', 'subCategory', 'enrolls', 'comments', 'reviews', 'lessons');

        if ($request->get('query')) {
            $search = $request->get('query');
            $query->where('title', 'LIKE', "%{$search}%");

        } else {
            $query = '';
        }
        $type = $request->type;
        if (empty($type)) {
            $type = '';
        } else {
            $types = explode(',', $type);
            if (count($types) == 1) {
                foreach ($types as $t) {
                    if ($t == 'free') {
                        $query->where('price', ' == ', "0");

                    } elseif ($t == 'paid') {
                        $query->where('price', ' != ', "0");
                    }
                }
            }


        }

        $language = $request->language;
        if (empty($language)) {
            $language = '';
        } else {
            $row_languages = explode(',', $language);
            $languages = [];
            foreach ($row_languages as $l) {
                $lang = Language::where('code', $l)->first();
                if ($lang) {
                    $languages[] = $lang->id;
                }
            }
            $query->whereIn('lang_id', $languages);
        }


        $level = $request->level;
        if (empty($level)) {
            $level = '';
        } else {
            $levels = explode(',', $level);
            $query->whereIn('level', $levels);
        }


        $category = $request->category;
        if (empty($category)) {
            $category = '';
        } else {
            $categories = explode(',', $category);

            $query->whereHas('quiz', function ($q) use ($categories) {
                $q->whereIn('category_id', $categories);
            });

        }


        $query->where('status', 1);

        $order = $request->order;
        if (empty($order)) {
            $order = '';
        } else {
            if ($order == "price") {
                $query->orderBy('price', 'asc');
            } else {
                $query->latest();
            }
        }

        $total = $query->count();
        $courses = $query->paginate(9);

        return view(theme('search'), $data, compact('search', 'order', 'category', 'level', 'order', 'language', 'type', 'total', 'courses'));
    }

    public function StudentApplyCoupon(Request $request)
    {


        $this->validate($request, [
            'code' => 'required',
            'total' => 'required'
        ]);

        try {
            $code = $request->code;

            $coupon = Coupon::where('code', $code)->whereDate('start_date', '<=', Carbon::now())
                ->whereDate('end_date', '>=', Carbon::now())->where('status', 1)->first();
            if (isset($coupon)) {

                $tracking = Cart::where('user_id', Auth::id())->first()->tracking;
                $total = $request->total;
                $max_dis = $coupon->max_discount;
                $min_purchase = $coupon->min_purchase;
                $type = $coupon->type;
                $value = $coupon->value;

                $couponApply = false;


                $checkout = Checkout::where('tracking', $tracking)->first();
                if (empty($checkout)) {
                    $checkout = new Checkout();
                }

                $checkTrackingId = Checkout::where('tracking', $tracking)->where('coupon_id', $coupon)->first();

                if ($checkTrackingId) {
                    return response()->json([
                        'error' => "Already used this coupon",
                        'total' => $total,
                    ], 200);
                }

                if ($total >= $min_purchase) {


                    if ($coupon->category == 1) {
                        $couponApply = true;
                    } elseif ($coupon->category == 2) {

                        if (count($checkout->carts) != 1) {
                            return response()->json([
                                'error' => "This coupon apply for single course",
                                'total' => $total,
                            ], 200);
                        }

                        if ($checkout->carts[0]->course_id == $coupon->course_id) {
                            $couponApply = true;
                        } else {
                            return response()->json([
                                'error' => "This coupon is not valid for this course.",
                                'total' => $total,
                            ], 200);
                        }
                    } elseif ($coupon->category == 3) {
//                        dd();
                        if ($coupon->coupon_user_id != $checkout->user_id) {
                            return response()->json([
                                'error' => "This coupon not for you.",
                                'total' => $total,
                            ], 200);
                        } else {
                            $couponApply = true;
                        }
//                        $couponApply=true;
                    }

                    $final = $total;
                    if ($couponApply) {
                        if ($type == 0) {

                            $discount = (($total * $value) / 100);
                            if ($discount >= $max_dis) {

                                $final = ($total - $max_dis);
                                $checkout->discount = $max_dis;
                                $checkout->purchase_price = $final;
                            } else {

                                $final = ($total - $discount);
                                $checkout->discount = $discount;
                                $checkout->purchase_price = $final;

                            }
                        } else {

                            $discount = $value;

                            if ($discount >= $max_dis) {
                                $final = ($total - $max_dis);

                                $checkout->discount = $max_dis;
                                $checkout->purchase_price = $final;
                            } else {
                                $final = ($total - $discount);
                                $checkout->discount = $discount;
                                $checkout->purchase_price = $final;
                            }
                        }
                    }


                    $checkout->tracking = $tracking;
                    $checkout->user_id = Auth::id();
                    $checkout->coupon_id = $coupon->id;
                    $checkout->price = $total;
                    $checkout->status = 0;
                    $checkout->save();

                    return response()->json([
                        'success' => "Coupon Successfully Applied",
                        'total' => $final,
                    ], 200);
                } else {
                    return response()->json([
                        'error' => "Coupon Minimum Purchase Does Not Match",
                        'total' => $total,
                    ], 200);
                }

            } else {

                return response()->json([
                    'error' => "Invalid Coupon",
                    'total' => $request->get('total'),
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Operation Failed']);
        }
    }


    public function enrollOrCart($id)
    {
        $user = Auth::user();

        $course = Course::findOrFail($id);
        $output = [];
        if ($course->discount_price != null) {
            $price = $course->discount_price;
        } else {
            $price = $course->price;
        }

        //add to cart
        $output['type'] = 'addToCart';


        try {
            $user = Auth::user();
            if (Auth::check() && ($user->role_id != 1)) {
                if (!isEnrolled($course->id, $user->id)) {
                    $exist = Cart::where('user_id', $user->id)->where('course_id', $id)->first();
                    $oldCart = Cart::where('user_id', $user->id)->first();
                    $course = Course::find($id);

                    if (isset($exist)) {
                        $output['result'] = 'failed';
                        $output['message'] = 'Course already added in your cart';
                    } elseif (Auth::check() && ($user->role_id == 1)) {
                        $output['result'] = 'failed';
                        $output['message'] = 'You logged in as admin so can not add cart';
                    } else {

                        if (isset($oldCart)) {
                            $course = Course::find($id);
                            $cart = new Cart();
                            $cart->user_id = $user->id;
                            $cart->instructor_id = $course->user_id;
                            $cart->course_id = $id;
                            $cart->tracking = $oldCart->tracking;
                            if ($course->discount_price != null) {
                                $cart->price = $course->discount_price;
                            } else {
                                $cart->price = $course->price;
                            }
                            $cart->save();

                        } else {

                            $course = Course::find($id);
                            $cart = new Cart();
                            $cart->user_id = $user->id;
                            $cart->instructor_id = $course->user_id;
                            $cart->course_id = $id;
                            $cart->tracking = getTrx();
                            if ($course->discount_price != null) {
                                $cart->price = $course->discount_price;
                            } else {
                                $cart->price = $course->price;
                            }
                            $cart->save();
                        }

                        $output['result'] = 'success';
                        $output['total'] = cartItem();
                        $output['message'] = 'Course Added to your cart';
                    }
                } else {
                    $output['result'] = 'failed';
                    $output['message'] = 'Already Enrolled ';
                }

            } //If user not logged in then cart added into session

            else {
                $price = 0;
                $course = Course::find($id);
                if (!$course) {
                    $output['result'] = 'failed';
                    $output['message'] = 'Course not found';

                }

                if ($course->discount_price > 0) {
                    $price = $course->discount_price;
                } else {
                    $price = $course->price;
                }


                $cart = session()->get('cart');
                if (!$cart) {
                    $cart = [
                        $id => [
                            "id" => $course->id,
                            "course_id" => $course->id,
                            "instructor_id" => $course->user_id,
                            "instructor_name" => $course->user->name,
                            "title" => $course->title,
                            "image" => $course->image,
                            "slug" => $course->slug,
                            "price" => $price,
                        ]
                    ];
                    session()->put('cart', $cart);

                    $output['result'] = 'success';
                    $output['total'] = cartItem();
                    $output['message'] = 'Course Added to your cart';
                } elseif (isset($cart[$id])) {
                    $output['result'] = 'failed';
                    $output['message'] = 'Course already added in your cart';
                } else {

                    $cart[$id] = [

                        "id" => $course->id,
                        "course_id" => $course->id,
                        "instructor_id" => $course->user_id,
                        "instructor_name" => $course->user->name,
                        "title" => $course->title,
                        "image" => $course->image,
                        "slug" => $course->slug,
                        "price" => $price,
                    ];

                    session()->put('cart', $cart);

                    $output['result'] = 'success';
                    $output['total'] = cartItem();
                    $output['message'] = 'Course Added to your cart';

                }

            }
        } catch (\Exception $e) {
            $output['result'] = 'failed';
            $output['message'] = 'Operation Failed !';
        }


        return json_encode($output);
    }

    public function getItemList()
    {
        $carts = [];
        if (Auth::check()) {
            $items = Cart::where('user_id', Auth::id())->with('course', 'course')->get();

            foreach ($items as $key => $cart) {
                $carts[$key]['course_id'] = $cart['course_id'];
                $carts[$key]['instructor_id'] = $cart['instructor_id'];
                $carts[$key]['title'] = $cart->course->title;
                $carts[$key]['instructor_name'] = $cart->course->user->name;
                $carts[$key]['image'] = getCourseImage($cart->course->thumbnail);
                if ($cart->course->discount_price != null) {
                    $carts[$key]['price'] = getPriceFormat($cart->course->discount_price);
                } else {
                    $carts[$key]['price'] = getPriceFormat($cart->course->price);
                }
            }

        } else {
            $items = session()->get('cart');

            foreach ($items as $key => $cart) {
                $course = Course::find($cart['course_id']);
                if ($course) {
                    $carts[$key]['course_id'] = $course->id;
                    $carts[$key]['instructor_id'] = $course->user_id;
                    $carts[$key]['title'] = $course->title;
                    $carts[$key]['instructor_name'] = $course->user->name;
                    $carts[$key]['image'] = getCourseImage($course->thumbnail);

                    if ($course->discount_price != null) {
                        $carts[$key]['price'] = getPriceFormat($course->discount_price);
                    } else {
                        $carts[$key]['price'] = getPriceFormat($course->price);
                    }
                }

            }

        }


        return json_encode($carts);
    }


    public function quizStart($id, $quiz_id, $slug)
    {


        try {
            $user = Auth::user();

            if (Auth::check() && isEnrolled($id, $user->id)) {
                $data = $this->common();

                $course = Course::where('courses.id', $id)->first();
                $quiz = OnlineQuiz::where('id', $quiz_id)->first();

                $quizSetup = QuizeSetup::first();

                // return $quizzes;
                return view(theme('quizStart'), $data, compact('quiz', 'quizSetup', 'course'));

            } else {
                Toastr::error('Permission Denied', 'Failed');
                return redirect()->back();
            }


        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function quizSubmit(Request $request)
    {
        try {
            $setting = QuizeSetup::first();
            $allAns = $request->ans;
            $userId = Auth::id();
            $courseId = $request->get('courseId');
            $quizId = $request->get('quizId');
            $question_review = $setting->question_review;
            $show_result_each_submit = $setting->show_result_each_submit;

            $quiz = new QuizTest();
            $quiz->user_id = $userId;
            $quiz->course_id = $courseId;
            $quiz->quiz_id = $quizId;
            $quiz->save();
            foreach ($allAns as $item) {
                $qusAns = explode('|', $item);
                $qus = $qusAns[0] ?? '';
                $ans = $qusAns[1] ?? '';


                if ($courseId && !empty($qusAns)) {
                    $quizDetails = new QuizTestDetails();
                    $option = QuestionBankMuOption::find($ans);
                    if ($option) {
                        $quizDetails->quiz_test_id = $quiz->id;
                        $quizDetails->qus_id = $qus;
                        $quizDetails->ans_id = $ans;
                        $quizDetails->status = $option->status;
                        $quizDetails->mark = $option->question->marks;

                        $quizDetails->save();
                    }


                }
            }
            Toastr::success('Successfully submitted', 'Success');
            return redirect()->route('getQuizResult', $quiz->id);

        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function quizResult($id)
    {
        try {
            $data = $this->common();
            $quizSetup = QuizeSetup::first();
            $user = Auth::user();

            $quiz = QuizTest::findOrFail($id);
            if ($quiz->user_id == $user->id) {
                $course = Course::findOrFail($quiz->course_id);


                $onlineQuiz = OnlineQuiz::find($quiz->quiz_id);

                $totalQus = totalQuizQus($quiz->quiz_id);
                $totalAns = count($quiz->details);
                $totalCorrect = 0;
                $totalScore = totalQuizMarks($quiz->quiz_id);
                $score = 0;
                if ($totalAns != 0) {
                    foreach ($quiz->details as $test) {
                        $ans = QuestionBankMuOption::find($test->ans_id);

                        if (!empty($ans)) {
                            if ($ans->status == 1) {

                                $score += $ans->question->marks ?? 1;
                                $totalCorrect++;
                            }
                        }

                    }
                }


                $result = [];
                $result['totalQus'] = $totalQus;
                $result['totalAns'] = $totalAns;
                $result['totalCorrect'] = $totalCorrect;
                $result['totalWrong'] = $totalAns - $totalCorrect;
                $result['score'] = $score;
                $result['totalScore'] = $totalScore;
                $result['passMark'] = $onlineQuiz->percentage ?? 0;
                $result['mark'] = $score / $totalScore * 100 ?? 0;
                $result['status'] = $result['mark'] >= $result['passMark'] ? "Passed" : "Failed";

                $certificate = Certificate::where('for_quiz', 1)->first();
                return view(theme('quizResult'), $data, compact('certificate', 'quiz', 'quizSetup', 'user', 'course', 'result'));

            } else {
                Toastr::error('Permission Denied', 'Failed');
                return redirect()->back();
            }

        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function quizResultPreview($id)
    {

        try {
            $questions = [];
            $user = Auth::user();
            $quizTest = QuizTest::findOrFail($id);

            if (Auth::check() && $quizTest->user_id == $user->id) {
                $data = $this->common();
                $quizSetup = QuizeSetup::first();

                $course = Course::with('quiz')
                    ->where('courses.id', $quizTest->course_id)->first();

                $quiz = OnlineQuiz::findOrFail($quizTest->quiz_id);

                foreach (@$quiz->assign as $key => $assign) {
                    $questions[$key]['qus'] = $assign->questionBank->question;
                    foreach (@$assign->questionBank->questionMu as $key2 => $option) {
                        $questions[$key]['option'][$key2]['title'] = $option->title;
//                        $questions[$key]['option'][$key2]['status'] = $option->status;
                        $questions[$key]['option'][$key2]['right'] = $option->status == 1 ? true : false;
//                        $questions[$key][$key2]['status'] = $option->title;


                        $test = QuizTestDetails::where('quiz_test_id', $quizTest->id)->where('ans_id', $option->id)->first();
                        if ($test) {
                            $questions[$key]['isSubmit'] = true;
                            if ($test->status == 0) {
                                $questions[$key]['option'][$key2]['wrong'] = $test->status == 0 ? true : false;
                                $questions[$key]['isWrong'] = true;
                            }
                        }

                    }
                }


                // return $quizzes;
                return view(theme('quizResultPreview'), $data, compact('questions', 'quizSetup', 'course'));

            } else {
                Toastr::error('Permission Denied', 'Failed');
                return redirect()->back();
            }

        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function purchaseInvoice($id)
    {

        $enroll = Checkout::with('billing', 'courses')->find($id);
        $invoice = $enroll->id + 1000;

        $pdf = PDF::loadView(theme('purchase-invoice-pdf'), compact('enroll'));
        return $pdf->download("INV-{$invoice}.pdf");
//        return view('frontend.infixlmstheme.layouts.purchase-invoice-pdf',compact('enroll'));
        $enroll = Checkout::with('billing', 'courses')->find($id);
        $invoice = $enroll->id + 1000;
//        $pdf = PDF::loadView(,compact('enroll'))->setPaper('a4', 'portrait');
//        return $pdf->download("INV-{$invoice}.pdf");
//


//        return view(theme('purchase-invoice-pdf'), compact('enroll'));

        $pdf = PDF::loadView(theme('purchase-invoice-pdf'), compact('enroll'));

        return $pdf->stream('document.pdf');


//        return view(theme('purchase-invoice-pdf'),compact('enroll'));
    }

    public function lessonComplete(Request $request)
    {


        try {
            $lesson = LessonComplete::where('course_id', $request->course_id)->where('lesson_id', $request->lesson_id)->where('user_id', Auth::id())->first();
            $certificateBtn = 0;
            if (!$lesson) {
                $lesson = new LessonComplete();
                $lesson->user_id = Auth::id();
                $lesson->course_id = $request->course_id;
                $lesson->lesson_id = $request->lesson_id;
            }
            $lesson->status = $request->status;
            if ($request->status == 1)
                $success = trans('frontend.Lesson Marked as Complete');
            else
                $success = trans('frontend.Lesson Marked as Incomplete');
            $lesson->save();

            if (count($lesson->course->lessons) == count($lesson->course->completeLessons->where('status', 1)))
                $certificateBtn = 1;
//
            return response()->json([
                'success' => $success,
                'btn' => $certificateBtn
            ], 200);


        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function lessonCompleteAjax(Request $request)
    {


        try {
            $lesson = LessonComplete::where('course_id', $request->course_id)->where('lesson_id', $request->lesson_id)->where('user_id', Auth::id())->first();

            if (!$lesson) {
                $lesson = new LessonComplete();
                $lesson->user_id = Auth::id();
                $lesson->course_id = $request->course;
                $lesson->lesson_id = $request->lesson;
            }
            $lesson->status = 1;
            $lesson->save();

            return true;


        } catch (\Exception $e) {
            return false;
        }

    }

    public function getCertificate($id, $slug, Request $request)
    {

        $course = Course::findOrFail($id);

        if ($course->type == 1)
            $certificate = Certificate::where('for_course', 1)->first();
        else
            $certificate = Certificate::where('for_quiz', 1)->first();

        if (!$certificate) {
            Toastr::error(trans('certificate.Right Now You Cannot Download The Certificate'));
            return back();
        }


        if (!isEnrolled($course->id, Auth::user()->id)) {
            Toastr::error(trans('certificate.You Are Not Already Enrolled This course. Please Enroll It First'));
            return back();
        }

        if (count($course->lessons) != count($course->completeLessons->where('status', 1)->where('user_id', Auth::user()->id))) {
            Toastr::error(trans('certificate.Please Complete The Course First'));
            return back();
        }


        $title = "{$course->slug}-certificate-for-" . Auth::user()->name . ".jpg";

        $downloadFile = new CertificateController();
        try {
            $request->course = $course;
            $request->user = Auth::user();
            $certificate = $downloadFile->makeCertificate($certificate->id, $request)['image'] ?? '';

            $certificate->encode('jpg');

            $headers = [
                'Content-Type' => 'image/jpeg',
                'Content-Disposition' => 'attachment; filename=' . $title,
            ];
            return response()->stream(function () use ($certificate) {
                echo $certificate;
            }, 200, $headers);
        } catch (\Exception $e) {

            Toastr::error(trans('common.Something Went Wrong'), 'Error');
            return back();
        }

    }

    public function loggedInDevices()
    {
        $data = $this->common();
        $logins = UserLogin::where('user_id', auth()->id())->where('status', 1)->get();

        return view('frontend.infixlmstheme.log_in_devices', compact('logins'))->with($data);
    }

    public function logOutDevice(Request $request)
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            Toastr::error(trans('frontend.Your Password Doesnt Match'));
            return back();
        }

        if (demoCheck()) {
            return redirect()->back();
        }

        $login = UserLogin::find($request->id);
        Auth::logoutOtherDevices($request->password);
        $login->status = 0;
        $login->logout_at = Carbon::now();
        $login->save();

        Toastr::success(trans('frontend.Logged Out SuccessFully'));
        return back();
    }

    public function page($slug)
    {
        $data = $this->common();
        $page = FooterWidget::where('slug', $slug)->first();
        return view(theme('footer_page'), compact('page'))->with($data);
    }

    public function subscriptionCourses()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        if (!isSubscribe()) {
            Toastr::error('You must subscribe first', 'Error');
            return redirect()->back();
        }
        try {
            $data = $this->common();


            $courses = DB::table('courses')
                ->join('users', 'users.id', '=', 'courses.user_id')
                ->whereIn('courses.type', [1, 2, 3])
                ->select('courses.*')
                ->orderBy('courses.created_at', 'desc')
                ->paginate(12);


            return view(theme('subscription-courses'), $data, compact('courses'));

        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function subscription(Request $request)
    {
        if (moduleStatusCheck('Subscription')) {
            $data = $this->common();
            $faqs = Faq::where('status', 1)->orderBy('order', 'asc')->get();
            $plans = CourseSubscription::where('status', 1)->orderBy('order', 'asc')->get();
            $plan_features = PlanFeature::where('status', 1)->orderBy('order', 'asc')->get();
            return view(theme('subscription'), compact('faqs', 'plans', 'plan_features'))->with($data);

        } else {
            Toastr::error('Module not active', 'Error');
            return redirect()->back();
        }
    }


    public function subscriptionCheckout(Request $request)
    {
        $data = $this->common();
        if (empty($request->plan)) {
            $s_plan = '';
        } else {
            $s_plan = $request->plan;
        }

        if (empty($request->price)) {
            $price = '';
        } else {
            $price = $request->price;
        }

        if (!empty($s_plan) && !empty($price)) {
            if (Auth::check()) {
                if (Auth::user()->role_id == 3) {
                    $subscription = new CourseSubscriptionController();
                    $addCart = $subscription->addToCart(Auth::user()->id, $s_plan);

                    if (!$addCart) {
                        Toastr::error('Invalid Request', 'Error');
                        return \redirect()->route('courseSubscription');
                    }
                } else {
                    Toastr::error('You must login as a student', 'Error');
                    return \redirect()->route('courseSubscription');
                }

            } else {
                Toastr::error('You must login', 'Error');
                return \redirect()->route('login');
            }
        } else {
            Toastr::error('Invalid Request ', 'Error');
            return \redirect()->route('login');
        }


        $type = $request->type;
        if (!empty($type)) {
            $current = BillingDetails::where('user_id', Auth::id())->latest()->first();
        } else {
            $current = '';
        }

        $profile = Auth::user();
        $bills = BillingDetails::with('country')->where('user_id', Auth::id())->latest()->get();

        $countries = DB::table('countries')->select('id', 'name')->get();
        $cities = DB::table('spn_cities')->where('country_id', $profile->country)->select('id', 'name')->get();


        $cart = SubscriptionCart::where('user_id', Auth::id())->first();


        $methods = PaymentMethod::where('active_status', 1)->where('module_status', 1)->where('method', '!=', 'Bank Payment')->where('method', '!=', 'Offline Payment')->get(['method', 'logo']);

        return view(theme('subscriptionCheckout'), compact('cart', 'profile', 'current', 'bills', 'countries', 'cities', 'methods', 's_plan', 'price'))->with($data);

    }
}
