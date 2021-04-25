<?php

namespace Modules\CourseSetting\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Rennokki\QueryCache\Traits\QueryCacheable;

class CourseReveiw extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    public function user(){

        return $this->belongsTo(User::class,'user_id','id')->select('id','role_id','name');
    }

    public function course(){

        $this->belongsTo(Course::class,'course_id');
    }


}
