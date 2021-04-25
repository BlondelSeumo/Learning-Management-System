<?php

namespace Modules\SystemSetting\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Message extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = [];

    protected $appends =['messageFormat'];

    public function sender()
    {
    	return $this->belongsTo(User::class,'sender_id')->withDefault();
    }

    public function reciever()
    {
    	return $this->belongsTo(User::class,'reciever_id')->withDefault();
    }

    public function getmessageFormatAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
