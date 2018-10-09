<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arbitrations extends Model
{
    protected $fillable = [
        'resolution',
        'transaction_id',
        'arbitrator_id',
        'status',
        'resolution_at'
    ];
}
