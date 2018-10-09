<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    protected $fillable = [
       'bankname',
       'shortname',
       'bankcode',
       'sortcode'
    ];
}
