<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Order extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;
}
