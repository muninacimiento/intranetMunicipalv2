<?php


/*
 *  JFuentealba @itux
 *  created at October 24, 2019 - 11:25 am
 *  updated at December 23, 2019 - 1:29 pm
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

class SCM_AdminSolicitudController extends Controller
{
    
	public function index(Request $request)
    {

        if (Auth::user()->email == 'heraldo.medina@nacimiento.cl') {

            /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $solicituds = DB::table('solicituds')
                    ->join('status_solicituds', 'solicituds.estado_id', '=', 'status_solicituds.id')
                    ->join('users', 'solicituds.user_id', '=', 'users.id')
                    ->join('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                    ->select('solicituds.*', 'status_solicituds.estado', 'dependencies.name')
                    ->where('solicituds.categoriaSolicitud', '=', 'Stock de Aseo')
                    ->orderBy('solicituds.id', 'desc')
                    ->get();
            
        }else if (Auth::user()->email == 'carolina.medina@nacimiento.cl' || Auth::user()->email == 'cecilia.castro@nacimiento.cl' || Auth::user()->email == 'juan.fuentealba@nacimiento.cl') {

        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $solicituds = DB::table('solicituds')
                    ->join('status_solicituds', 'solicituds.estado_id', '=', 'status_solicituds.id')
                    ->join('users', 'solicituds.user_id', '=', 'users.id')
                    ->join('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                    ->select('solicituds.*', 'status_solicituds.estado', 'dependencies.name')
                    ->orderBy('solicituds.id', 'desc')
                    ->get();

        }else {

        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $solicituds = DB::table('solicituds')
                    ->join('status_solicituds', 'solicituds.estado_id', '=', 'status_solicituds.id')
                    ->join('users', 'solicituds.user_id', '=', 'users.id')
                    ->join('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                    ->select('solicituds.*', 'status_solicituds.estado', 'dependencies.name')
                    ->where('solicituds.compradorTitular', '=', Auth::user()->name)
                    ->orWhere('solicituds.compradorSuplencia', '=', Auth::user()->name)
                    ->orderBy('solicituds.id', 'desc')
                    ->get();
        }
         

        //dd($solicituds);

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.admin.index', ['solicituds' => $solicituds, 'dateCarbon' => $dateCarbon]);
    }

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
                    ->leftjoin('facturas', 'detail_solicituds.factura_id', 'facturas.id')
                    ->select('detail_solicituds.*', 'products.name as Producto', DB::raw('(detail_solicituds.cantidad * detail_solicituds.valorUnitario) as SubTotal'), 'orden_compras.ordenCompra_id as NoOC', 'status_o_c_s.estado as EstadoOC', 'licitacions.licitacion_id as NoLicitacion', 'status_licitacions.estado as EstadoLicitacion', 'facturas.factura_id as NoFactura')
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

        //dd($move);

        return view('siscom.admin.show', ['solicitud' => $solicitud, 'products' => $products, 'detalleSolicitud' => $detalleSolicitud, 'move' => $move]);

    }

    public function entregaStock($id)
    {
        
         /*
         * Declaramos un Objeto para obtener acceso a los datos de la tabla DetalleSolicitud
         */
        $detalleSolicitud = DB::table('detail_solicituds')
                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    ->select('detail_solicituds.*', 'products.name as Producto', DB::raw('(detail_solicituds.cantidad * detail_solicituds.valorUnitario) as SubTotal'), DB::raw('(detail_solicituds.cantidad - detail_solicituds.cantidadEntregada) as Saldo'))
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

        //dd($move);

        return view('siscom.admin.entregaStock.show', compact('solicitud', 'products', 'detalleSolicitud', 'move'));

    }

    public function update(Request $request, $id)
    {
       // Actualizar ENCABEZADO Solicitud
        if ($request->flag == 'Recepcionar') {

            try {

                DB::beginTransaction();

                    $solicitud = Solicitud::findOrFail($id);
                    $solicitud->iddoc                       = $request->iddoc;
                    $solicitud->estado_id                   = 3;

                    $solicitud->save();

                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $solicitud->id;
                    $move->estadoSolicitud_id               = 3;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }

            return redirect('/siscom/admin')->with('info', 'Solicitud Recepcionada con éxito !');
        }

        // Asignar Solicitud
        else if ($request->flag == 'Asignar') {

            try {

                DB::beginTransaction();

                    $solicitud = Solicitud::findOrFail($id);
                    $solicitud->compradorTitular            = $request->compradorTitular;
                    $solicitud->estado_id                   = 4;

                    //dd($solicitud);

                    $solicitud->save(); //Guardamos la Solicitud

                     //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $solicitud->id;
                    $move->estadoSolicitud_id               = 4;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }

            return redirect('/siscom/admin')->with('info', 'Solicitud Asignada con éxito !');
        }    

        // Asignar Solicitud
        else if ($request->flag == 'ReAsignar') {

            try {

                DB::beginTransaction();

                    $solicitud = Solicitud::findOrFail($id);
                    $solicitud->compradorSuplencia            = $request->compradorSuplencia;
                    $solicitud->estado_id                     = 5;

                    //dd($solicitud);

                    $solicitud->save(); //Guardamos la Solicitud

                     //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $solicitud->id;
                    $move->estadoSolicitud_id               = 5;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }

            return redirect('/siscom/admin')->with('info', 'Solicitud ReAsignada con éxito !');
        }    

        // Confirmar Solicitud
        else if ($request->flag == 'Confirmar') {

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

            return redirect('/siscom/admin')->with('info', 'Solicitud Confirmada con éxito !');
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

                DB::rollback();
                
            }

            return redirect('/siscom/admin')->with('info', 'Solicitud Anulada con éxito !');
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

        //Confirmamos la Entrega de Productos de la Solicitud
        else if ($request->flag == 'EntregarSolicitud'){

            try {

                DB::beginTransaction();

                    $solicitud = Solicitud::findOrFail($id);
                    $solicitud->estado_id                   = 7;

                    $solicitud->save();


                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $solicitud->id;
                    $move->estadoSolicitud_id               = 7;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();

                return redirect('/siscom/admin')->with('info', 'Solicitud En Proceso de Entrega!');
                
            } catch (Exception $e) {

                DB::rollback();
                
            }
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

        //Cerramos la Solicitud de Entrega de Productos
        else if ($request->flag == 'Cerrar'){

            try {

                DB::beginTransaction();

                    $solicitud = Solicitud::findOrFail($id);
                    $solicitud->estado_id                   = 11;

                    $solicitud->save();


                    //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $solicitud->id;
                    $move->estadoSolicitud_id               = 11;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();

                return redirect('/siscom/admin')->with('info', 'Solicitud Entregada Completamente!');
                
            } catch (Exception $e) {

                DB::rollback();
                
            }
        }

    }

    public function consulta()
    {

        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
        $solicituds = DB::table('solicituds')
                    ->join('status_solicituds', 'solicituds.estado_id', '=', 'status_solicituds.id')
                    ->join('users', 'solicituds.user_id', '=', 'users.id')
                    ->join('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                    ->select('solicituds.*', 'status_solicituds.estado', 'dependencies.name')
                    ->orderBy('solicituds.id', 'desc')
                    ->get();         

        //dd($solicituds);

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.consulta.index', compact('dateCarbon', 'solicituds'));
    }

}