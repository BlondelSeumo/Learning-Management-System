<?php

use Illuminate\Support\Facades\Route;

Route::prefix('certificate')->middleware('auth')->group(function () {
    Route::resource('certificate', 'CertificateController')->except('update')->middleware('RoutePermissionCheck:certificate.index');
    Route::post('certificate-update/{id}', 'CertificateController@update')->name('certificate.update')->middleware('RoutePermissionCheck:certificate.edit');
    Route::post('certificate-course/{id}', 'CertificateController@courseCertificate')->name('course.certificate.update')->middleware('RoutePermissionCheck:certificate.index');
    Route::post('certificate-quiz/{id}', 'CertificateController@quizCertificate')->name('quiz.certificate.update')->middleware('RoutePermissionCheck:certificate.index');
    Route::post('get-fonts/variant', 'CertificateController@getVariants')->name('get.fonts.variant');
    Route::get('view/{id}', 'CertificateController@view')->name('certificate.view');
    Route::get('download/{id}', 'CertificateController@download')->name('certificate.download');

    Route::get('make', 'CertificateController@preview')->name('certificate.make');
    Route::post('upload', 'CertificateController@upload')->name('certificate.upload');
});
