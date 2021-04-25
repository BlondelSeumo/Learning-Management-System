<?php

namespace App;

use App\Notifications\PasswordResetNotification;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\CourseSetting\Entities\Course;
use Modules\CourseSetting\Entities\CourseEnrolled;
use Modules\CourseSetting\Entities\CourseReveiw;
use Modules\Localization\Entities\Language;
use Modules\OfflinePayment\Entities\OfflinePayment;
use Modules\Payment\Entities\InstructorPayout;
use Modules\Payment\Entities\Subscriber;
use Modules\Payment\Entities\Withdraw;
use Modules\Quiz\Entities\StudentTakeOnlineQuiz;
use Modules\RolePermission\Entities\Role;
use Modules\SystemSetting\Entities\Currency;
use Modules\SystemSetting\Entities\Message;
use Rennokki\QueryCache\Traits\QueryCacheable;

//class User extends Authenticatable
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, QueryCacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [
        'name', 'role_id', 'username', 'email', 'phone', 'password', 'email_verified_at', 'mobile_verified_at', 'avatar', 'subscribe'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class)->withDefault();
    }

    public function offlinePayments()
    {
        return $this->hasMany(OfflinePayment::class, 'user_id');
    }


    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscriber::class, 'user_id', 'id')->whereDate('valid', '>=', Carbon::now());
    }


    public function enrolls()
    {
        return $this->hasManyThrough(CourseEnrolled::class, Course::class);
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'instructor_id');
    }


    public function earnings()
    {
        return $this->hasMany(InstructorPayout::class, 'instructor_id');
    }

    public function gettotalEarnAttribute()
    {

        return round($this->earnings()->sum('reveune'), 2);
    }

    public function reciever()
    {
        return $this->hasOne(Message::class, 'reciever_id')->latest();
    }


    public function sender()
    {
        return $this->hasOne(Message::class, 'sender_id')->latest();
    }

    public function getmessageFormatAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function enrollCourse()
    {
        return $this->belongsToMany(Course::class, 'course_enrolleds', 'user_id', 'course_id');
    }


    public function language()
    {
        return $this->belongsTo(Language::class);
    }


    public function recievers()
    {
        return $this->hasMany(Message::class, 'reciever_id')->latest();
    }

    public function senders()
    {
        return $this->hasMany(Message::class, 'sender_id')->latest();
    }

    public function userLanguage()
    {
        return $this->belongsTo(Language::class, 'language_id')->withDefault();
    }

    public function enrollStudents()
    {
        return $this->hasMany(CourseEnrolled::class)->EnrollStudent();
    }

    public function apiKey()
    {
        return $this->zoom_api_key_of_user;
    }

    public function apiSecret()
    {
        return $this->zoom_api_serect_of_user;
    }

    public function submittedExam()
    {
        return $this->hasOne(StudentTakeOnlineQuiz::class, 'student_id')->latest();
    }

    public function totalCourses()
    {
        $totalCourses = Course::where('user_id', '=', $this->id)->count();
        return $totalCourses;
    }

    public function totalEnrolled()
    {
        $totalEnrolled = Course::where('user_id', '=', $this->id)->sum('total_enrolled');
        return $totalEnrolled;
    }

    public function totalRating()
    {
        $totalRatings['total'] = 0;
        $totalRatings['rating'] = 0;
        $courses = Course::where('user_id', '=', $this->id)->get('id');
        foreach ($courses as $course) {
            $all = CourseReveiw::where('course_id', $course->id)->where('status', 1)->get();
            $totalRatings['total'] = $totalRatings['total'] + count($all);
            $ratings = 0;
            foreach ($all as $data) {
                $ratings = $data->star + $ratings;

            }
            $totalRatings['rating'] = $totalRatings['rating'] + $ratings;

        }

        if ($totalRatings['total'] != 0) {
            $avg = ($totalRatings['rating'] / $totalRatings['total']);
        } else {
            $avg = 0;
        }

        if ($avg != 0) {
            if ($avg - floor($avg) > 0) {
                $rate = number_format($avg, 1);
            } else {
                $rate = number_format($avg, 0);
            }
            $totalRatings['rating'] = $rate;
        }


        return $totalRatings;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }
}
