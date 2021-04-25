<?php

namespace Modules\FrontendManage\Entities;

use Illuminate\Database\Eloquent\Model;

class HeaderMenu extends Model
{
    protected $guarded = ['id'];


    public function childs(){
        return $this->hasMany(HeaderMenu::class,'parent_id','id')->orderBy('position');
    }
}
