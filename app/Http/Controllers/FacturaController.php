<?php

namespace App\Http\Controllers;

use App\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

use App\OrdenCompra;

use App\MoveOC;

/* Invocamos el modelo de la Entidad DetalleSolicitud*/
use App\DetailSolicitud;

use App\Solicitud;

/* Invocamos el modelo de la Entidad Movimiento de la Solicitud*/
use App\MoveSolicitud;

use DB;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        $proveedores = DB::table('proveedores')
                        ->select(DB::raw('CONCAT(proveedores.id, " ) ", proveedores.razonSocial) as RazonSocial'), 'proveedores.id')
                        ->get();

        $facturas = DB::table('facturas')
                    ->join('proveedores', 'facturas.proveedor_id', '=', 'proveedores.id')
                    ->join('orden_compras', 'facturas.ordenCompra_id', '=', 'orden_compras.ordenCompra_id')
                    ->join('detail_solicituds', 'orden_compras.id', '=', 'detail_solicituds.ordenCompra_id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    ->join('users', 'solicituds.user_id', '=', 'users.id')
                    ->join('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                    ->select('facturas.*', 'proveedores.razonSocial as RazonSocial', 'dependencies.name as Dependencia')
                    ->get();

        return view('siscom.factura.index', compact('facturas', 'proveedores', 'dateCarbon'));
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

                    $factura = new Factura;
                    $factura->factura_id        = $request->factura_id;
                    $factura->iddoc             = $request->iddoc;
                    $factura->tipoDocumento     = $request->tipoDocumento;
                    $factura->proveedor_id      = $request->proveedor_id;
                    $factura->ordenCompra_id    = $request->ordenCompra_id;
                    $factura->totalFactura      = $request->totalFactura;
                    $factura->user_id           = Auth::user()->id;
                    $factura->estado_id         = 1;

                    $factura->save();

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }

        

        return back()->with('info', 'Factura Creada con Éxito!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        $proveedores = DB::table('proveedores')
                        ->select(DB::raw('CONCAT(proveedores.id, " ) ", proveedores.razonSocial) as RazonSocial'), 'proveedores.id')
                        ->get();

        $factura = DB::table('facturas')
                    ->join('proveedores', 'facturas.proveedor_id', '=', 'proveedores.id')
                    ->join('orden_compras', 'facturas.ordenCompra_id', '=', 'orden_compras.ordenCompra_id')
                    ->join('detail_solicituds', 'orden_compras.id', '=', 'detail_solicituds.ordenCompra_id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    ->join('users', 'solicituds.user_id', '=', 'users.id')
                    ->join('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                    ->select('facturas.*', 'proveedores.razonSocial as RazonSocial', 'dependencies.name as Dependencia', 'users.name as userName')
                    ->where('facturas.id', '=', $id)
                    ->first();

        $detalleSolicituds = DB::table('detail_solicituds')
                    ->join('products', 'detail_solicituds.product_id', 'products.id')
                    ->join('solicituds', 'detail_solicituds.solicitud_id', '=', 'solicituds.id')
                    ->leftjoin('orden_compras', 'detail_solicituds.ordenCompra_id', '=', 'orden_compras.id')
                    ->leftjoin('status_o_c_s', 'orden_compras.estado_id', '=', 'status_o_c_s.id')
                    ->leftjoin('licitacions', 'detail_solicituds.licitacion_id', '=', 'licitacions.id')
                    ->leftjoin('status_licitacions', 'licitacions.estado_id', '=', 'status_licitacions.id')
                    ->select('detail_solicituds.*', 'products.name as Producto', DB::raw('(detail_solicituds.cantidad * detail_solicituds.valorUnitario) as SubTotal'), 'orden_compras.ordenCompra_id as NoOC', 'status_o_c_s.estado as EstadoOC', 'licitacions.licitacion_id as NoLicitacion', 'status_licitacions.estado as EstadoLicitacion')
                     ->where('orden_compras.ordenCompra_id', '=', $factura->ordenCompra_id)
                    ->get();

                    //dd($detalleSolicitud);

        return view('siscom.factura.show', compact('factura', 'proveedores', 'dateCarbon', 'detalleSolicituds'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->flag == 'FacturarProducto') {

            $facturar = DetailSolicitud::findOrFail($id);

            $facturar->factura_id       = $request->factura_id;
            $facturar->save();

            return back()->with('info', 'Producto Facturado Correctamente!');

        }else if ($request->flag == 'NoFacturarProducto') {

            $nofacturar = DetailSolicitud::findOrFail($id);

            $nofacturar->factura_id       = NULL;
            $nofacturar->save();

            return back()->with('info', 'Producto Facturado Correctamente!');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
