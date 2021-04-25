<?php

namespace App\Http\Controllers\Api;

use App\BillingDetails;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Coupons\Entities\Coupon;
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
use Modules\Payment\Entities\InstructorPayout;
use Modules\PaymentMethodSetting\Entities\PaymentMethod;
use Modules\SystemSetting\Entities\GeneralSettings;

/**
 * @group  Frontend Api
 *
 * APIs for managing frontend api
 */
class WebsiteApiController extends Controller
{
    /**
     * Cart List
     * @response {
     * "success": true,
     * "data": [
     * {
     * "id": 1,
     * "course_id": 1,
     * "user_id": 6,
     * "instructor_id": 2,
     * "tracking": "MQKR46KB7JJP",
     * "price": 10,
     * "created_at": "2020-11-17T06:29:05.000000Z",
     * "updated_at": "2020-11-17T06:29:05.000000Z",
     * "course": {
     * "id": 1,
     * "category_id": 1,
     * "subcategory_id": 1,
     * "quiz_id": null,
     * "user_id": 2,
     * "lang_id": 1,
     * "title": "Managerial Accounting Advance Course",
     * "slug": "managerial-accounting",
     * "duration": "5H",
     * "image": "public/demo/course/image/1.png",
     * "thumbnail": "public/demo/course/thumb/1.png",
     * "price": 20,
     * "discount_price": 10,
     * "publish": 1,
     * "status": 1,
     * "level": 2,
     * "trailer_link": "https://www.youtube.com/watch?v=mlqWUqVZrHA",
     * "host": "Youtube",
     * "meta_keywords": null,
     * "meta_description": null,
     * "about": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text\r\n            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
     * "special_commission": null,
     * "total_enrolled": 1,
     * "reveune": 50,
     * "reveiw": 0,
     * "type": 1,
     * "created_at": null,
     * "updated_at": null,
     * "dateFormat": "17th November 2020",
     * "publishedDate": "17th November 2020 12:28 pm",
     * "sumRev": 2,
     * "purchasePrice": 21,
     * "enrollCount": 1,
     * "user": {
     * "id": 2,
     * "role_id": 2,
     * "name": "Teacher",
     * "photo": "public/infixlms/img/admin.png",
     * "image": "public/infixlms/img/admin.png",
     * "avatar": "public/infixlms/img/admin.png",
     * "mobile_verified_at": null,
     * "email_verified_at": "2020-09-09T10:52:36.000000Z",
     * "notification_preference": "mail",
     * "is_active": 1,
     * "username": "teacher@infixedu.com",
     * "email": "teacher@infixedu.com",
     * "email_verify": "0",
     * "phone": null,
     * "address": null,
     * "city": "1374",
     * "country": "19",
     * "zip": null,
     * "dob": null,
     * "about": null,
     * "facebook": null,
     * "twitter": null,
     * "linkedin": null,
     * "instagram": null,
     * "subscribe": 0,
     * "provider": null,
     * "provider_id": null,
     * "status": 1,
     * "balance": 0,
     * "currency_id": 112,
     * "special_commission": 1,
     * "payout": "Paypal",
     * "payout_icon": "/uploads/payout/pay_1.png",
     * "payout_email": "demo@paypal.com",
     * "referral": "4MLV6zZjd9",
     * "added_by": 0,
     * "created_at": "2020-11-16T04:39:07.000000Z",
     * "updated_at": "2020-11-16T04:39:07.000000Z"
     * }
     * }
     * }
     * ],
     * "message": "Getting Cart info"
     * }
     *
     */

    public function cartList()
    {

        try {

            $carts = Cart::where('user_id', Auth::id())->with('course', 'course.user')->get();

            if (count($carts) != 0) {
                $response = [
                    'success' => true,
                    'data' => $carts,
                    'message' => 'Getting Cart info',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Cart is empty ',
                ];
            }

            return response()->json($response, 200);
        } catch (\Exception $exception) {
            $response = [
                'success' => false,
                'message' => $exception->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Add to cart
     *
     * @queryParam id required The id of course/quiz Example:1.
     * @response  {
     * "success": false,
     * "message": "Course already added in your cart"
     * }
     */

    public function addToCart($id)
    {
        try {
            $user = Auth::user();
            if (Auth::check() && ($user->role_id != 1)) {

                $exist = Cart::where('user_id', $user->id)->where('course_id', $id)->first();
                $oldCart = Cart::where('user_id', $user->id)->first();

                if (isset($exist)) {
                    $message = 'Course already added in your cart';
                    $success = false;
                } elseif (Auth::check() && ($user->role_id == 1)) {
                    $message = 'You logged in as admin so can not add cart !';
                    $success = false;
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

                    $message = 'Course Added to your cart';
                    $success = true;
                }

            } //If user not logged in then cart added into session

            else {
                $message = 'Only student can add to cart';
                $success = true;
            }
            $response = [
                'success' => $success,
                'message' => $message,
            ];

            return response()->json($response, 200);
        } catch (\Exception $exception) {
            $response = [
                'success' => false,
                'message' => $exception->getMessage()
            ];
            return response()->json($response, 500);
        }

    }

    /**
     * Remove cart
     * @queryParam id required The id of course/quiz Example:1.
     * @response  {
     * "success": false,
     * "message": "Course removed from your cart"
     * }
     */

    public function removeCart($id)
    {

        try {

            if (Auth::check()) {
                $item = Cart::find($id);
                if ($item) {
                    $item->delete();
                    $success = true;
                    $message = 'Course removed from your cart';
                } else {
                    $success = false;
                    $message = 'Something went wrong';
                }

            } else {
                $success = false;
                $message = 'Something went wrong';
            }

            $response = [
                'success' => $success,
                'message' => $message,
            ];

            return response()->json($response, 200);
        } catch (\Exception $exception) {
            $response = [
                'success' => false,
                'message' => $exception->getMessage()
            ];
            return response()->json($response, 500);
        }
    }


    /**
     * Apply Coupon
     * @bodyParam code string required The code of coupon Example:newyear2020
     * @bodyParam total number required The total of Amount Example:5000
     * @response  {
     * "success": true,
     * "message": "Coupon Successful Applied"
     * }
     */
    public function applyCoupon(Request $request)
    {

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
                    $response = [
                        'success' => false,
                        'message' => "Already used this coupon",
                    ];
                    return response()->json($response, 200);

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
                    $response = [
                        'success' => true,
                        'message' => "Coupon Successful Applied",
                    ];
                    return response()->json($response, 200);

                } else {

                    $response = [
                        'success' => false,
                        'message' => "Coupon Minimum Purchase Does Not Match",
                    ];
                    return response()->json($response, 200);

                }

            } else {
                $response = [
                    'success' => false,
                    'message' => "Invalid Coupon",
                ];
                return response()->json($response, 200);

            }

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Operation Failed",
            ];
            return response()->json($response, 500);
        }


    }


    /**
     * My Courses
     * @response
     * {
     * "success": true,
     * "data": [
     * {
     * "id": 1,
     * "category_id": 1,
     * "subcategory_id": 1,
     * "quiz_id": null,
     * "user_id": 2,
     * "lang_id": 1,
     * "title": "Managerial Accounting Advance Course",
     * "slug": "managerial-accounting",
     * "duration": "5H",
     * "image": "public/demo/course/image/1.png",
     * "thumbnail": "public/demo/course/thumb/1.png",
     * "price": 20,
     * "discount_price": 10,
     * "publish": 1,
     * "status": 1,
     * "level": 2,
     * "trailer_link": "https://www.youtube.com/watch?v=mlqWUqVZrHA",
     * "host": "Youtube",
     * "meta_keywords": null,
     * "meta_description": null,
     * "about": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text\r\n            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
     * "special_commission": null,
     * "total_enrolled": 1,
     * "reveune": 50,
     * "reveiw": 0,
     * "type": 1,
     * "created_at": null,
     * "updated_at": null,
     * "dateFormat": "17th November 2020",
     * "publishedDate": "17th November 2020 10:40 am",
     * "sumRev": 2,
     * "purchasePrice": 21,
     * "enrollCount": 1
     * }
     * ],
     * "total": 11,
     * "message": "Getting Courses Data"
     * }
     */
    public function myCourses()
    {
        try {
            $courses = CourseEnrolled::where('course_enrolleds.user_id', Auth::user()->id)
                ->leftjoin('courses', 'courses.id', 'course_enrolleds.course_id')
                ->select('courses.*')
                ->get();
            $response = [
                'success' => true,
                'data' => $courses,
                'message' => "Getting my courses",
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Something went wrong",
            ];
            return response()->json($response, 500);
        }
    }


    /**
     * Update Profile
     * @bodyParam name string required The name of User Example:Student
     * @bodyParam email string required The email of User Example:user@email.com
     * @bodyParam phone string required The phone number of User Example:01711223344
     * @bodyParam address string required The address of User Example:Dhaka,Bangladesh
     * @bodyParam city string required The city of User Example:Dhaka
     * @bodyParam country string required The country of User Example:Bangladesh
     * @bodyParam zip string required The zip of User Example:1200
     * @bodyParam about string required The about of User Example:something.....
     * @bodyParam image file  The profile image of User Example:image.png
     * @response  {
     * "success": true,
     * "message": "Password has been changed"
     * }
     */

    public function updateProfile(Request $request)
    {
        /*   if (Auth::user()->role_id == 1) {
               $request->validate([
                   'name' => 'required',
                   'email' => 'required|email',

               ]);
           } else {
               $request->validate([
                   'name' => 'required',
                   'email' => 'required|email',
                   'phone' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|unique:users',
                   'address' => 'required',
                   'city' => 'required',
                   'country' => 'required',
                   'zip' => 'required',
               ]);
           }*/


        try {

            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->language_id = $request->language;
            $user->city = $request->city;
            $user->country = $request->country;
            $user->zip = $request->zip;
            $user->currency_id = 112;
            $user->facebook = $request->facebook;
            $user->twitter = $request->twitter;
            $user->linkedin = $request->linkedin;
            $user->instagram = $request->instagram;
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
            $response = [
                'success' => true,
                'message' => "Profile has been updated",
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Something went wrong",
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Review Course
     *
     * @bodyParam course_id  integer required The course_id of course/quiz Example:1
     * @bodyParam review string required The review  of course/quiz Example:Something
     * @bodyParam rating integer required The rating  of course/quiz Example:5
     * @response  {
     * "success": true,
     * "message": "Review Submit Successful"
     * }
     */
    public function submitReview(Request $request)
    {
        $this->validate($request, [
            'review' => 'required',
            'course_id' => 'required',
            'rating' => 'required'
        ]);

        try {
            $user_id = Auth::user()->id;
            $review = CourseReveiw::where('user_id', $user_id)->where('course_id', $request->course_id)->first();
// return $review;
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
                $success = true;
                $message = 'Review Submit Successful';
            } else {
                $success = false;
                $message = 'Invalid Action!';
            }

            $response = [
                'success' => $success,
                'message' => $message
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Something went wrong",
            ];
            return response()->json($response, 500);
        }

    }

    /**
     * Comment Course
     *
     * @bodyParam course_id integer required The course_id of course/quiz Example:1
     * @bodyParam comment string required The comment  of course/quiz Example:Something
     * @response  {
     * "success": true,
     * "message": "Operation Successful"
     * }
     */
    public function comment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required',
            'course_id' => 'required',
        ]);

        try {
            $course = Course::where('id', $request->course_id)->where('status', 1)->where('publish', 1)->first();

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
                    'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                    'course' => $course->title,
                    'comment' => $comment->comment,
                ]);

                $success = true;
                $message = 'Operation successful';
            } else {
                $success = false;
                $message = 'Invalid Action !';
            }
            $response = [
                'success' => $success,
                'message' => $message
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Something went wrong",
            ];
            return response()->json($response, 500);
        }

    }

    /**
     * Comment Reply Course
     *
     * @bodyParam comment_id integer required The comment id of Comment Example:1
     * @bodyParam reply string required The reply  of Comment Example:Something
     * @response  {
     * "success": true,
     * "message": "Operation Successful"
     * }
     */
    public function commentReply(Request $request)
    {
        $this->validate($request, [
            'comment_id' => 'required',
            'reply' => 'required',
        ]);

        try {
            $comment = CourseComment::find($request->comment_id);
            $course = $comment->course;


            if (isset($course)) {

                $comment = new CourseCommentReply();
                $comment->user_id = Auth::user()->id;
                $comment->course_id = $course->id;
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


                $success = true;
                $message = 'Operation successful';
            } else {
                $success = false;
                $message = 'Invalid Action !';
            }
            $response = [
                'success' => $success,
                'message' => $message
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Something went wrong",
            ];
            return response()->json($response, 500);
        }

    }


    /**
     * Checkout
     *
     * @bodyParam billing_address  string required  Select "new" || "previous"
     * @bodyParam old_billing  integer required  If select Previous billing Address
     * @bodyParam first_name  string required  If select New billing Address
     * @bodyParam last_name  string required  If select New billing Address
     * @bodyParam country  string required  If select New billing Address
     * @bodyParam address1  string required  If select New billing Address
     * @bodyParam city  string required  If select New billing Address
     * @bodyParam phone  string required  If select New billing Address
     * @bodyParam email  string required  If select New billing Address
     * @response  {
     * "success": true,
     * "message": "Operation Successful"
     * }
     */
    public function makeOrder(Request $request)
    {
        $response = array('response' => '', 'success' => false);
        /* $validator = Validator::make($request->all(), [
             'billing_address' => 'required',
             'old_billing' => 'required_if:billing_address,previous',
             'first_name' => 'required_if:billing_address,new',
             'last_name' => 'required_if:billing_address,new',
             'country' => 'required_if:billing_address,new',
             'address1' => 'required_if:billing_address,new',
             'city' => 'required_if:billing_address,new',
             'phone' => 'required_if:billing_address,new',
             'email' => 'required_if:billing_address,new',
         ]);
         if ($validator->fails()) {
             return $response['response'] = $validator->messages();
         }*/

        try {
            $profile = Auth::user();
            $tracking = Cart::where('user_id', Auth::id())->first()->tracking;
            if ($profile->role_id == 3) {
                /* if (isSubscribe()) {
                     $total = 0;
                 } else {
                     $total = Cart::where('user_id', Auth::user()->id)->sum('price');
                 }*/
                $total = Cart::where('user_id', Auth::user()->id)->sum('price');
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

            if ($request->billing_address == 'new') {
                $bill = BillingDetails::where('tracking_id', $tracking)->first();

                if (empty($bill)) {
                    $bill = new BillingDetails();
                }

                $bill->user_id = Auth::id();
                $bill->tracking_id = $tracking;
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

            $checkout_info = $checkout;
            if ($checkout_info) {
                $checkout_info->billing_detail_id = $bill->id;
                $checkout_info->save();

                if ($checkout_info->purchase_price == 0) {
                    $checkout_info->payment_method = 'None';
                    $bill->payment_method = 'None';
                    $checkout_info->save();
                    $carts = Cart::where('tracking', $checkout_info->tracking)->get();

                    foreach ($carts as $cart) {

                        $payment = new PaymentController();
                        $payment->directEnroll($cart->course_id, $checkout_info->tracking);
                        $cart->delete();

                    }


                    $response = [
                        'success' => true,
                        'type' => 'Free',
                        'message' => 'Operation successful'
                    ];
                    return response()->json($response, 200);
                } else {
                    $response = [
                        'success' => true,
                        'type' => 'Paid',
                        'message' => 'Operation successful. Go to Payment page'
                    ];
                    return response()->json($response, 200);

                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Operation Failed.'
                ];
                return response()->json($response, 500);
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);

        }
    }

    /**
     * Payment
     *
     * @queryParam response  required array Response Form Gateway.
     * @queryParam gateWayName  required string Gateway Name.
     * @response  {
     * "success": true,
     * "message": "Successfully Done"
     * }
     */
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
                    $response = [
                        'success' => true,
                        'message' => 'Operation successful.'
                    ];
                    return response()->json($response, 200);

                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Operation Failed.'
                    ];
                    return response()->json($response, 500);
                }

            } else {
                $response = [
                    'success' => false,
                    'message' => 'Operation Failed.'
                ];
                return response()->json($response, 500);
            }


        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return response()->json($response, 500);

        }
    }

    /**
     * Available Payment Methods
     * @response {
     * "success": true,
     * "data": [
     * {
     * "method": "PayPal",
     * "logo": "public/demo/gateway/paypal.png"
     * },
     * {
     * "method": "Stripe",
     * "logo": "public/demo/gateway/stripe.png"
     * },
     * {
     * "method": "PayStack",
     * "logo": "public/demo/gateway/paystack.png"
     * },
     * {
     * "method": "RazorPay",
     * "logo": "public/demo/gateway/razorpay.png"
     * },
     * {
     * "method": "PayTM",
     * "logo": "public/demo/gateway/paytm.png"
     * },
     * {
     * "method": "Bank Payment",
     * "logo": ""
     * },
     * {
     * "method": "Offline Payment",
     * "logo": ""
     * },
     * {
     * "method": "Wallet",
     * "logo": ""
     * }
     * ],
     * "message": "Operation successful"
     * }
     */
    public function paymentMethods()
    {
        try {
            $methods = PaymentMethod::where('active_status', 1)->get(['method', 'logo']);
            $response = [
                'success' => true,
                'data' => $methods,
                'message' => "Operation successful"
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Operation Failed!"
            ];
            return response()->json($response, 200);

        }
    }


    /**
     * Billing Address
     * @response {
     * "success": true,
     * "data": [
     * {
     * "id": 1,
     * "tracking_id": "K3USKPJBC5U8",
     * "user_id": 3,
     * "first_name": "Student",
     * "last_name": "",
     * "company_name": "Spondon IT",
     * "country": {
     * "id": 19,
     * "name": "Bangladesh",
     * "iso3": "BGD",
     * "iso2": "BD",
     * "phonecode": "880",
     * "currency": "BDT",
     * "capital": "Dhaka",
     * "active_status": 1,
     * "created_at": "2018-07-20T08:41:03.000000Z",
     * "updated_at": "2018-07-20T08:41:03.000000Z"
     * },
     * "address1": "Dhaka",
     * "address2": "",
     * "city": "Dhaka",
     * "zip_code": "1200",
     * "phone": "01723442233",
     * "email": "student@infixedu.com",
     * "details": "add here additional info.",
     * "payment_method": null,
     * "created_at": "2021-03-03T11:21:01.000000Z",
     * "updated_at": "2021-03-03T11:21:01.000000Z"
     * },
     * {
     * "id": 2,
     * "tracking_id": "765A3UJ7B11M",
     * "user_id": 3,
     * "first_name": "Student",
     * "last_name": "",
     * "company_name": "Spondon IT",
     * "country": {
     * "id": 19,
     * "name": "Bangladesh",
     * "iso3": "BGD",
     * "iso2": "BD",
     * "phonecode": "880",
     * "currency": "BDT",
     * "capital": "Dhaka",
     * "active_status": 1,
     * "created_at": "2018-07-20T08:41:03.000000Z",
     * "updated_at": "2018-07-20T08:41:03.000000Z"
     * },
     * "address1": "Dhaka",
     * "address2": "",
     * "city": "Dhaka",
     * "zip_code": "1200",
     * "phone": "01723442233",
     * "email": "student@infixedu.com",
     * "details": "add here additional info.",
     * "payment_method": null,
     * "created_at": "2021-03-03T11:21:01.000000Z",
     * "updated_at": "2021-03-03T11:21:01.000000Z"
     * }
     * ],
     * "message": "Operation successful"
     * }
     */
    public function billingAddress(Request $request)
    {
        try {
            $bills = BillingDetails::with('country')->where('user_id', $request->user()->id)->get();

            $response = [
                'success' => true,
                'data' => $bills,
                'message' => "Operation successful"
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Operation Failed!"
            ];
            return response()->json($response, 200);

        }
    }


    /**
     * Countries
     * @response {
     * "success": true,
     * "data": [
     * {
     * "id": 1,
     * "name": "Afghanistan"
     * }
     * ],
     * "message": "Operation successful"
     * }
     */
    public function countries()
    {
        try {
            $countries = DB::table('countries')->select('id', 'name')->get();
            $response = [
                'success' => true,
                'data' => $countries,
                'message' => "Operation successful"
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Operation Failed!"
            ];
            return response()->json($response, 200);

        }
    }


    /**
     * Cities
     * @queryParam country_id required The id of course/quiz Example:1.
     * @response {
     * "success": true,
     * "data": [
     * {
     * "id": 1,
     * "name": "Dhaka"
     * }
     * ],
     * "message": "Operation successful"
     * }
     */
    public function cities($country_id)
    {
        try {
            $cities = DB::table('spn_cities')->where('country_id', $country_id)->select('id', 'name')->get();
            $response = [
                'success' => true,
                'data' => $cities,
                'message' => "Operation successful"
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Operation Failed!"
            ];
            return response()->json($response, 200);

        }
    }


    /**
     * Payment Gateways
     * @response {
     * "success": true,
     * "data": [
     * {
     * "id": 1,
     * "method": "method-name",
     * "logo": "image.png"
     * }
     * ],
     * "message": "Operation successful"
     * }
     */
    public function paymentGateways()
    {
        try {
            $methods = PaymentMethod::where('active_status', 1)->get(['method', 'logo']);

            $response = [
                'success' => true,
                'data' => $methods,
                'message' => "Operation successful"
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Operation Failed!"
            ];
            return response()->json($response, 200);

        }
    }


    /**
     * My Billing Address
     * @response {
     * "success": true,
     * "data": [
     * {
     * "success": true,
     * "data": [

     * {
     * "id": 1,
     * "tracking_id": "K3USKPJBC5U8",
     * "user_id": 3,
     * "first_name": "Student",
     * "last_name": "",
     * "company_name": "Spondon IT",
     * "country": {
     * "id": 19,
     * "name": "Bangladesh",
     * "iso3": "BGD",
     * "iso2": "BD",
     * "phonecode": "880",
     * "currency": "BDT",
     * "capital": "Dhaka",
     * "active_status": 1,
     * "created_at": "2018-07-20T08:41:03.000000Z",
     * "updated_at": "2018-07-20T08:41:03.000000Z"
     * }

     * ],
     * "message": "Operation successful"
     * }
     * ],
     * "message": "Operation successful"
     * }
     */

    public function myBilling()
    {
        try {
            $bills = BillingDetails::with('country')->where('user_id', Auth::id())->latest()->get();

            $response = [
                'success' => true,
                'data' => $bills,
                'message' => "Operation successful"
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => "Operation Failed!"
            ];
            return response()->json($response, 200);

        }
    }


}



