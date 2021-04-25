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

Route::prefix('modulemanager')->middleware('auth')->group(function () {
    Route::get('/', 'ModuleManagerController@ManageAddOns')->name('modulemanager.index');
    Route::post('/uploadModule', 'ModuleManagerController@uploadModule')->name('modulemanager.uploadModule');

    Route::get('manage-adons-delete/{name}', 'ModuleManagerController@ManageAddOns')->name('deleteModule');
    Route::get('manage-adons-enable/{name}', 'ModuleManagerController@moduleAddOnsEnable')->name('moduleAddOnsEnable');
    Route::get('manage-adons-disable/{name}', 'ModuleManagerController@moduleAddOnsDisable')->name('moduleAddOnsDisable');
});
