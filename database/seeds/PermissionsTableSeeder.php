<?php

/*
 *	JFuentealba @itux
 *	created at September 9, 2019 - 12:20 pm
 *	updated at September 30, 2019 - 3:49 pm
 */

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        /********************************************************************************************************************************************
         * USERS    *********************************************************************************************************************************
         ********************************************************************************************************************************************/
    	Permission::create([

    		'name' 			=> 'Navegamos por TODOS los Usuarios del Sistema',
    		'slug' 			=> 'users.index',
    		'description' 	=> 'Permiso que nos lista y muestra las acciones que podemos realizar con los Usuarios de la Intranet Municipal',
            'user_id'       =>  1,

    	]);

        Permission::create([

            'name'          => 'Muestra el Detalle de un Usuario de la Intranet Municipal',
            'slug'          => 'users.show',
            'description'   => 'Permiso que autoriza Visualizar en detalle todos los datos almacenados del Usuario seleccionado',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Editar Usuario de la Intranet Municipal',
            'slug'          => 'users.edit',
            'description'   => 'Permiso que autoriza la Modificación los datos del Usuario seleccionado',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Eliminar Usuario de la Intranet Municipal',
            'slug'          => 'users.destroy',
            'description'   => 'Permiso que autoriza la eliminación del Usuario seleccionado',
            'user_id'      =>  1,
        
        ]);

        /********************************************************************************************************************************************
         * DEPENDENCIES  ****************************************************************************************************************************
         ********************************************************************************************************************************************/
        Permission::create([

            'name'          => 'Navegamos por TODAS las Dependencias Municipales',
            'slug'          => 'dependencies.index',
            'description'   => 'Permiso que nos lista y muestra las acciones que podemos realizar con las Dependencias Municipales',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Creación de las Dependencias Municipales',
            'slug'          => 'dependencies.create',
            'description'   => 'Permiso que autoriza la creación de nuevas Dependencias Municipales',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Muestra el Detalle de la Dependencia Municipal',
            'slug'          => 'dependencies.show',
            'description'   => 'Permiso que autoriza Visualizar en detalle todos los datos almacenados de la Dependencia Municipal',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Editar las Dependencias Municipales',
            'slug'          => 'dependencies.edit',
            'description'   => 'Permiso que autoriza la Modificación los datos de la Dependencia Municipal seleccionada',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Eliminar las Dependencias Municipales',
            'slug'          => 'dependencies.destroy',
            'description'   => 'Permiso que autoriza la eliminación de la Dependencia Municipal seleccionada',
            'user_id'      =>  1,
        
        ]);

        /********************************************************************************************************************************************
         * PERMISSIONS  *****************************************************************************************************************************
         ********************************************************************************************************************************************/
        Permission::create([

            'name'          => 'Navegamos por TODOS los Permisos del Sistema',
            'slug'          => 'permissions.index',
            'description'   => 'Permiso que nos lista y muestra las acciones que podemos realizar con los Permisos de la Intranet Municipal y cada unos de los sistemas presentes en esta plataforma',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Creación de Permisos para la Intranet Municipal',
            'slug'          => 'permissions.create',
            'description'   => 'Permiso que autoriza la creación de nuevos permisos',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Muestra el Detalle del Permiso de la Intranet Municipal',
            'slug'          => 'permissions.show',
            'description'   => 'Permiso que autoriza Visualizar en detalle todos los datos almacenados del Permiso seleccionado',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Editar Permiso de la Intranet Municipal',
            'slug'          => 'permissions.edit',
            'description'   => 'Permiso que autoriza la Modificación los datos del Permiso seleccionado',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Eliminar Permiso de la Intranet Municipal',
            'slug'          => 'permissions.destroy',
            'description'   => 'Permiso que autoriza la eliminación del Permiso seleccionado',
            'user_id'      =>  1,
        
        ]);

        /********************************************************************************************************************************************
         * ROLES    *********************************************************************************************************************************
         ********************************************************************************************************************************************/
        Permission::create([

            'name'          => 'Navegamos por TODOS los Roles del Sistema',
            'slug'          => 'roles.index',
            'description'   => 'Permiso que nos lista y muestra las acciones que podemos realizar con los Roles de la Intranet Municipal',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Creación de Roles para la Intranet Municipal',
            'slug'          => 'roles.create',
            'description'   => 'Permiso que autoriza la creación de nuevos Roles del sistema',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Mustra el Detalle el Rol de la Intranet Municipal',
            'slug'          => 'roles.show',
            'description'   => 'Permiso que autoriza Visualizar en detalle todos los datos almacenados del Rol seleccionado',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Editar Rol de la Intranet Municipal',
            'slug'          => 'roles.edit',
            'description'   => 'Permiso que autoriza la Modificación los datos del Rol seleccionado',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Eliminar Rol de la Intranet Municipal',
            'slug'          => 'roles.destroy',
            'description'   => 'Permiso que autoriza la eliminación del Rol seleccionado',
            'user_id'      =>  1,
        
        ]);

        /********************************************************************************************************************************************
         * ADMINISTRATION   *************************************************************************************************************************
         ********************************************************************************************************************************************/

        Permission::create([

            'name'          => 'Administración de las Solicitudes Generales',
            'slug'          => 'administration.solicitudGeneral.index',
            'description'   => 'Permiso que da acceso al listado de las Solicitudes Generales.',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Muestra el Detalle de la Solicitud General',
            'slug'          => 'administration.solicitudGeneral.show',
            'description'   => 'Permiso que autoriza la visualización más completa de la Solicitud General',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Editar Solicitud General',
            'slug'          => 'administration.solicitudGeneral.edit',
            'description'   => 'Permiso que autoriza la modificación de la Solicitud General seleccionada',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Anular una Solicitud General',
            'slug'          => 'administration.solicitudGeneral.destroy',
            'description'   => 'Permiso que autoriza la anulación de la Solicitud General seleccionada',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Administración de las Solicitudes de Actividades',
            'slug'          => 'administration.solicitudActividad.index',
            'description'   => 'Permiso que da acceso al listado de las Solicitudes de Actividades.',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Muestra el Detalle de la Solicitud de Actividad',
            'slug'          => 'administration.solicitudActividad.show',
            'description'   => 'Permiso que autoriza la visualización más completa de la Solicitud Actividad',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Editar Solicitud de Actividad',
            'slug'          => 'administration.solicitudActividad.edit',
            'description'   => 'Permiso que autoriza la modificación de la Solicitud de Actividad seleccionada',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Anular una Solicitud de Actividad',
            'slug'          => 'administration.solicitudActividad.destroy',
            'description'   => 'Permiso que autoriza la anulación de la Solicitud de Actividad seleccionada',
            'user_id'      =>  1,

        ]);

    	/*
         * GESPRO
         */
    	Permission::create([

    		'name' 			=> 'Acceso al Sistema de Gestión y Control de Proyectos Municipales - GesPRO ',
    		'slug' 			=> 'gespro.index',
    		'description' 	=> 'Permiso que nos autoriza a utilizar el Sistema de Gestión y Control de Proyectos Municipales - GesPRO',
            'user_id'      =>  1,

    	]);

    	/*
         * FARMACIA
         */
    	Permission::create([

    		'name' 			=> 'Acceso al Sistema de Farmacia Municipal',
    		'slug' 			=> 'farmacia.index',
    		'description' 	=> 'Permiso que nos autoriza a utilizar el Sistema de Farmacia Municipal',
            'user_id'      =>  1,

    	]);

    	/********************************************************************************************************************************************
         * SISCOM   *********************************************************************************************************************************
         ********************************************************************************************************************************************/
    	Permission::create([

    		'name' 			=> 'Acceso al Sistema de Compras Públicas Municipales - SisCoM',
    		'slug' 			=> 'siscom.index',
    		'description' 	=> 'Permiso que nos autoriza a utilizar el Sistema de Compras Públicas Municipales - SisCoM',
            'user_id'      =>  1,

    	]);

        Permission::create([

            'name'          => 'Acceso a las Solicitudes Generales',
            'slug'          => 'siscom.solicitudGeneral.index',
            'description'   => 'Permiso que da acceso al listado de las Solicitudes Generales.',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Muestra el Detalle de la Solicitud General',
            'slug'          => 'siscom.solicitudGeneral.show',
            'description'   => 'Permiso que autoriza la visualización más completa de la Solicitud General',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Editar Solicitud General',
            'slug'          => 'siscom.solicitudGeneral.edit',
            'description'   => 'Permiso que autoriza la modificación de la Solicitud General seleccionada',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Anular una Solicitud General',
            'slug'          => 'siscom.solicitudGeneral.destroy',
            'description'   => 'Permiso que autoriza la anulación de la Solicitud General seleccionada',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Acceso a las Solicitudes de Actividades',
            'slug'          => 'siscom.solicitudActividad.index',
            'description'   => 'Permiso que da acceso al listado de las Solicitudes de Actividades.',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Muestra el Detalle de la Solicitud de Actividad',
            'slug'          => 'siscom.solicitudActividad.show',
            'description'   => 'Permiso que autoriza la visualización más completa de la Solicitud Actividad',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Editar Solicitud de Actividad',
            'slug'          => 'siscom.solicitudActividad.edit',
            'description'   => 'Permiso que autoriza la modificación de la Solicitud de Actividad seleccionada',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Anular una Solicitud de Actividad',
            'slug'          => 'siscom.solicitudActividad.destroy',
            'description'   => 'Permiso que autoriza la anulación de la Solicitud de Actividad seleccionada',
            'user_id'      =>  1,

        ]);

    }
}
