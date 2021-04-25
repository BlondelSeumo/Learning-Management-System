<?php

namespace Modules\Quiz\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\CourseSetting\Entities\Category;
use Modules\Quiz\Entities\QuestionBank;
use Modules\Quiz\Entities\QuestionBankMuOption;
use Modules\Quiz\Entities\QuestionGroup;
use Modules\Quiz\Entities\QuestionLevel;

class QuestionBankController extends Controller
{
    public function index()
    {
        try{
            $groups = QuestionGroup::where('active_status', 1)->get();
            $categories = Category::get();
            $banks = QuestionBank::where('active_status', 1)->get();
           return view('quiz::question_bank', compact('banks','groups','categories'));
        }catch (\Exception $e) {
           Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
           return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        if ($request->question_type == "") {
            $request->validate([
                'group' => "required",
                'category' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required"
            ]);
        } elseif ($request->question_type == "M") {
            $request->validate([
                'group' => "required",
                'category' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required",
                'number_of_option' => "required"
            ]);
        } elseif ($request->question_type == "F") {
            $request->validate([
                'group' => "required",
                'category' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required",
                'suitable_words' => "required"
            ]);
        }
        try{
            if ($request->question_type != 'M') {
                $online_question = new QuestionBank();
                $online_question->type = $request->question_type;
                $online_question->q_group_id = $request->group;
                $online_question->category_id = $request->category;
                $online_question->sub_category_id = $request->sub_category;
                $online_question->marks = $request->marks;
                $online_question->question = $request->question;
                if ($request->question_type == "F") {
                    $online_question->suitable_words = $request->suitable_words;
                } elseif ($request->question_type == "T") {
                    $online_question->trueFalse = $request->trueOrFalse;
                }
                $result = $online_question->save();
                if ($result) {
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->back();
                } else {
                    Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                    return redirect()->back();
                }
            } else {

                DB::beginTransaction();

                try {
                    $online_question = new QuestionBank();
                    $online_question->type = $request->question_type;
                    $online_question->q_group_id = $request->group;
                    $online_question->category_id = $request->category;
                    $online_question->sub_category_id = $request->sub_category;
                    $online_question->marks = $request->marks;
                    $online_question->question = $request->question;
                    $online_question->number_of_option = $request->number_of_option;

                    $online_question->save();
                    $online_question->toArray();
                    $i = 0;
                    if (isset($request->option)) {
                        foreach ($request->option as $option) {
                            $i++;
                            $option_check = 'option_check_' . $i;
                            $online_question_option = new QuestionBankMuOption();
                            $online_question_option->question_bank_id = $online_question->id;
                            $online_question_option->title = $option;
                            if (isset($request->$option_check)) {
                                $online_question_option->status = 1;
                            } else {
                                $online_question_option->status = 0;
                            }
                            $online_question_option->save();
                        }
                    }
                    DB::commit();
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->back();
                } catch (\Exception $e) {
                    DB::rollBack();
                }
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();

            }
        }catch (\Exception $e) {
           Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
           return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $levels = QuestionLevel::get();
            $groups = QuestionGroup::get();
            $banks = QuestionBank::get();
            $bank = QuestionBank::find($id);
            $categories = Category::get();

             //return $bank;
            return view('quiz::question_bank', compact('levels', 'groups', 'banks', 'bank', 'categories'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
            if ($request->question_type == "") {
            $request->validate([
                'group' => "required",
                'category' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required"
            ]);
        } elseif ($request->question_type == "M") {
            $request->validate([
                'group' => "required",
                'category' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required",
                'number_of_option' => "required"
            ]);
        } elseif ($request->question_type == "F") {
            $request->validate([
                'group' => "required",
                'category' => "required",
                'question' => "required",
                'question_type' => "required",
                'marks' => "required",
                'suitable_words' => "required"
            ]);
        }
        try{
            if ($request->question_type != 'M') {
                $online_question = QuestionBank::find($id);
                $online_question->type = $request->question_type;
                $online_question->q_group_id = $request->group;
                $online_question->category_id = $request->category;
                $online_question->sub_category_id = $request->sub_category;
                $online_question->marks = $request->marks;
                $online_question->question = $request->question;
                if ($request->question_type == "F") {
                    $online_question->suitable_words = $request->suitable_words;
                } elseif ($request->question_type == "T") {
                    $online_question->trueFalse = $request->trueOrFalse;
                }
                $result = $online_question->save();
                if ($result) {
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                     return redirect('quiz/question-bank');
                } else {
                    Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                    return redirect()->back();
                }
            } else {
                DB::beginTransaction();
                try {
                    $online_question = QuestionBank::find($id);
                    $online_question->type = $request->question_type;
                    $online_question->q_group_id = $request->group;
                    $online_question->category_id = $request->category;
                    $online_question->sub_category_id = $request->sub_category;
                    $online_question->marks = $request->marks;
                    $online_question->question = $request->question;
                    $online_question->number_of_option = $request->number_of_option;
                    $online_question->save();
                    $online_question->toArray();
                    $i = 0;
                    if (isset($request->option)) {
                        QuestionBankMuOption::where('question_bank_id', $online_question->id)->delete();
                        foreach ($request->option as $option) {
                            $i++;
                            $option_check = 'option_check_' . $i;
                            $online_question_option = new QuestionBankMuOption();
                            $online_question_option->question_bank_id = $online_question->id;
                            $online_question_option->title = $option;
                            if (isset($request->$option_check)) {
                                $online_question_option->status = 1;
                            } else {
                                $online_question_option->status = 0;
                            }
                            $online_question_option->save();
                        }
                    }
                    DB::commit();
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect('quiz/question-bank');
                } catch (\Exception $e) {
                    DB::rollBack();
                }
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        }catch (\Exception $e) {\
        // dd($e);
           Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
           return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $tables = \App\TableList::getTableList('question_bank_id', $id);

        try{
            if ($tables==null) {
                $online_question = QuestionBank::find($id);
                if ($online_question->type == "M") {
                    QuestionBankMuOption::where('question_bank_id', $online_question->id)->delete();
                }

                $result = $online_question->delete();

                if ($result) {
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect('question-bank');
                } else {
                    Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                    return redirect()->back();
                }
            } else {
                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }


        }catch (\Exception $e) {
            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
            Toastr::error($msg, 'Failed');
           return redirect()->back();
        }
    }
}
