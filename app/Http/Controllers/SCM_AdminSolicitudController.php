<?php


/*
 *  JFuentealba @itux
 *  created at October 24, 2019 - 11:25 am
 *  updated at December 23, 2019 - 1:29 pm
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
                    ->where('solicituds.estado_id', '!=', 10)
                    ->where('solicituds.estado_id', '!=', 11)
                    ->where('solicituds.estado_id', '!=', 12)
                    ->orderBy('solicituds.id', 'desc')
                    ->get();

        $fechaRecepcion = DB::table('solicituds')
                        ->join('move_solicituds', 'solicituds.id', 'move_solicituds.solicitud_id')
                        ->select('solicituds.id', 'move_solicituds.created_at')
                        ->where('move_solicituds.estadoSolicitud_id', 3)
                        ->get();

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.admin.index', compact('solicituds', 'dateCarbon', 'fechaRecepcion'));
            
        }elseif (Auth::user()->email == 'carolina.medina@nacimiento.cl') {

       /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');
        $anio = Carbon::now()->locale('es')->isoFormat('YYYY');
         /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
         $solicituds = DB::table('solicituds')
                    ->leftJoin('move_solicituds', 'solicituds.id', 'move_solicituds.solicitud_id')
                    ->leftJoin('status_solicituds', 'solicituds.estado_id', '=', 'status_solicituds.id')
                    ->leftJoin('users', 'solicituds.user_id', '=', 'users.id')
                    ->leftJoin('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                    ->select('solicituds.id','status_solicituds.estado as Estado','solicituds.iddoc','move_solicituds.created_at as Recepcionada',
                    'solicituds.compradorTitular','solicituds.motivo','solicituds.tipoSolicitud','solicituds.fechaActividad',
                    'solicituds.categoriaSolicitud','dependencies.name as Dependencia','solicituds.decretoPrograma','solicituds.nombrePrograma')
                    ->where('solicituds.categoriaSolicitud', '<>', 'Stock de Aseo')
                    ->where('move_solicituds.estadoSolicitud_id', 3)
                    ->whereYear('solicituds.created_at', $anio)//tomar 2 meses para atrás
                    ->orderBy('solicituds.id', 'ASC')
                    ->get();
                    
                    //dd($solicituds);
        /*$fechaRecepcion = DB::table('solicituds')
        ->join('move_solicituds', 'solicituds.id', 'move_solicituds.solicitud_id')
        ->select('solicituds.id', 'move_solicituds.created_at')
        ->where('move_solicituds.estadoSolicitud_id', 3)
        ->get();*/

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.admin.index', compact('solicituds', 'dateCarbon'));

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
                    ->where('solicituds.estado_id', '!=', 10)
                    ->where('solicituds.estado_id', '!=', 11)
                    ->where('solicituds.estado_id', '!=', 12)
                    ->orderBy('solicituds.id', 'desc')
                    ->get();

        $fechaRecepcion = DB::table('solicituds')
                        ->join('move_solicituds', 'solicituds.id', 'move_solicituds.solicitud_id')
                        ->select('solicituds.id', 'move_solicituds.created_at')
                        ->where('move_solicituds.estadoSolicitud_id', 3)
                        ->get();

                        //dd($dateCarbon);
             /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.admin.index', compact('solicituds', 'dateCarbon', 'fechaRecepcion'));
        }

        /* Retornamos a la vista los resultados psanadolos por parametros */
        //return view('siscom.admin.index', compact('solicituds', 'dateCarbon', 'fechaRecepcion'));
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

    public function showRecepcionar($id)
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

        return view('siscom.recepcionarSolicitudes.show', ['solicitud' => $solicitud, 'products' => $products, 'detalleSolicitud' => $detalleSolicitud, 'move' => $move]);

    }

    public function showConsulta($id)
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

        return view('siscom.admin.showConsulta', ['solicitud' => $solicitud, 'products' => $products, 'detalleSolicitud' => $detalleSolicitud, 'move' => $move]);

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

    public function showStock($id)
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

        return view('siscom.admin.showStock', compact('solicitud', 'products', 'detalleSolicitud', 'move'));

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

    public function recepcionar()
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
                    ->where('solicituds.estado_id', 1)
                    ->orWhere('solicituds.estado_id', 2)
                    ->orderBy('solicituds.id', 'desc')
                    ->get();

        $fechaRecepcion = DB::table('solicituds')
                        ->join('move_solicituds', 'solicituds.id', 'move_solicituds.solicitud_id')
                        ->select('solicituds.id', 'move_solicituds.created_at')
                        ->where('move_solicituds.estadoSolicitud_id', 3)
                        ->get();

                        //dd($fechaRecepcion);
            
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
                    ->where('solicituds.estado_id', 1)
                    ->orWhere('solicituds.estado_id', 2)
                    ->orderBy('solicituds.id', 'desc')
                    ->get();         

        $fechaRecepcion = DB::table('solicituds')
                        ->join('move_solicituds', 'solicituds.id', 'move_solicituds.solicitud_id')
                        ->select('solicituds.id', 'move_solicituds.created_at')
                        ->where('move_solicituds.estadoSolicitud_id', 3)
                        ->get();

        //dd($fechaRecepcion); 
        //dd($solicituds);

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
                    ->where('solicituds.estado_id', 1)
                    ->orWhere('solicituds.estado_id', 2)
                    ->orderBy('solicituds.id', 'desc')
                    ->get();         

        $fechaRecepcion = DB::table('solicituds')
                        ->join('move_solicituds', 'solicituds.id', 'move_solicituds.solicitud_id')
                        ->select('solicituds.id', 'move_solicituds.created_at')
                        ->where('move_solicituds.estadoSolicitud_id', 3)
                        ->get();

        }

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('siscom.recepcionarSolicitudes.index', compact('solicituds', 'dateCarbon', 'fechaRecepcion'));
    }

    public function update(Request $request, $id)
    {
       // Actualizar ENCABEZADO Solicitud
        if ($request->flag == 'Recepcionar') {

            try {

                DB::beginTransaction();

                    $solicitud = Solicitud::findOrFail($id);

                    if ($solicitud->categoriaSolicitud == 'Stock de Aseo') {
                        
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

                        $solicitud->compradorTitular            = 'Ruth Rivera Jaque';
                        $solicitud->estado_id                   = 4;

                        $solicitud->save(); 

                        //Guardamos los datos de Movimientos de la Solicitud
                        $move = new MoveSolicitud;
                        $move->solicitud_id                     = $solicitud->id;
                        $move->estadoSolicitud_id               = 4;
                        $move->fecha                            = $solicitud->updated_at;
                        $move->user_id                          = Auth::user()->id;

                        $move->save(); //Guardamos el Movimiento de la Solicitud    

                    } else {

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

                        
                    }
                    
                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }

            return back()->with('info', 'Solicitud Recepcionada con éxito !');
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
            $detalleSolicitud->obsActualizacion     = strtoupper($request->obsActualizacion);     

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

        // Rechazar Solicitud
        else if ($request->flag == 'Rechazar') {

            try {

                DB::beginTransaction();

                    $solicitud = Solicitud::findOrFail($id);
                    $solicitud->obsRechazo                  = $request->obsRechazo;
                    $solicitud->estado_id                   = 13;

                    //dd($solicitud);

                    $solicitud->save(); //Guardamos la Solicitud

                     //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $solicitud->id;
                    $move->estadoSolicitud_id               = 13;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }

            return redirect('/siscom/admin')->with('info', 'Solicitud Rechazada con éxito !');
        }  

        // Subsanar Solicitud
        else if ($request->flag == 'Subsanar') {

            try {

                DB::beginTransaction();

                    $solicitud = Solicitud::findOrFail($id);
                    $solicitud->estado_id                   = 14;

                    //dd($solicitud);

                    $solicitud->save(); //Guardamos la Solicitud

                     //Guardamos los datos de Movimientos de la Solicitud
                    $move = new MoveSolicitud;
                    $move->solicitud_id                     = $solicitud->id;
                    $move->estadoSolicitud_id               = 14;
                    $move->fecha                            = $solicitud->updated_at;
                    $move->user_id                          = Auth::user()->id;

                    $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }

            return redirect('/siscom/admin')->with('info', 'Solicitud Subsanada con éxito !');
        }  

    }

    public function reporteEntregaStock($id)
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
                   ->join('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                   ->join('status_solicituds', 'solicituds.estado_id', '=', 'status_solicituds.id')
                   ->select('solicituds.*', 'users.name as nameUser', 'status_solicituds.estado', 'dependencies.name as dependencyUser')
                   ->where('solicituds.id', '=', $id)
                   ->first();

        $move = DB::table('move_solicituds') 
                ->join('status_solicituds', 'move_solicituds.estadoSolicitud_id', 'status_solicituds.id')               
                ->join('users', 'move_solicituds.user_id', 'users.id')
                ->select('status_solicituds.estado as status', 'users.name as name', 'move_solicituds.created_at as date')
                ->where('move_solicituds.solicitud_id', '=', $id)
                ->get();


        $pdf = PDF::loadView('pdf.entregaStock', compact('solicitud', 'detalleSolicitud'));
        return $pdf->stream('entregaStock.pdf');
                     

    }

}