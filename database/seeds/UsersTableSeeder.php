<?php

/*
 *	JFuentealba @itux
 *	created at September 9, 2019 - 1:57 pm
 *	updated at
 */

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([

            'dependency_id'     =>  5,
            'name'              => 'Juan Fuentealba',
            'email'             => 'juan.fuentealba@nacimiento.cl',
            'password'          => '$2y$10$ht/4rF7CoO9ypK6Sfl7z7Ot9LSudGrs12aGgjwp134A5tphXhns52',

        ]);

        User::create([

            'dependency_id'     =>  10,
            'name'              => 'Usuario de SisCoM',
            'email'             => 'u@u.cl',
            'password'          => '$2y$10$K742L1ka.anWGaTcdLRARelIGFBt4aII7h0NmXd2zZpYM.GY9LPFa',

        ]);

        User::create([

            'dependency_id'     =>  8,
            'name'              => 'Mónica Alvares',
            'email'             => 'monica.alvarez@nacimiento.cl',
            'password'          => '$2y$10$K742L1ka.anWGaTcdLRARelIGFBt4aII7h0NmXd2zZpYM.GY9LPFa',

        ]);

        User::create([

            'dependency_id'     =>  8,
            'name'              => 'Marcos Mella',
            'email'             => 'marcos.mella@nacimiento.cl',
            'password'          => '$2y$10$K742L1ka.anWGaTcdLRARelIGFBt4aII7h0NmXd2zZpYM.GY9LPFa',

        ]);

        User::create([

            'dependency_id'     =>  8,
            'name'              => 'Fabiola Macaya',
            'email'             => 'fabiola.macaya@nacimiento.cl',
            'password'          => '$2y$10$K742L1ka.anWGaTcdLRARelIGFBt4aII7h0NmXd2zZpYM.GY9LPFa',

        ]);

        User::create([

            'dependency_id'     =>  8,
            'name'              => 'Cecilia Castro S',
            'email'             => 'cecilia.castro@nacimiento.cl',
            'password'          => '$2y$10$K742L1ka.anWGaTcdLRARelIGFBt4aII7h0NmXd2zZpYM.GY9LPFa',

        ]);

        User::create([

            'dependency_id'     =>  8,
            'name'              => 'Carolina Medina',
            'email'             => 'carolina.medina@nacimiento.cl',
            'password'          => '$2y$10$K742L1ka.anWGaTcdLRARelIGFBt4aII7h0NmXd2zZpYM.GY9LPFa',

        ]);

    	Role::create([

    		'name'              => 'Administrador',
    		'slug'              => 'admin',
            'description'       => 'Rol de la plataforma al que se le asignan TODOS los permisos.',
    		'special'           => 'all-access',
            'user_id'           => 1,

    	]);

        Role::create([

            'name'              => 'Usuario SisCoM',
            'slug'              => 'siscom.usuario',
            'description'       => 'Rol de la plataforma al que se le permite generar Solicitudes Generales y/o de Actividad',
            'special'           => null,
            'user_id'           => 1,

        ]);

        Role::create([

            'name'              => 'Encargad@ Bodega de C&S',
            'slug'              => 'siscom.bodega',
            'description'       => 'Rol que provee de los permisos necesarios para Gestionar las Solicitudes de Stock',
            'special'           => null,
            'user_id'           => 1,

        ]);

        Role::create([

            'name'              => 'Encargad@ de la Documentación de C&S',
            'slug'              => 'siscom.documentos',
            'description'       => 'Rol que provee de los permisos necesarios para recepcionar las Solicitudes y Gestionar las Facturas emitidas a la Municipalidad de Nacimiento',
            'special'           => null,
            'user_id'           => 1,

        ]);

        Role::create([

            'name'              => 'Encargad@ de Compras',
            'slug'              => 'siscom.comprador',
            'description'       => 'Rol que provee de los permisos necesarios para Gestionar las Solicitudes de Compra y sus respectivas Órdenes de Compra',
            'special'           => null,
            'user_id'           => 1,

        ]);

        Role::create([

            'name'              => 'Encargad@ de Licitaciones',
            'slug'              => 'siscom.licitaciones',
            'description'       => 'Rol que provee de los permisos necesarios para Gestionar las Licitaciones desde su Solicitud hasta la Órden de Compra',
            'special'           => null,
            'user_id'           => 1,

        ]);

        Role::create([

            'name'              => 'Jefe de C&S',
            'slug'              => 'siscom.jefeC&S',
            'description'       => 'Rol que provee de TODOS los permisos necesarios para Administrar el Sistema de Compras - SisCoM',
            'special'           => null,
            'user_id'           => 1,

        ]);

    }
}
