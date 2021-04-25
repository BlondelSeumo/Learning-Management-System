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

Route::prefix('paytm')->middleware('auth')->group(function () {
    Route::get('/', 'PaytmController@index');
    Route::post('/payment/status', 'PaytmController@paymentCallback')->name('paytmStatus');
    Route::post('/deposit/status', 'PaytmController@depositCallback')->name('paytmDepositStatus');
    Route::post('/subscription/status', 'PaytmController@subscriptionCallback')->name('paytmSubscriptionStatus');
});
