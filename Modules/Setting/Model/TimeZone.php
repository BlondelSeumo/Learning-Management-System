<?php

namespace Modules\Setting\Model;

use Illuminate\Database\Eloquent\Model;

class TimeZone extends Model
{
    protected $hidden = ['id', 'created_at', 'updated_at'];
    protected $guarded = [];
}
