<?php

use Illuminate\Database\Seeder;
use App\StatusFactura;

class StatusFacturaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	StatusFactura::create([

            'estado'     =>  'Recepcionada',

        ]);
        
    	StatusFactura::create([

            'estado'     =>  'Enviada VB',

        ]);

        StatusFactura::create([

            'estado'     =>  'Recepcionada con VB',

        ]);

        StatusFactura::create([

            'estado'     =>  'Enviada a Pago',

        ]);

         StatusFactura::create([

            'estado'     =>  'Anulada',

        ]);

    }
}
