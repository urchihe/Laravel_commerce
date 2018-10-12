<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
  
  protected $table = "currencies";


  protected $fillable = [
       'name',
       'abbreviation',
        
    ];
     protected $dates = [
       'created_at', 
       'updated_at',
       'deleted_at'
    ];
}
