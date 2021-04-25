<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin/course', 'middleware' => ['auth']], function () {
    Route::get('/allCategory', 'CourseSettingController@allCategory');
    Route::get('/getSubcat/{id}', 'CourseSettingController@getSubcat');
});

//Route For Admin

Route::group(['prefix' => 'admin/course', 'middleware' => ['auth', 'admin']], function () {


    Route::post('/change-chapter-position', 'CourseSettingController@changeChapterPosition')->name('changeChapterPosition');
    Route::post('/change-lesson-position', 'CourseSettingController@changeLessonPosition')->name('changeLessonPosition');

    //Get Course Subcategory
    Route::get('/ajaxGetCourseSubCategory', 'CourseSettingController@ajaxGetCourseSubCategory');

    //Manage Category
    Route::get('/messages', 'CourseSettingController@toastrMessages')->name('toastrMessages');

    Route::get('/searchCategory', 'CourseSettingController@searchCategory')->name('searchCategory');
    Route::get('/searchCourse', 'CourseSettingController@searchCourse')->name('searchCourse');
    Route::post('/saveCategory', 'CourseSettingController@saveCategory')->name('saveCategory');
    Route::get('/categoryEdit/{id}', 'CourseSettingController@categoryEdit')->name('categoryEdit');

    Route::post('/updateCategory', 'CourseSettingController@updateCategory')->name('updateCategory');
    Route::get('/categoryStatus/{id}', 'CourseSettingController@categoryStatus')->name('categoryStatus');

    //Manage Subcategory

    Route::get('/editSubCategory/{id}', 'CourseSettingController@editSubCategory')->name('editSubCategory');
    Route::post('/updateSubCategory', 'CourseSettingController@updateSubCategory')->name('updateSubCategory');
    Route::post('/disableSubCategory', 'CourseSettingController@disableSubCategory')->name('disableSubCategory');


    Route::get('/course-details/{id}', 'CourseSettingController@courseDetails')->name('courseDetails')->middleware('RoutePermissionCheck:course.details');


    Route::post('/setCourseDripContent', 'CourseSettingController@setCourseDripContent')->name('setCourseDripContent');
    // Route::get('/course-test/{id}', 'CourseSettingController@courseDetails2')->name('courseDetails2');


    //Manage course
    Route::get('/all/courses', 'CourseSettingController@getAllCourse')->name('getAllCourse')->middleware('RoutePermissionCheck:getAllCourse');
    Route::get('/active/courses', 'CourseSettingController@getActiveCourse')->name('getActiveCourse')->middleware('RoutePermissionCheck:getActiveCourse');
    Route::get('/pending/courses', 'CourseSettingController@getPendingCourse')->name('getPendingCourse')->middleware('RoutePermissionCheck:getPendingCourse');
    Route::get('/disable/courses', 'CourseSettingController@getDisableCourse')->name('getDisableCourse')->middleware('RoutePermissionCheck:getDisableCourse');
    Route::get('/publish/courses', 'CourseSettingController@getPublishCourse')->name('getPublishCourse')->middleware('RoutePermissionCheck:getPublishCourse');
    Route::get('/unpublish/courses', 'CourseSettingController@getUnpublishCourse')->name('getUnpublishCourse')->middleware('RoutePermissionCheck:getUnpublishCourse');
    Route::post('/saveCourse', 'CourseSettingController@saveCourse')->name('AdminSaveCourse')->middleware('RoutePermissionCheck:course.store');
    Route::get('/editCourse/{id}', 'CourseSettingController@editCourse')->name('editCourse')->middleware('RoutePermissionCheck:course.edit');
    Route::post('/updateCourse', 'CourseSettingController@AdminUpdateCourse')->name('AdminUpdateCourse')->middleware('RoutePermissionCheck:course.edit');
    Route::post('/unpublishCourse', 'CourseSettingController@unpublishCourse')->name('AdminUnpublishCourse');
    Route::get('/publishCourse/{id}', 'CourseSettingController@publishCourse')->name('publishCourse');
    Route::post('/courseStatus', 'CourseSettingController@courseStatus')->name('AdminCourseStatus')->middleware('RoutePermissionCheck:course.status_update');


    Route::get('/getEnroll/{id}', 'CourseSettingController@getEnroll')->name('getEnroll');
    Route::post('/rejectEnroll', 'CourseSettingController@rejectEnroll')->name('rejectEnroll');
    Route::post('/enableEnroll', 'CourseSettingController@enableEnroll')->name('enableEnroll');
    Route::post('/submitEnroll/{id}', 'CourseSettingController@submitEnroll')->name('submitEnroll');
    Route::post('/course-sort-by', 'CourseSettingController@courseSortBy')->name('courseSortBy');
    Route::get('/course-sort-by', 'CourseSettingController@getAllCourse');
    Route::get('/courseSortByCat/{id}', 'CourseSettingController@courseSortByCat')->name('courseSortByCat');
    Route::get('/courseSort/{value}', 'CourseSettingController@courseSort')->name('courseSort');
    Route::get('/courseSortByInstructor/{value}', 'CourseSettingController@courseSortByInstructor')->name('courseSortByInstructor');


    Route::get('chapter', 'ChapterController@index')->name('chapterPage');
    Route::POST('chapter', 'ChapterController@store')->name('saveChapterPage');
    Route::POST('chapter-search', 'ChapterController@chapterSearchByCourse')->name('chapterSearchByCourse');
    Route::get('chapter/{id}', 'ChapterController@chapterEdit')->name('chapterEdit');
    Route::PUT('chapter-update', 'ChapterController@chapterUpdate')->name('chapterUpdate');

    Route::get('lesson/{id}', 'LessonController@index')->name('lessonPage');
    Route::post('/addLesson', 'LessonController@addLesson')->name('addLesson');
    Route::get('/edit-lesson/{id}', 'LessonController@editLesson')->name('editLesson');
    Route::put('/updateLesson', 'LessonController@updateLesson')->name('updateLesson');
    Route::post('/deleteLesson', 'LessonController@deleteLesson')->name('deleteLesson');
    Route::post('/add-chapter', 'InstructorCourseSettingController@saveChapter')->name('saveChapter');
    Route::post('/saveFile', 'InstructorCourseSettingController@saveFile')->name('saveFile');
    Route::get('/download-file/{id}', 'InstructorCourseSettingController@download_course_file')->name('download_course_file');
    Route::get('/edit-chapter/{id}/{course}', 'InstructorCourseSettingController@editChapter')->name('editChapter');
    Route::get('/delete-chapter/{id}/{course}', 'InstructorCourseSettingController@deleteChapter')->name('deleteChapter');
    Route::put('/update-chapter', 'InstructorCourseSettingController@updateChapter')->name('updateChapter');
    Route::POST('/updateFile', 'InstructorCourseSettingController@updateFile')->name('updateFile');
    Route::get('/course_chapters/{id}', 'InstructorCourseSettingController@course_chapters')->name('course_chapters');
    Route::post('/deleteFile2', 'InstructorCourseSettingController@deleteFile')->name('deleteFile');

});



