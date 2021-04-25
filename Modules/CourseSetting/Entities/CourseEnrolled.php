<?php

namespace Modules\CourseSetting\Entities;

use App\BillingDetails;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Payment\Entities\Checkout;
use Rennokki\QueryCache\Traits\QueryCacheable;

class CourseEnrolled extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    protected $appends = ['enrolledDate'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function getenrolledDateAttribute()
    {
        return Carbon::parse($this->created_at)->isoformat('Do MMMM Y H:ss a');
    }

    public function scopeEnrollStudent($query)
    {
        return $query->whereHas('course',function ($query){
            $query->where('user_id',Auth::id());
        });
    }
    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'tracking', 'tracking')->withDefault();

    }

    public function bill()
    {
        return $this->belongsTo(BillingDetails::class, 'tracking', 'tracking_id')->withDefault();

    }
}
