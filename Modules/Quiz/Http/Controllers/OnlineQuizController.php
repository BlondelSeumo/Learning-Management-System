<?php

namespace Modules\Quiz\Http\Controllers;

use App\TableList;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\CourseSetting\Entities\Category;
use Modules\Quiz\Entities\OnlineExamQuestionAssign;
use Modules\Quiz\Entities\OnlineQuiz;
use Modules\Quiz\Entities\QuestionBank;
use Modules\Quiz\Entities\QuestionGroup;
use Modules\Quiz\Entities\QuizeSetup;
use Modules\Quiz\Entities\QuizTest;
use Modules\Quiz\Entities\QuizTestDetails;
use Modules\Quiz\Entities\StudentTakeOnlineQuiz;

class OnlineQuizController extends Controller
{
    public function index()
    {

        try {
            $online_exams = OnlineQuiz::get();
            $categories = Category::get();

            $present_date_time = date("Y-m-d H:i:s");
            $present_time = date("H:i:s");
            return view('quiz::online_quiz', compact('online_exams', 'categories', 'present_date_time', 'present_time'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required',
            'category' => 'required',
//            'sub_category' => 'required',
            'percentage' => 'required',
            'instruction' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $sub = $request->sub_category;
            if (empty($sub)) {
                $sub = null;
            }
            $online_exam = new OnlineQuiz();
            $online_exam->title = $request->title;
            $online_exam->category_id = $request->category;
            $online_exam->sub_category_id = $sub;
            $online_exam->course_id = $request->course;
            $online_exam->percentage = $request->percentage;
            $online_exam->instruction = $request->instruction;
            $online_exam->status = 0;
            $result = $online_exam->save();
            if ($result) {

                DB::commit();
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            dd($e);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {
            $online_exams = OnlineQuiz::get();


            $categories = Category::get();
            $online_exam = OnlineQuiz::find($id);

            $present_date_time = date("Y-m-d H:i:s");
            $present_time = date("H:i:s");

            return view('quiz::online_quiz', compact('online_exams', 'categories', 'online_exam', 'present_date_time', 'present_time'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'sub_category' => 'required',
            'percentage' => 'required',
            'instruction' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $online_exam = OnlineQuiz::find($id);
            $online_exam->title = $request->title;
            $online_exam->category_id = $request->category;
            $online_exam->sub_category_id = $request->sub_category;
            $online_exam->course_id = $request->course;
            $online_exam->percentage = $request->percentage;
            $online_exam->instruction = $request->instruction;
            $online_exam->status = 0;
            $result = $online_exam->save();
            if ($result) {

                DB::commit();
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $id_key = 'online_exam_id';

            $tables = TableList::getTableList($id_key, $request->id);

            try {
                if ($tables == null) {
                    $delete_query = OnlineQuiz::destroy($request->id);

                    if ($delete_query) {
                        Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                        return redirect()->back();
                    } else {
                        Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                        return redirect()->back();

                    }
                } else {
                    $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                    Toastr::error($msg, 'Failed');
                    return redirect()->back();
                }


            } catch (\Illuminate\Database\QueryException $e) {
                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function manageOnlineExamQuestion($id, Request $request)
    {

        try {
            $online_exam = OnlineQuiz::findOrFail($id);

            $online_exam->total_marks = $online_exam->totalMarks() ?? 0;
            $online_exam->total_questions = $online_exam->totalQuestions() ?? 0;

            if (empty($request->get('group'))) {
                $searchGroup = '';
                $query = QuestionBank::where('category_id', $online_exam->category_id);
                if ($online_exam->sub_category_id != null) {
                    $query->where('sub_category_id', $online_exam->sub_category_id);
                }
                $question_banks = $query->get();
            } else {
                $searchGroup = $request->get('group');
                $query = QuestionBank::where('category_id', $online_exam->category_id);
                if ($online_exam->sub_category_id != null) {
                    $query->where('sub_category_id', $online_exam->sub_category_id);
                }
                $question_banks = $query->where('q_group_id', $request->get('group'))
                    ->get();

            }

            $groups = QuestionGroup::where('active_status', 1)->get();
            $assigned_questions = OnlineExamQuestionAssign::where('online_exam_id', $id)->get();
            $already_assigned = [];
            foreach ($assigned_questions as $assigned_question) {
                $already_assigned[] = $assigned_question->question_bank_id;
            }


            return view('quiz::manage_quiz', compact('searchGroup', 'groups', 'online_exam', 'question_banks', 'already_assigned'));
        } catch (\Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function onlineExamPublish($id)
    {
        try {
            $publish = OnlineQuiz::find($id);
            $publish->status = 1;
            $publish->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function quizSetup()
    {
        $quiz_setup = QuizeSetup::first();
        return view('quiz::quiz_setup', compact('quiz_setup'));
    }

    public function SaveQuizSetup(Request $request)
    {
        try {
            $setup = QuizeSetup::firstOrCreate(['id' => 1]);
            $setup->random_question = $request->random_question;
            $setup->set_per_question_time = $request->set_per_question_time;
            $setup->multiple_attend = $request->multiple_attend ?? 0;
            if ($request->set_per_question_time == 1) {
                $setup->time_per_question = $request->set_time_per_question;
                $setup->time_total_question = null;
            } else {
                $setup->time_per_question = null;
                $setup->time_total_question = $request->set_time_total_question;
            }
            $setup->question_review = $request->question_review;
            if ($request->question_review == 1) {
                $setup->show_result_each_submit = null;
            } else {
                $setup->show_result_each_submit = $request->show_result_each_submit;
            }
            $setup->save();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

        return view('quiz::quiz_setup', compact('quiz_setup'));
    }

    public function onlineExamMarksRegister($id)
    {
        try {
            $online_exam_question = OnlineQuiz::find($id);
            $students = User::where('role_id', 3)->get();
            $present_students = [];
            foreach ($students as $student) {
                $take_exam = StudentTakeOnlineQuiz::where('student_id', $student->id)->where('online_exam_id', $online_exam_question->id)->first();
                if ($take_exam != "") {
                    $present_students[] = $student->id;
                }
            }

            return view('quiz::online_exam_marks_register', compact('online_exam_question', 'students', 'present_students'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function onlineExamQuestionAssign(Request $request)
    {
        try {
            OnlineExamQuestionAssign::where('online_exam_id', $request->online_exam_id)->delete();
            if (isset($request->questions)) {
                foreach ($request->questions as $question) {
                    $assign = new OnlineExamQuestionAssign();
                    $assign->online_exam_id = $request->online_exam_id;
                    $assign->question_bank_id = $question;
                    $assign->save();
                }
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            }
            Toastr::error('No question is assigned', 'Failed');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }


    public function onlineExamQuestionAssignByAjax(Request $request)
    {

        try {
            $online_exam = OnlineQuiz::findOrFail($request->online_exam_id);

            OnlineExamQuestionAssign::where('online_exam_id', $request->online_exam_id)->delete();

            if (isset($request->questions)) {
                foreach ($request->questions as $question) {
                    $assign = new OnlineExamQuestionAssign();
                    $assign->online_exam_id = $request->online_exam_id;
                    $assign->question_bank_id = $question;
                    $assign->save();
                }

                $totalMarks = $online_exam->total_marks = $online_exam->totalMarks() ?? 0;
                $totalQus = $online_exam->total_questions = $online_exam->totalQuestions() ?? 0;
                return response()->json([
                    'success' => 'Operation successful',
                    'totalQus' => $totalQus,
                    'totalMarks' => $totalMarks,
                ], 200);
            }

            return response()->json(['success' => 'No question is assigned'], 200);

        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['error' => 'Something Went Wrong'], 500);
        }
    }

    public function viewOnlineQuestionModal($id)
    {

        try {
            $question_bank = QuestionBank::find($id);
            return view('quiz::online_eaxm_question_view_modal', compact('question_bank'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function quizResult(Request $request)
    {
        $category = $request->get('category');
        $sub_category = $request->get('sub_category');
        $quiz_id = $request->get('quiz');


        try {

            $categories = Category::all();

            if ($request->category) {
                $category_search = $request->category;
            } else {
                $category_search = '';

            }

            if ($request->sub_category) {
                $subcategory_search = $request->sub_category;
            } else {
                $subcategory_search = '';
            }

            if ($request->course) {
                $course_search = $request->course;
            } else {
                $course_search = '';
            }

            $allReports = QuizTest::latest()->get();

            $reports = [];
            foreach ($allReports as $key => $report) {
                $quiz = OnlineQuiz::find($report->quiz_id);

                if ((empty($category) || $quiz->category_id == $category) &&
                    (empty($sub_category) || $quiz->subcategory_id == $sub_category) &&
                    (empty($quiz_id) || $quiz->id == $quiz_id)
                ) {

                    $reports[$key]['user_name'] = User::find($report->user_id)->name ?? "";
                    $reports[$key]['category'] = $quiz->category->name ?? "";
                    $reports[$key]['quiz'] = $quiz->title ?? "";
                    $reports[$key]['course'] = $quiz->course->title;


                    $totalCorrect = QuizTestDetails::where('quiz_test_id', $report->id)->where('status', 1)->count();
                    $totalMark = QuizTestDetails::where('quiz_test_id', $report->id)->where('status', 1)->sum('mark');

                    $reports[$key]['totalMarks'] = $totalMark;
                    $reports[$key]['marks'] = $totalCorrect;

                }
            }

            return view('quiz::online_exam_report', compact('course_search', 'subcategory_search', 'category_search', 'categories', 'reports'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }
}
