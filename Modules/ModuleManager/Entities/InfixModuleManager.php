<?php

namespace Modules\ModuleManager\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class InfixModuleManager extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $table = 'infix_module_managers';
    protected $fillable = ['name','email','notes','version','purchase_code','installed_domain','activated_date'];
}
