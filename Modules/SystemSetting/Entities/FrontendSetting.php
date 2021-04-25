<?php

namespace Modules\SystemSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Rennokki\QueryCache\Traits\QueryCacheable;

class FrontendSetting extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = ['section', 'title', 'description', 'heading', 'default_title', 'default_description', 'btn_name', 'default_btn', 'url', 'icon'];
}
