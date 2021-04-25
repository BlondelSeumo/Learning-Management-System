<?php

namespace Modules\CourseSetting\Entities;

use App\LessonComplete;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Quiz\Entities\OnlineQuiz;
use Modules\Subscription\Entities\SubscriptionCourseList;
use Modules\VirtualClass\Entities\VirtualClass;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Course extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    protected $appends = ['dateFormat', 'publishedDate', 'sumRev', 'purchasePrice', 'enrollCount'];

    protected $casts = [
        'meta_keywords' => 'object'
    ];

    public function enrollUsers()
    {
        return $this->belongsToMany(User::class, 'course_enrolleds', 'course_id', 'user_id');
    }

    public function quiz()
    {

        return $this->belongsTo(OnlineQuiz::class, 'quiz_id', 'id')
            ->select(
                'id',
                'title',
                'percentage',
                'instruction',
                'active_status',
                'course_id',
                'sub_category_id',
                'category_id',
                'status',
                'created_by',
            )
            ->withDefault();
    }

    public function class()
    {

        return $this->belongsTo(VirtualClass::class, 'class_id', 'id')->withDefault();
    }

    public function category()
    {

        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault();
    }

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function subCategory()
    {

        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id')->withDefault();
    }

    public function chapters()
    {

        return $this->hasMany(Chapter::class)->orderBy('position', 'asc');
    }

    public function lessons()
    {

        return $this->hasMany(Lesson::class, 'course_id')
            ->select(
                'id',
                'course_id',
                'chapter_id',
                'quiz_id',
                'name',
                'description',
                'video_url',
                'host',
                'duration',
                'is_lock',
                'is_quiz',
            )->orderBy('position', 'asc');
    }

    public function enrolls()
    {

        return $this->hasMany(CourseEnrolled::class, 'course_id', 'id');
    }

    public function comments()
    {

        return $this->hasMany(CourseComment::class, 'course_id')
            ->select(
                'id',
                'user_id',
                'course_id',
                'instructor_id',
                'status',
                'comment',
                'created_at',
            );
    }

    public function reviews()
    {

        return $this->hasMany(CourseReveiw::class, 'course_id')
            ->select(
                'user_id',
                'course_id',
                'status',
                'comment',
                'star',
            );
    }

    public function files()
    {

        return $this->hasMany(CourseExercise::class, 'course_id');
    }

    public function getdateFormatAttribute()
    {
        return Carbon::parse($this->created_at)->format(getSetting()->date_format->format ?? 'jS M, Y');
    }

    public function getpublishedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format(getSetting()->date_format->format ?? 'jS M, Y');
    }

    public function getsumRevAttribute()
    {
        return round($this->enrolls->sum('reveune'), 2);
    }

    public function getenrollCountAttribute()
    {
        return $this->enrolls->count();
    }

    public function getpurchasePriceAttribute()
    {
        return round($this->enrolls->sum('purchase_price'), 2);
    }

    public function virtualClass()
    {
        return $this->belongsTo(VirtualClass::class, 'class_id');
    }

    public function completeLessons()
    {
        if (Auth::check()) {
            return $this->hasMany(LessonComplete::class)->where('user_id', Auth::user()->id);

        } else {
            return $this->hasMany(LessonComplete::class);

        }
    }

    public function getPriceAttribute()
    {
        $course = DB::table('courses')->select('price', 'subscription')->where('id', $this->id)->first();
        $price = $course->price;

        if (moduleStatusCheck('Subscription')) {
            if (Auth::check()) {
                if (Auth::user()->role_id == 3) {
                    if (isSubscribe()) {
                        $setting = DB::table('subscription_settings')->first();
                        if ($setting->type == 2) {
                            if ($course->subscription == 0) {
                                return $price;
                            } else {
                                $plans = userCurrentPlan();
                                if (count($plans) != 0) {
                                    $check = SubscriptionCourseList::whereIn('plan_id', $plans)->where('course_id', $this->id)->first();
                                    if ($check) {
                                        return 0;
                                    } else {
                                        return $price;
                                    }
                                } else {
                                    return $price;
                                }
                            }


                        }

                        return 0;
                    }
                }
            }
        }

        return $price;
    }

    public function getDiscountPriceAttribute()
    {
        $price = DB::table('courses')->select('discount_price')->where('id', $this->id)->first()->discount_price;
        if (moduleStatusCheck('Subscription')) {
            if (Auth::check()) {
                if (Auth::user()->role_id == 3) {
                    if (isSubscribe()) {
                        return 0;
                    }
                }
            }
        }
        return $price;
    }
}
