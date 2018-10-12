<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries";
 

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
