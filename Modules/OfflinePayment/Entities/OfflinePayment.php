<?php

namespace Modules\OfflinePayment\Entities;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class OfflinePayment extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    protected $appends =['addedFormat'];


    public function user(){

        return $this->belongsTo(User::class,'user_id')->withDefault();
    }

    public function getaddedFormatAttribute()
    {
        return Carbon::parse($this->created_at)->isoformat('Do MMMM Y H:ss a');
    }
}
