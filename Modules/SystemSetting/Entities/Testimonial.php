<?php

namespace Modules\SystemSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Testimonial extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    public function course(){

        return $this->belongsTo(Course::class,'course_id' );
    }

    public function replies(){

        return $this->hasMany(CourseCommentReply::class,'comment_id' );
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id' );
    }

}
