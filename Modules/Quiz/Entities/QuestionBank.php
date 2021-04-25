<?php

namespace Modules\Quiz\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\SubCategory;
use Rennokki\QueryCache\Traits\QueryCacheable;

class QuestionBank extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

     public function questionGroup(){
    	return $this->belongsTo('Modules\Quiz\Entities\QuestionGroup', 'q_group_id');
    }
    public function questionLevel(){
    	return $this->belongsTo('Modules\Quiz\Entities\QuestionLevel', 'question_level_id');
    }
     public function category(){

        return $this->belongsTo(Category::class,'category_id','id')->withDefault();
    }
      public function subCategory(){

        return $this->belongsTo(SubCategory::class,'sub_category_id','id')->withDefault();
    }

	public function questionMu(){
		return $this->hasMany('Modules\Quiz\Entities\QuestionBankMuOption', 'question_bank_id', 'id');
	}
}
