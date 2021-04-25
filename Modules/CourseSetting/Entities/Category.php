<?php

namespace Modules\CourseSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Category extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = ['name', 'status', 'show_home', 'position_order', 'image', 'thumbnail'];

    protected $appends = ['courseCount'];


    public function subcategories()
    {

        return $this->hasMany(SubCategory::class, 'category_id', 'id')->select('id', 'category_id', 'name')->orderBy('position_order');
    }
    public function activeSubcategories()
    {

        return $this->hasMany(SubCategory::class, 'category_id', 'id')->select('id', 'category_id', 'name')->where('status',1)->orderBy('position_order');
    }

    public function courses()
    {

        return $this->hasMany(Course::class, 'category_id', 'id')->where('status', 1);
    }

    public function getcourseCountAttribute()
    {
        return $this->courses()->count();
    }
    public function totalCourses()
    {
        return $this->courses()->count();
    }
    public function getSlugAttribute()
    {
        return Str::slug($this->name) == "" ? str_replace(' ','-',$this->name) : Str::slug($this->name);
    }

}
