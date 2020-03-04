<?php

use Illuminate\Database\Seeder;
use App\StatusLicitacion;

class StatusLicitacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	StatusLicitacion::create([

            'estado'     =>  'Creada',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases Recepcionadas y en Revisión por C&S',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases en Revisión por C&S',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases Aprobada por C&S',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases Rechazada por C&S',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases en Revisión por Profesional D.A.F.',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases Aprobada por Profesional D.A.F.',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases Rechazada por Profesional D.A.F.',

        ]);

		StatusLicitacion::create([

            'estado'     =>  'Bases en Firma D.A.F.',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases Aprobada por D.A.F.',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases Rechazada por D.A.F.',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases en Firma Dirección de Control',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases Aprobada por Dirección de Control',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases Rechazada por Dirección de Control',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases en Firma Administración',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Bases Aprobada por Administración',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Lista para Publicar',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Publicada',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Cerrada',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación Recepcionada y en Revisión por C&S',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación en Revisión por C&S',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación Aprobada por C&S',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación Rechazada por C&S',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación en Revisión por Profesional D.A.F.',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación Aprobada por Profesional D.A.F.',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación Rechazada por Profesional D.A.F.',

        ]);

		StatusLicitacion::create([

            'estado'     =>  'Adjudicación en Firma D.A.F.',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación Aprobada por D.A.F.',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación Rechazada por D.A.F.',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación en Firma Alcadía',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación Aprobada por Alcaldía',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación en Firma Administración',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicación Aprobada por Administración',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Lista para Adjudicar',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Adjudicada',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Desierta',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Inadmisible',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Anulada',

        ]);

        StatusLicitacion::create([

            'estado'     =>  'Confirmada',

        ]);

    }
}
