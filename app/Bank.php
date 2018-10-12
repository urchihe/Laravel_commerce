<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{

	protected $table = "banks";

    protected $fillable = [
       'bankname',
       'shortname',
       'bankcode',
       'sortcode'
    ];

    protected $dates = [
       'created_at', 
       'updated_at',
    ];
}
