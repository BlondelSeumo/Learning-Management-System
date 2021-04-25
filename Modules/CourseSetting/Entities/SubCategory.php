<?php

namespace Modules\CourseSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Rennokki\QueryCache\Traits\QueryCacheable;

class SubCategory extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    protected $fillable = [
        'category_id', 'name', 'status', 'show_home', 'position_order',
    ];


    public function category()
    {

        return $this->belongsTo(Category::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'subcategory_id');
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name) == "" ? str_replace(' ','-',$this->name) : Str::slug($this->name);

    }
}
