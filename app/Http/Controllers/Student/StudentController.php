<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Image;
use Modules\Coupons\Entities\UserWiseCoupon;
use Modules\Coupons\Entities\UserWiseCouponSetting;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseComment;
use Modules\CourseSetting\Entities\CourseCommentReply;
use Modules\CourseSetting\Entities\CourseEnrolled;
use Modules\CourseSetting\Entities\CourseReveiw;
use Modules\CourseSetting\Entities\Notification;
use Modules\Payment\Entities\Cart;
use Modules\Payment\Entities\Checkout;
use Modules\Payment\Entities\Withdraw;
use Modules\SystemSetting\Entities\GeneralSettings;

class StudentController extends Controller
{
    public function submitCommnetReply(Request $request, $id)
    {

        $this->validate($request, [
            'reply' => 'required'
        ]);
        try {
            $comment = CourseComment::find($id);
            $course = $comment->course;


            if (isset($course)) {
                $success = trans('lang.Reply') . ' ' . trans('lang.Submit') . ' ' . trans('Successfully');

                $comment = new CourseCommentReply();
                $comment->user_id = Auth::id();
                $comment->course_id = $course->id;
                $comment->comment_id = $id;
                $comment->reply = $request->reply;
                $comment->status = 1;
                $comment->save();

                send_email($course->user, 'Course_comment_Reply', [
                    'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                    'course' => $course->title,
                    'comment' => $comment->comment,
                    'reply' => $comment->reply,
                ]);

                return response()->json([
                    'success' => $success
                ], 200);
            } else {
                return response()->json([
                    'message' => "Invalid Action"
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => trans("lang.Operation Failed")]);
        }
    }

    public function submitReview(Request $request)
    {
        $this->validate($request, [
            'review' => 'required',
            'rating' => 'required'
        ]);

        try {
            $user_id = Auth::user()->id;
            $review = CourseReveiw::where('user_id', $user_id)->where('course_id', $request->course_id)->first();

            if (is_null($review)) {

                $newReview = new CourseReveiw();
                $newReview->user_id = $user_id;
                $newReview->course_id = $request->course_id;
                $newReview->comment = $request->review;
                $newReview->star = $request->rating;
                $newReview->save();

                $course = Course::find($request->course_id);
                $total = CourseReveiw::where('course_id', $course->id)->sum('star');
                $count = CourseReveiw::where('course_id', $course->id)->where('status', 1)->count();
                $average = $total / $count;
                $course->reveiw = $average;
                $course->save();
// return $course;
                $notification = new Notification();
                $notification->author_id = Auth::user()->id;
                $notification->user_id = $user_id;
                $notification->course_id = $request->course_id;
                $notification->course_review_id = $newReview->id;
                $notification->save();

                send_email($course->user, 'Course_Review', [
                    'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                    'course' => $course->title,
                    'review' => $newReview->comment,
                    'star' => $newReview->star,
                ]);

                Toastr::success('Review Submit Successfully', 'Success');
                return back()->with('review', 'review');
            } else {

                Toastr::error('Invalid Action !', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function addCartDb()
    {
        // return "test";
        try {
            if (session('cart') && Auth::check()) {
                $carts = session('cart');
                $tracking = getTrx();

                foreach ($carts as $course) {
                    $cart = new Cart();
                    $cart->course_id = $course['id'];
                    $cart->user_id = Auth::id();
                    $cart->instructor_id = $course['instructor_id'];
                    $cart->tracking = $tracking;
                    $cart->price = $course['price'];
                    $cart->save();
                }
                Session::forget('cart');
            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function payWithWallet(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $chekout = Checkout::where('user_id', $user->id)->where('status', 0)->first();
            // return $chekout;

            $track = $chekout->tracking;


            if (isset($chekout)) {
                $success = trans('lang.CheckOut') . trans('lang.Successfully');

                $newBal = ($user->balance - $chekout->purchase_price);
                $user->balance = $newBal;

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
                        // $referral_check->save();
                        $percentage_cal = ($referral_settings->amount / 100) * $chekout->price;
                        //Check bonus type (fixd or %)
                        if ($referral_settings->type == 1) {
                            if ($chekout->price > $referral_settings->max_limit) {
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

                        // $course_buyer=User::find($referral_check->invite_accept_by);
                        $user->balance += $bonus_amount;
                        $user->save();

                        $invite_by = User::find($referral_check->invite_by);
                        $invite_by->balance += $bonus_amount;
                        $invite_by->save();


                    }
                    //==========================End Referral========================

                    $enroll = new CourseEnrolled();
                    $instractor = User::find($cart->instructor_id);
                    $enroll->user_id = $user->id;
                    $enroll->tracking = $track;
                    $enroll->course_id = $course->id;
                    $enroll->purchase_price = $cart->price;
                    $enroll->coupon = null;
                    $enroll->discount_amount = 0.00;
                    $enroll->status = 1;


                    if (!is_null($course->special_commission)) {
                        $commission = $course->special_commission;
                        $reveune = ($cart->price * $commission) / 100;
                        $enroll->reveune = $reveune;
                        $course->reveune = (($course->reveune) + ($enroll->reveune));
                    } elseif (!is_null($instractor->special_commission)) {

                        $commission = $instractor->special_commission;
                        $reveune = ($cart->price * $commission) / 100;
                        $enroll->reveune = $reveune;
                        $course->reveune = (($course->reveune) + ($enroll->reveune));
                    } else {

                        $commission = GeneralSettings::first()->commission;
                        $reveune = ($cart->price * $commission) / 100;
                        $enroll->reveune = $reveune;
                        $course->reveune = (($course->reveune) + ($enroll->reveune));
                    }

                    $enroll->save();
                    $course->save();

                    $withdraw = Withdraw::where('instructor_id', $course->user_id)->whereMonth('created_at', Carbon::now())->latest()->first();
                    if (!$withdraw) {
                        $withdraw = new Withdraw();
                        $amount = $reveune;
                        $withdraw->issueDate = date('Y-m-d H:i:s', mktime(0, 0, 0, now()->month + 1, 1));
                    } else
                        $amount = $reveune + $withdraw->amount;

                    $withdraw->instructor_id = $course->user_id;
                    $withdraw->amount = $amount;
                    $withdraw->status = 0;
                    $withdraw->method = $course->user->payout ?? 'Paypal';
                    $withdraw->save();

                    send_email($user, 'Course_Enroll_Payment', [
                        'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                        'course' => $course->title,
                        'currency' => $user->currency->symbol ?? '$',
                        'price' => ($user->currency->conversion_rate * $cart->price),
                        'instructor' => $course->user->name,
                        'gateway' => 'Wallet',
                    ]);

                    send_email($user, 'Enroll_notify_Instructor', [
                        'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                        'course' => $course->title,
                        'currency' => $user->currency->symbol ?? '$',
                        'price' => ($user->currency->conversion_rate * $cart->price),
                        'rev' => @$reveune,

                    ]);

                }

                $chekout->payment_method = 'Wallet';
                $chekout->status = 1;
                $chekout->save();
                $user->save();

                if ($chekout->status == 1) {

                    foreach ($carts as $old) {
                        $old->delete();
                    }
                }

                DB::commit();
                // return $invite_accept_by;
                Toastr::success('CheckOut Successfully Done', 'Success');
                return redirect(url('student-dashboard'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
}
