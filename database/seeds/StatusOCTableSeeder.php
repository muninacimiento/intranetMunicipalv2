<?php

use Illuminate\Database\Seeder;
use App\StatusOC;

class StatusOCTableSeeder extends Seeder
{
        /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusOC::create([

            'estado'     =>  'Emitida',

        ]);

        StatusOC::create([

            'estado'     =>  'Recepcionada y en Revisión por C&S',

        ]);

        StatusOC::create([

            'estado'     =>  'Revisión por C&S', //Cuando sea Rechazada

        ]);

        StatusOC::create([

            'estado'     =>  'Aprobada por C&S',

        ]);

        StatusOC::create([

            'estado'     =>  'Rechazada por C&S',

        ]);

        StatusOC::create([

            'estado'     =>  'En Revisión por Profesional DAF',

        ]);

        StatusOC::create([

            'estado'     =>  'Aprobada por Profesional DAF',

        ]);

         StatusOC::create([

            'estado'     =>  'Rechazada por Profesional DAF',

        ]);

        StatusOC::create([

            'estado'     =>  'En Firma DAF',

        ]);

        StatusOC::create([

            'estado'     =>  'Aprobada por DAF',

        ]);

        StatusOC::create([

            'estado'     =>  'Rechazada por DAF',

        ]);

        StatusOC::create([

            'estado'     =>  'En Firma Alcaldía',

        ]);

        StatusOC::create([

            'estado'     =>  'Aprobada por Alcaldía',

        ]);

        StatusOC::create([

            'estado'     =>  'En Firma Administración',

        ]);

        StatusOC::create([

            'estado'     =>  'Aprobada por Administración',

        ]);

		StatusOC::create([

            'estado'     =>  'Lista para Enviar a Proveedor',

        ]);

        StatusOC::create([

            'estado'     =>  'Enviada a Proveedor',

        ]);

        StatusOC::create([

            'estado'     =>  'Enviada a Proveedor con Excepción',

        ]);

        StatusOC::create([

            'estado'     =>  'Productos Recepcionados',

        ]);

        StatusOC::create([

            'estado'     =>  'Facturada',

        ]);

        StatusOC::create([

            'estado'     =>  'Parcialmente Facturada',

        ]);

        StatusOC::create([

            'estado'     =>  'Anulada',

        ]);

        StatusOC::create([

            'estado'     =>  'Confirmada',

        ]);
    }
}
