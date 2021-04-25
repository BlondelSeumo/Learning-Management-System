<?php
namespace Modules\Coupons\Entities;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Payment\Entities\Checkout;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Coupon extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];
    protected $dates = [
        'end_date',
        'start_date',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function coupon_user(){
        return $this->belongsTo(User::class,'coupon_user_id');
    }
    public function totalUsed(){
        return $this->hasMany(Checkout::class,'coupon_id');
    }
}
