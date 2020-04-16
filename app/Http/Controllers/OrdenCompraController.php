<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrdenDeCompraRecibida;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

use App\OrdenCompra;

use App\MoveOC;

use App\AssignRequestToOC;

/* Invocamos el modelo de la Entidad DetalleSolicitud*/
use App\DetailSolicitud;

use App\Solicitud;

/* Invocamos el modelo de la Entidad Movimiento de la Solicitud*/
use App\MoveSolicitud;

use DB;

class OrdenCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->email == 'perla.briceno@nacimiento.cl') {
        
            /*
             * Definimos variable que contendrá la fecha actual del sistema
             */
            $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

            /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
            $ordenesCompra = DB::table('orden_compras')
                        ->join('users', 'orden_compras.user_id', '=', 'users.id')
                        ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                        ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                        ->select('orden_compras.*', 'users.name as Comprador', 'users.email as EmailComprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial', 'proveedores.correo as EmailProveedor')
                        ->where('orden_compras.estado_id', '=', 6)
                        ->get();

            $proveedores = DB::table('proveedores')
                        ->select(DB::raw('CONCAT(proveedores.id, " ) ", proveedores.razonSocial) as RazonSocial'), 'proveedores.id')
                        ->get();

        }else{

             /*
             * Definimos variable que contendrá la fecha actual del sistema
             */
            $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

            /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
            $ordenesCompra = DB::table('orden_compras')
                        ->join('users', 'orden_compras.user_id', '=', 'users.id')
                        ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                        ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                        ->select('orden_compras.*', 'users.name as Comprador', 'users.email as EmailComprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial', 'proveedores.correo as EmailProveedor')
                        ->get();

            $proveedores = DB::table('proveedores')
                        ->select(DB::raw('CONCAT(proveedores.id, " ) ", proveedores.razonSocial) as RazonSocial'), 'proveedores.id')
                        ->get();

        }

        //dd($ordenesCompra);

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.ordenCompra.index', ['ordenesCompra' => $ordenesCompra, 'dateCarbon' => $dateCarbon, 'proveedores'=>$proveedores]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            try {

                DB::beginTransaction();

                //Comenzamos a capturar desde la vista los datos a guardar de la SOLICITUD
                $oc = new OrdenCompra;
                $oc->user_id                        = Auth::user()->id;
                $oc->ordenCompra_id                 = $request->ordenCompra_id;
                $oc->iddoc                          = $request->iddoc;
                $oc->proveedor_id                   = $request->flagIdProveedor;
                $oc->estado_id                      = 1;
                $oc->tipoOrdenCompra                = $request->tipoOrdenCompra;
                $oc->mercadoPublico                 = $request->mercadoPublico;
                $oc->valorEstimado                  = $request->valorEstimado;
                $oc->totalOrdenCompra               = $request->totalOrdenCompra;
                $oc->excepcion                      = $request->excepcion;
                $oc->deptoRecepcion                 = $request->deptoReceptor;
                
                $oc->save(); //Guardamos la OC

                //Guardamos los datos de Movimientos de la OC
                $move = new MoveOC;
                $move->ordenCompra_id               = $oc->id;
                $move->estadoOrdenCompra_id         = 1;
                $move->fecha                        = $oc->created_at;
                $move->user_id                      = Auth::user()->id;

                $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit(); //Ejecutamos ambas sentencias y si todo resulta OK, guarda, sino ejecuta el catch
                
            } catch (Exception $e) {

                DB::rollback();
                
            }
            
            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Creada con Éxito !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $ordenCompra = DB::table('orden_compras')
                    ->join('users', 'orden_compras.user_id', '=', 'users.id')
                    ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                    ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                    ->select('orden_compras.*', 'users.name as Comprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial')
                    ->where('orden_compras.id', '=', $id)
                    ->first();

        $proveedores = DB::table('proveedores')
                    ->select(DB::raw('CONCAT(proveedores.id, " ) ", proveedores.razonSocial) as RazonSocial'), 'proveedores.id')
                    ->get();

        $move = DB::table('move_o_c_s') 
                ->join('status_o_c_s', 'move_o_c_s.estadoOrdenCompra_id', 'status_o_c_s.id')               
                ->join('users', 'move_o_c_s.user_id', 'users.id')
                ->select('move_o_c_s.*', 'status_o_c_s.estado as status', 'users.name as name', 'move_o_c_s.created_at as date')
                ->where('move_o_c_s.ordenCompra_id', '=', $id)
                ->get();

        $assign = DB::table('assign_request_to_o_c_s')
                ->join('orden_compras', 'assign_request_to_o_c_s.ordenCompra_id', '=', 'orden_compras.id')
                ->select('assign_request_to_o_c_s.*', 'orden_compras.ordenCompra_id as NoOC')
                ->where('assign_request_to_o_c_s.ordenCompra_id', '=', $ordenCompra->id)
                ->get();

        $detalleSolicitud = DB::table('detail_solicituds')
                                ->join('products', 'detail_solicituds.product_id', 'products.id')
                                ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                                ->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                                ->select('detail_solicituds.*', 'products.name as Producto')
                                ->where('detail_solicituds.ordenCompra_id', '=', $id)
                                ->get();

        
                    //dd($ordenCompra);

                     /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.ordenCompra.show', compact('ordenCompra', 'dateCarbon', 'proveedores', 'move', 'detalleSolicitud', 'assign'));

    }

    public function agregarProductos($id)
    {

        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $ordenCompra = DB::table('orden_compras')
                    ->join('users', 'orden_compras.user_id', '=', 'users.id')
                    ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                    ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                    ->select('orden_compras.*', 'users.name as Comprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial')
                    ->where('orden_compras.id', '=', $id)
                    ->first();

        $proveedores = DB::table('proveedores')
                    ->select(DB::raw('CONCAT(proveedores.id, " ) ", proveedores.razonSocial) as RazonSocial'), 'proveedores.id')
                    ->get();

        $move = DB::table('move_o_c_s') 
                ->join('status_o_c_s', 'move_o_c_s.estadoOrdenCompra_id', 'status_o_c_s.id')               
                ->join('users', 'move_o_c_s.user_id', 'users.id')
                ->select('move_o_c_s.*', 'status_o_c_s.estado as status', 'users.name as name', 'move_o_c_s.created_at as date')
                ->where('move_o_c_s.ordenCompra_id', '=', $id)
                ->get();

        $assign = DB::table('assign_request_to_o_c_s')
                ->join('orden_compras', 'assign_request_to_o_c_s.ordenCompra_id', '=', 'orden_compras.id')
                ->select('assign_request_to_o_c_s.*', 'orden_compras.ordenCompra_id as NoOC')
                ->where('assign_request_to_o_c_s.ordenCompra_id', '=', $ordenCompra->id)
                ->get();

        $detalleSolicitud = DB::table('detail_solicituds')
                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    ->join('assign_request_to_o_c_s', 'detail_solicituds.solicitud_id', '=', 'assign_request_to_o_c_s.solicitud_id')
                    //->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                    ->select('detail_solicituds.*', 'products.name as Producto')
                    ->where('assign_request_to_o_c_s.ordenCompra_id', '=', $ordenCompra->id)
                    ->get();    

        
                    //dd($ordenCompra);

                     /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.ordenCompra.agregarProductos', compact('ordenCompra', 'dateCarbon', 'proveedores', 'move', 'detalleSolicitud', 'assign'));

    }

    public function buscarSolicitud(Request $request, $id)
    {

        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $ordenCompra = DB::table('orden_compras')
                    ->join('users', 'orden_compras.user_id', '=', 'users.id')
                    ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                    ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                    ->select('orden_compras.*', 'users.name as Comprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial')
                    ->where('orden_compras.id', '=', $id)
                    ->first();

        $proveedores = DB::table('proveedores')
                    ->select(DB::raw('CONCAT(proveedores.id, " ) ", proveedores.razonSocial) as RazonSocial'), 'proveedores.id')
                    ->get();

        $move = DB::table('move_o_c_s') 
                ->join('status_o_c_s', 'move_o_c_s.estadoOrdenCompra_id', 'status_o_c_s.id')               
                ->join('users', 'move_o_c_s.user_id', 'users.id')
                ->select('move_o_c_s.*', 'status_o_c_s.estado as status', 'users.name as name', 'move_o_c_s.created_at as date')
                ->where('move_o_c_s.ordenCompra_id', '=', $id)
                ->get();

        $assign = DB::table('assign_request_to_o_c_s')
                ->join('orden_compras', 'assign_request_to_o_c_s.ordenCompra_id', '=', 'orden_compras.id')
                ->select('assign_request_to_o_c_s.*', 'orden_compras.ordenCompra_id as NoOC')
                ->where('assign_request_to_o_c_s.ordenCompra_id', '=', $ordenCompra->id)
                ->get();

        $detalleSolicitud = DB::table('detail_solicituds')
                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    //->join('assign_request_to_o_c_s', 'detail_solicituds.solicitud_id', '=', 'assign_request_to_o_c_s.solicitud_id')
                    //->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                    ->select('detail_solicituds.*', 'products.name as Producto')
                    ->where('detail_solicituds.solicitud_id', '=', $request->numeroSolicitud)
                    ->get();    

        
                    //dd($ordenCompra);

                     /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.ordenCompra.agregarProductos', compact('ordenCompra', 'dateCarbon', 'proveedores', 'move', 'detalleSolicitud', 'assign'));

    }

    public function validar($id)
    {

        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $ordenCompra = DB::table('orden_compras')
                    ->join('users', 'orden_compras.user_id', '=', 'users.id')
                    ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                    ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                    ->select('orden_compras.*', 'users.name as Comprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial')
                    ->where('orden_compras.id', '=', $id)
                    ->first();

        $move = DB::table('move_o_c_s') 
                ->join('status_o_c_s', 'move_o_c_s.estadoOrdenCompra_id', 'status_o_c_s.id')               
                ->join('users', 'move_o_c_s.user_id', 'users.id')
                ->select('status_o_c_s.estado as status', 'users.name as name', 'move_o_c_s.created_at as date')
                ->where('move_o_c_s.ordenCompra_id', '=', $id)
                ->get();

        $detalleSolicitud = DB::table('detail_solicituds')
                                ->join('products', 'detail_solicituds.product_id', 'products.id')
                                ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                                ->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                                ->select('detail_solicituds.*', 'products.name as Producto')
                                ->where('detail_solicituds.ordenCompra_id', '=', $id)
                                ->get();


                    //dd($detalleSolicituds);

                     /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.ordenCompra.validar', compact('ordenCompra', 'dateCarbon', 'move', 'detalleSolicitud'));

    }

    public function recepcionarProductos($id)
    {

        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $ordenCompra = DB::table('orden_compras')
                    ->join('users', 'orden_compras.user_id', '=', 'users.id')
                    ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                    ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                    ->select('orden_compras.*', 'users.name as Comprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial')
                    ->where('orden_compras.id', '=', $id)
                    ->first();

        $move = DB::table('move_o_c_s') 
                ->join('status_o_c_s', 'move_o_c_s.estadoOrdenCompra_id', 'status_o_c_s.id')               
                ->join('users', 'move_o_c_s.user_id', 'users.id')
                ->select('move_o_c_s.*', 'status_o_c_s.estado as status', 'users.name as name', 'move_o_c_s.created_at as date')
                ->where('move_o_c_s.ordenCompra_id', '=', $id)
                ->get();

        $detalleSolicitud = DB::table('detail_solicituds')
                                ->join('products', 'detail_solicituds.product_id', 'products.id')
                                ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                                ->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                                ->select('detail_solicituds.*', 'products.name as Producto')
                                ->where('detail_solicituds.ordenCompra_id', '=', $id)
                                ->get();


                    //dd($detalleSolicituds);

                     /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.ordenCompra.recepcionarProductos', compact('ordenCompra', 'dateCarbon', 'move', 'detalleSolicitud'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenCompra $ordenCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Actualizamos el Encabezado de la Órden de Compra
        if ($request->flag == 'Actualizar') {

            $oc = OrdenCompra::findOrFail($id);
            $oc->ordenCompra_id                 = $request->ordenCompra_id;
            $oc->iddoc                          = $request->iddoc;
            $oc->proveedor_id                   = $request->flagIdProveedor;
            $oc->tipoOrdenCompra                = $request->tipoOrdenCompra;
            $oc->mercadoPublico                 = $request->mercadoPublico;
            $oc->valorEstimado                  = $request->valorEstimado;
            $oc->totalOrdenCompra               = $request->totalOrdenCompra;
            $oc->excepcion                      = $request->excepcion;
            $oc->deptoRecepcion                 = $request->deptoReceptor;
                
            $oc->save(); //Guardamos la OC

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Actualizada con éxito!');

        }

        //Asignamos las Solicitudes que proveerán de los Productos para la Órden de Compra
        else if ($request->flag == 'Asignar') {

            try {

                DB::beginTransaction();

                    $year = Carbon::now();

                    //Asignamos la Solicitud a la Órden de Compra
                    $assign = new AssignRequestToOC;
                    $assign->ordenCompra_id             = $id;
                    $assign->solicitud_id               = $request->solicitud_id_assign;
                    $assign->year                       = $year->format('Y');

                    $assign->save();

                    //Cambiamos el Estado de la Solicitud a "En Proceso de Compra"
                    $solicitud = Solicitud::findOrFail($request->solicitud_id_assign);
                    $solicitud->estado_id               = 6;

                    $solicitud->save();

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $request->solicitud_id_assign;
                    $move->estadoSolicitud_id               = 6;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();

                return redirect('/siscom/ordenCompra')->with('info', 'No se ha podido asignar la Solicitud a la Órden de Compra');

            }

            return redirect('/siscom/ordenCompra')->with('info', 'Solicitud Asignada con éxito!');

        }

        // Recepcionar y Órden de Compra en Revisión por C&S
        else if ($request->flag == 'Recepcionar') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->estado_id                              = 2;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                       = $oc->id;
                    $move->estadoOrdenCompra_id                 = 2;
                    $move->fecha                                = $oc->updated_at;
                    $move->user_id                              = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Recepcionada con éxito !');
        }  

        // Aprobada por C&S
        else if ($request->flag == 'AprobadaC&S') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);

                    if ($oc->tipoOrdenCompra == "Trato Directo") {
                        
                        $oc->estado_id                                 = 9;

                        //dd($solicitud);

                        $oc->save(); //Guardamos la Solicitud

                        //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveOC;
                        $move->ordenCompra_id                          = $oc->id;
                        $move->estadoOrdenCompra_id                    = 4;
                        $move->fecha                                   = $oc->updated_at;
                        $move->user_id                                 = Auth::user()->id;

                        $move->save(); //Guardamos el Movimiento de la Solicitud    

                    }else{

                        $oc->estado_id                                 = 6;

                        //dd($solicitud);

                        $oc->save(); //Guardamos la Solicitud

                        //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveOC;
                        $move->ordenCompra_id                          = $oc->id;
                        $move->estadoOrdenCompra_id                    = 4;
                        $move->fecha                                   = $oc->updated_at;
                        $move->user_id                                 = Auth::user()->id;

                        $move->save(); //Guardamos el Movimiento de la Solicitud    

                    }

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return back();
        } 

        //Rechazada por C&S
        else if ($request->flag == 'RechazadaC&S') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->estado_id                      = 3;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                = $oc->id;
                    $move->estadoOrdenCompra_id          = 5;
                    $move->fecha                         = $oc->updated_at;
                    $move->user_id                       = Auth::user()->id;
                    $move->obsRechazoValidacion          = $request->motivoRechazo;


                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Rechazada por C&S con éxito !');
        }    

        //Aprobada por Profesinoal DAF
        else if ($request->flag == 'AprobadaProfDAF') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->estado_id                      = 9;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id               = $oc->id;
                    $move->estadoOrdenCompra_id         = 7;
                    $move->fecha                        = $oc->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Aprobada por Profesinal DAF con éxito !');
        } 

        // Rechazada por Profesinoal DAF
        else if ($request->flag == 'RechazadaProfDAF') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->estado_id                      = 3;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                = $oc->id;
                    $move->estadoOrdenCompra_id          = 8;
                    $move->fecha                         = $oc->updated_at;
                    $move->user_id                       = Auth::user()->id;
                    $move->obsRechazoValidacion          = $request->motivoRechazo;


                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Rechazada por Profesional DAF con éxito !');
        }

        //Órden de compra en Firma DAF
        else if ($request->flag == 'FirmadaPorDAF') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);

                    if ($oc->valorEstimado == 'Mayor a 10 UTM' || $oc->tipoOrdenCompra == 'Convenio Marco / Suministro') {
                        
                        $oc->estado_id                      = 12;

                        //dd($solicitud);

                        $oc->save(); //Guardamos la Solicitud

                        //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveOC;
                        $move->ordenCompra_id                = $oc->id;
                        $move->estadoOrdenCompra_id          = 10;
                        $move->fecha                         = $oc->updated_at;
                        $move->user_id                       = Auth::user()->id;


                        $move->save(); //Guardamos el Movimiento de la Solicitud    
                    
                    } else if ($oc->valorEstimado == 'Menor o Igual a 10 UTM' || $oc->tipoOrdenCompra == 'Trato Directo') {
                        
                        $oc->estado_id                      = 14;

                        //dd($solicitud);

                        $oc->save(); //Guardamos la Solicitud

                        //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveOC;
                        $move->ordenCompra_id                = $oc->id;
                        $move->estadoOrdenCompra_id          = 10;
                        $move->fecha                         = $oc->updated_at;
                        $move->user_id                       = Auth::user()->id;


                        $move->save(); //Guardamos el Movimiento de la Solicitud    

                    }

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Firmada por DAF con éxito !');
        }

        // Rechazada por DAF
        else if ($request->flag == 'RechazadaDAF') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->estado_id                      = 3;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                = $oc->id;
                    $move->estadoOrdenCompra_id          = 11;
                    $move->fecha                         = $oc->updated_at;
                    $move->user_id                       = Auth::user()->id;
                    $move->obsRechazoValidacion          = $request->motivoRechazo;


                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Rechazada por DAF con éxito !');
        }

        //Órden de compra en Firma Alcaldia
        else if ($request->flag == 'FirmadaPorAlcaldia') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);

                    //Consultaremos si la Órden de Compra ha sido enviada con Excepción
                    if ($oc->enviadaProveedor == 0) {
                        
                        $oc->estado_id                      = 16;

                        //dd($solicitud);

                        $oc->save(); //Actualizamos el Estado de la OC

                        //Guardamos los datos de Movimientos de la Órden de Compra
                        $move = new MoveOC;
                        $move->ordenCompra_id                = $oc->id;
                        $move->estadoOrdenCompra_id          = 13;
                        $move->fecha                         = $oc->updated_at;
                        $move->user_id                       = Auth::user()->id;

                        $move->save();

                    } else if ($oc->enviadaProveedor == 1) {

                        $oc->estado_id                      = 17;

                        //dd($solicitud);

                        $oc->save(); //Actualizamos el Estado de la OC

                        //Guardamos los datos de Movimientos de la Órden de Compr
                        $move = new MoveOC;
                        $move->ordenCompra_id                = $oc->id;
                        $move->estadoOrdenCompra_id          = 13;
                        $move->fecha                         = $oc->updated_at;
                        $move->user_id                       = Auth::user()->id;

                        $move->save();

                    }

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Firmada por Alcaldía con éxito !');
        } 

        

        //Órden de compra en Firma Administracion
        else if ($request->flag == 'FirmadaPorAdministracion') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);

                    //Consultaremos si la Órden de Compra ha sido enviada con Excepción
                    if ($oc->enviadaProveedor == 0) {

                        $oc->estado_id                      = 16;

                        //dd($solicitud);

                        $oc->save(); //Guardamos la Solicitud

                        //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveOC;
                        $move->ordenCompra_id                = $oc->id;
                        $move->estadoOrdenCompra_id          = 15;
                        $move->fecha                         = $oc->updated_at;
                        $move->user_id                       = Auth::user()->id;

                        $move->save();

                    }else if ($oc->enviadaProveedor == 1) {

                         $oc->estado_id                      = 17;

                        //dd($solicitud);

                        $oc->save(); //Guardamos la Solicitud

                        //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveOC;
                        $move->ordenCompra_id                = $oc->id;
                        $move->estadoOrdenCompra_id          = 15;
                        $move->fecha                         = $oc->updated_at;
                        $move->user_id                       = Auth::user()->id;

                        $move->save(); //Guardamos el Movimiento de la Solicitud

                    }

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Firmada por Administración con éxito !');
        }

        //Órden de compra Lista para Enviar al Proveedor
        else if ($request->flag == 'EnviarProveedor') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->estado_id                      = 17;
                    $oc->enviadaProveedor               = 1;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                = $oc->id;
                    $move->estadoOrdenCompra_id          = 17;
                    $move->fecha                         = $oc->updated_at;
                    $move->user_id                       = Auth::user()->id;


                    $move->save(); //Guardamos el Movimiento de la Solicitud
                        
                        $correo = DB::table('orden_compras')
                            ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                            ->join('users', 'orden_compras.user_id', '=', 'users.id')
                            ->select('orden_compras.id', 'orden_compras.deptoRecepcion', 'proveedores.correo as MailProveedor', 'users.email as MailComprador')
                            ->where('orden_compras.id', '=', $id)
                            ->first();
                            //dd($correo);

                        $ocMail = DB::table('orden_compras')
                            ->join('users', 'orden_compras.user_id', '=', 'users.id')
                            ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                            ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                            ->select('orden_compras.*', 'users.name as Comprador', 'users.email as EmailComprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial', 'proveedores.correo as EmailProveedor')
                            ->where('orden_compras.id', '=', $id)
                            ->first();

                        $detalleSolicitud = DB::table('detail_solicituds')
                                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                                    ->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                                    ->select('detail_solicituds.*', 'products.name as Producto')
                                    ->where('detail_solicituds.ordenCompra_id', '=', $id)
                                    ->get();

                        $solicitud = DB::table('solicituds')
                                    ->join('detail_solicituds', 'solicituds.id', '=', 'detail_solicituds.solicitud_id')
                                    ->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                                    ->select('solicituds.*')
                                    ->where('orden_compras.id', '=', $id)
                                    ->first();

                        //dd($solicitud);
                        if ($oc->mercadoPublico == 'No') {

                        if ($correo->deptoRecepcion == 'Compras y Suministros, Freire #614 Nacimiento') {
                            
                            Mail::to( $correo->MailProveedor )
                            ->cc($correo->MailComprador)
                            ->send(new OrdenDeCompraRecibida($id, $detalleSolicitud, $ocMail, $solicitud));

                        }else if ($correo->deptoRecepcion == 'Bodega Talleres Municipales, San Martin #649 Nacimiento'){

                            Mail::to( $correo->MailProveedor )
                            ->cc($correo->MailComprador)
                            ->bcc('heraldo.medina@nacimiento.cl')
                            ->send(new OrdenDeCompraRecibida($id, $detalleSolicitud, $ocMail, $solicitud));
                        }

                    }else if($oc->mercadoPublico == 'Si'){

                         if ($correo->deptoRecepcion == 'Bodega Talleres Municipales, San Martin #649 Nacimiento'){

                                Mail::to( $correo->MailProveedor )
                                ->cc($correo->MailComprador)
                                ->bcc('heraldo.medina@nacimiento.cl')
                                ->send(new OrdenDeCompraRecibida($id, $detalleSolicitud, $ocMail, $solicitud));
                            }else{

                                //no hace nada
                            }

                    }

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

           return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Enviada al Proveedor con éxito !');
            
        }                                 

        //Órden de compra Lista para Enviar al Proveedor
        else if ($request->flag == 'EnviarProveedorConExcepcion') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->estado_id                      = 18;
                    $oc->enviadaProveedor               = 1;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                = $oc->id;
                    $move->estadoOrdenCompra_id          = 18;
                    $move->fecha                         = $oc->updated_at;
                    $move->user_id                       = Auth::user()->id;


                    $move->save(); //Guardamos el Movimiento de la Solicitud
                        
                        $correo = DB::table('orden_compras')
                            ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                            ->join('users', 'orden_compras.user_id', '=', 'users.id')
                            ->select('orden_compras.id', 'orden_compras.deptoRecepcion', 'proveedores.correo as MailProveedor', 'users.email as MailComprador')
                            ->where('orden_compras.id', '=', $id)
                            ->first();
                            //dd($correo);

                        $ocMail = DB::table('orden_compras')
                            ->join('users', 'orden_compras.user_id', '=', 'users.id')
                            ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                            ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                            ->select('orden_compras.*', 'users.name as Comprador', 'users.email as EmailComprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial', 'proveedores.correo as EmailProveedor')
                            ->where('orden_compras.id', '=', $id)
                            ->first();

                        $detalleSolicitud = DB::table('detail_solicituds')
                                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                                    ->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                                    ->select('detail_solicituds.*', 'products.name as Producto')
                                    ->where('detail_solicituds.ordenCompra_id', '=', $id)
                                    ->get();

                        $solicitud = DB::table('solicituds')
                                    ->join('detail_solicituds', 'solicituds.id', '=', 'detail_solicituds.solicitud_id')
                                    ->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                                    ->select('solicituds.*')
                                    ->where('orden_compras.id', '=', $id)
                                    ->first();


                        //dd($ocMail);
                        if ($ocMail->mercadoPublico == 'No') {

                            if ($correo->deptoRecepcion == 'Compras y Suministros, Freire #614 Nacimiento') {
                                
                                Mail::to( $correo->MailProveedor )
                                ->cc($correo->MailComprador)
                                ->send(new OrdenDeCompraRecibida($id, $detalleSolicitud, $ocMail, $solicitud));

                            }else if ($correo->deptoRecepcion == 'Bodega Talleres Municipales, San Martin #649 Nacimiento'){

                                Mail::to( $correo->MailProveedor )
                                ->cc($correo->MailComprador)
                                ->bcc('heraldo.medina@nacimiento.cl')
                                ->send(new OrdenDeCompraRecibida($id, $detalleSolicitud, $ocMail, $solicitud));
                            }

                        }else if($ocMail->mercadoPublico == 'Si'){

                            if ($correo->deptoRecepcion == 'Bodega Talleres Municipales, San Martin #649 Nacimiento'){

                                Mail::to( $correo->MailProveedor )
                                ->cc($correo->MailComprador)
                                ->bcc('heraldo.medina@nacimiento.cl')
                                ->send(new OrdenDeCompraRecibida($id, $detalleSolicitud, $ocMail, $solicitud));
                            }else{

                                //no hace nada
                            }

                        }


                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();

                return redirect('/siscom/ordenCompra')->with('danger', 'La Órden de Compra NO ha podido ser enviada al proveedor, favor verifique el correo del Proveedor!');
                
            }

           return back();

            
        }                                 

        // Anular Órden de Compra
        else if ($request->flag == 'Anular') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->motivoAnulacion                = $request->motivoAnulacion;
                    $oc->estado_id                      = 22;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id               = $oc->id;
                    $move->estadoOrdenCompra_id         = 22;
                    $move->fecha                        = $oc->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Anulada con éxito !');
        }   

        // Confirmar Órden de Compra
        else if ($request->flag == 'ConfirmarOC') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->estado_id                      = 23;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id               = $oc->id;
                    $move->estadoOrdenCompra_id         = 23;
                    $move->fecha                        = $oc->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Confirmada con éxito !');
        }     

        

        // Ingresamos la Cantidad Entregada de un Producto
        else if ($request->flag == 'EntregarProductos') {


            $detalleSolicitud = DetailSolicitud::findOrFail($id);
            $suma = $detalleSolicitud->cantidadEntregada;
            $suma = $suma + $request->cantidadEntregada;

            //dd($suma);

            if ($detalleSolicitud->cantidad >= $suma) {
                        
                $detalleSolicitud->cantidadEntregada    = $suma;
                $detalleSolicitud->userDeliver_id       = Auth::user()->id;
                $detalleSolicitud->fechaEntrega         = $detalleSolicitud->updated_at;
                $detalleSolicitud->obsEntrega           = strtoupper($request->observacion);

                $detalleSolicitud->save(); //Guardamos la solicitud

                return back();

            }else{

                return back()->with('danger', 'La Cantidad Entregada No puede ser mayor a la Solicitada');
            }

        }

        // Recepcionar TODOS los Productos de la Órden de Compra 
        else if ($request->flag == 'RecepcionarTodosProductosOC') {

            try {

                DB::beginTransaction();

                    $dateCarbon = Carbon::now();

                    //Traemos todos los productos de la OC
                    $fullRecepction = DB::table('detail_solicituds')
                                    ->where('detail_solicituds.ordenCompra_id', '=', $id)
                                    ->count();

                    $parcialReception = DB::table('detail_solicituds')
                                        ->where('detail_solicituds.ordenCompra_id', '=', $id)
                                        ->where('detail_solicituds.obsRecepcion', '=', null)
                                        ->count();

                    if ($fullRecepction == $parcialReception) {
                        
                        $dSolicitud = DetailSolicitud::where('ordenCompra_id', $id);
                        $dSolicitud->update(['userReceive_id' => Auth::user()->id, 'fechaRecepcion' => $dateCarbon]);                      
                        //Buscamos la Solicitud relacionada con la OC a recepcionar
                        $s = DB::table('solicituds')
                                    ->join('detail_solicituds', 'solicituds.id', 'detail_solicituds.solicitud_id')
                                    ->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                                    ->where('detail_solicituds.ordenCompra_id', '=', $id)
                                    ->first();

                        //Actualizmos el estado de la Solicitud
                        $solicitud = Solicitud::findOrFail($s->solicitud_id);            
                        $solicitud->estado_id                   = 9;
                        $solicitud->save();

                        //Guardamos el Movimientos de la Solicitud
                        $move = new MoveSolicitud;
                        $move->solicitud_id                     = $solicitud->id;
                        $move->estadoSolicitud_id               = 9;
                        $move->fecha                            = $solicitud->updated_at;
                        $move->user_id                          = Auth::user()->id;
                        $move->save();

                        //Actualizamos el estado de la OC
                        $oc = OrdenCompra::findOrFail($s->id);
                        //dd($oc);
                        $oc->estado_id                          = 19;
                        $oc->save();


                        

                        //Guardamos el Movimientos de la OC
                        $move = new MoveOC;
                        $move->ordenCompra_id                   = $oc->id;
                        $move->estadoOrdenCompra_id             = 19;
                        $move->fecha                            = $oc->updated_at;
                        $move->user_id                          = Auth::user()->id;
                        $move->save();      

                    }else{

                        //Buscamos la Solicitud relacionada con la OC a recepcionar
                        $s = DB::table('solicituds')
                                    ->join('detail_solicituds', 'solicituds.id', '=', 'detail_solicituds.solicitud_id')
                                    ->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                                    ->where('orden_compras.id', '=', $id)
                                    ->first();

                        //dd($solicitud->id);
                        //Actualizmos el estado de la Solicitud
                        $solicitud = Solicitud::findOrFail($s->id);            
                        $solicitud->estado_id                   = 9;
                        $solicitud->save();

                        //Actualizamos el estado de la OC
                        $oc = OrdenCompra::findOrFail($id);
                        $oc->estado_id                          = 24;
                        $oc->save();


                        //Guardamos el Movimientos de la Solicitud
                        $move = new MoveSolicitud;
                        $move->solicitud_id                     = $solicitud->id;
                        $move->estadoSolicitud_id               = 9;
                        $move->fecha                            = $solicitud->updated_at;
                        $move->user_id                          = Auth::user()->id;
                        $move->save();

                        //Guardamos el Movimientos de la OC
                        $move = new MoveOC;
                        $move->ordenCompra_id                   = $oc->id;
                        $move->estadoOrdenCompra_id             = 24;
                        $move->fecha                            = $oc->updated_at;
                        $move->user_id                          = Auth::user()->id;
                        $move->save();      

                    }

                    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Productos de Órden de Compra Recepcionados con éxito !');
        }  

        // Recepcionar Producto a Producto la Órden de Compra 
        else if ($request->flag == 'RecepcionarProductoOrdenCompra') {

            try {

                DB::beginTransaction();

                    $dateCarbon = Carbon::now();

                    $dSolicitud = DetailSolicitud::findOrFail($id);

                    $dSolicitud->fechaRecepcion         = $dateCarbon;
                    $dSolicitud->userReceive_id         = Auth::user()->id;
                    $dSolicitud->obsRecepcion           = $request->obsRecepcion;

                    $dSolicitud->save();

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return back()->with('info', 'Producto Recepcionado con Obervaciones!');
        }  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenCompra $ordenCompra)
    {
        //
    }

}
