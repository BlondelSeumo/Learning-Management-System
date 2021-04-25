<?php

namespace Modules\FooterSetting\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\FrontendManage\Entities\FrontPage;

class FooterWidget extends Model
{


    protected $guarded = ['id'];

    public function frontpage()
    {
        return $this->belongsTo(FrontPage::class, 'page_id')->withDefault();
    }
}
