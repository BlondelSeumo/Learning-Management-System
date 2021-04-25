<?php

namespace Modules\VirtualClass\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\BBB\Entities\BbbiMeeting;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\SubCategory;
use Modules\Jitsi\Entities\JitsiMeeting;
use Modules\Localization\Entities\Language;
use Modules\Zoom\Entities\ZoomMeeting;
use Rennokki\QueryCache\Traits\QueryCacheable;

class VirtualClass extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class)->withDefault();
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id')->withDefault();
    }

    public function zoomMeetings()
    {
        return $this->hasMany(ZoomMeeting::class, 'class_id')->orderBy('date_of_meeting', 'asc')->orderBy('time_of_meeting', 'asc');
    }

    public function bbbMeetings()
    {
        return $this->hasMany(BbbMeeting::class, 'class_id')->orderBy('date', 'asc')->orderBy('time', 'asc');
    }

    public function jitsiMeetings()
    {
        return $this->hasMany(JitsiMeeting::class, 'class_id')->orderBy('date', 'asc')->orderBy('time', 'asc');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'class_id')->withDefault();
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->title) == "" ? str_replace(' ','-',$this->title) : Str::slug($this->title);

    }
}
