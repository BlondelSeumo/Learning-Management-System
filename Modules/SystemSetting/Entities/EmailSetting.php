<?php

namespace Modules\SystemSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class EmailSetting extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $guarded = ['id'];
    protected $fillable = [];
}
