<?php

namespace Modules\CourseSetting\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Rennokki\QueryCache\Traits\QueryCacheable;

class CourseCommentReply extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    protected $appends =['replyDate'];


    public function user(){

        return $this->belongsTo(User::class,'user_id' );
    }

    public function getreplyDateAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
