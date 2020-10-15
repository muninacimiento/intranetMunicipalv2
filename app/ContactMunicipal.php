<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactMunicipal extends Model
{
    protected $fillable = [

		'user_id', 'dependency_id', 'unidad', 'telefono'

	];

	//Establecemos la relación 1:1 con User
	public function dependency(){

		return $this->belongsTo(Dependency::class);

	}
}
