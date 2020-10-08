<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
	protected $fillable = [

		'user_id', 'category_id', 'name', 'slug', 'excerpt', 'body', 'status', 'file'

	];

	//Establecemos la relación 1:1 con User
	public function user(){

		return $this->belongsTo(User::class);

	}

	//Establecemos la relación 1:1 con Category
	public function category(){

		return $this->belongsTo(Category::class);

	}
    
	//Establecemos la relación 1:N con Tags
	public function tags(){

		return $this->belongsToMany(Tag::class);

	}

}
