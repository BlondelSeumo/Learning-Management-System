<?php

namespace Modules\CourseSetting\Entities;

use App\LessonComplete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Quiz\Entities\OnlineQuiz;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Lesson extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    public function chapter()
    {

        return $this->belongsTo(Chapter::class);
    }

    public function course()
    {

        return $this->belongsTo(Course::class);
    }

    public function quiz()
    {

        return $this->hasMany(OnlineQuiz::class, 'id', 'quiz_id');
    }

    public function completed()
    {
        $id = 0;
        if (Auth::check()) {
            $id = Auth::user()->id;
        }
        return $this->hasOne(LessonComplete::class, 'lesson_id', 'id')->where('user_id', $id);
    }
}
