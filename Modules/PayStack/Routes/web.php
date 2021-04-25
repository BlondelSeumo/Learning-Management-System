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

Route::prefix('paystack')->middleware('auth')->group(function() {
    Route::get('/', 'PayStackController@index');
//    Route::get('/create', 'PayStackController@create');
    Route::post('/pay', 'PayStackController@redirectToGateway')->name('payStack');
    Route::get('/payment/callback', 'PayStackController@handleGatewayCallback')->name('payStackCallBack');  //Make sure you have /payment/callback registered in Paystack Dashboard |  https://dashboard.paystack.com/

});
