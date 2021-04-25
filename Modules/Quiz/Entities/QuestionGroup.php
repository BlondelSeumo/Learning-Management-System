<?php

namespace Modules\Quiz\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class QuestionGroup extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];
}
