<?php

namespace Modules\FrontendManage\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class FrontPage extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    protected $guarded = ['id'];
}
