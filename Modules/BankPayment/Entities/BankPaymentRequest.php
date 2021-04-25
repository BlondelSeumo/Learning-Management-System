<?php

namespace Modules\BankPayment\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BankPaymentRequest extends Model
{
    protected $fillable = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }
}
