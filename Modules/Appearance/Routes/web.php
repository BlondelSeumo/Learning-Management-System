<?php


use Illuminate\Support\Facades\Route;

Route::prefix('appearance')->as('appearance.')->middleware('auth')->group(function () {
    Route::get('/', 'AppearanceController@index')->name('index')->middleware('RoutePermissionCheck:appearance.themes.index');

    //themes
    Route::resource('/themes', 'ThemeController')->except('destroy', 'update', 'edit')->middleware('RoutePermissionCheck:appearance.themes.index');
    Route::post('/themes/active', 'ThemeController@active')->name('themes.active')->middleware('RoutePermissionCheck:appearance.themes.index');
    Route::post('/themes/delete', 'ThemeController@destroy')->name('themes.delete')->middleware('RoutePermissionCheck:appearance.themes.index');
});
