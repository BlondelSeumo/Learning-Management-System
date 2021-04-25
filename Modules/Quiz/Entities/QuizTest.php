<?php

namespace Modules\Quiz\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class QuizTest extends Model
{
    use QueryCacheable;

    protected static $flushCacheOnUpdate = true;

    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(QuizTestDetails::class, 'quiz_test_id');
    }

}
