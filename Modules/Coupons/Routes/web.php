<?php


use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'coupons','as'=>'coupons.', 'middleware'=>['auth','admin']], function (){

    Route::get('manage','CouponsController@index')->name('manage')->middleware('RoutePermissionCheck:coupons.manage');
    Route::get('common','CouponsController@coupon_common')->name('common')->middleware('RoutePermissionCheck:coupons.common');
    Route::get('single','CouponsController@coupon_single')->name('single')->middleware('RoutePermissionCheck:coupons.single');
    Route::get('personalized','CouponsController@coupon_personalized')->name('personalized')->middleware('RoutePermissionCheck:coupons.personalized');
    Route::post('/status-update','CouponsController@coupon_status_update')->name('status_update')->middleware('RoutePermissionCheck:coupons.status_update');

    Route::post('/store','CouponsController@saveCoupon')->name('store')->middleware('RoutePermissionCheck:coupons.store');
    Route::post('/update','CouponsController@updateCoupon')->name('update')->middleware('RoutePermissionCheck:coupons.edit');
    Route::get('/edit/{id}','CouponsController@editCoupon')->name('edit')->middleware('RoutePermissionCheck:coupons.edit');
    Route::get('/delete/{id}','CouponsController@coupon_delete')->name('delete')->middleware('RoutePermissionCheck:coupons.delete');

    Route::get('invite_code','CouponsController@invitebyCode')->name('invite_code')->middleware('RoutePermissionCheck:coupons.invite_code');
    Route::get('invite-settings','CouponsController@inviteSettings')->name('inviteSettings')->middleware('RoutePermissionCheck:coupons.inviteSettings');

    Route::POST('invite-settings-store','CouponsController@inviteSettingStore')->name('inviteSettingStore');
    Route::get('invite-settings-edit/{id}','CouponsController@inviteSettingEdit')->name('inviteSettingEdit');
    Route::get('invite-settings-delete/{id}','CouponsController@inviteSettingDelete')->name('inviteSettingDelete');

});

Route::group(['prefix'=>'coupons','as'=>'coupons.'], function (){
    // Route::get('/', 'CouponsController@index');
});
