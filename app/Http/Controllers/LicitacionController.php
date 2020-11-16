<?php

namespace App\Http\Controllers;
use App\Licitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;
use App\MoveLicitacion;
use App\AssignRequestToLicitacion;
use App\DetailSolicitud;
use App\Solicitud;
/* Invocamos el modelo de la Entidad Movimiento de la Solicitud*/
use App\MoveSolicitud;
use DB;

class LicitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        $ocs = DB::table('orden_compras')
        ->select(DB::raw('CONCAT(orden_compras.id, " ) ", orden_compras.ordenCompra_id) as OC'), 'orden_compras.id')
        ->get();

        $licitaciones = DB::table('licitacions')
        ->join('status_licitacions', 'licitacions.estado_id', '=', 'status_licitacions.id')
        ->leftjoin('orden_compras', 'licitacions.ordenCompra_id', 'orden_compras.id')
        ->select('licitacions.*', 'status_licitacions.estado as Estado', 'orden_compras.ordenCompra_id as NoOC')
        ->get();
//dd(Auth::user()->id);

        return view('siscom.licitacion.index', compact('licitaciones', 'dateCarbon', 'ocs'));
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
                $licitacion = new Licitacion;
                $licitacion->user_id                        = Auth::user()->id;
                $licitacion->licitacion_id                  = $request->licitacion_id;
                $licitacion->iddoc                          = $request->iddoc;
                $licitacion->valorEstimado                  = $request->valorEstimado;
                $licitacion->proposito                      = strtoupper($request->proposito);
                $licitacion->estado_id                      = 1;
                
                
                $licitacion->save(); //Guardamos la OC

                //Guardamos los datos de Movimientos de la OC
                $move = new MoveLicitacion;
                $move->licitacion_id               = $licitacion->id;
                $move->estadoLicitacion_id         = 1;
                $move->fecha                        = $licitacion->created_at;
                $move->user_id                      = Auth::user()->id;

                $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                DB::rollback();                
            }            
            return redirect('/siscom/licitacion')->with('info', 'Licitación Creada con Éxito !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $licitacion = DB::table('licitacions')
        ->join('status_licitacions', 'licitacions.estado_id', 'status_licitacions.id')
        ->select('licitacions.*', 'status_licitacions.estado as Estado')
        ->where('licitacions.id', $id)
        ->first();

        $move = DB::table('move_licitacions') 
        ->join('status_licitacions', 'move_licitacions.estadoLicitacion_id', 'status_licitacions.id')               
        ->join('users', 'move_licitacions.user_id', 'users.id')
        ->select('status_licitacions.estado as status', 'users.name as name', 'move_licitacions.*')
        ->where('move_licitacions.licitacion_id', $id)
        ->get();

        $detalleSolicitud = DB::table('detail_solicituds')
        ->join('products', 'detail_solicituds.product_id', 'products.id')
        ->join('solicituds', 'detail_solicituds.solicitud_id', 'solicituds.id')
        //->join('assign_request_to_licitacions', 'detail_solicituds.solicitud_id', '=', 'assign_request_to_licitacions.solicitud_id')
        //->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
        ->select('detail_solicituds.*', 'products.name as Producto')
        ->where('detail_solicituds.licitacion_id', $id)
        ->get();  
//dd($id);

        return view('siscom.licitacion.show', compact('licitacion', 'move', 'detalleSolicitud'));
    }

    public function agregarProductos($id, Request $request)
    {
        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $licitacion = DB::table('licitacions')
        ->join('status_licitacions', 'licitacions.estado_id', 'status_licitacions.id')
        ->select('licitacions.*', 'status_licitacions.estado as Estado')
        ->where('licitacions.id', $id)
        ->first();

        $detalleSolicitud = DB::table('detail_solicituds')
        ->join('products', 'detail_solicituds.product_id', 'products.id')
        ->join('solicituds', 'detail_solicituds.solicitud_id', 'solicituds.id')
        ->join('assign_request_to_licitacions', 'detail_solicituds.solicitud_id', 'assign_request_to_licitacions.solicitud_id')
        //->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
        ->select('detail_solicituds.*', 'products.name as Producto')
        ->where('assign_request_to_licitacions.licitacion_id',  $licitacion->id)
        ->get();     

        $existeLicitacion = DetailSolicitud::where('licitacion_id', $id)->count();

        $solicitudNo = $request->numeroSolicitud;

        //dd($existeOC);
        return view('siscom.licitacion.agregarProductos', compact('licitacion', 'dateCarbon', 'detalleSolicitud', 'solicitudNo', 'existeLicitacion'));
    }

    public function buscarSolicitud(Request $request, $id)
    {
        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $licitacion = DB::table('licitacions')
        ->join('status_licitacions', 'licitacions.estado_id', 'status_licitacions.id')
        ->select('licitacions.*', 'status_licitacions.estado as Estado')
        ->where('licitacions.id', $id)
        ->first();
        
        $detalleSolicitud = DB::table('detail_solicituds')
        ->join('products', 'detail_solicituds.product_id', 'products.id')
        ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
        //->join('assign_request_to_o_c_s', 'detail_solicituds.solicitud_id', '=', 'assign_request_to_o_c_s.solicitud_id')
        //->join('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
        ->select('detail_solicituds.*', 'products.name as Producto')
        ->where('detail_solicituds.solicitud_id', $request->numeroSolicitud)
        ->get();   

        $existeLicitacion = DetailSolicitud::where('licitacion_id', $id)->count();

        $solicitudNo = $request->numeroSolicitud;
//dd($id);
                    
        return view('siscom.licitacion.agregarProductos', compact('licitacion', 'dateCarbon', 'detalleSolicitud', 'solicitudNo', 'existeLicitacion'));
    }

    public function validar($id)
    {
        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $ordenCompra = DB::table('orden_compras')
        ->join('users', 'orden_compras.user_id', 'users.id')
        ->join('status_o_c_s', 'orden_compras.estado_id', 'status_o_c_s.id')
        ->join('proveedores', 'orden_compras.proveedor_id', 'proveedores.id')
        ->select('orden_compras.*', 'users.name as Comprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial')
        ->where('orden_compras.id', $id)
        ->first();

        $proveedores = DB::table('proveedores')
        ->select(DB::raw('CONCAT(proveedores.id, " ) ", proveedores.razonSocial) as RazonSocial'), 'proveedores.id')
        ->get();

        $licitacion = DB::table('licitacions')
        ->join('status_licitacions', 'licitacions.estado_id', 'status_licitacions.id')
        ->select('licitacions.*', 'status_licitacions.estado as Estado')
        ->where('licitacions.id', $id)
        ->first();

        $move = DB::table('move_licitacions') 
        ->join('status_licitacions', 'move_licitacions.estadoLicitacion_id', 'status_licitacions.id')               
        ->join('users', 'move_licitacions.user_id', 'users.id')
        ->select('status_licitacions.estado as status', 'users.name as name', 'move_licitacions.*')
        ->where('move_licitacions.licitacion_id', $id)
        ->get();

        $assign = DB::table('assign_request_to_licitacions')
        ->join('licitacions', 'assign_request_to_licitacions.licitacion_id', 'licitacions.id')
        ->select('assign_request_to_licitacions.*', 'licitacions.licitacion_id as NoOC')
        ->where('assign_request_to_licitacions.licitacion_id', $licitacion->id)
        ->get();

        $detalleSolicitud = DB::table('detail_solicituds')
        ->join('products', 'detail_solicituds.product_id', 'products.id')
        ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
        //->join('assign_request_to_licitacions', 'detail_solicituds.solicitud_id', '=', 'assign_request_to_licitacions.solicitud_id')
        ->join('licitacions', 'detail_solicituds.licitacion_id', '=', 'licitacions.id')
        ->select('detail_solicituds.*', 'products.name as Producto')
        ->where('detail_solicituds.licitacion_id', '=', $id)
        ->get();    
//dd($licitacion);

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.licitacion.validar', compact('licitacion', 'dateCarbon', 'move', 'detalleSolicitud', 'assign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Licitacion $licitacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->flag == 'Actualizar') {            
            $licitacion = Licitacion::findOrFail($id);
            $licitacion->licitacion_id                  = $request->licitacion_id;
            $licitacion->iddoc                          = $request->iddoc;
            $licitacion->valorEstimado                  = $request->valorEstimado;
            $licitacion->proposito                      = strtoupper($request->proposito);

            $licitacion->save();

            return redirect('/siscom/licitacion')->with('info', 'Licitación Actualizada con Éxito !');
        }
        //Asignamos las Solicitudes que proveerán de los Productos para la Órden de Compra
        else if ($request->flag == 'Asignar') {
            try {
                DB::beginTransaction();

                    $year = Carbon::now();

                    //Asignamos la Solicitud a la Órden de Compra
                    $assign = new AssignRequestToLicitacion;
                    $assign->licitacion_id             = $id;
                    $assign->solicitud_id               = $request->solicitud_id_assign;
                    $assign->year                       = $year->format('Y');

                    $assign->save();

                    //Cambiamos el Estado de la Solicitud a "En Proceso de Compra"
                    $solicitud = Solicitud::findOrFail($request->solicitud_id_assign);
                    $solicitud->estado_id               = 8;

                    $solicitud->save();

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $request->solicitud_id_assign;
                    $move->estadoSolicitud_id               = 8;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                DB::rollback();
                return redirect('/siscom/licitacion')->with('info', 'No se ha podido asignar la Solicitud a la Licitación');
            }
            return redirect('/siscom/licitacion')->with('info', 'Solicitud Asignada con éxito!');
        }
        // Confirmar Órden de Compra
        else if ($request->flag == 'ConfirmarLicitacion') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                      = 39;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 39;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Confirmada con éxito !');
        }
        // Confirmar Órden de Compra
        else if ($request->flag == 'AnularLicitacion') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                      = 38;
                    $licitacion->motivoAnulacion                = $request->motivoAnulacion;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 38;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Anulada con éxito !');
        }
        // Recepcionar y Órden de Compra en Revisión por C&S
        else if ($request->flag == 'RecepcionarLicitacion') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                              = 2;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 2;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Recepcionada con éxito !');
        }  
        // Aprobada por C&S
        else if ($request->flag == 'AprobadaC&S') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                              = 6;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 4;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    


                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Aprobada por C&S con éxito !');
        } 
        //Rechazada por C&S
        else if ($request->flag == 'RechazadaC&S') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                              = 3;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 5;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;
                    $move->obsRechazoValidacion          = $request->motivoRechazo;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Rechazada por C&S con éxito !');
        }   
        //Aprobada por Profesinoal DAF
        else if ($request->flag == 'AprobadaProfDAF') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                              = 9;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 7;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Aprobada por Profesinal DAF con éxito !');
        } 
        // Rechazada por Profesinoal DAF
        else if ($request->flag == 'RechazadaProfDAF') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                              = 3;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 8;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;
                    $move->obsRechazoValidacion          = $request->motivoRechazo;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Rechazada por Profesional DAF con éxito !');
        } 
        //Órden de compra en Firma DAF
        else if ($request->flag == 'FirmadaPorDAF') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);

                    if ($licitacion->valorEstimado == 'Menor o Igual a 100 UTM' || $licitacion->valorEstimado == 'Mayor a 100 y Menor a 500 UTM') {
                        
                        $licitacion->estado_id                      = 15;

                        //dd($solicitud);

                        $licitacion->save(); //Guardamos la Solicitud

                       //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveLicitacion;
                        $move->licitacion_id                = $licitacion->id;
                        $move->estadoLicitacion_id          = 10;
                        $move->fecha                        = $licitacion->updated_at;
                        $move->user_id                      = Auth::user()->id;

                        $move->save(); //Guardamos el Movimiento de la Solicitud    


                        $move->save(); //Guardamos el Movimiento de la Solicitud    
                    
                    }
                    else if ($licitacion->valorEstimado == 'Mayor o Igual a 500 UTM') {
                        
                        $licitacion->estado_id                      = 12;

                        //dd($solicitud);

                        $licitacion->save(); //Guardamos la Solicitud

                       //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveLicitacion;
                        $move->licitacion_id                = $licitacion->id;
                        $move->estadoLicitacion_id          = 10;
                        $move->fecha                        = $licitacion->updated_at;
                        $move->user_id                      = Auth::user()->id;

                        $move->save(); //Guardamos el Movimiento de la Solicitud    

                    }

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Firmada por DAF con éxito !');
        }
        // Rechazada por DAF
        else if ($request->flag == 'RechazadaDAF') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                              = 3;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 11;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;
                    $move->obsRechazoValidacion          = $request->motivoRechazo;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Rechazada por DAF con éxito !');
        }
        //Aprobada por Profesinoal DAF
        else if ($request->flag == 'FirmadaPorControl') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                              = 15;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 13;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Aprobada por Dirección de Control con éxito !');
        } 
        // Rechazada por Profesinoal DAF
        else if ($request->flag == 'RechazadaControl') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                              = 3;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 14;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;
                    $move->obsRechazoValidacion          = $request->motivoRechazo;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Rechazada por Dirección de Control con éxito !');
        } 
        //Aprobada por Profesinoal DAF
        else if ($request->flag == 'FirmadaPorAdministracion') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                              = 17;
                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 16;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Aprobada por Administración con éxito !');
        } 
        //Publicar Licitación
        else if ($request->flag == 'PublicarLicitacion') {
            try {
                DB::beginTransaction();

                    $fechaPublicacion = Carbon::now();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id              = 18;
                    $licitacion->fechaPublicacion       = $fechaPublicacion;
                    $licitacion->fechaCierre            = $request->fechaCierre;
                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 18;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Publicada con éxito !');
        } 
        /*
         * EVALUACIÓN DE LA ADJUDICACIÓN
         */

        // Recepcionar y Órden de Compra en Revisión por C&S
        else if ($request->flag == 'RecepcionarAdjudicacionLicitacion') {
            try {
                DB::beginTransaction();

                    $licitacionC = Licitacion::findOrFail($id);

                    //Actualizamos el Movimiento del Cierre de la Licitacion
                    $moveC = new MoveLicitacion;
                    $moveC->licitacion_id                = $licitacionC->id;
                    $moveC->estadoLicitacion_id          = 19;
                    $moveC->fecha                        = $licitacionC->updated_at;
                    $moveC->user_id                      = 1;

                    $moveC->save(); //Guardamos el Movimiento de la Solicitud    

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                              = 20;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 20;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Recepcionada con éxito !');
        }  
        // Aprobada por C&S
        else if ($request->flag == 'AdjAprobadaC&S') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id              = 24;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 22;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    


                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }

            return redirect('/siscom/licitacion')->with('info', 'Licitación Aprobada por C&S con éxito !');
        } 
        //Rechazada por C&S
        else if ($request->flag == 'AdjRechazadaC&S') {
            try {

                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id              = 21;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 23;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;
                    $move->obsRechazoValidacion         = $request->motivoRechazo;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Rechazada por C&S con éxito !');
        }   
        //Aprobada por Profesinoal DAF
        else if ($request->flag == 'AdjAprobadaProfDAF') {
            try {
                DB::beginTransaction();

                   $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id               = 27;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 25;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Aprobada por Profesinal DAF con éxito !');
        } 
        // Rechazada por Profesinoal DAF
        else if ($request->flag == 'AdjRechazadaProfDAF') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id              = 21;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 26;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;
                    $move->obsRechazoValidacion          = $request->motivoRechazo;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Rechazada por Profesional DAF con éxito !');
        } 
        //Órden de compra en Firma DAF
        else if ($request->flag == 'AdjFirmadaPorDAF') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);

                    if ($licitacion->valorEstimado == 'Menor o Igual a 100 UTM') {
                        
                        $licitacion->estado_id               = 32;

                        //dd($solicitud);

                        $licitacion->save(); //Guardamos la Solicitud

                       //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveLicitacion;
                        $move->licitacion_id                = $licitacion->id;
                        $move->estadoLicitacion_id          = 28;
                        $move->fecha                        = $licitacion->updated_at;
                        $move->user_id                      = Auth::user()->id;

                        $move->save(); //Guardamos el Movimiento de la Solicitud    


                        $move->save(); //Guardamos el Movimiento de la Solicitud    
                    
                    }
                    else if ($licitacion->valorEstimado == 'Mayor a 100 y Menor a 500 UTM' || $licitacion->valorEstimado == 'Mayor o Igual a 500 UTM') {
                        
                        $licitacion->estado_id               = 30;

                        //dd($solicitud);

                        $licitacion->save(); //Guardamos la Solicitud

                       //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveLicitacion;
                        $move->licitacion_id                = $licitacion->id;
                        $move->estadoLicitacion_id          = 28;
                        $move->fecha                        = $licitacion->updated_at;
                        $move->user_id                      = Auth::user()->id;

                        $move->save(); //Guardamos el Movimiento de la Solicitud    

                    }
                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Firmada por DAF con éxito !');
        }
        // Rechazada por DAF
        else if ($request->flag == 'AdjRechazadaDAF') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id               = 21;

                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 29;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;
                    $move->obsRechazoValidacion         = $request->motivoRechazo;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Rechazada por DAF con éxito !');
        }
        //Aprobada por Profesinoal DAF
        else if ($request->flag == 'AdjFirmadaPorAlcaldia') {
            try {
                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id              = 34;
                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 31;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Aprobada por Alcadía con éxito !');
        } 
        //Aprobada por Profesinoal DAF
        else if ($request->flag == 'AdjFirmadaPorAdministracion') {
            try {

                DB::beginTransaction();

                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id              = 34;
                    //dd($solicitud);

                    $licitacion->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 33;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Aprobada por Administración con éxito !');
        }
        // Resolver Licitación (Adjudicada-Desierta-Inadmisible-Revocada)
        else if ($request->flag == 'ResolverLicitacion') {
            try {

                DB::beginTransaction();

                $fechaResolucion = Carbon::now()->format('Y-m-d');

                //Preguntar si es Adjudicada
                if ($request->Resolucion == 'Adjudicada') {
                    
                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                      = 35;
                    $licitacion->ordenCompra_id                 = $request->ordenCompra_id;
                    $licitacion->fechaResolucion                = $fechaResolucion;

                    $licitacion->save();

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 35;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    
                }
                //Preguntar si es Desierta
                else if($request->Resolucion == 'Desierta'){
                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                      = 36;
                    $licitacion->fechaResolucion                = $fechaResolucion;

                    $licitacion->save();

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 36;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save();
                }                
                //Preguntar si es Inadmisible
                else if($request->Resolucion == 'Inadmisible'){
                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                      = 37;
                    $licitacion->fechaResolucion                = $fechaResolucion;

                    $licitacion->save();

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 37;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save();
                }
                //Preguntar si es Revocada
                else if($request->Resolucion == 'Revocada'){
                    $licitacion = Licitacion::findOrFail($id);
                    $licitacion->estado_id                      = 40;
                    $licitacion->fechaResolucion                = $fechaResolucion;

                    $licitacion->save();

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveLicitacion;
                    $move->licitacion_id                = $licitacion->id;
                    $move->estadoLicitacion_id          = 40;
                    $move->fecha                        = $licitacion->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save();
                }
                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/licitacion')->with('info', 'Licitación Confirmada con éxito !');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Licitacion  $licitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licitacion $licitacion)
    {
        //
    }
}
