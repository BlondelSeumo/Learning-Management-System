<?php

namespace Modules\Blog\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Blog extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $guarded = ['id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
