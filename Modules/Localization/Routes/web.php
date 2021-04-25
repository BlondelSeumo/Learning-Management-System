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

Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::prefix('localization')->group(function() {
        Route::get('/','LanguageController@index')->name('languages.index')->middleware('RoutePermissionCheck:languages.index');
    	Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy')->middleware('RoutePermissionCheck:languages.destroy');
        Route::post('/edit', 'LanguageController@edit')->name('languages.edit_modal')->middleware('RoutePermissionCheck:languages.edit');
        Route::post('/store', 'LanguageController@store')->name('languages.store')->middleware('RoutePermissionCheck:languages.store');
        Route::post('/update/{id}', 'LanguageController@update')->name('languages.update')->middleware('RoutePermissionCheck:languages.edit');
        Route::get('/translate-view/{id}', 'LanguageController@show')->name('language.translate_view')->middleware('RoutePermissionCheck:languages.translate_view');
        Route::post('/update-rtl-status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status')->middleware('RoutePermissionCheck:languages.update_rtl_status');
    	Route::post('/update-active-status', 'LanguageController@update_active_status')->name('languages.update_active_status')->middleware('RoutePermissionCheck:languages.update_active_status');
    	Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store')->middleware('RoutePermissionCheck:languages.key_value_store');
        Route::post('/set-language', 'LanguageController@changeLanguage')->name('language.change')->middleware('RoutePermissionCheck:languages.change');
        Route::post('/get-translate-file', 'LanguageController@get_translate_file')->name('language.get_translate_file')->middleware('RoutePermissionCheck:languages.get_translate_file');
    });
});
