<?php

namespace Modules\Payment\Entities;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Withdraw extends Model
{
    use QueryCacheable;
    protected static $flushCacheOnUpdate = true;

    protected $fillable = ['instructor_id', 'method', 'status', 'issueDate', 'amount'];


    protected $appends = ['invoiceDate', 'issueDateFormat'];

    public function user()
    {

        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function getinvoiceDateAttribute()
    {
        return Carbon::parse($this->created_at)->isoformat('Do MMMM Y');
    }

    public function getissueDateFormatAttribute()
    {
        return Carbon::parse($this->issueDate)->isoformat('Do MMMM Y');
    }
}
