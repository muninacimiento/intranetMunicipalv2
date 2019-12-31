<?php

/*
 *  JFuentealba @itux
 *  created at October 09, 2019 - 11:15 am
 *  updated at 
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Solicitud extends Model
{
    
    protected $guarded = [];

    public function user()
    {

    	return $this->belongsTo('App\User');

    }

}
