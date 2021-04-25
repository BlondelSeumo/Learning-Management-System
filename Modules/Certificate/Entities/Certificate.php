<?php

namespace Modules\Certificate\Entities;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
