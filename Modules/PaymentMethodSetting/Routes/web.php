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

Route::prefix('paymentmethodsetting')->middleware('auth')->group(function () {
    Route::get('payment-method-setting', 'PaymentMethodSettingController@index')->name('paymentmethodsetting.payment_method_setting')->middleware('RoutePermissionCheck:paymentmethodsetting.payment_method_setting');
    Route::post('payment-method-setting', 'PaymentMethodSettingController@update')->name('paymentmethodsetting.update_payment_gateway')->middleware('RoutePermissionCheck:paymentmethodsetting.payment_method_setting_update');
    Route::post('changePaymentGatewayStatus', 'PaymentMethodSettingController@changePaymentGatewayStatus')->name('paymentmethodsetting.changePaymentGatewayStatus');
});
