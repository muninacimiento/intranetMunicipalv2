<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

use App\OrdenCompra;

use App\MoveOC;

/* Invocamos el modelo de la Entidad DetalleSolicitud*/
use App\DetailSolicitud;

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
        
        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $ordenesCompra = DB::table('orden_compras')
                    ->join('users', 'orden_compras.user_id', '=', 'users.id')
                    ->join('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                    ->join('proveedores', 'orden_compras.proveedor_id', '=', 'proveedores.id')
                    ->select('orden_compras.*', 'users.name as Comprador', 'status_o_c_s.estado as Estado', 'proveedores.razonSocial as RazonSocial')
                    ->orderBy('orden_compras.id', 'desc')
                    ->get();

        $proveedores = DB::table('proveedores')
                    ->select(DB::raw('CONCAT(proveedores.id, " ) ", proveedores.razonSocial) as RazonSocial'), 'proveedores.id')
                    ->get();

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
                ->select('status_o_c_s.estado as status', 'users.name as name', 'move_o_c_s.created_at as date')
                ->where('move_o_c_s.ordenCompra_id', '=', $id)
                ->get();

        $detalleSolicitud = DB::table('detail_solicituds')
                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    ->select('detail_solicituds.*', 'products.name as Producto', DB::raw('(detail_solicituds.cantidad * detail_solicituds.valorUnitario) as SubTotal'))
                     ->where('solicituds.id', '=', $ordenCompra->solicitud1) //Revisar la vista y el envio de los datos a la tabla de Detalle de la Solicitud
                     ->orWhere('solicituds.id', '=', $ordenCompra->solicitud2)
                    ->get();    

                    //dd($detalleSolicitud);

                     /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.ordenCompra.show', compact('ordenCompra', 'dateCarbon', 'proveedores', 'move', 'detalleSolicitud'));

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

        $proveedores = DB::table('proveedores')
                    ->select(DB::raw('CONCAT(proveedores.id, " ) ", proveedores.razonSocial) as RazonSocial'), 'proveedores.id')
                    ->get();

        $move = DB::table('move_o_c_s') 
                ->join('status_o_c_s', 'move_o_c_s.estadoOrdenCompra_id', 'status_o_c_s.id')               
                ->join('users', 'move_o_c_s.user_id', 'users.id')
                ->select('status_o_c_s.estado as status', 'users.name as name', 'move_o_c_s.created_at as date')
                ->where('move_o_c_s.ordenCompra_id', '=', $id)
                ->get();

        $detalleSolicitud = DB::table('detail_solicituds')
                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    ->select('detail_solicituds.*', 'products.name as Producto', DB::raw('(detail_solicituds.cantidad * detail_solicituds.valorUnitario) as SubTotal'))
                     ->where('solicituds.id', '=', $ordenCompra->solicitud1) //Revisar la vista y el envio de los datos a la tabla de Detalle de la Solicitud
                     ->orWhere('solicituds.id', '=', $ordenCompra->solicitud2)
                    ->get();    

                    //dd($detalleSolicitud);

                     /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.ordenCompra.validar', compact('ordenCompra', 'dateCarbon', 'proveedores', 'move', 'detalleSolicitud'));

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

        if ($request->flag == 'Actualizar') {

            $oc = OrdenCompra::findOrFail($id);
            $oc->user_id                        = Auth::user()->id;
            $oc->ordenCompra_id                 = $request->ordenCompra_id;
            $oc->iddoc                          = $request->iddoc;
            $oc->proveedor_id                   = $request->flagIdProveedor;
            $oc->estado_id                      = 1;
            $oc->tipoOrdenCompra                = $request->tipoOrdenCompra;
            $oc->valorEstimado                  = $request->valorEstimado;
            $oc->totalOrdenCompra               = $request->totalOrdenCompra;
            $oc->excepcion                      = $request->excepcion;
            $oc->deptoRecepcion                 = $request->deptoReceptor;
                
            $oc->save(); //Guardamos la OC

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Actualizada con éxito!');

        }

        else if ($request->flag == 'Asignar') {

            $oc = OrdenCompra::findOrFail($id);

            if ($oc->solicitud1 == null) {
            
                $oc->solicitud1                     = $request->solicitud_ID;
                
                $oc->save(); //Guardamos la OC
                
            }
            else if ($oc->solicitud2 == null) {
                
                $oc->solicitud2                     = $request->solicitud_ID;
                
                $oc->save(); //Guardamos la OC

            }
            

            return redirect('/siscom/ordenCompra')->with('info', 'Solicitud Asignada con éxito!');
        }

        // Actualizamos la OC en el Producto
        else if ($request->flag == 'AsignarTodosOC') {

            $oc = OrdenCompra::findOrFail($id);

            $detalleSolicitud = DB::table('detail_solicituds')
                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    ->select('detail_solicituds.ordenCompra_id')
                     ->where('solicituds.id', '=', $oc->solicitud1) 
                     ->orWhere('solicituds.id', '=', $oc->solicitud2)
                    ->get();    

            //dd($detalleSolicitud);

            foreach ($detalleSolicitud as $ds) {

                $dSol = new DetailSolicitud;
                
                $dSol->ordenCompra_id = $request->ordenCompraID;

                //dd($ds);

                $dSol->push(); //Guardamos la Solicitud

            }


            return back();

        } 

        /*else if ($request->flag == 'Asignar2') {

            $oc = OrdenCompra::findOrFail($id);
            $oc->solicitud2                     = $request->solicitud_2_ID;
                
            $oc->save(); //Guardamos la OC

            return redirect('/siscom/ordenCompra')->with('info', 'Solicitud Asignada con éxito!');
        }*/

        // Recepcionar Órden de Compra
        else if ($request->flag == 'Recepcionar') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->user_id                        = Auth::user()->id;
                    $oc->estado_id                      = 2;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                     = $oc->id;
                    $move->estadoOrdenCompra_id               = 2 ;
                    $move->fecha                            = $oc->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Anulada con éxito !');
        }  

        // Revisión Órden de Compra C&S
        else if ($request->flag == 'AprobadaC&S') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->user_id                        = Auth::user()->id;
                    $oc->estado_id                      = 3;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                     = $oc->id;
                    $move->estadoOrdenCompra_id               = 3 ;
                    $move->fecha                            = $oc->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Aprobada por C&S con éxito !');
        } 

        // Revisión Órden de Compra C&S
        else if ($request->flag == 'RechazadaC&S') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->user_id                        = Auth::user()->id;
                    $oc->estado_id                      = 2;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                = $oc->id;
                    $move->estadoOrdenCompra_id          = 4 ;
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

        // Revisión Órden de Compra C&S
        else if ($request->flag == 'AprobadaProfDAF') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->user_id                        = Auth::user()->id;
                    $oc->estado_id                      = 5;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id               = $oc->id;
                    $move->estadoOrdenCompra_id         = 5 ;
                    $move->fecha                        = $oc->updated_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Aprobada por C&S con éxito !');
        } 

        // Revisión Órden de Compra C&S
        else if ($request->flag == 'RechazadaProfDAF') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->user_id                        = Auth::user()->id;
                    $oc->estado_id                      = 3;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                = $oc->id;
                    $move->estadoOrdenCompra_id          = 6 ;
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

        // Anular Órden de Compra
        else if ($request->flag == 'Anular') {

            try {

                DB::beginTransaction();

                    $oc = OrdenCompra::findOrFail($id);
                    $oc->user_id                        = Auth::user()->id;
                    $oc->motivoAnulacion                = $request->motivoAnulacion;
                    $oc->estado_id                      = 16;

                    //dd($solicitud);

                    $oc->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveOC;
                    $move->ordenCompra_id                     = $oc->id;
                    $move->estadoOrdenCompra_id               = 16;
                    $move->fecha                            = $oc->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Anulada con éxito !');
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
