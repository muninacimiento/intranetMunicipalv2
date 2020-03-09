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
	Route::put('/siscom/solicitud/anular/{solicitud}', 'SCM_SolicitudController@update')->name('solicitud.anular')->middleware('can:solicitud.anular');


	//Administrar Solicitudes
	Route::resource('/siscom/admin', 'SCM_AdminSolicitudController')->middleware('can:admin.index');
	Route::get('/siscom/admin/{solicitud}', 'SCM_AdminSolicitudController@show')->name('admin.show')->middleware('can:admin.show');
	Route::post('/siscom/admin/{solicitud}', 'SCM_AdminSolicitudController@update')->name('admin.update')->middleware('can:admin.update');
	Route::put('/siscom/admin/asignar/{solicitud}', 'SCM_AdminSolicitudController@update')->name('admin.asignar')->middleware('can:admin.asignar');
	Route::put('/siscom/admin/reasignar/{solicitud}', 'SCM_AdminSolicitudController@update')->name('admin.reasignar')->middleware('can:admin.reasignar');
	Route::put('/siscom/admin/recepcionar/{solicitud}', 'SCM_AdminSolicitudController@update')->name('admin.recepcionar')->middleware('can:admin.recepcionar');
	Route::put('/siscom/admin/anular/{solicitud}', 'SCM_AdminSolicitudController@update')->name('admin.anular')->middleware('can:admin.anular');
	Route::get('/siscom/admin/entregaStock/{solicitud}', 'SCM_AdminSolicitudController@entregaStock')->name('admin.stock')->middleware('can:admin.stock');
	Route::get('/siscom/consulta', 'SCM_AdminSolicitudController@consulta')->name('admin.consulta')->middleware('can:admin.consulta');
	Route::put('/siscom/admin/cerrarSolicitud/{solicitud}', 'SCM_AdminSolicitudController@update')->name('admin.cerrar')->middleware('can:admin.cerrar');


	//Vistas PDF
	Route::get('VerSolicitud/{solicitud}', 'SCM_SolicitudController@exportarPdf')->name('solicitud.pdf');
	Route::get('reporteEntregaStock/{solicitud}', 'SCM_AdminSolicitudController@reporteEntregaStock')->name('reporteEntregaStock.pdf');


	//Órdenes de Compra
	Route::resource('/siscom/ordenCompra', 'OrdenCompraController')->middleware('can:ordenCompra.index');
	Route::get('/siscom/ordenCompra/{oc}', 'OrdenCompraController@show')->name('ordenCompra.show')->middleware('can:ordenCompra.show');
	Route::get('/siscom/ordenCompra/validar/{oc}', 'OrdenCompraController@validar')->name('ordenCompra.validar')->middleware('can:ordenCompra.validar');
	Route::post('/siscom/ordenCompra/{oc}', 'OrdenCompraController@update')->name('ordenCompra.update')->middleware('can:ordenCompra.update');
	Route::put('/siscom/ordenCompra/asignar/{oc}', 'OrdenCompraController@update')->name('ordenCompra.asignar')->middleware('can:ordenCompra.asignar');
	Route::put('/siscom/ordenCompra/recepcionar/{oc}', 'OrdenCompraController@update')->name('ordenCompra.recepcionar')->middleware('can:ordenCompra.recepcionar');
	Route::put('/siscom/ordenCompra/enviarExcepcion/{oc}', 'OrdenCompraController@update')->name('ordenCompra.enviarExcepcion')->middleware('can:ordenCompra.enviarExcepcion');
	Route::put('/siscom/ordenCompra/anular/{oc}', 'OrdenCompraController@update')->name('ordenCompra.anular')->middleware('can:ordenCompra.anular');
	Route::get('/siscom/ordenCompra/recepcionarProductos/{oc}', 'OrdenCompraController@recepcionarProductos')->name('ordenCompra.recepcionarProductos')->middleware('can:ordenCompra.recepcionarProducto');
	Route::put('/siscom/ordenCompra/confirmarRecepcion/{oc}', 'OrdenCompraController@update')->name('ordenCompra.confirmarRecepcion')->middleware('can:ordenCompra.confirmarRecepcionProductos');
	Route::put('/siscom/ordenCompra/recepcionarProducto/{oc}', 'OrdenCompraController@update')->name('ordenCompra.recepcionarProducto')->middleware('can:ordenCompra.recepcionarProducto');


	//Productos
	Route::resource('/siscom/productos', 'ProductController');


	//Proveedores
	Route::resource('/siscom/proveedores', 'ProveedoresController')->middleware('can:proveedores.index');
	Route::post('/siscom/proveedores/{proveedor}', 'ProveedoresController@show')->name('proveedores.show')->middleware('can:proveedores.show');
	Route::post('/siscom/proveedores/{proveedor}', 'ProveedoresController@update')->name('proveedores.update')->middleware('can:proveedores.update');

	//Licitaciones
	Route::resource('/siscom/licitacion', 'LicitacionController')->middleware('can:licitacion.index');
	Route::post('/siscom/licitacion/{licitacion}', 'LicitacionController@show')->name('licitacion.show')->middleware('can:licitacion.show');
	Route::post('/siscom/licitacion/{licitacion}', 'LicitacionController@update')->name('licitacion.update')->middleware('can:licitacion.update');
	Route::get('/siscom/licitacion/validar/{licitacion}', 'LicitacionController@validar')->name('licitacion.validar')->middleware('can:licitacion.validar');
	Route::put('/siscom/licitacion/publicar/{licitacion}', 'LicitacionController@update')->name('licitacion.publicar')->middleware('can:licitacion.publicar');
	Route::put('/siscom/licitacion/anular/{licitacion}', 'LicitacionController@update')->name('licitacion.anular')->middleware('can:licitacion.anular');
	Route::put('/siscom/licitacion/resolucion/{licitacion}', 'LicitacionController@update')->name('licitacion.resolucion')->middleware('can:licitacion.resolucion');

	//Facturas
	Route::resource('/siscom/factura', 'FacturaController')->middleware('can:factura.index');
	Route::get('/siscom/factura/{factura}', 'FacturaController@show')->name('factura.show')->middleware('can:factura.show');
	Route::get('/siscom/factura/validar/{factura}', 'FacturaController@validar')->name('factura.validar')->middleware('can:factura.validar');
	Route::put('/siscom/factura/facturar/{factura}', 'FacturaController@update')->name('factura.facturarTodos')->middleware('can:factura.facturarTodos');
	

	/*#############################################################################################################################################################
	 *	FARMACIA	###############################################################################################################################################
	 *#############################################################################################################################################################*/
	Route::get('farmacia', 'FarmaciaController@index')->name('farmacia.index')->middleware('can:farmacia.index');
	Route::resource('/farmacia/usuarios', 'UsuarioFarmaciaController')->middleware('can:usuarioFarmacia.index'); //Usuario = Paciente
	Route::delete('/farmacia/usuarios/{usuario}', 'UsuarioFarmaciaController@destroy')->name('usuarioFarmacia.destroy')->middleware('can:usuarioFarmacia.destroy');
	Route::resource('/farmacia/medicamentos', 'MedicamentoController')->middleware('can:medicamentos.index');
	Route::delete('/farmacia/medicamentos/{medicamento}', 'MedicamentoController@destroy')->name('medicamento.destroy')->middleware('can:medicamento.destroy');
	Route::resource('/farmacia/categoria', 'CategoriaMedicamentoController')->middleware('can:categoria.index');
	Route::resource('/farmacia/ventas', 'VentaFarmaciaController')->middleware('can:ventas.index'); 
	Route::delete('/farmacia/ventas/{venta}', 'VentaFarmaciaController@destroy')->name('ventas.destroy')->middleware('can:ventas.destroy');
	Route::post('/farmacia/ventas/{venta}', 'VentaFarmaciaController@show')->name('ventas.show')->middleware('can:ventas.show');
	Route::put('/farmacia/ventas/medicamento/{venta}', 'VentaFarmaciaController@update')->name('ventas.update')->middleware('can:ventas.update');




});