<?php

namespace Modules\Quiz\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\SubCategory;
use Rennokki\QueryCache\Traits\QueryCacheable;

class OnlineQuiz extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    public function category()
    {

        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault();
    }

    public function subCategory()
    {

        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id')->withDefault();
    }

    public function course()
    {

        return $this->belongsTo(Course::class, 'course_id', 'id')->withDefault();
    }

    public function assign()
    {

        return $this->hasMany(OnlineExamQuestionAssign::class, 'online_exam_id', 'id');
    }


    public function totalMarks()
    {
        $totalMark = 0;
        $assigns = $this->hasMany(OnlineExamQuestionAssign::class, 'online_exam_id')->get();

        foreach ($assigns as $assign) {
            $totalMark = $totalMark + $assign->questionBank->marks;
        }
        return $totalMark;
    }

    public function totalQuestions()
    {
        return $this->hasMany(OnlineExamQuestionAssign::class, 'online_exam_id')->count();

    }

}
