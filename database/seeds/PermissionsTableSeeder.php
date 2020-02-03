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

    	/*
         * GESPRO
         */
    	Permission::create([

    		'name' 			=> 'Acceso al Sistema de Gestión y Control de Proyectos Municipales - GesPRO ',
    		'slug' 			=> 'gespro.index',
    		'description' 	=> 'Permiso que nos autoriza a utilizar el Sistema de Gestión y Control de Proyectos Municipales - GesPRO',
            'user_id'      =>  1,

    	]);

    	/*###################################################################################################################################
         * FARMACIA #########################################################################################################################
         *###################################################################################################################################*/
    	Permission::create([

    		'name' 			=> 'Acceso al Sistema de Farmacia Municipal',
    		'slug' 			=> 'farmacia.index',
    		'description' 	=> 'Permiso que nos autoriza a utilizar el Sistema de Farmacia Municipal',
            'user_id'      =>  1,

    	]);

        Permission::create([

            'name'          => 'Listar Usuarios de la Farmacia',
            'slug'          => 'usuarioFarmacia.index',
            'description'   => 'Permiso que autoriza el Listar a los Usuarios de la Farmacia',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Eliminar Usuarios de la Farmacia',
            'slug'          => 'usuarioFarmacia.destroy',
            'description'   => 'Permiso que autoriza la Eliminación de los Usuarios de la Farmacia',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Listar Medicamentos de la Farmacia',
            'slug'          => 'medicamentos.index',
            'description'   => 'Permiso que autoriza Listar los Medicamentos de la Farmacia',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Eliminar Medicamentos de la Farmacia',
            'slug'          => 'medicamentos.destroy',
            'description'   => 'Permiso que autoriza la Eliminación de los Medicamentos de la Farmacia',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Listar Categoría de Medicamentos de la Farmacia',
            'slug'          => 'categoria.index',
            'description'   => 'Permiso que autoriza Listar las Categorías de los Medicamentos de la Farmacia',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Eliminar Categoría de Medicamento de la Farmacia',
            'slug'          => 'categoria.destroy',
            'description'   => 'Permiso que autoriza la Eliminación de las Categorías de los Medicamentos de la Farmacia',
            'user_id'      =>  1,

        ]);



    	/********************************************************************************************************************************************
         * SISCOM   *********************************************************************************************************************************
         ********************************************************************************************************************************************/

        Permission::create([

    		'name' 			=> 'SisCoM - Acceso al Sistema de Compras Públicas Municipales',
    		'slug' 			=> 'siscom.index',
    		'description' 	=> 'Permiso que nos autoriza a utilizar el Sistema de Compras Públicas Municipales (SisCoM)',
            'user_id'      =>  1,

    	]);

        //Solicitudes

        Permission::create([

            'name'          => 'Listar Solicitudes Generadas por los Usuarios',
            'slug'          => 'solicitud.index',
            'description'   => 'Permiso que autoriza ver el Listado de todas las Solicitudes Generadas por los Usuarios SisCoM',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Agregar Productos a la Solicitud',
            'slug'          => 'solicitud.show',
            'description'   => 'Permiso que autoriza el Ingreso de Productos a la Solicitud, además de Mostrar el Detalle de la Solicitud (TimeLine)',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Actualizar Encabezado de la Solicitud',
            'slug'          => 'solicitud.update',
            'description'   => 'Permiso que autoriza le Modificación del Encabezado de la Solicitud',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Anular Solicitud',
            'slug'          => 'solicitud.anular',
            'description'   => 'Permiso que autoriza la Anulación de la Solicitud',
            'user_id'      =>  1,

        ]);

        //Administrar Solicitudes

        Permission::create([

            'name'          => 'Listar Solicitudes Asignadas al Comprador en el Panel de Administración',
            'slug'          => 'admin.index',
            'description'   => 'Permiso que autoriza ver el Listado de Solicitudes Generadas en el Panel de Administración',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Mostrar Detalle de la Solicitud en el Panel de Administración',
            'slug'          => 'admin.show',
            'description'   => 'Permiso que autoriza Ver y Modificar la Solicitud, si corresponde, en el Panel de Administración',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Actualizar Encabezado de la Solicitud en el Panel de Administración',
            'slug'          => 'admin.update',
            'description'   => 'Permiso que autoriza la Modificación de la Solicitud en el Panel de Administración',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Anular Solicitud en el Panel de Administración',
            'slug'          => 'admin.anular',
            'description'   => 'Permiso que autoriza la Anulación de la Solicitud en el Panel de Administración',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Entrega de Productos de las Solicitudes de Stock',
            'slug'          => 'admin.stock',
            'description'   => 'Permiso que autoriza la Entrega de Productos Solicitados que se encuentran en Stock',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Recepcionar las Solicitudes en el Panel de Administración',
            'slug'          => 'admin.recepcionar',
            'description'   => 'Permiso que autoriza la Recepción de las Solicitudes en el Panel de Administración',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Asignar Solicitudes en el Panel de Administración',
            'slug'          => 'admin.asignar',
            'description'   => 'Permiso que autoriza a la Jefa de C&S, Titular y Subrogante, la asignación de un Comprador a la Solicitud en el Panel de Administración',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Listar Todas las Solicitudes Generadas para Consulta',
            'slug'          => 'admin.consulta',
            'description'   => 'Permiso que autoriza ver el Listado de Todas las Solicitudes Generadas a los Compradores, a modo de Consulta',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Cerrar Solicitudes de Stock',
            'slug'          => 'admin.cerrar',
            'description'   => 'Permiso que autoriza el Cerrar las Solicitudes de Stock',
            'user_id'      =>  1,

        ]);

        //Órdenes de Compra

        Permission::create([

            'name'          => 'Listar Todas las Órdenes de Compra',
            'slug'          => 'ordenCompra.index',
            'description'   => 'Permiso que autoriza ver el Listado de las Órdenes de Compra generadas por los Compradores y Encargada de Licitaciones',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Actualizar Encabezado de la Órden de Compra',
            'slug'          => 'ordenCompra.update',
            'description'   => 'Permiso que autoriza la Modificación del Encabezado de la Órden de Compra',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Anular Órden de Compra',
            'slug'          => 'ordenCompra.anular',
            'description'   => 'Permiso que autoriza la Anulación de la Órden de Compra',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Ver el Detalle de la Órden de Compra y Agregar Productos',
            'slug'          => 'ordenCompra.show',
            'description'   => 'Permiso que autoriza ver el Detalle de la Órden de Compra y Agregar los Productos de la Solicitud asignada',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Válidar la Órden de Compra',
            'slug'          => 'ordenCompra.validar',
            'description'   => 'Permiso que autoriza la Validación de la Órden de Compra',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Recepcionar la Órden de Compra',
            'slug'          => 'ordenCompra.recepcionar',
            'description'   => 'Permiso que autoriza la Recepción de la Órden de Compra',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Asignar Solicitud a la Órden de Compra',
            'slug'          => 'ordenCompra.asignar',
            'description'   => 'Permiso que autoriza Asignar una o varias Soliitudes a la Órden de Compra',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Enviar Órden de Compra con Excepción',
            'slug'          => 'ordenCompra.enviarExcepcion',
            'description'   => 'Permiso que autoriza el Envío de la Órden de Compra al Proveedor con Excepción',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Recepcionar Productos',
            'slug'          => 'ordenCompra.recepcionarProductos',
            'description'   => 'Permiso que autoriza Recepcionar los produtos de la Órden de Compra',
            'user_id'      =>  1,

        ]);

        //Licitaciones

        Permission::create([

            'name'          => 'Listar las Licitaciones',
            'slug'          => 'licitacion.index',
            'description'   => 'Permiso que autoriza Listar las Licitaciones generadas para su Gestión',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Actualizar Licitación',
            'slug'          => 'licitacion.update',
            'description'   => 'Permiso que autoriza Actualizar el Encabezado de las Licitaciones',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Mostrar el Detalle y Agregar Productos de la Licitación',
            'slug'          => 'licitacion.show',
            'description'   => 'Permiso que autoriza a Ver el Detalle de las Licitaciones, además de Agregar los Productos de la(s) Solicitudes Asignadas',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Anular Licitación',
            'slug'          => 'licitacion.anular',
            'description'   => 'Permiso que autoriza Anular la Licitación',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Recepcionar Licitación',
            'slug'          => 'licitacion.recepcionar',
            'description'   => 'Permiso que autoriza la Recepción de la Licitación',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Validar Licitación',
            'slug'          => 'licitacion.validar',
            'description'   => 'Permiso que autoriza el proceso de Validación de la Licitación',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Publicar Licitación',
            'slug'          => 'licitacion.publicar',
            'description'   => 'Permiso que autoriza la Publicación de la Licitación',
            'user_id'      =>  1,

        ]);

        //Proveedores

        Permission::create([

            'name'          => 'Listar a los Proveedores',
            'slug'          => 'proveedores.index',
            'description'   => 'Permiso que autoriza Ver el Listado de todos los Proveedores',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Ver el Detalle de los Proveedores',
            'slug'          => 'proveedores.show',
            'description'   => 'Permiso que autoriza ver el Detalle de los Proveedores',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Actualizar Proveedor',
            'slug'          => 'proveedores.update',
            'description'   => 'Permiso que autoriza la Actualización de los datos de los Proveedores',
            'user_id'      =>  1,

        ]);

        Permission::create([

            'name'          => 'Eliminar a un Proveedor',
            'slug'          => 'proveedores.delete',
            'description'   => 'Permiso que autoriza la Eliminación de un Proveedor',
            'user_id'      =>  1,

        ]);

    }
}
