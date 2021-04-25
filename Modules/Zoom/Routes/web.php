<?php

use Illuminate\Support\Facades\Route;


Route::prefix('zoom')->group(function () {
    Route::name('zoom.')->middleware('auth')->group(function () {
        Route::get('about', 'MeetingController@about');

        Route::get('meetings', 'MeetingController@index')->name('meetings')->middleware('RoutePermissionCheck:zoom.meetings.index');
        Route::post('meetings', 'MeetingController@store')->name('meetings.store')->middleware('RoutePermissionCheck:zoom.meetings.store');
        Route::get('meetings-show/{id}', 'MeetingController@show')->name('meetings.show')->middleware('RoutePermissionCheck:zoom.meetings');
        Route::get('meetings-edit/{id}', 'MeetingController@edit')->name('meetings.edit')->middleware('RoutePermissionCheck:zoom.meetings.edit');
        Route::post('meetings/{id}', 'MeetingController@update')->name('meetings.update')->middleware('RoutePermissionCheck:zoom.meetings.edit');
        Route::delete('meetings/{id}', 'MeetingController@destroy')->name('meetings.destroy')->middleware('RoutePermissionCheck:zoom.meetings.destroy');

        Route::get('settings', 'SettingController@settings')->name('settings')->middleware('RoutePermissionCheck:zoom.settings');
        Route::post('settings', 'SettingController@updateSettings')->name('settings.update')->middleware('RoutePermissionCheck:zoom.settings');
        Route::get('user-list-user-type-wise', 'MeetingController@userWiseUserList')->name('user.list.user.type.wise');
        Route::get('virtual-class-room/{id}', 'MeetingController@meetingStart')->name('meeting.join');


    });
});
