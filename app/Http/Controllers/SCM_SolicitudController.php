<?php


/*
 *  JFuentealba @itux
 *  created at October 04, 2019 - 09:52 am
 *  updated at November 11, 2019 - 12:05 pm
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* Invocamos la clase para exportar la vista a un archivo PDF */
use Barryvdh\DomPDF\Facade as PDF;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

/* Invocamos el modelo de la Entidad */
use App\Solicitud;

/* Invocamos el modelo de la Entidad DetalleSolicitud*/
use App\DetailSolicitud;

/* Invocamos el modelo de la Entidad Movimiento de la Solicitud*/
use App\MoveSolicitud;

/* Invocamos el modelo de la Entidad Actividad*/
use App\Activity;

/* Invocamos el modelo de la Entidad Product*/
use App\Product;

use App\User;
use DB;


class SCM_SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $solicituds = DB::table('solicituds')
                    ->join('status_solicituds', 'solicituds.estado_id', '=', 'status_solicituds.id')
                    ->join('users', 'solicituds.user_id', '=', 'users.id')
                    ->select('solicituds.*', 'status_solicituds.estado')
                    ->orderBy('solicituds.id', 'desc')
                    ->where('solicituds.user_id', '=', Auth::user()->id)
                    ->orWhere('users.dependency_id', '=', Auth::user()->dependency_id)
                    ->get();

                   // dd($solicituds);

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.solicitud.index', ['solicituds' => $solicituds, 'dateCarbon' => $dateCarbon]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Guardamos el ENCABEZADO Solicitud y la Actividad si es que existe!!!
        if ($request->flag == 'Solicitud') {



            try {

                DB::beginTransaction();

                //Comenzamos a capturar desde la vista los datos a guardar de la SOLICITUD
                $solicitud = new Solicitud;
                $solicitud->user_id                     = Auth::user()->id;
                $solicitud->motivo                      = strtoupper($request->motivo);
                $solicitud->tipoSolicitud               = $request->tipoSolicitud;
                $solicitud->categoriaSolicitud          = $request->categoriaSolicitud;
                $solicitud->decretoPrograma             = $request->decretoPrograma;
                $solicitud->nombrePrograma              = strtoupper($request->nombrePrograma);
                $solicitud->estado_id                   = 1;

                //Actividad
                $solicitud->nombreActividad             = strtoupper($request->nombreActividad);
                $solicitud->fechaActividad              = $request->fechaActividad;
                $solicitud->horaActividad               = $request->horaActividad;
                $solicitud->lugarActividad              = strtoupper($request->lugarActividad);
                $solicitud->objetivoActividad           = strtoupper($request->objetivoActividad);
                $solicitud->descripcionActividad        = strtoupper($request->descripcionActividad);
                $solicitud->participantesActividad      = strtoupper($request->participantesActividad);
                $solicitud->cuentaPresupuestaria        = $request->cuentaPresupuestaria;
                $solicitud->cuentaComplementaria        = $request->cuentaComplementaria;
                $solicitud->obsActividad                = strtoupper($request->obsActividad);

                $solicitud->save(); //Guardamos la Solicitud    

                //Guardamos los datos de Movimientos de la Solicitud
                $move = new MoveSolicitud;
                $move->solicitud_id                     = $solicitud->id;
                $move->estadoSolicitud_id               = 1;
                $move->fecha                            = $solicitud->created_at;
                $move->user_id                          = Auth::user()->id;

                $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit(); //Ejecutamos ambas sentencias y si todo resulta OK, guarda, sino ejecuta el catch
                
            } catch (Exception $e) {

                DB::rollback();
                
            }
            
            return redirect('/siscom/solicitud')->with('info', 'Solicitud Creada con Éxito !');

        }
        // Guardamos los Productos que el Usuario Solicitará
        else if ($request->flag == 'detalleSolicitud') {

            //Comenzamos a capturar desde la vista los datos a guardar del DETALLE DE LA SOLICITUD
            $detalleSolicitud = new DetailSolicitud;
            $detalleSolicitud->solicitud_id         = $request->solicitudID;
            $detalleSolicitud->product_id           = $request->flagIdProducto;
            $detalleSolicitud->cantidad             = $request->flagCantidad;
            $detalleSolicitud->especificacion       = strtoupper($request->flagEspecificacion);
            $detalleSolicitud->valorUnitario        = $request->flagValorUnitario;

            $detalleSolicitud->save();

            return back();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         /*
         * Declaramos un Objeto para obtener acceso a los datos de la tabla DetalleSolicitud
         */
        $detalleSolicitud = DB::table('detail_solicituds')
                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    ->leftjoin('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                    ->leftjoin('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                    ->leftjoin('licitacions', 'detail_solicituds.licitacion_id', '=', 'licitacions.id')
                    ->leftjoin('status_licitacions', 'licitacions.estado_id', '=', 'status_licitacions.id')
                    ->select('detail_solicituds.*', 'products.name as Producto', DB::raw('(detail_solicituds.cantidad * detail_solicituds.valorUnitario) as SubTotal'), 'orden_compras.ordenCompra_id as NoOC', 'status_o_c_s.estado as EstadoOC', 'licitacions.licitacion_id as NoLicitacion', 'status_licitacions.estado as EstadoLicitacion')
                     ->where('solicituds.id', '=', $id) //Revisar la vista y el envio de los datos a la tabla de Detalle de la Solicitud
                    ->get();

        $products = DB::table('products as productos')
                    ->select(DB::raw('CONCAT(productos.id, " ) ", productos.name) as Producto'), 'productos.id')
                    ->get();

        $solicitud = DB::table('solicituds')
                   ->join('users', 'solicituds.user_id', '=', 'users.id')
                   ->join('status_solicituds', 'solicituds.estado_id', '=', 'status_solicituds.id')
                   ->select('solicituds.*', 'users.name as nameUser', 'status_solicituds.estado')
                   ->where('solicituds.id', '=', $id)
                   ->first();

         $move = DB::table('move_solicituds') 
                ->join('status_solicituds', 'move_solicituds.estadoSolicitud_id', 'status_solicituds.id')               
                ->join('users', 'move_solicituds.user_id', 'users.id')
                ->select('status_solicituds.estado as status', 'users.name as name', 'move_solicituds.created_at as date')
                ->where('move_solicituds.solicitud_id', '=', $id)
                ->get();

        //dd($detalleSolicitud);

        return view('siscom.solicitud.show', compact('solicitud', 'products', 'detalleSolicitud', 'move'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // Actualizar ENCABEZADO Solicitud Interna
        if ($request->flag == 'ActualizarInterna') {

            $solicitud = Solicitud::findOrFail($id);
            $solicitud->motivo                      = strtoupper($request->motivo);
            $solicitud->tipoSolicitud               = $request->tipoSolicitud;
            $solicitud->categoriaSolicitud          = $request->categoriaSolicitud;

            //dd($solicitud);

            $solicitud->save(); //Guardamos la Solicitud

            return redirect('/siscom/solicitud')->with('info', 'Solicitud Actualizada con éxito !');
        }

        else // Actualizar ENCABEZADO Solicitud Programa
        if ($request->flag == 'ActualizarPrograma') {

            $solicitud = Solicitud::findOrFail($id);
            $solicitud->motivo                      = strtoupper($request->motivo);
            $solicitud->tipoSolicitud               = $request->tipoSolicitud;
            $solicitud->categoriaSolicitud          = $request->categoriaSolicitud;
            $solicitud->decretoPrograma             = $request->decretoPrograma;
            $solicitud->nombrePrograma              = strtoupper($request->nombrePrograma);

            //dd($solicitud);

            $solicitud->save(); //Guardamos la Solicitud

            return redirect('/siscom/solicitud')->with('info', 'Solicitud Actualizada con éxito !');
        }

        // Anular Solicitud
        else if ($request->flag == 'Anular') {

            try {

                DB::beginTransaction();

                    $solicitud = Solicitud::findOrFail($id);
                    $solicitud->motivoAnulacion            = strtoupper($request->motivoAnulacion);
                    $solicitud->estado_id                  = 12;

                    //dd($solicitud);

                    $solicitud->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $solicitud->id;
                    $move->estadoSolicitud_id               = 12;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                db::rollback();
                
            }

            return redirect('/siscom/solicitud')->with('info', 'Solicitud Anulada con éxito !');
        }    

        // Confirmar Solicitud
        else if ($request->flag == 'Confirmar') {

            try {

                DB::beginTransaction();

                    $solicitud = Solicitud::findOrFail($id);
                    $solicitud->estado_id                   = 2;
                    $solicitud->total                       = $request->totalSolicitud;

                    //dd($solicitud);

                    $solicitud->save(); //Guardamos la Solicitud

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $solicitud->id;
                    $move->estadoSolicitud_id               = 2;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }

            

            return redirect('/siscom/solicitud')->with('info', 'Solicitud Confirmada con éxito !');
        }   

        // Actualizar Actividad
        else if ($request->flag == 'Actividad') {

            $solicitud = Solicitud::findOrFail($id);
            $solicitud->nombreActividad             = strtoupper($request->nombreActividad);
            $solicitud->fechaActividad              = $request->fechaActividad;
            $solicitud->horaActividad               = $request->horaActividad;
            $solicitud->lugarActividad              = strtoupper($request->lugarActividad);
            $solicitud->objetivoActividad           = strtoupper($request->objetivoActividad);
            $solicitud->descripcionActividad        = strtoupper($request->descripcionActividad);
            $solicitud->participantesActividad      = strtoupper($request->participantesActividad);
            $solicitud->cuentaPresupuestaria        = $request->cuentaPresupuestaria;
            $solicitud->cuentaComplementaria        = $request->cuentaComplementaria;
            $solicitud->obsActividad                = strtoupper($request->obsActividad);

            //dd($solicitud);

            $solicitud->save(); //Guardamos la Solicitud

            return back();

        }    
        // Actualizamos Producto del Detalle de la Solicitud
        else if ($request->flag == 'UpdateProducts') {

            $detalleSolicitud = DetailSolicitud::findOrFail($id);

            $detalleSolicitud->cantidad             = $request->Cantidad;
            $detalleSolicitud->especificacion       = strtoupper($request->Especificacion);
            $detalleSolicitud->valorUnitario        = $request->ValorUnitario;        

            //dd($solicitud);

            $detalleSolicitud->save(); //Guardamos la Solicitud

            return back();

        }
        // Eliminamos el Producto del Detalle de la Solicitud
        else if ($request->flag == 'DeleteProduct') {

            $deleteProduct = DetailSolicitud::findOrFail($id);

            //dd($solicitud);

            $deleteProduct->delete(); //Guardamos la Solicitud

            return back();

        }

        // Actualizamos la OC en el Producto
        else if ($request->flag == 'AsignarTodosOC') {

            $detalleSolicitud = DetailSolicitud::where('solicitud_id', $request->noSolicitud)->where('ordenCompra_id', NULL);

            $detalleSolicitud->update(['ordenCompra_id' => $id]); 

            return back();

        } 

        // Actualizamos la OC en el Producto
        else if ($request->flag == 'AsignarOC') {

            $detalleSolicitud = DetailSolicitud::findOrFail($id);

            $detalleSolicitud->ordenCompra_id       = $request->ordenCompraID;       

            //dd($detalleSolicitud);

           $detalleSolicitud->save(); //Guardamos la Solicitud

            return back();

        } 

        // Actualizamos la OC en el Producto
        else if ($request->flag == 'EliminarOC') {

            $detalleSolicitud = DetailSolicitud::findOrFail($id);

            $detalleSolicitud->ordenCompra_id       = null;       

            //dd($solicitud);

            $detalleSolicitud->save(); //Guardamos la Solicitud

            return back();

        } 

        // Actualizamos la OC en el Producto
        else if ($request->flag == 'AsignarLicitacion') {

            $detalleSolicitud = DetailSolicitud::findOrFail($id);

            $detalleSolicitud->licitacion_id       = $request->licitacion_id;       

            //dd($detalleSolicitud);

           $detalleSolicitud->save(); //Guardamos la Solicitud

            return back();

        } 

        // Actualizamos la OC en el Producto
        else if ($request->flag == 'EliminarLicitacion') {

            $detalleSolicitud = DetailSolicitud::findOrFail($id);

            $detalleSolicitud->licitacion_id       = null;       

            //dd($solicitud);

            $detalleSolicitud->save(); //Guardamos la Solicitud

            return back();

        }       

    }

    public function exportarPDF($id)
    {       

        $solicitud = DB::table('solicituds')
                   ->join('users', 'solicituds.user_id', '=', 'users.id')
                   ->join('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                   ->join('status_solicituds', 'solicituds.estado_id', '=', 'status_solicituds.id')
                   ->select('solicituds.*', 'users.name as nameUser', 'dependencies.name as dependencyUser', 'status_solicituds.estado')
                   ->where('solicituds.id', '=', $id)
                   ->first();

        //dd($solicitud); 

        $detalleSolicitud = DB::table('detail_solicituds')
                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    ->select('detail_solicituds.*', 'products.name as Producto', DB::raw('(detail_solicituds.cantidad * detail_solicituds.valorUnitario) as SubTotal'))
                     ->where('solicituds.id', '=', $id) //Revisar la vista y el envio de los datos a la tabla de Detalle de la Solicitud
                    ->get();

        //Consultamos que tipo de Solicitud es para mostrar el PDF correcto


        if ($solicitud) {

            switch ($solicitud->tipoSolicitud) {

                case 'Operacional':

                    $pdf = PDF::loadView('pdf.operacional', compact('solicitud', 'detalleSolicitud'));
                    return $pdf->stream('solicitudSisCoM.pdf');
                    
                    break;

                case 'Actividad':

                    $pdf = PDF::loadView('pdf.actividad', compact('solicitud', 'detalleSolicitud'));
                    return $pdf->stream('solicitudSisCoM.pdf');

                    break;
                
                default:
                    # code...
                    break;
            }

        }      

    }

}
