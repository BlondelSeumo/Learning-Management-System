<?php

namespace Modules\CourseSetting\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\Localization\Entities\Language;
use Vimeo\Laravel\Facades\Vimeo;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Modules\Quiz\Entities\OnlineQuiz;
use Modules\Setting\Model\GeneralSetting;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\Lesson;
use Modules\CourseSetting\Entities\Chapter;
use Illuminate\Contracts\Support\Renderable;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\CourseExercise;
use Modules\SystemSetting\Entities\GeneralSettings;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id)
    {
        try {
            $categories=Category::get();
            $chapter=Chapter::leftjoin('courses','courses.id','=','chapters.course_id')
            ->leftjoin('sub_categories','courses.subcategory_id','=','sub_categories.id')
            ->where('chapters.id',$id)
            ->select('chapters.*','courses.title','courses.category_id','subcategory_id','sub_categories.name as subcategory_name')->first();

            $lessons=Lesson::where('chapter_id',$id)->get();
        return view('coursesetting::lesson',compact('categories','lessons','chapter'));
        } catch (Exception $e) {
          Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
             return redirect()->back();
        }
    }
 public function addLesson(Request $request)
    {

       $request->validate([
            'name'=>'required',
            'chapter_id'=>'required',
            'duration'=>'required',
            'course_id'=>'required',
            'video_url'=>'required',
        ]);

        try{
            $course = Course::where('id',$request->course_id)->where('user_id',Auth::id())->first();
            $chapter = Chapter::find($request->chapter_id);

            if(isset($course) && isset($chapter)){
                $success = trans('lang.Lesson').' '.trans('lang.Added').' '.trans('lang.Successfully');

                $lesson = new Lesson();
                $lesson->course_id = $request->course_id;
                $lesson->chapter_id = $request->chapter_id;
                $lesson->name = $request->name;
                $lesson->description = $request->description;
                $lesson->video_url = $request->video_url;
                $lesson->host = $request->host;
                $lesson->duration = $request->duration;
                $lesson->is_lock = $request->is_lock;
                $lesson->save();


                send_email(Auth::user(), 'Course_Lesson_Added ', [
                    'time' =>  Carbon::now()->format('d-M-Y ,s:i A'),
                    'course' => $course->title,
                    'chapter' => $chapter->name,
                    'lesson' => $lesson->name,
                ]);


               Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            }

            Toastr::error('Invalid Access !', 'Failed');
             return redirect()->back();

        } catch (Exception $e) {
             Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
             return redirect()->back();
        }
    }
      public function editLesson($id)
    {

        try{
             $vimeo_video_list= Vimeo::request('/me/videos', ['per_page' => 10], 'GET');

                $video_list= $vimeo_video_list['body']['data'];
                $editLesson = Lesson::find($id);
                $course=Course::find($editLesson->course_id);
                $chapters=Chapter::where('course_id',$editLesson->course_id)->with('lessons')->get();
                $getsmSetting=GeneralSetting::leftjoin('currencies','currencies.id','=','general_settings.currency_id')->first();
                $categories=Category::get();
                $instructors=User::where('role_id',2)->get();
                $languages=Language::get();
                $quizzes=OnlineQuiz::where('category_id',$course->category_id)->get();
                $course_exercises=CourseExercise::where('course_id',$editLesson->course_id)->get();
            // return $course_exercises;
            return view('coursesetting::course_details',compact('course','chapters','categories','getsmSetting','instructors','languages','course_exercises','editLesson','quizzes','video_list'));
        } catch (Exception $e) {
          Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
             return redirect()->back();
        }
    }

    public function updateLesson(Request $request)
    {
        try{
            // $success = trans('lang.Lesson').' '.trans('lang.Updated').' '.trans('lang.Successfully');

            $lesson = Lesson::find($request->id);
            $course = Course::where('id',$lesson->course_id)->where('user_id',Auth::id())->first();
            if(isset($course)){
                $lesson->course_id = $request->course_id;
                $lesson->chapter_id = $request->chapter_id;
                $lesson->name = $request->name;
                $lesson->description = $request->description;
                $lesson->video_url = $request->video_url;
                if ($request->get('host')=="Vimeo"){
                    $lesson->video_url = $request->vimeo;
                }
                $lesson->duration = $request->duration;
                $lesson->is_lock = $request->is_lock;
                $lesson->save();
               Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->route('lessonPage',[$request->chapter_id]);
            }
            else{
                Toastr::error('Invalid Access !', 'Failed');
            }
            return redirect()->back();
        } catch (Exception $e) {
             Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
             return redirect()->back();
        }
    }

    public function deleteLesson(Request $request)
    {
        try{
            // $success = trans('lang.Lesson').' '.trans('lang.Deleted').' '.trans('lang.Successfully');

            $lesson = Lesson::find($request->id);
            $course = Course::where('id',$lesson->course_id)->where('user_id',Auth::id())->first();
            if(isset($course)){

                $lesson->delete();
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->back();
            }
            else{

                Toastr::error('Invalid Access !', 'Failed');
             return redirect()->back();
            }
       } catch (Exception $e) {
             Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
             return redirect()->back();
        }

    }
}
