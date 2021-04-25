<?php

namespace Modules\CourseSetting\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Image;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\Chapter;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseExercise;
use Modules\CourseSetting\Entities\Lesson;
use Modules\Localization\Entities\Language;
use Modules\Quiz\Entities\OnlineQuiz;
use Modules\SCORM\Http\Controllers\SCORMController;
use Modules\Setting\Model\GeneralSetting;
use Throwable;
use Vimeo\Laravel\Facades\Vimeo;


class InstructorCourseSettingController extends Controller
{

    public function saveChapter(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        // return $request;
        $this->validate($request, [
            'input_type' => 'required',
        ]);

        if ($request->input_type == 1) {
            $request->validate([
                'chapter_name' => 'required',
            ]);
        } else if ($request->input_type == 2) {
            $request->validate([
                'quiz' => 'required',
                'chapterId' => 'required',
                'lock' => 'required',

            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'chapter_id' => 'required',
                'course_id' => 'required',
//                    'video_url'=>'required',
            ]);

            if ($request->get('host') == "Vimeo") {
                $request->validate([
                    'vimeo' => 'required',
                ]);
            } elseif ($request->get('host') == "Iframe") {
                $request->validate([
                    'iframe_url' => 'required',
                ]);
            } elseif ($request->get('host') == "Youtube" || $request->get('host') == "URL") {
                $request->validate([
                    'video_url' => 'required',
                ]);
            } elseif ($request->get('host') == "SCORM" || $request->get('host') == "SCORM-AwsS3") {
                $request->validate([
                    'file' => 'required|mimes:zip',
                ]);
            } elseif ($request->get('host') == "Image") {
                $request->validate([
                    'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
            } elseif ($request->get('host') == "PDF") {
                $request->validate([
                    'file' => 'required|mimes:pdf',
                ]);
            } elseif ($request->get('host') == "Word") {
                $request->validate([
                    'file' => 'required|mimes:doc,docx',
                ]);
            } elseif ($request->get('host') == "Excel") {
                $request->validate([
                    'file' => 'required|mimes:xlsx,xls',
                ]);
            } elseif ($request->get('host') == "PowerPoint") {
                $request->validate([
                    'file' => 'required|mimes:ppt,pptx',
                ]);
            } elseif ($request->get('host') == "Text") {
                $request->validate([
                    'file' => 'required|mimetypes:text/plain',
                ]);
            } elseif ($request->get('host') == "Zip") {
                $request->validate([
                    'file' => 'required|mimes:zip',
                ]);
            } else {
                $request->validate([
                    'file' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
                ]);
            }
        }

        if ($request->input_type == 1) {
            try {
                $course = Course::where('id', $request->course_id)->where('user_id', Auth::id())->first();

                if (isset($course)) {

                    $chpter_no = Chapter::where('course_id', $course->course_id)->count();
                    $chapter = new Chapter();
                    $chapter->name = $request->chapter_name;
                    $chapter->course_id = $request->course_id;
                    $chapter->chapter_no = $chpter_no + 1;
                    $chapter->save();

                    send_email(Auth::user(), 'Course_Chapter_Added ', [
                        'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                        'course' => $course->title,
                        'chapter' => $chapter->name,
                    ]);

                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->back();
                } else {
                    Toastr::error('Invalid Access !', 'Failed');
                    return redirect()->back();
                }
            } catch (Exception $e) {
                // dd($e);
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        } else if ($request->input_type == 2) {
            try {
                $course = Course::where('id', $request->course_id)->where('user_id', Auth::id())->first();
                $chapter = Chapter::find($request->chapterId);

                if (isset($course) && isset($chapter)) {

                    $lesson = new Lesson();
                    $lesson->course_id = $request->course_id;
                    $lesson->chapter_id = $request->chapterId;
                    $lesson->quiz_id = $request->quiz;
                    $lesson->is_quiz = $request->is_quiz;
                    $lesson->is_lock = $request->lock;
                    $lesson->save();
                    $quiz = OnlineQuiz::find($request->quiz);
                    send_email(Auth::user(), 'Course_Quiz_Added ', [
                        'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                        'course' => $course->title,
                        'chapter' => $chapter->name,
                        'quiz' => $quiz->title,
                    ]);
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->back();
                }

                Toastr::error('Invalid Access !', 'Failed');
                return redirect()->back();

            } catch (Exception $e) {
                // dd($e);
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        } else {
            try {

                $course = Course::where('id', $request->course_id)->where('user_id', Auth::id())->first();
                $chapter = Chapter::find($request->chapter_id);

                if (isset($course) && isset($chapter)) {
                    $success = trans('lang.Lesson') . ' ' . trans('lang.Added') . ' ' . trans('lang.Successfully');

                    $lesson = new Lesson();
                    $lesson->course_id = $request->course_id;
                    $lesson->chapter_id = $request->chapter_id;
                    $lesson->name = $request->name;
                    $lesson->description = $request->description;

                    if ($request->get('host') == "Vimeo") {
                        $lesson->video_url = $request->vimeo;
                    } elseif ($request->get('host') == "Youtube" || $request->get('host') == "URL") {
                        $lesson->video_url = $request->video_url;
                    } elseif ($request->get('host') == "Iframe") {
                        $lesson->video_url = $request->iframe_url;
                    } elseif ($request->get('host') == "Self") {
                        if ($request->file('file') != "") {
                            $file = $request->file('file');
                            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                            $file->move('public/uploads/courses/videos/', $fileName);
                            $fileName = 'public/uploads/courses/videos/' . $fileName;
                            $lesson->video_url = $fileName;
                        }

                    } elseif ($request->get('host') == "AmazonS3") {
                        $filePath = '/';

                        if ($request->file('file') != "") {
                            $path = $request->file('file')->store($filePath, 's3');

                            $link = Storage::disk('s3')->url($path);
                            $lesson->video_url = $link;
                        }


                    } elseif ($request->get('host') == "SCORM" || $request->get('host') == "SCORM-AwsS3") {

                        $scorm = new SCORMController();
                        $url = $scorm->getScormUrl($request, $request->get('host'));
                        $lesson->video_url = $url;

                    } elseif (
                        $request->get('host') == "Zip"
                        || $request->get('host') == "PowerPoint"
                        || $request->get('host') == "Excel"
                        || $request->get('host') == "Text"
                        || $request->get('host') == "Word"
                        || $request->get('host') == "PDF"
                        || $request->get('host') == "Image"
                    ) {
                        $file = $request->file;
                        $src_url = public_path() . "/uploads/exerciseFile";
                        $fileName = md5(time() . rand(1, 9999999)) . '.' . $request->file->extension();
                        $file->move($src_url, $fileName);

                        $url = 'public/uploads/exerciseFile/' . $fileName;
                        $lesson->video_url = $url;

                    } else {
                        $lesson->video_url = null;
                    }
                    $lesson->host = $request->host;
                    $lesson->duration = $request->duration;
                    $lesson->is_lock = $request->is_lock;
                    $lesson->save();

                    send_email(Auth::user(), 'Course_Lesson_Added ', [
                        'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                        'course' => $course->title,
                        'chapter' => $chapter->name,
                        'lesson' => $lesson->name,
                    ]);

                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->back();
                }

                Toastr::error('Invalid Access !', 'Failed');
                return redirect()->back();

            } catch
            (Exception $e) {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        }

    }

    public function deleteChapter($chapter, $course_id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $course = Course::where('id', $course_id)->where('user_id', Auth::id())->first();
            // return $course;
            if (isset($course)) {
                $lessons = Lesson::where('chapter_id', $chapter)->where('course_id', $course_id)->get();
                foreach ($lessons as $key => $lesson) {
                    $lesson = Lesson::find($lesson->id)->delete();
                }
                $chapter = Chapter::find($chapter);
                $chapter->delete();

                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->route('courseDetails', [$course_id]);
            } else {
                Toastr::error('Invalid Access !', 'Failed');
                return redirect()->route('courseDetails', [$course_id]);
            }
        } catch (Exception $e) {
            // dd($e);
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function updateChapter(Request $request)
    {
        $this->validate($request, [
            'input_type' => 'required',
        ]);

        if ($request->input_type == 1) {
            $request->validate([
                'chapter_name' => 'required',
            ]);
        } else if ($request->input_type == 2) {
            $request->validate([
                'quiz' => 'required',
                'chapterId' => 'required',
                'lock' => 'required',

            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'chapter_id' => 'required',
//                'duration' => 'required',
                'course_id' => 'required',
//                'video_url' => 'required',
            ]);

            if ($request->get('host') == "Vimeo") {
                $request->validate([
                    'vimeo' => 'required',
                ]);
            } elseif ($request->get('host') == "Youtube" || $request->get('host') == "URL") {
                $request->validate([
                    'video_url' => 'required',
                ]);
            } elseif ($request->get('host') == "SCORM") {

                $request->validate([
                    'file' => 'required|mimes:zip',
                ]);
            }
            elseif ($request->get('host') == "Iframe") {
                $request->validate([
                    'iframe_url' => 'required',
                ]);
            } elseif ($request->get('host') == "Image") {
                $request->validate([
                    'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);
            } elseif ($request->get('host') == "PDF") {
                $request->validate([
                    'file' => 'required|mimes:pdf',
                ]);
            } elseif ($request->get('host') == "Word") {
                $request->validate([
                    'file' => 'required|mimes:doc,docx',
                ]);
            } elseif ($request->get('host') == "Excel") {
                $request->validate([
                    'file' => 'required|mimes:xlsx,xls',
                ]);
            } elseif ($request->get('host') == "PowerPoint") {
                $request->validate([
                    'file' => 'required|mimes:ppt,pptx',
                ]);
            } elseif ($request->get('host') == "Text") {
                $request->validate([
                    'file' => 'required|mimes:txt',
                ]);
            } elseif ($request->get('host') == "Zip") {
                $request->validate([
                    'file' => 'required|mimes:zip',
                ]);
            } else {
                $request->validate([
                    'file' => 'mimes:mp4,ogx,oga,ogv,ogg,webm',
                ]);
            }
        }

        if ($request->input_type == 1) {
            try {
                $course = Course::where('id', $request->course_id)->where('user_id', Auth::id())->first();

                // return $course;
                if (isset($course)) {
                    $chapter = Chapter::find($request->chapter);
                    $chapter->name = $request->chapter_name;
                    $chapter->save();

                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->route('courseDetails', [$request->course_id]);
                } else {
                    Toastr::error('Invalid Access !', 'Failed');
                    return redirect()->route('courseDetails', [$request->course_id]);
                }
            } catch (Exception $e) {

                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        } else if ($request->input_type == 2) {
            try {
                $course = Course::where('id', $request->course_id)->where('user_id', Auth::id())->first();
                $chapter = Chapter::find($request->chapterId);

                if (isset($course) && isset($chapter)) {

                    $lesson = Lesson::find($request->lesson_id);
                    $lesson->course_id = $request->course_id;
                    $lesson->chapter_id = $request->chapterId;
                    $lesson->quiz_id = $request->quiz;
                    $lesson->is_quiz = $request->is_quiz;
                    $lesson->is_lock = $request->lock;
                    $lesson->save();
                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->route('courseDetails', [$request->course_id]);
                }

                Toastr::error('Invalid Access !', 'Failed');
                return redirect()->route('courseDetails', [$request->course_id]);

            } catch (Exception $e) {
                // dd($e);
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        } else {
            try {
                $course = Course::where('id', $request->course_id)->where('user_id', Auth::id())->first();
                $chapter = Chapter::find($request->chapter_id);

                if (isset($course) && isset($chapter)) {
                    // $success = trans('lang.Lesson').' '.trans('lang.Added').' '.trans('lang.Successfully');

                    $lesson = Lesson::find($request->lesson_id);
                    $lesson->course_id = $request->course_id;
                    $lesson->chapter_id = $request->chapter_id;
                    $lesson->name = $request->name;
                    $lesson->description = $request->description;

                    $lesson->host = $request->host;

                    if ($request->get('host') == "Vimeo") {
                        $lesson->video_url = $request->vimeo;
                    } elseif ($request->get('host') == "Youtube" || $request->get('host') == "URL") {
                        $lesson->video_url = $request->video_url;
                    }elseif ($request->get('host') == "Iframe") {
                        $lesson->video_url = $request->iframe_url;
                    } elseif ($request->get('host') == "Self") {
//                        dd('self ok');
                        if ($request->file('file') != "") {
                            $file = $request->file('file');
                            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                            $file->move('public/uploads/courses/videos/', $fileName);
                            $fileName = 'public/uploads/courses/videos/' . $fileName;
                            $lesson->video_url = $fileName;
                        }

                    } elseif ($request->get('host') == "AmazonS3") {
                        $filePath = '/';

                        if ($request->file('file') != "") {
                            $path = $request->file('file')->store($filePath, 's3');

                            $link = Storage::disk('s3')->url($path);

                            $lesson->video_url = $link;
                        }


                    } elseif ($request->get('host') == "SCORM") {

                        $scorm = new SCORMController();
                        $url = $scorm->getScormUrl($request);
                        $lesson->video_url = $url;
                    } else {
                        $lesson->video_url = null;
                    }
                    $lesson->duration = $request->duration;
                    $lesson->is_lock = $request->is_lock;
                    $lesson->save();


                    send_email(Auth::user(), 'Course_Lesson_Added ', [
                        'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                        'course' => $course->title,
                        'chapter' => $chapter->name,
                        'lesson' => $lesson->name,
                    ]);


                    Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                    return redirect()->route('courseDetails', [$request->course_id]);
                }

                Toastr::error('Invalid Access !', 'Failed');
                return redirect()->route('courseDetails', [$request->course_id]);

            } catch (Exception $e) {
                // dd($e);
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }
        }

    }

    public function editChapter($id, $course_id)
    {

        try {
            $vimeo_video_list = Vimeo::request('/me/videos', ['per_page' => 10], 'GET');
            if (isset($vimeo_video_list['body']['data'])) {
                $video_list = $vimeo_video_list['body']['data'];
            } else {
                $video_list = [];
            }

            $editChapter = Chapter::where('id', $id)->first();
            $course = Course::find($course_id);
            $chapters = Chapter::where('course_id', $course_id)->with('lessons')->get();
            $getsmSetting = GeneralSetting::leftjoin('currencies', 'currencies.id', '=', 'general_settings.currency_id')->first();
            $categories = Category::get();
            $instructors = User::where('role_id', 2)->get();
            $languages = Language::get();
            $quizzes = OnlineQuiz::where('category_id', $course->category_id)->get();
            $course_exercises = CourseExercise::where('course_id', $course_id)->get();

            // return $course;
            return view('coursesetting::course_details', compact('course', 'chapters', 'categories', 'getsmSetting', 'instructors', 'languages', 'course_exercises', 'editChapter', 'quizzes', 'video_list'));

        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }

    }

    public function saveFile(Request $request)
    {
        Session::flash('type', 'files');
        $request->validate([
            'status' => 'required',
            'exercise_file' => 'required'
        ]);

        try {

            $course_file = new CourseExercise();
            $course_file->course_id = $request->id;

            $fileName = "";
            if ($request->file('exercise_file') != "") {
                $file = $request->file('exercise_file');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/exerciseFile/', $fileName);
                $fileName = 'public/uploads/exerciseFile/' . $fileName;
                $course_file->file = $fileName;
            }
            $course_file->lock = $request->lock;
            $course_file->fileName = $request->fileName;
            $course_file->status = $request->status;
            $course_file->save();


            send_email(Auth::user(), 'Course_ExerciseFile_Added', [
                'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                'course' => Course::find($request->id)->first(['title'])->title,
                'filename' => $course_file->fileName,
            ]);


            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (Exception $e) {

            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function updateFile(Request $request)
    {
        Session::flash('type', 'files');
        $request->validate([
            'status' => 'required',
            // 'exercise_file'=>'required'
        ]);

        try {

            $course_file = CourseExercise::find($request->id);

            $fileName = "";
            if ($request->file('exercise_file_update') != "") {
                if (file_exists($course_file->file)) {
                    unlink($course_file->file);
                }

                $file = $request->file('exercise_file_update');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/exerciseFile/', $fileName);
                $fileName = 'public/uploads/exerciseFile/' . $fileName;
                $course_file->file = $fileName;
            }
            $course_file->lock = $request->lock;
            $course_file->fileName = $request->fileName;
            $course_file->status = $request->status;
            $course_file->save();
            $course = Course::find($course_file->course_id);
            if ($course) {
                send_email(Auth::user(), 'Course_ExerciseFile_Added', [
                    'time' => Carbon::now()->format('d-M-Y ,s:i A'),
                    'course' => $course->title,
                    'filename' => $course_file->fileName,
                ]);
            }


            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function deleteFile(Request $request)
    {
        Session::flash('type', 'files');
        try {
            $course_file = CourseExercise::find($request->id);
            if (file_exists($course_file->file)) {
                unlink($course_file->file);
            }
            $course_file->delete();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function download_course_file($id)
    {
        try {
            $course_file = CourseExercise::find($id);
            // return base_path();
            $file_path = base_path('/' . $course_file->file);
            return response()->download($file_path);
        } catch (Throwable $th) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }


    }
}
