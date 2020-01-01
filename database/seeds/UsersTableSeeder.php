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

            'dependency_id'     =>  null,
            'name'              => 'Juan Fuentealba',
            'email'             => 'juan.fuentealba@nacimiento.cl',
            'password'          => '$2y$10$ht/4rF7CoO9ypK6Sfl7z7Ot9LSudGrs12aGgjwp134A5tphXhns52',

        ]);

        User::create([

            'dependency_id'     =>  null,
            'name'              => 'Usuario de SisCoM',
            'email'             => 'u@u.cl',
            'password'          => '$2y$10$K742L1ka.anWGaTcdLRARelIGFBt4aII7h0NmXd2zZpYM.GY9LPFa',

        ]);

        User::create([

            'dependency_id'     =>  null,
            'name'              => 'Profesional SisCoM',
            'email'             => 's@s.cl',
            'password'          => '$2y$10$K742L1ka.anWGaTcdLRARelIGFBt4aII7h0NmXd2zZpYM.GY9LPFa',

        ]);

    	Role::create([

    		'name'              => 'Administrador',
    		'slug'              => 'admin',
            'description'       => 'Rol de la plataforma al que se le asignan TODOS los permisos.',
    		'special'           => 'all-access',
            //'user_id'           => 1,

    	]);

        Role::create([

            'name'              => 'Usuario SisCoM',
            'slug'              => 'siscom.usuario',
            'description'       => 'Rol de la plataforma al que se le permite generar Solicitudes Generales y/o de Actividad',
            'special'           => null,
            //'user_id'           => 1,

        ]);

        Role::create([

            'name'              => 'Profesional SisCoM',
            'slug'              => 'siscom.profesional',
            'description'       => 'Rol de la plataforma al que se le autoriza a gestionar las Solicitudes generadas por los Usuarios SisCoM',
            'special'           => null,
            //'user_id'           => 1,

        ]);

    }
}
