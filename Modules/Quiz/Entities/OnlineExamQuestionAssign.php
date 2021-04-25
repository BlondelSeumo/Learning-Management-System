<?php

namespace Modules\Quiz\Entities;

use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class OnlineExamQuestionAssign extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];
     public function questionBank(){
    	return $this->belongsTo('Modules\Quiz\Entities\QuestionBank', 'question_bank_id', 'id');
    }
}
