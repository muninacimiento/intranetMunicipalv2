<?php

/*
 *  JFuentealba @itux
 *  created at 
 *  updated at September 30, 2019 - 3:47 pm
 */

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*	Rutas del Sistema de Intranet
 *	Exclusivas para usuarios Auténticados
 */
Route::middleware(['auth'])->group( function() {

	/*
	 *	ESTRUCTURA DE LA RUTA
	 * 	---------------------
	 *	post 		: método
	 *	name 		: nombre de la ruta
	 *	middleware	: permiso de la ruta
	 */

	/**********************************
	 *	PERMISSIONS	*******************
	 **********************************/
	Route::get('permissions', 'PermissionController@index')->name('permissions.index')->middleware('can:permissions.index');
	Route::post('permissions/store', 'PermissionController@store')->name('permissions.store')->middleware('can:permissions.create');
	Route::get('permissions/create', 'PermissionController@create')->name('permissions.create')->middleware('can:permissions.create');
	Route::get('permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit')->middleware('can:permissions.edit');
	Route::put('permissions/{permission}', 'PermissionController@update')->name('permissions.update')->middleware('can:permissions.edit');
	Route::get('permissions/{permission}', 'PermissionController@show')->name('permissions.show')->middleware('can:permissions.show');
	Route::delete('permissions/{permission}', 'PermissionController@destroy')->name('permissions.destroy')->middleware('can:permissions.destroy');

	/**********************************
	 *	ROLES 	***********************
	 **********************************/
	Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('can:roles.index');
	Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('can:roles.create');
	Route::post('roles/store', 'RoleController@store')->name('roles.store')->middleware('can:roles.create');
	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')->middleware('can:roles.show');
	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware('can:roles.edit');
	Route::put('roles/{role}', 'RoleController@update')->name('roles.update')->middleware('can:roles.edit');
	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('can:roles.destroy');

	/**********************************
	 *	USERS 	***********************
	 **********************************/
	Route::get('users', 'UserController@index')->name('users.index')->middleware('can:users.index');
	//Route::get('users/create', 'UserController@create')->name('users.create')->middleware('can:users.create');
	Route::post('users/store', 'UserController@store')->name('users.store')->middleware('can:users.create');
	Route::get('users/{user}', 'UserController@show')->name('users.show')->middleware('can:users.show');
	Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('can:users.edit');
	Route::put('users/{user}', 'UserController@update')->name('users.update')->middleware('can:users.edit');
	Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('can:users.destroy');

	/**********************************
	 *	DEPENDENCIES	***************
	 **********************************/
	Route::get('dependencies', 'DependencyController@index')->name('dependencies.index')->middleware('can:dependencies.index');
	Route::post('dependencies/store', 'DependencyController@store')->name('dependencies.store')->middleware('can:dependencies.create');
	Route::get('dependencies/create', 'DependencyController@create')->name('dependencies.create')->middleware('can:dependencies.create');
	Route::get('dependencies/{dependency}/edit', 'DependencyController@edit')->name('dependencies.edit')->middleware('can:dependencies.edit');
	Route::put('dependencies/{dependency}', 'DependencyController@update')->name('dependencies.update')->middleware('can:dependencies.edit');
	Route::get('dependencies/{dependency}', 'DependencyController@show')->name('dependencies.show')->middleware('can:dependencies.show');
	Route::delete('dependencies/{dependency}', 'DependencyController@destroy')->name('dependencies.destroy')->middleware('can:dependencies.destroy');


	/**********************************
	 *	GESPRO 	***********************
	 **********************************/
	Route::get('gespro', 'GesproController@index')->name('gespro.index')->middleware('can:gespro.index');

	/**********************************
	 *	SISCOM 	***********************
	 **********************************/

	//Solicitudes
	Route::get('siscom', 'SiscomController@index')->name('siscom.index')->middleware('can:siscom.index');
	Route::resource('/siscom/solicitud', 'SCM_SolicitudController')->middleware('can:solicitud.index');
	Route::get('/siscom/solicitud/{solicitud}', 'SCM_SolicitudController@show')->name('solicitud.show')->middleware('can:solicitud.show');
	Route::post('/siscom/solicitud/{solicitud}', 'SCM_SolicitudController@update')->name('solicitud.update')->middleware('can:solicitud.update');

	//Administrar Solicitudes
	Route::resource('/siscom/admin', 'SCM_AdminSolicitudController')->middleware('can:admin.index');
	Route::get('/siscom/admin/{solicitud}', 'SCM_AdminSolicitudController@show')->name('admin.show')->middleware('can:admin.show');
	Route::post('/siscom/admin/{solicitud}', 'SCM_AdminSolicitudController@update')->name('admin.update')->middleware('can:admin.update');
	Route::get('/siscom/admin/entregaStock/{solicitud}', 'SCM_AdminSolicitudController@entregaStock')->name('admin.stock')->middleware('can:admin.stock');

	//Consulta de Solicitudes por C&S
	Route::get('/siscom/consulta', 'SCM_AdminSolicitudController@consulta')->name('admin.consulta')->middleware('can:admin.consulta');


	//Vista PDF
	Route::get('VerSolicitud/{solicitud}', 'SCM_SolicitudController@exportarPdf')->name('solicitud.pdf');


	//Órdenes de Compra
	Route::resource('/siscom/ordenCompra', 'OrdenCompraController')->middleware('can:ordenCompra.index');
	Route::get('/siscom/ordenCompra/{oc}', 'OrdenCompraController@show')->name('ordenCompra.show')->middleware('can:ordenCompra.show');
	Route::get('/siscom/ordenCompra/validar/{oc}', 'OrdenCompraController@validar')->name('ordenCompra.validar')->middleware('can:ordenCompra.validar');
	Route::post('/siscom/ordenCompra/{oc}', 'OrdenCompraController@update')->name('ordenCompra.update')->middleware('can:ordenCompra.update');
	//Route::get('/email', 'OrdenCompraController@enviarOC')->name('enviarOC');


	//Productos
	Route::resource('/siscom/productos', 'ProductController');


	//Proveedores
	Route::resource('/siscom/proveedores', 'ProveedoresController')->middleware('can:proveedores.index');
	Route::post('/siscom/proveedores/{proveedor}', 'ProveedoresController@show')->name('proveedores.show')->middleware('can:proveedores.show');
	Route::post('/siscom/proveedores/{proveedor}', 'ProveedoresController@update')->name('proveedores.update')->middleware('can:proveedores.update');

	//Licitaciones
	Route::resource('/siscom/licitaciones', 'LicitacionesController')->middleware('can:licitaciones.index');

	//Factudas
	Route::resource('/siscom/facturas', 'FacturaController')->middleware('can:factura.index');
	

	/**********************************
	 *	FARMACIA	*******************
	 **********************************/
	Route::get('farmacia', 'FarmaciaController@index')->name('farmacia.index')->middleware('can:farmacia.index');

});