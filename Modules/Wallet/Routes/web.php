<?php


use Illuminate\Support\Facades\Route;

Route::prefix('wallet')->middleware('auth')->group(function () {
    Route::get('/', 'WalletController@index');
});
