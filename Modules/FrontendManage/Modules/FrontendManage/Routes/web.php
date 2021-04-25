<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'frontend', 'as' => 'frontend.', 'middleware' => ['auth', 'admin']], function () {

    //sponsor
    Route::resource('/sponsors', 'SponsorController')->except('update', 'destroy');
    Route::post('/sponsors/update', 'SponsorController@update')->name('sponsors.update');
    Route::get('/sponsors/destroy/{id}', 'SponsorController@destroy')->name('sponsors.destroy');

    Route::get('/', 'FrontendManageController@index')->name('home');
    Route::get('about', 'FrontendManageController@about')->name('about');
    Route::get('privacy', 'FrontendManageController@privacy')->name('privacy');

    // testimonials
    Route::get('testimonials', 'FrontendManageController@testimonials')->name('testimonials');
    Route::post('testimonials-store', 'FrontendManageController@testimonials_store')->name('testimonials_store');
    Route::post('testimonials-update', 'FrontendManageController@testimonials_update')->name('testimonials_update');
    Route::get('testimonials-edit/{id}', 'FrontendManageController@testimonials_edit')->name('testimonials_edit');
    Route::get('testimonials-delete/{id}', 'FrontendManageController@testimonials_delete')->name('testimonials_delete');


    Route::get('social-setting', 'FrontendManageController@socialSetting')->name('socialSetting')->middleware('RoutePermissionCheck:frontend.socialSetting');
    Route::get('social-setting/{id}', 'FrontendManageController@socialSettingEdit')->name('socialSetting_edit');
    Route::get('social-setting-delete/{id}', 'FrontendManageController@socialSettingDelete')->name('socialSetting.delete');
    Route::post('social-setting', 'FrontendManageController@socialSettingSave')->name('socialSetting.store')->middleware('RoutePermissionCheck:frontend.socialSetting.store');
    Route::post('social-setting-update', 'FrontendManageController@socialSettingUpdate')->name('socialSetting.update')->middleware('RoutePermissionCheck:frontend.socialSetting.update');

    Route::get('section-setting', 'FrontendManageController@sectionSetting')->name('sectionSetting')->middleware('RoutePermissionCheck:frontend.sectionSetting');
    Route::get('section-setting-edit/{id}', 'FrontendManageController@sectionSettingEdit')->name('sectionSetting_edit')->middleware('RoutePermissionCheck:frontend.sectionSetting.edit');
    Route::post('section-setting-store', 'FrontendManageController@sectionSetting')->name('sectionSetting_store')->middleware('RoutePermissionCheck:frontend.socialSetting.store');
    Route::post('section-setting-update', 'FrontendManageController@sectionSetting_update')->name('sectionSetting_update')->middleware('RoutePermissionCheck:frontend.sectionSetting.edit');

    // Home Content
    Route::get('home-content', 'FrontendManageController@HomeContent')->name('homeContent');
    Route::post('home-content', 'FrontendManageController@HomeContentUpdate')->name('homeContent_Update');


    // Home Content
    Route::get('privacy-policy', 'FrontendManageController@PrivacyPolicy')->name('privacy_policy');
    Route::post('privacy-.policy', 'FrontendManageController@PrivacyPolicyUpdate')->name('privacy_policy_Update');

    Route::get('about', 'FrontendManageController@AboutPage')->name('AboutPage');
    Route::post('about', 'FrontendManageController@saveAboutPage')->name('saveAboutPage');


    //Page Builder
    Route::resource('page', 'FrontPageController');


    //become instructor
    // Become Instructor Manage
    Route::get('/becomeInstructor', 'BecomeInstructorSettingController@index')->name('becomeInstructor');
    Route::get('/becomeInstructorStore/{id}', 'BecomeInstructorSettingController@store')->name('becomeInstructorStore');
    Route::get('/becomeInstructorEdit/{id}', 'BecomeInstructorSettingController@edit')->name('becomeInstructorEdit');
    Route::post('/becomeInstructorUpdate', 'BecomeInstructorSettingController@update')->name('becomeInstructorUpdate');

    // Work Process Manage
    Route::get('/workProcess', 'BecomeInstructorSettingController@allWork')->name('workProcess');
    Route::post('/workProcessStore', 'BecomeInstructorSettingController@store')->name('workProcessStore');
    Route::get('/workProcessEdit/{id}', 'BecomeInstructorSettingController@editWork')->name('workProcessEdit');
    Route::post('/workProcessUpdate', 'BecomeInstructorSettingController@updateWork')->name('workProcessUpdate');
    Route::get('/workProcessDestroy/{id}', 'BecomeInstructorSettingController@destroy')->name('workProcessDestroy');
    Route::get('subscriber', 'FrontendManageController@subscriber')->name('subscriber');
    Route::get('subscriber_delete/{id}', 'FrontendManageController@subscriberDelete')->name('subscriberDelete');

    Route::get('/loginpage', 'LoginPageController@index')->name('loginpage.index');
    Route::post('/loginpage', 'LoginPageController@store')->name('loginpage.store');

});
