<?php

namespace Modules\SystemSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\SystemSetting\Entities\FooterContent;
use Rennokki\QueryCache\Traits\QueryCacheable;

class FooterCategory extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = ['title','description','placeholder'];

    public function contents()
    {
        return $this->hasMany(FooterContent::class);
    }
}
