<?php


/*
 *	JFuentealba @itux
 *	created at October 4, 2019 - 10:36 am
 *	updated at
 */

use Illuminate\Database\Seeder;
//Invocamos el Modelo de la Entidad
use App\StatusSolicitud;

class StatusSolicitudTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusSolicitud::create([

            'estado'     =>  'Creada',

        ]);
        
    	StatusSolicitud::create([

            'estado'     =>  'Pendiente',

        ]);

        StatusSolicitud::create([

            'estado'     =>  'Recepcionada',

        ]);

        StatusSolicitud::create([

            'estado'     =>  'Asignada a Comprador',

        ]);

         StatusSolicitud::create([

            'estado'     =>  'Re-Asignada a Comprador',

        ]);

        StatusSolicitud::create([

            'estado'     =>  'En Proceso de Compra',

        ]);

        StatusSolicitud::create([

            'estado'     =>  'En Proceso de Entrega',

        ]);

        StatusSolicitud::create([

            'estado'     =>  'En Proceso de Licitación',

        ]);

        StatusSolicitud::create([

            'estado'     =>  'Productos Recepcionados',

        ]);

		StatusSolicitud::create([

            'estado'     =>  'Solicitud Gestionada Completamente',

        ]);

        StatusSolicitud::create([

            'estado'     =>  'Solicitud Entreagada Completamente',

        ]);

        StatusSolicitud::create([

            'estado'     =>  'Anulada',

        ]);

    }
}
