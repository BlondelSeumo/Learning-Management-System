<?php

use Illuminate\Support\Facades\Route;

Route::prefix('footer')->as('footerSetting.')->middleware('auth')->group(function () {
    //footer setting
    Route::get('/footer-setting', 'FooterSettingController@index')->name('footer.index');
    Route::post('/footer-setting', 'FooterSettingController@contentUpdate')->name('footer.content-update');
    Route::get('/footer-setting/tab/{id}', 'FooterSettingController@tabSelect')->name('footer.content-tabselect');

    Route::post('/footer-widget', 'FooterSettingController@widgetStore')->name('footer.widget-store');
    Route::post('/footer-widget-status', 'FooterSettingController@widgetStatus')->name('footer.widget-status');
    Route::post('/footer-widget-update', 'FooterSettingController@widgetUpdate')->name('footer.widget-update');
    Route::get('/footer-widget-delete/{id}', 'FooterSettingController@destroy')->name('footer.widget-delete');
});
