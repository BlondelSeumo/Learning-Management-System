<?php

namespace Modules\Quiz\Http\Controllers;

use App\TableList;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Quiz\Entities\QuestionGroup;

class QuizController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $groups = QuestionGroup::get();
            return view('quiz::index', compact('groups'));
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
        $request->validate([
            'title' => "required|unique:question_groups"
        ]);
        try{
            $group = new QuestionGroup();
            $group->title = $request->title;
            $result = $group->save();
            if ($result) {
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
                // return redirect()->back()->with('message-danger', 'Something went wrong, please try again');
            }
        }catch (\Exception $e) {
           Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
           return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            // $group = QuestionGroup::find($id);

            $group = QuestionGroup::find($id);

            $groups = QuestionGroup::get();
            return view('quiz::index', compact('groups', 'group'));
        }catch (\Exception $e) {
            // dd($e);
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
            'title' => "required|unique:question_groups,title," . $request->id
        ]);
        try{
            // $group = QuestionGroup::find($request->id);

            $group = QuestionGroup::find($request->id);

            $group->title = $request->title;
            $result = $group->save();
            if ($result) {
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect('quiz/question-group');
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        }catch (\Exception $e) {
           Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
           return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $tables = TableList::getTableList('question_group_id', $id);

        try{
            if ($tables==null) {
                // $group = QuestionGroup::destroy($id);

                        $group = QuestionGroup::destroy($id);

                if ($group) {
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect('quiz/question-group');
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
