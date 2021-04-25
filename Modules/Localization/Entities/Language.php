<?php

namespace Modules\Localization\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Language extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $guarded = [];

    protected $hidden = ['id', 'created_at', 'updated_at'];
}
