<?php

namespace Modules\VirtualClass\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ClassSetting extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    protected $guarded = [];
}
