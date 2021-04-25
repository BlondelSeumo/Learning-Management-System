<?php

namespace Modules\Zoom\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class ZoomSetting extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;


    protected $guarded = ['id'];
    protected $table = 'zoom_settings';
}
