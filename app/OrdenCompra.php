<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Proveedor;

class OrdenCompra extends Model
{
    
	protected $guarded = [];

	public function proveedor()
    {

        return $this->hasMany('App\Proveedor');

    }
    
}
