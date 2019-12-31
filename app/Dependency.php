<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependency extends Model
{
    //
    protected $guarded=[];


    public function user()
    {

    	return $this->belongsTo('App\User');

    }
}
