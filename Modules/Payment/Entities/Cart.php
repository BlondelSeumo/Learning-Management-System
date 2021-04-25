<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Course;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Cart extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = ['course_id','user_id','price','instructor_id','tracking'];
    protected $guarded  = ['id'];

    public function course(){

        return $this->belongsTo(Course::class,'course_id','id');
    }
}
