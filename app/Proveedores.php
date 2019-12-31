<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OrdenCompra;

class Proveedores extends Model
{
    
	protected $guarded=[];

	public function ordenCompra()
    {

    	return $this->belongsTo('App\OrdenCompra');

    }

}
