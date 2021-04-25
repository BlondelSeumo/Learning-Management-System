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

Route::group(['prefix'=>'imagegallery','as'=>'imagegallery.', 'middleware'=>['auth','admin']], function (){

    Route::get('/', 'ImageGalleryController@index')->name('list')->middleware('RoutePermissionCheck:imagegallery.list');
    Route::post('image-store', 'ImageGalleryController@store')->name('store')->middleware('RoutePermissionCheck:imagegallery.store');
    Route::get('image-edit/{id}', 'ImageGalleryController@edit')->name('edit')->middleware('RoutePermissionCheck:imagegallery.edit');
    Route::post('image-update', 'ImageGalleryController@update')->name('update')->middleware('RoutePermissionCheck:imagegallery.edit');
    Route::any('image-gallery/{id}', 'ImageGalleryController@destroy')->name('delete')->middleware('RoutePermissionCheck:imagegallery.delete');
});
