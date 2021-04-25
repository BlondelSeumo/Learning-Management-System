<?php

namespace Modules\Coupons\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\RolePermission\Entities\Role;
use Rennokki\QueryCache\Traits\QueryCacheable;

class UserWiseCouponSetting extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $table = 'user_wise_coupon_settings';
    protected $fillable = [];


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
