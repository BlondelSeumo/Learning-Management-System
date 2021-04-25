<?php

namespace Modules\FrontendManage\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class HomeContent extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];
}
