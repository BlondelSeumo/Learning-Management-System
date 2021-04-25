<?php


use Illuminate\Support\Facades\Route;

Route::prefix('vimeosetting')->middleware('auth')->group(function () {
    Route::get('vimeo-setting', 'VimeoSettingController@index')->name('vimeosetting.index')->middleware('RoutePermissionCheck:vimeosetting.index');
    Route::post('vimeo-setting', 'VimeoSettingController@update')->name('vimeosetting.update')->middleware('RoutePermissionCheck:vimeosetting.update');
});
