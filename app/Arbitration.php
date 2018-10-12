<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arbitration extends Model
{
	protected $table = "arbitrations";

	
    protected $fillable = [
        'resolution',
        'transaction_id',
        'arbitrator_id',
        'status',
        'resolution_at'
    ];
}
