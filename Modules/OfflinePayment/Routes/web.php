<?php

use Illuminate\Support\Facades\Route;

Route::prefix('offlinepayment')->middleware('auth')->group(function() {
    Route::get('/', 'OfflinePaymentController@index');

    Route::get('/offline', 'OfflinePaymentController@offlinePaymentView')->name('offlinePayment')->middleware('RoutePermissionCheck:offlinePayment');
    Route::get('/offline-history/{id}', 'OfflinePaymentController@FundHistory')->name('fundHistory')->middleware('RoutePermissionCheck:offlinePayment.fund-history');
    Route::post('/addBalance', 'OfflinePaymentController@addBalance')->name('addBalance')->middleware('RoutePermissionCheck:offlinePayment.add');
});
