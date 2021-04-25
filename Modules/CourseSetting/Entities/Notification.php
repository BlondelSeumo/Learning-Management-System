<?php

namespace Modules\CourseSetting\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseComment;
use Modules\CourseSetting\Entities\CourseReview;
use Modules\CourseSetting\Entities\CourseEnrolled;
use Modules\SystemSetting\Entities\Message;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Notification extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $guarded = [];

    protected $appends =['notificationDate'];


    public function instructor()
    {
    	return $this->belongsTo(User::class)->withDefault();
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'author_id')->withDefault();
    }

    public function course()
    {
    	return $this->belongsTo(Course::class)->withDefault();
    }

    public function comment()
    {
    	return $this->belongsTo(CourseComment::class)->withDefault();
    }

    public function review()
    {
    	return $this->belongsTo(CourseReview::class)->withDefault();
    }

    public function enroll()
    {
    	return $this->belongsTo(CourseEnrolled::class)->withDefault();
    }

    public function message()
    {
        return $this->belongsTo(Message::class)->withDefault();
    }

    public function getnotificationDateAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

}
