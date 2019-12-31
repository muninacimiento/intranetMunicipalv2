<?php

/*
 *  JFuentealba @itux
 *  created at September 16, 2019 - 9:41 am
 *  updated at 
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /* Definimos los campos a llenar en la tabla Permission */

    protected $fillable = [

    	'name', 'slug', 'description',

    ];

    public function user()
    {

    	return $this->belongsTo('App\User');

    }
}
