<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Course;
use Rennokki\QueryCache\Traits\QueryCacheable;

class RecentviewCourse extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    public function course(){
        return $this->belongsTo(Course::class,'course_id','id')->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    }
}
