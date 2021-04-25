<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);

Route::get('send-password-reset-link', 'Auth\ForgotPasswordController@SendPasswordResetLink')->name('SendPasswordResetLink');
Route::get('reset-password', 'Auth\ForgotPasswordController@ResetPassword')->name('ResetPassword');
Route::get('register', 'Auth\RegisterController@RegisterForm')->name('register');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/resend', '\App\Http\Controllers\Auth\VerificationController@resend_mail')->name('verification_mail_resend');


Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'WebsiteController@index')->name('index');
    Route::get('/footer/page/{slug}', 'WebsiteController@page')->name('dynamic.page');
    Route::get('/about-us', 'WebsiteController@aboutData')->name('about');
    Route::get('/contact-us', 'WebsiteController@contact')->name('contact');
    Route::post('/contact-submit', 'WebsiteController@contactMsgSubmit')->name('contactMsgSubmit');
    Route::get('course-categories', 'WebsiteController@categoryPage')->name('categoryPage');
    Route::get('courses-details/{id}/{slug}', 'WebsiteController@courseDetails')->name('courseDetailsView');
    Route::get('courses-quiz/{course_id}/{quiz_id}/{slug}', 'WebsiteController@courseQuizDetails')->name('courseQuizDetails');
    Route::get('quiz-details/{id}/{slug}', 'WebsiteController@quizDetails')->name('quizDetailsView');
    Route::get('instructor-profile/{id}', 'WebsiteController@InstructorProfileView')->name('InstructorProfileView');
    Route::get('instructor-profile/{id}/duration-filter', 'WebsiteController@InstructorProfileViewDuration')->name('InstructorProfileViewDuration');
    Route::get('privacy', 'WebsiteController@privacy')->name('privacy');
    Route::get('category/{id}/{name}', 'WebsiteController@categoryCourse')->name('categoryCourse');
    Route::get('sub_category/{id}/{slug}', 'WebsiteController@subCategoryCourse')->name('subCategory.course');
    Route::get('quizzes/{id}/{name}', 'WebsiteController@categoryQuiz')->name('categoryQuiz');
    Route::get('live-classes/{id}/{name}', 'WebsiteController@categoryClass')->name('categoryClass');
    Route::get('class-details/{id}/{slug}', 'WebsiteController@classDetails')->name('classDetails');
    Route::get('fetch-course', 'WebsiteController@fetch_course')->name('fetch_course');
    Route::get('search-course', 'WebsiteController@search_course')->name('search_course');
    Route::get('/addToCart/{id}', 'WebsiteController@addToCart')->name('addToCart');
    Route::get('/buyNow/{id}', 'WebsiteController@buyNow')->name('buyNow');
    Route::get('/enrollNow/{id}', 'WebsiteController@enrollNow')->name('enrollNow');
    Route::get('my-cart', 'WebsiteController@myCart')->name('myCart');
    Route::get('ajaxCounterCity', 'WebsiteController@ajaxCounterCity')->name('ajaxCounterCity');
    Route::get('/home/removeItem/{id}', 'WebsiteController@removeItem')->name('removeItem');

    Route::get('/get_quiz-qus_ans', 'WebsiteController@getQuizQusAns')->name('getQuizQusAns');
    Route::get('/skip_qus', 'WebsiteController@skipQus')->name('skipQus');
    Route::post('/submit_ans', 'WebsiteController@submitAns')->name('submitAns');
    Route::get('referral/{code}', 'WebsiteController@referralCode')->name('referralCode');
    Route::get('pages/{id}/{slug}', 'WebsiteController@frontPage')->name('frontPage');
    Route::post('subscribe', 'WebsiteController@subscribe')->name('subscribe');

    Route::get('instructors', 'WebsiteController@instructors')->name('instructors');
    Route::get('become-instructor', 'WebsiteController@becomeInstructor')->name('becomeInstructor');
    Route::get('instructorDetails/{id}/{name}', 'WebsiteController@instructorDetails')->name('instructorDetails');

    Route::get('blogs', 'WebsiteController@allBlog')->name('blogs');
    Route::get('blog-details/{id}/{slug}', 'WebsiteController@blogDetails')->name('blogDetails');

    //new route for new template start
    Route::get('courses', 'WebsiteController@courses')->name('courses');
    Route::get('quizzes', 'WebsiteController@quizzes')->name('quizzes');
    Route::get('classes', 'WebsiteController@classes')->name('classes');
    Route::get('search', 'WebsiteController@search')->name('search');
    Route::post('enrollOrCart/{id}', 'WebsiteController@enrollOrCart')->name('enrollOrCart');
    Route::get('getItemList', 'WebsiteController@getItemList')->name('getItemList');
    Route::get('quizStart/{id}/{quiz_id}/{slug}', 'WebsiteController@quizStart')->name('quizStart');
    Route::post('quizSubmit', 'WebsiteController@quizSubmit')->name('quizSubmit');
    Route::get('quizResult/{id}', 'WebsiteController@quizResult')->name('getQuizResult');
    Route::get('quizResultPreview/{id}', 'WebsiteController@quizResultPreview')->name('quizResultPreview');

    Route::get('/purchase-invoice/pdf/{id}', 'WebsiteController@purchaseInvoice')->name('purchase-invoice');
    //end


    Route::get('/course/subscription', 'WebsiteController@subscription')->name('courseSubscription');
    Route::get('/course/subscription/checkout', 'WebsiteController@subscriptionCheckout')->name('courseSubscriptionCheckout');
    Route::get('/course/subscription/payment', 'WebsiteController@subscriptionPayment')->name('courseSubscriptionPayment');


    Route::get('/subscription-courses', 'WebsiteController@subscriptionCourses')->name('subscriptionCourses');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard', 'HomeController@dashboard')->name('dashboard')->middleware('RoutePermissionCheck:dashboard');

});
//in this controller we can use for place order
Route::group(['prefix' => 'order', 'middleware' => ['auth']], function () {

    Route::post('submit', 'PaymentController@makePlaceOrder')->name('makePlaceOrder');
    Route::get('/payment', 'PaymentController@payment')->name('orderPayment');
    Route::post('/paymentSubmit', 'PaymentController@paymentSubmit')->name('paymentSubmit');

    //paypal url
    Route::get('paypal/success', 'PaymentController@paypalSuccess')->name('paypalSuccess');
    Route::get('paypal/failed', 'PaymentController@paypalFailed')->name('paypalFailed');
});
//deposit
Route::group(['prefix' => 'deposit', 'middleware' => ['auth']], function () {

    Route::post('submit', 'DepositController@depositSubmit')->name('depositSubmit');
    Route::get('paypalDepositSuccess', 'DepositController@paypalDepositSuccess')->name('paypalDepositSuccess');
    Route::get('paypalDepositFailed', 'DepositController@paypalDepositFailed')->name('paypalDepositFailed');

});

Route::group(['prefix' => 'subscription', 'middleware' => ['auth']], function () {
    Route::post('payment', 'SubscriptionPaymentController@payment')->name('subscriptionPayment');
    Route::post('submit', 'SubscriptionPaymentController@subscriptionSubmit')->name('subscriptionSubmit');
    Route::get('paypalSubscriptionSuccess', 'SubscriptionPaymentController@paypalSubscriptionSuccess')->name('paypalSubscriptionSuccess');
    Route::get('paypalSubscriptionFailed', 'SubscriptionPaymentController@paypalSubscriptionFailed')->name('paypalSubscriptionFailed');

});


Route::group(['namespace' => 'Frontend'], function () {
    Route::post('comment', 'WebsiteController@saveComment')->name('saveComment');
    Route::post('comment-replay', 'WebsiteController@submitCommnetReply')->name('submitCommnetReply');
});
Route::group(['namespace' => 'Frontend', 'middleware' => ['student']], function () {
    Route::get('student-dashboard', 'WebsiteController@myDashboard')->name('studentDashboard');
    Route::get('my-courses', 'WebsiteController@myCourses')->name('myCourses');
    Route::get('my-classes', 'WebsiteController@myClasses')->name('myClasses');
    Route::get('my-quizzes', 'WebsiteController@myQuizzes')->name('myQuizzes');
    Route::get('my-wishlist', 'WebsiteController@myWishlists')->name('myWishlists');
    Route::get('my-purchases', 'WebsiteController@myPurchases')->name('myPurchases');


    Route::get('topic-report/{id}', 'WebsiteController@topicReport')->name('topicReport');

    Route::get('checkout', 'WebsiteController@CheckOut')->name('CheckOut');
    Route::get('deposit', 'WebsiteController@deposit')->name('deposit');
    Route::post('deposit', 'WebsiteController@deposit')->name('depositSelectOption');

    Route::get('/home/checkoutDetail', 'WebsiteController@checkoutDetail')->name('checkoutDetail');
    Route::get('StudentApplyCoupon', 'WebsiteController@StudentApplyCoupon')->name('StudentApplyCoupon');


    Route::get('my-profile', 'WebsiteController@myProfile')->name('myProfile');
    Route::post('my-profile-update', 'WebsiteController@myProfileUpdate')->name('myProfileUpdate');

    Route::get('referral', 'WebsiteController@referral')->name('referral');
    Route::get('invoice/{id}', 'WebsiteController@Invoice')->name('invoice');
    Route::get('subscription-invoice/{id}', 'WebsiteController@subInvoice')->name('subInvoice');


    Route::get('my-account', 'WebsiteController@myAccount')->name('myAccount');

    Route::post('my-password-update', 'WebsiteController@MyUpdatePassword')->name('MyUpdatePassword');
    Route::post('my-email-update', 'WebsiteController@MyEmailUpdate')->name('MyEmailUpdate');

    // Student Register
    Route::get('student-register', 'WebsiteController@studentRegister')->name('studentRegister');

    //get certificate

});

Route::get('fullscreen-view/{course_id}/{lesson_id}', 'Frontend\WebsiteController@fullScreenView')->name('fullScreenView');

Route::group(['middleware' => ['auth']], function () {
    Route::get('remove-profile-pic', 'Frontend\WebsiteController@removeProfilePic')->name('removeProfilePic');
    Route::post('lesson-complete', 'Frontend\WebsiteController@lessonComplete')->name('lesson.complete');
    Route::post('lesson-complete-ajax', 'Frontend\WebsiteController@lessonCompleteAjax')->name('lesson.complete.ajax');
    Route::get('course-certificate/{id}/{slug}', 'Frontend\WebsiteController@getCertificate')->name('getCertificate');
    Route::get('logged-in/devices', 'Frontend\WebsiteController@loggedInDevices')->name('logged.in.devices');
    Route::post('logged-out/device', 'Frontend\WebsiteController@logOutDevice')->name('log.out.device');
});
Route::group(['namespace' => 'Student', 'prefix' => 'student/get', 'as' => 'student.', 'middleware' => ['student']], function () {


    Route::get('/myCourse', 'StudentController@myCourse')->name('myCourse');
    Route::get('recentEnroll', 'StudentController@recentEnroll')->name('recentEnroll');
    Route::get('/course_detail/{id}', 'StudentController@course_detail')->name('course_detail');

    Route::get('/videoInfo/{id}', 'StudentController@videoInfo')->name('videoInfo');
    Route::get('/course_comments/{id}', 'StudentController@course_comments')->name('course_comments');

    Route::middleware(['studentPermission:1'])->group(function () {
        Route::post('/submitComment/{id}', 'StudentController@submitComment')->name('submitComment');
    });

    Route::post('/submitCommnetReply/{id}', 'StudentController@submitCommnetReply')->name('submitCommnetReply');
    Route::post('/submitReview', 'StudentController@submitReview')->name('submitReview');
    Route::post('applyCoupon/', 'StudentController@applyCoupon')->name('applyCoupon');

    Route::post('check-out/', 'StudentController@checkOut')->name('checkOut');


    Route::get('videoInfo/{id}', 'StudentController@videoInfo')->name('videoInfo');
    Route::get('lessonVideoInfo/{id}', 'StudentController@lessonVideoInfo')->name('lessonVideoInfo');

    Route::get('enrolledCourses', 'StudentController@enrolledCourses');


    Route::post('payWithBalance/', 'StudentController@payWithBalance')->name('payWithBalance');
    Route::post('payWithBalanceSubscriber', 'StudentController@payWithBalanceSubscriber')->name('payWithBalanceSubscriber');

    Route::post('migrateToInsturcotr', 'StudentController@migrateToInsturcotr')->name('migrateToInsturcotr');


});


// Cart manage


Route::get('/user-payout-info', 'Frontend\WebsiteController@userPayoutInfo')->name('userPayoutInfo');
Route::post('/savePayOutEmail', 'Frontend\WebsiteController@savePayOutEmail')->name('save.userPayoutInfo');


Route::group(['namespace' => 'Frontend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('all-categories', 'WebsiteController@allCallCategory')->name('all-categories');
    Route::get('all-subcategories', 'WebsiteController@allSubCategory')->name('all-subcategories');
});

Route::group(['namespace' => 'Instructor', 'prefix' => 'instructor', 'middleware' => ['auth', 'admin']], function () {

    Route::get('/toastrMessages', 'InstructorController@toastrMessages');

    Route::get('profile_data', 'InstructorController@profile_data')->name('profile_data');

    Route::get('payout/get-history', 'InstructorController@getHistory')->name('getHistory')->middleware('RoutePermissionCheck:getHistory');


    Route::get('/{anypath}', 'InstructorController@index')->where('path', '*');
    Route::get('/courses_edit/{anypath}', 'InstructorController@index')->where('path', '*');
    Route::get('/get/notifications', 'InstructorController@notifications');
    Route::get('/notification/comment/{id}', 'InstructorController@notificationComment');
    Route::get('/notification/review/{id}', 'InstructorController@notificationReview');
    Route::get('/notification/enroll/{id}', 'InstructorController@notificationEnroll');
    Route::get('/get/dashboard', 'InstructorController@dashboard');
    Route::get('/enroll_history/{id}/{anypath}', 'InstructorController@index')->where('path', '*');

    //Message Manage
    Route::get('get/users', 'InstructorController@users');
    Route::get('get/findUser/{id}', 'InstructorController@messages');
    Route::post('get/sentMessage/{id}', 'InstructorController@sentMessage');

    //Chart Area
    Route::get('/get/enroll_monthly', 'InstructorController@enrollMonthly');
    Route::get('/get/enroll_yearly', 'InstructorController@enrollYearly');

});

//Admin Routes Here
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {


    Route::post('/instructor_permission', 'RolePermissionController@instructor_permission')->name('instructor_permission');
    Route::post('/student_permission', 'RolePermissionController@student_permission')->name('student_permission');


    //Chart Area
    Route::get('/get/course_earning', 'AdminController@courseEarning');
    Route::get('/get/payment_statistics', 'AdminController@paymentStatistics');
    Route::get('/get/course_overview', 'AdminController@courseOverview');
    Route::get('/get/course_enroll', 'AdminController@courseEnroll');


//Subscription Area
    Route::get('/get/subscriptions', 'AdminController@subscriptions')->name('subscriptions')->middleware('RoutePermissionCheck:admin.subscriptions');

    Route::post('/get/subscriberDelete/{id}', 'AdminController@subscriberDelete')->name('subscriptionDelete')->middleware('RoutePermissionCheck:subscriptions.remove');

    Route::post('/single/subscriberMailSend/', 'AdminController@subscriberMailSingle')->name('singleEmailSend')->middleware('RoutePermissionCheck:subscriptions.send_mail');

    Route::get('/reveune-list', 'AdminController@reveuneList')->name('reveuneList')->middleware('RoutePermissionCheck:admin.reveuneList');
    Route::get('/reveuneListInstructor', 'AdminController@reveuneListInstructor')->name('reveuneListInstructor')->middleware('RoutePermissionCheck:admin.reveuneListInstructor');

    Route::get('/enrol-list', 'AdminController@enrollLogs')->name('enrollLogs')->middleware('RoutePermissionCheck:admin.enrollLogs');
    Route::get('/instructor-payout', 'AdminController@instructorPayout')->name('instructor.payout')->middleware('RoutePermissionCheck:admin.instructor.payout');
    Route::post('/instructor-payout-request', 'AdminController@instructorRequestPayout')->name('instructor.instructorRequestPayout')->middleware('RoutePermissionCheck:admin.instructor.payout');
    Route::post('/instructor-payout-complete', 'AdminController@instructorCompletePayout')->name('instructor.instructorCompletePayout')->middleware('RoutePermissionCheck:admin.instructor.payout');
    Route::get('/enrollFilter', 'AdminController@enrollLogs');
    Route::post('/enrollFilter', 'AdminController@enrollFilter')->name('enrollFilter');
    Route::get('/courseEnrolls/{id}', 'AdminController@courseEnrolls')->name('enrollLog');
    Route::post('/courseEnrolls/{id}', 'AdminController@sortByDiscount')->name('sortByDiscount');

});


Route::group(['namespace' => 'Admin', 'prefix' => 'course', 'as' => 'course.', 'middleware' => ['auth', 'admin']], function () {


    Route::get('categories', 'CourseController@category')->name('category')->middleware('RoutePermissionCheck:course.category');
    Route::post('categories/status-update', 'CourseController@category_status_update')->name('category.status_update')->middleware('RoutePermissionCheck:course.category.status_update');
    Route::post('categories/store', 'CourseController@category_store')->name('category.store')->middleware('RoutePermissionCheck:course.category.store');
    Route::post('categories/update', 'CourseController@category_update')->name('category.update')->middleware('RoutePermissionCheck:course.category.edit');
    Route::get('categories/edit/{id}', 'CourseController@category_edit')->name('category.edit')->middleware('RoutePermissionCheck:course.category.edit');
    Route::get('categories/delete/{id}', 'CourseController@category_delete')->name('category.delete')->middleware('RoutePermissionCheck:course.category.delete');


    Route::get('sub-categories', 'CourseController@sub_category')->name('subcategory')->middleware('RoutePermissionCheck:course.subcategory');
    Route::post('sub-categories/status-update', 'CourseController@sub_category_status_update')->name('subcategory.status_update')->middleware('RoutePermissionCheck:course.subcategory.status_update');
    Route::post('sub-categories/store', 'CourseController@sub_category_store')->name('subcategory.store')->middleware('RoutePermissionCheck:course.subcategory.store');
    Route::post('sub-categories/update', 'CourseController@sub_category_update')->name('subcategory.update')->middleware('RoutePermissionCheck:course.subcategory.edit');
    Route::get('sub-categories/edit/{id}', 'CourseController@sub_category_edit')->name('subcategory.edit')->middleware('RoutePermissionCheck:course.subcategory.edit');
    Route::get('sub-categories/delete/{id}', 'CourseController@sub_category_delete')->name('subcategory.delete')->middleware('RoutePermissionCheck:course.subcategory.delete');


});
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('profile-settings', 'UserController@changePassword')->name('changePassword');
    Route::post('profile-settings', 'UserController@UpdatePassword')->name('updatePassword');
    Route::post('profile-update', 'UserController@update_user')->name('update_user');
});
Route::post('get-user-by-role', 'UserController@getUsersByRole')->name('getUsersByRole')->middleware('auth');

Route::group(['namespace' => 'Admin', 'prefix' => 'communication', 'as' => 'communication.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('private-messages', 'CommunicationController@PrivateMessage')->name('PrivateMessage')->middleware('RoutePermissionCheck:communication.PrivateMessage');
    Route::get('questions-answer', 'CommunicationController@QuestionAnswer')->name('QuestionAnswer')->middleware('RoutePermissionCheck:communication.QuestionAnswer');
    Route::any('StorePrivateMessage', 'CommunicationController@StorePrivateMessage')->name('StorePrivateMessage')->middleware('RoutePermissionCheck:communication.send');
    Route::post('getMessage', 'CommunicationController@getMessage')->name('getMessage');
});

Route::get('ajaxGetSubCategoryList', 'AjaxController@ajaxGetSubCategoryList')->name('ajaxGetSubCategoryList');
Route::get('ajaxGetCourseList', 'AjaxController@ajaxGetCourseList')->name('ajaxGetCourseList');
Route::get('ajaxGetQuizList', 'AjaxController@ajaxGetQuizList')->name('ajaxGetQuizList');


Route::get('status-enable-disable', 'AjaxController@statusEnableDisable')->name('statusEnableDisable')->middleware(['auth']);
Route::get('publish-enable-disable', 'AjaxController@publishEnableDisable')->name('publishEnableDisable');
Route::get('topbar-enable-disable', 'AjaxController@topbarEnableDisable')->name('topbarEnableDisable');
Route::get('footer-enable-disable', 'AjaxController@footerEnableDisable')->name('footerEnableDisable');


Route::get('change-language/{language_code}', 'UserController@changeLanguage')->name('changeLanguage');

Route::post('/search', 'SearchController@search')->name('routeSearch');


