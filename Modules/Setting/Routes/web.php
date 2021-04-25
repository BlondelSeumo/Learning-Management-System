<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'setting', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'SettingController@index')->name('setting.index');
    Route::get('/activation', 'SettingController@activation')->name('setting.activation')->middleware('RoutePermissionCheck:setting.activation');
    Route::get('/general-settings', 'SettingController@general_settings')->name('setting.general_settings')->middleware('RoutePermissionCheck:setting.general_settings');
    Route::get('/email-configaration', 'SettingController@email_setup')->name('setting.email_setup')->middleware('RoutePermissionCheck:setting.email_setup');
    Route::get('/seo-setup', 'SettingController@seo_setting')->name('setting.seo_setting')->middleware('RoutePermissionCheck:setting.seo_setting');
    Route::get('/payment-setup', 'SettingController@paymentSetup')->name('setting.paymentSetup')->middleware('RoutePermissionCheck:route_name');
    Route::get('/social-login-setup', 'SettingController@social_login_setup')->name('setting.social_login_setup')->middleware('RoutePermissionCheck:setting.social_login_setup');
    Route::post('/update-activation-status', 'SettingController@update_activation_status')->name('update_activation_status')->middleware('RoutePermissionCheck:settings.ChangeActivationStatus');
    Route::post('general-settings/update', 'GeneralSettingsController@update')->name('company_information_update')->middleware('RoutePermissionCheck:settings.general_setting_update');
    Route::post('smtp-gateway-credentials/update', 'GeneralSettingsController@smtp_gateway_credentials_update')->name('smtp_gateway_credentials_update');
    Route::post('/test-mail/send', 'GeneralSettingsController@test_mail_send')->name('test_mail.send')->middleware('RoutePermissionCheck:setting.send_test_mail');
    Route::post('/social_login', 'GeneralSettingsController@socialCreditional')->name('socialCreditional')->middleware('RoutePermissionCheck:setting.setting.social_login_setup_update');
    Route::post('/seo-setup', 'GeneralSettingsController@seoSetting')->name('seo_setup')->middleware('RoutePermissionCheck:setting.seo_setting_update');

    Route::get('/footerEmailConfig', 'GeneralSettingsController@footerEmailConfig')->name('footerEmailConfig')->middleware('RoutePermissionCheck:footerEmailConfig');
    Route::get('/EmailTemp', 'GeneralSettingsController@EmailTemp')->name('EmailTemp')->middleware('RoutePermissionCheck:EmailTemp');


    Route::resource('currencies', 'CurrencyController')->except('destroy')->middleware('RoutePermissionCheck:currencies.index');
    Route::post('currency-edit-modal', 'CurrencyController@edit_modal')->name('currencies.edit_modal')->middleware('RoutePermissionCheck:currencies.edit_modal');
    Route::get('/currencies/destroy/{id}', 'CurrencyController@destroy')->name('currencies.destroy')->middleware('RoutePermissionCheck:currencies.destroy');


    Route::get('/aboutSystem', 'GeneralSettingsController@aboutSystem')->name('setting.aboutSystem')->middleware('RoutePermissionCheck:setting.aboutSystem');
    Route::get('/updateSystem', 'UpdateController@updateSystem')->name('setting.updateSystem')->middleware('RoutePermissionCheck:setting.updateSystem');
    Route::post('/updateSystem', 'UpdateController@updateSystemSubmit')->name('setting.updateSystem.submit')->middleware('RoutePermissionCheck:setting.updateSystem.submit');


    Route::resource('ipBlock', 'IpBlockController')->except('destroy')->middleware('RoutePermissionCheck:ipBlock.index');
    Route::post('ipBlock-delete', 'IpBlockController@destroy')->name('ipBlockDelete')->middleware('RoutePermissionCheck:ipBlock.index');

    Route::get('/geo-location', 'GeoLocationController@index')->name('setting.geoLocation')->middleware('RoutePermissionCheck:setting.geoLocation');
    Route::post('/geo-location-delete', 'GeoLocationController@destroy')->name('setting.geoLocation.delete')->middleware('RoutePermissionCheck:setting.geoLocation');

    Route::get('/cron-job', 'CornJobController@index')->name('setting.cronJob')->middleware('RoutePermissionCheck:setting.cronJob');


    Route::get('/cookie-setting', 'CookieSettingController@index')
        ->name('setting.cookieSetting')
        ->middleware('RoutePermissionCheck:setting.cookieSetting');

    Route::post('/cookie-setting', 'CookieSettingController@store')
        ->name('setting.cookieSettingStore')
        ->middleware('RoutePermissionCheck:setting.cookieSettingStore');

});
