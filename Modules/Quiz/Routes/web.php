<?php


use Illuminate\Support\Facades\Route;

Route::prefix('quiz')->middleware('auth')->group(function () {


    Route::get('question-group', 'QuizController@index')->name('question-group')->middleware('RoutePermissionCheck:question-group');
    Route::post('question-group', 'QuizController@store')->name('question-group.store')->middleware('RoutePermissionCheck:question-group.store');
    Route::get('question-group/{id}', 'QuizController@show')->name('question-group-edit')->middleware('RoutePermissionCheck:question-group.edit');
    Route::put('question-group/{id}', 'QuizController@update')->name('question-group-update')->middleware('RoutePermissionCheck:question-group.edit');
    Route::delete('question-group/{id}', 'QuizController@destroy')->name('question-group-delete')->middleware('RoutePermissionCheck:question-group.delete');

    Route::get('question-bank', 'QuestionBankController@index')->name('question-bank')->middleware('RoutePermissionCheck:question-bank');
    Route::post('question-bank', 'QuestionBankController@store')->name('question-bank.store')->middleware('RoutePermissionCheck:question-bank.store');
    Route::get('question-bank/{id}', 'QuestionBankController@show')->name('question-bank-edit')->middleware('RoutePermissionCheck:question-bank.edit');
    Route::put('question-bank/{id}', 'QuestionBankController@update')->name('question-bank-update')->middleware('RoutePermissionCheck:question-bank.edit');
    Route::delete('question-bank/{id}', 'QuestionBankController@destroy')->name('question-bank-delete')->middleware('RoutePermissionCheck:question-bank.delete');


    Route::get('set-quiz', 'OnlineQuizController@index')->name('online-quiz')->middleware('RoutePermissionCheck:set-quiz.store');
    Route::post('online-exam', 'OnlineQuizController@store')->name('online-exam')->middleware('RoutePermissionCheck:set-quiz.store');
    Route::get('online-exam/{id}', 'OnlineQuizController@edit')->name('online-exam-edit')->middleware('RoutePermissionCheck:set-quiz.edit');
    Route::put('online-exam/{id}', 'OnlineQuizController@update')->name('online-exam-update')->middleware('RoutePermissionCheck:set-quiz.edit');
    Route::post('online-exam-delete', 'OnlineQuizController@delete')->name('online-exam-delete')->middleware('RoutePermissionCheck:set-quiz.delete');

    Route::get('quiz-setup', 'OnlineQuizController@quizSetup')->name('quizSetup')->middleware('RoutePermissionCheck:quizSetup');
    Route::POST('quiz-setup', 'OnlineQuizController@SaveQuizSetup')->name('quizSetup.store')->middleware('RoutePermissionCheck:quiz-setup.store');

    Route::get('quiz-result', 'OnlineQuizController@quizResult')->name('quizResult')->middleware('RoutePermissionCheck:quizResult');
    Route::POST('quiz-result', 'OnlineQuizController@getQuizResult')->middleware('RoutePermissionCheck:quizResult');


    Route::get('manage-online-exam-question/{id}', ['as' => 'manage_online_exam_question', 'uses' => 'OnlineQuizController@manageOnlineExamQuestion'])->middleware('RoutePermissionCheck:set-quiz.set-question');
    Route::post('online_exam_question_store', ['as' => 'online_exam_question_store', 'uses' => 'OnlineQuizController@manageOnlineExamQuestionStore'])->middleware('RoutePermissionCheck:set-quiz.set-question');

    Route::get('online-exam-publish/{id}', ['as' => 'online_exam_publish', 'uses' => 'OnlineQuizController@onlineExamPublish'])->middleware('RoutePermissionCheck:set-quiz.publish-now');
    Route::get('online-exam-publish-cancel/{id}', ['as' => 'online_exam_publish_cancel', 'uses' => 'OnlineQuizController@onlineExamPublishCancel'])->middleware('RoutePermissionCheck:set-quiz.publish-now');

    Route::get('online-question-edit/{id}/{type}/{examId}', 'OnlineQuizController@onlineQuestionEdit');
    Route::post('online-exam-question-edit', ['as' => 'online_exam_question_edit', 'uses' => 'OnlineQuizController@onlineExamQuestionEdit']);
    Route::post('online-exam-question-delete', 'OnlineQuizController@onlineExamQuestionDelete')->name('online-exam-question-delete');

    // store online exam question
    Route::post('online-exam-question-assign', ['as' => 'online_exam_question_assign', 'uses' => 'OnlineQuizController@onlineExamQuestionAssign']);
    Route::post('online-exam-question-assign-by-ajax', ['as' => 'online_exam_question_assign_by_ajax', 'uses' => 'OnlineQuizController@onlineExamQuestionAssignByAjax']);

    Route::get('view_online_question_modal/{id}', ['as' => 'view_online_question_modal', 'uses' => 'OnlineQuizController@viewOnlineQuestionModal']);

    // Online exam marks
    Route::get('online-exam-marks-register/{id}', ['as' => 'online_exam_marks_register', 'uses' => 'OnlineQuizController@onlineExamMarksRegister'])->middleware('RoutePermissionCheck:set-quiz.mark-register');

    Route::post('online-exam-marks-store', ['as' => 'online_exam_marks_store', 'uses' => 'OnlineQuizController@onlineExamMarksStore']);
    Route::get('online-exam-result/{id}', ['as' => 'online_exam_result', 'uses' => 'OnlineQuizController@onlineExamResult'])->middleware('RoutePermissionCheck:set-quiz.quiz_result');

    Route::get('online-exam-marking/{exam_id}/{s_id}', ['as' => 'online_exam_marking', 'uses' => 'OnlineQuizController@onlineExamMarking']);
    Route::post('online-exam-marks-store', ['as' => 'online_exam_marks_store', 'uses' => 'OnlineQuizController@onlineExamMarkingStore']);


});
