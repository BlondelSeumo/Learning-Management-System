<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\SubCategory;
use Modules\Quiz\Entities\OnlineQuiz;

// use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{


    public function topbarEnableDisable(Request $request)
    {

        Log::error($request->all());
        try {
            $id = $request->id;
            $table = $request->table;
            $status = $request->status;
            $result = DB::table($table)->where('id', $id)->update(['topbar' => $status]);
            if ($result) {
                return response()->json(['message' => 'success']);
            } else {
                return response()->json(['error' => 'Something went wrong!'], 400);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = $e->getMessage();
            Log::error($errorMessage);
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function footerEnableDisable(Request $request)
    {

        Log::error($request->all());
        try {
            $id = $request->id;
            $table = $request->table;
            $status = $request->status;
            $result = DB::table($table)->where('id', $id)->update(['footer' => $status]);
            if ($result) {
                return response()->json(['message' => 'success']);
            } else {
                return response()->json(['error' => 'Something went wrong!'], 400);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = $e->getMessage();
            Log::error($errorMessage);
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function statusEnableDisable(Request $request)
    {
        if (appMode()) {
            return response()->json(['warning' => trans('common.For the demo version, you cannot change this')], 200);
        }
        if (!Auth::check()) {
            return response()->json(['error' => 'Permission Denied'], 403);
        }
        if (Auth::user()->role_id == 3) {
            return response()->json(['error' => 'Permission Denied'], 403);
        }

        try {
            $id = $request->id;
            $table = $request->table;
            $status = $request->status;
            $result = DB::table($table)->where('id', $id)->update(['status' => $status]);
            if ($table == "courses") {
                $course = Course::find($id);
                if ($status == 1) {
                    send_email(Auth::user(), 'Course_Publish_Successfully', [
                        'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                        'course' => $course->title,
                    ]);
                } else {
                    send_email(Auth::user(), 'Course_Unpublished', [
                        'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                        'course' => $course->title,
                    ]);
                }

            }

            if ($result) {
                return response()->json(['success' => trans('common.Status has been changed')]);
            } else {
                return response()->json(['error' => trans('common.Something went wrong') . '!'], 400);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = $e->getMessage();
            Log::error($errorMessage);
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function publishEnableDisable(Request $request)
    {

        // Log::error($request->all());
        try {
            $id = $request->id;
            $table = $request->table;
            $status = $request->status;
            $result = DB::table($table)->where('id', $id)->update(['publish' => $status]);
            if ($result) {
                return response()->json(['message' => 'success']);
            } else {
                return response()->json(['error' => 'Something went wrong!'], 400);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = $e->getMessage();
            Log::error($errorMessage);
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function ajaxGetSubCategoryList(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->id)->get();
        return response()->json([$subcategories]);
    }


    public function ajaxGetCourseList(Request $request)
    {
        try {
            $category_id = $request->category_id;
            $subcategory_id = $request->subcategory_id;
            if (Auth::user()->role_id == 1) {
                $subcategories = Course::select('id', 'title')->where('category_id', $category_id)->where('subcategory_id', $subcategory_id)->get();
            } else {
                $subcategories = Course::select('id', 'title')->where('category_id', $category_id)->where('subcategory_id', $subcategory_id)->where('user_id', Auth::user()->id)->get();
            }
            return response()->json([$subcategories]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function ajaxGetQuizList(Request $request)
    {
        try {
            $category_id = $request->category_id;
            $subcategory_id = $request->subcategory_id;
            $course_id = $request->course_id;


            $quiz_list = OnlineQuiz::query();
            if ($request->category_id != "") {
                $quiz_list->where('category_id', $request->category_id);
            }
            if ($request->subcategory_id != "") {
                $quiz_list->where('sub_category_id', $request->subcategory_id);
            }
            if ($request->course_id != "") {
                $quiz_list->where('course_id', $request->course_id);
            }


            $quiz_list = $quiz_list->with('category', 'subCategory', 'course')->get();

            return response()->json([$quiz_list]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


}
