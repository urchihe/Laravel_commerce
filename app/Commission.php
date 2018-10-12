<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
	protected $table = "commissions";

    protected $fillable = [
       'transaction_id',
       'transfer_batch_id',
       'payment_status',
       'payment_at',
       'merchant_pay_at'
    ];

    protected $dates = [
       'created_at', 
       'updated_at',
       'deleted_at'
    ];
}
