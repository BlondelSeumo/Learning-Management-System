<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('systemsetting')->group(function () {
    Route::get('/', 'SystemSettingController@index');
    // Route::get('/lang/{id}', 'SystemSettingController@locale');
    Route::get('/setLocale/{lang}', 'SystemSettingController@setLocale');
    Route::get('/getLocale', 'SystemSettingController@getLocale');
    Route::get('/languages', 'SystemSettingController@languages');
    Route::get('/currencies', 'SystemSettingController@currencies');
    Route::get('/get_language', 'SystemSettingController@getLocaleLang');
});

Route::group(['prefix' => 'admin/systemsetting', 'middleware' => ['auth', 'admin']], function () {

    Route::get('/getAllLanguage', 'SystemSettingController@getAllLanguage');
});

Route::group(['prefix' => 'admin/systemsetting', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'SystemSettingController@index');

    Route::post('/add_phrase', 'SystemSettingController@addPhrase');
    Route::post('/add_module', 'SystemSettingController@addModule');

    Route::get('/messages', 'InstructorSettingController@toastrMessages');
    Route::get('/companyMessages', 'CompanyController@toastrMessages');
    Route::get('/workMessages', 'BecomeInstructorSettingController@toastrMessages');
    Route::get('/testimonialMessages', 'TestimonialController@toastrMessages');
    Route::get('/blogMessages', 'SystemSettingController@toastrMessages');
    Route::get('/faqMessages', 'FAQController@toastrMessages');
    Route::get('/footerMessages', 'FooterController@toastrMessages');
    Route::get('/socialMessages', 'SocialLinkController@toastrMessages');
    Route::get('/pageMessages', 'PageController@toastrMessages');

    //Language Setting

//    Route::get('/getAllLanguage', 'SystemSettingController@getAllLanguage');
    Route::get('/languageStatus/{id}', 'SystemSettingController@languageStatus');
    Route::post('/language_add', 'SystemSettingController@language_add');
    Route::get('/language_edit/{id}', 'SystemSettingController@language_edit');
    Route::post('/language_update', 'SystemSettingController@language_update');
    Route::post('/language_search', 'SystemSettingController@language_search');
    Route::get('/language_searchData', 'SystemSettingController@language_searchData');
    Route::post('/language_phase', 'SystemSettingController@language_phase');
    Route::get('/language', 'SystemSettingController@language');
    Route::post('/language_delete/{id}', 'SystemSettingController@language_delete');
    Route::get('/changeLanguage/{id}', 'SystemSettingController@changeLanguage');
    Route::get('/allModules', 'SystemSettingController@allModules');
    Route::post('/moduleCode', 'SystemSettingController@moduleCode');
    Route::post('/saveTranslate/{lang}', 'SystemSettingController@saveTranslate');
    Route::post('/socialCreditional', 'SystemSettingController@socialCreditional');

//Instructor Manage
    Route::get('/allInstructor', 'InstructorSettingController@index')->name('allInstructor')->middleware('RoutePermissionCheck:allInstructor');
    Route::post('/store', 'InstructorSettingController@store')->name('instructor.store')->middleware('RoutePermissionCheck:instructor.store');
    Route::get('/searchInstructor', 'InstructorSettingController@searchInstructor');
    Route::get('/edit/{id}', 'InstructorSettingController@edit')->middleware('RoutePermissionCheck:instructor.edit');
    Route::post('/update', 'InstructorSettingController@update')->name('instructor.update')->middleware('RoutePermissionCheck:instructor.edit');
    Route::post('/destroy', 'InstructorSettingController@destroy')->name('instructor.delete')->middleware('RoutePermissionCheck:instructor.delete');
    Route::get('/status/{id}', 'InstructorSettingController@status')->name('instructor.change_status')->middleware('RoutePermissionCheck:instructor.change_status');

    //Email Setting
    Route::get('/editEmailSetting', 'SystemSettingController@editEmailSetting');
    Route::post('/updateEmailSetting', 'SystemSettingController@updateEmailSetting')->name('updateEmailSetting');
    Route::post('/sendTestMail', 'SystemSettingController@sendTestMail')->name('sendTestMail');
    Route::get('/getEmailTemp', 'SystemSettingController@getEmailTemp');
    Route::get('/editEmailTemp/{id}', 'SystemSettingController@editEmailTemp');
    Route::get('/viewEmailTemp/{id}', 'SystemSettingController@viewEmailTemp');
    Route::post('/updateEmailTemp', 'SystemSettingController@updateEmailTemp')->name('updateEmailTemp')->middleware('RoutePermissionCheck:updateEmailTemp');
     Route::post('/footerTemplateUpdate', 'SystemSettingController@footerTemplateUpdate')->name('footerTemplateUpdate')->middleware('RoutePermissionCheck:footerTemplateUpdate');

    //Web Setting
    Route::post('/websiteSetting', 'SystemSettingController@websiteSetting');
    Route::post('/seoSetting', 'SystemSettingController@seoSetting');
    Route::post('/recapchaSetting', 'SystemSettingController@recapchaSetting');
    Route::post('/homeVarriant/{id}', 'SystemSettingController@homeVarriant');
    Route::post('/systemSetting', 'SystemSettingController@systemSetting');
    Route::get('/websiteSetting_view', 'SystemSettingController@websiteSetting_view');
    Route::get('/alltimezones', 'SystemSettingController@alltimezones');

    //Currency Setting
    Route::get('/allCurrency', 'SystemSettingController@allCurrency');
    Route::get('/currencyStatus/{id}', 'SystemSettingController@currencyStatus');
    Route::get('/currency_edit/{id}', 'SystemSettingController@currency_edit');
    Route::post('/currency_update', 'SystemSettingController@currency_update');
    Route::post('/currency_add', 'SystemSettingController@currency_add');



    // Company Manage
    Route::get('/allCompany', 'CompanyController@index');
    Route::post('/storeCompany', 'CompanyController@store');
    Route::get('/editCompany/{id}', 'CompanyController@edit');
    Route::post('/updateCompany', 'CompanyController@update');
    Route::get('/destroyCompany/{id}', 'CompanyController@destroy');
    Route::get('/companyStatus/{id}', 'CompanyController@status');
    Route::get('/searchCompany', 'CompanyController@search');

    // Page Manage
    Route::get('/allPage', 'PageController@index');
    Route::post('/storePage', 'PageController@store');
    Route::get('/editPage/{id}', 'PageController@edit');
    Route::post('/updatePage', 'PageController@update');
    Route::get('/destroyPage/{id}', 'PageController@destroy');
    Route::get('/pageStatus/{id}', 'PageController@status');
    Route::get('/searchPage', 'PageController@search');

    // Frontend Manage
    Route::get('/allFrontend', 'FrontendSettingController@index');
    Route::get('/editFrontend/{id}', 'FrontendSettingController@edit');
    Route::post('/updateFrontend', 'FrontendSettingController@update');
    Route::get('/searchFrontend', 'FrontendSettingController@search');

    // Testimonial Manage
    Route::get('/allTestimonial', 'TestimonialController@index');
    Route::post('/storeTestimonial', 'TestimonialController@store');
    Route::get('/editTestimonial/{id}', 'TestimonialController@edit');
    Route::post('/updateTestimonial', 'TestimonialController@update');
    Route::get('/destroyTestimonial/{id}', 'TestimonialController@destroy');
    Route::get('/testimonialStatus/{id}', 'TestimonialController@status');
    Route::get('/searchTestimonial', 'TestimonialController@search');

    // Faq Manage
    Route::get('/allFaq', 'FAQController@index');
    Route::post('/storeFaq', 'FAQController@store');
    Route::get('/editFaq/{id}', 'FAQController@edit');
    Route::post('/updateFaq', 'FAQController@update');
    Route::get('/destroyFaq/{id}', 'FAQController@destroy');
    Route::get('/faqStatus/{id}', 'FAQController@status');
    Route::get('/searchFaq', 'FAQController@search');




    //message Area
    Route::get('/users', 'MessageController@index');
    Route::get('/findUser/{id}', 'MessageController@show');
    Route::get('/firstUser', 'MessageController@user');
    Route::post('/sentMessage/{id}', 'MessageController@store');
    Route::get('/searchUser', 'MessageController@search');

    Route::get('api','SystemSettingController@allApi')->name('api.setting');
    Route::post('save/api','SystemSettingController@saveApi')->name('save.api.setting');



});

Route::get('/become_instructor/getSetting', 'BecomeInstructorSettingController@getSetting');


Route::group(['prefix' => 'websitesetting'], function () {
    Route::get('/blog_details/{id}', 'SystemSettingController@blog_detail');
    Route::get('/nextBlog/{id}', 'SystemSettingController@nextBlog');
    Route::get('/previousBlog/{id}', 'SystemSettingController@previousBlog');
    Route::get('/viewBlog/{id}', 'SystemSettingController@viewBlog');

    Route::get('/website_data', 'GeneralSettingController@index');
});

//Footer Section
Route::group(['prefix' => 'footer/'], function () {
    Route::get('/categories', 'FooterController@index');
    Route::get('/categories/{id}', 'FooterController@show');
    Route::get('/content', 'FooterController@firstContent');
    Route::post('/saveFooter/{id}', 'FooterController@store');
    Route::post('/saveCategory/{id}', 'FooterController@saveCategory');
    Route::get('/destroy/{id}', 'FooterController@destroy');
    Route::get('/footerData', 'FooterController@footerData');
});

//Socail Link Section
Route::group(['prefix' => 'social/', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/social_list', 'SocialLinkController@index');
    Route::get('/getSocial/{id}', 'SocialLinkController@show');
    Route::post('/store', 'SocialLinkController@store');
    Route::post('/update', 'SocialLinkController@update');
    Route::get('/destroy/{id}', 'SocialLinkController@destroy');
    Route::get('/status/{id}', 'SocialLinkController@status');
});

//Socail Link Section
Route::group(['prefix' => 'counter/'], function () {
    Route::get('/counter_list', 'PageController@counters');
    Route::get('/getCounter/{id}', 'PageController@getCounter');
    Route::post('/saveCounter', 'PageController@saveCounter');
    Route::post('/updateCounter', 'PageController@updateCounter');
});
