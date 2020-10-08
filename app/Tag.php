<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
	//MODELO PARA LAS ETIQUETAS DE LOS POSTS
    
	protected $fillable = [

		'name', 'slug'

	];
    
	//Establecemos la relación de Pertenencia con Posts
	public function posts(){

		return $this->belongsToMany(Post::class);

	}

}
