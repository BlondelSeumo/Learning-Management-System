<?php

namespace Modules\Coupons\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\SubCategory;
use Modules\CourseSetting\Entities\Category;
use Rennokki\QueryCache\Traits\QueryCacheable;

class UserWiseCoupon extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $table ='user_wise_coupons';
    protected $fillable = [];
    public function invite_byF(){
        return $this->belongsTo(User::class,'invite_by');
    }
    public function invite_accept_byF(){
        return $this->belongsTo(User::class,'invite_accept_by');
    }


    public function category(){

        return $this->belongsTo(Category::class,'category_id','id')->withDefault();
    }

    public function subCategory(){

        return $this->belongsTo(SubCategory::class,'subcategory_id','id')->withDefault();
    }

    public function course(){

        return $this->belongsTo(Course::class,'course_id','id')->withDefault();
    }

}
