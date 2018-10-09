<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commissions extends Model
{
    protected $fillable = [
       'transaction_id',
       'transfer_batch_id',
       'payment_status',
       'payment_at',
       'merchant_pay_at'
    ];
}
