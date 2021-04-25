<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Course;
use Rennokki\QueryCache\Traits\QueryCacheable;

class LessonComplete extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
