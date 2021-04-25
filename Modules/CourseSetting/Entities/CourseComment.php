<?php

namespace Modules\CourseSetting\Entities;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class CourseComment extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    protected $appends =['submittedDate','commentDate'];

    public function getsubmittedDateAttribute()
    {
        return Carbon::parse($this->created_at)->isoformat('Do MMMM Y H:ss a');
    }

    public function getcommentDateAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function course(){

        return $this->belongsTo(Course::class,'course_id' )->withDefault();
    }

    public function replies(){

        return $this->hasMany(CourseCommentReply::class,'comment_id' );
    }

    public function user(){

        return $this->belongsTo(User::class,'user_id' )->withDefault();
    }

}
