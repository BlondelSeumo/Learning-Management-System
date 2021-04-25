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

Route::prefix('razorpay')->middleware('auth')->group(function() {
    Route::get('/', 'RazorpayController@index');
    Route::get('/pay', 'RazorpayController@create')->name('paywithrazorpay');
    Route::post('/payment', 'RazorpayController@payment')->name('razorpayPayment');
});
