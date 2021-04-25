<?php

namespace Modules\SystemSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Currency extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne('App\User','currency_id','id');
    }
}
