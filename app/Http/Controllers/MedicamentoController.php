<?php

namespace App\Http\Controllers;

use App\Medicamento;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

use App\CategoriaMedicamento;
use App\VentaDetalleFarmacia;

use DB;

class MedicamentoController extends Controller
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

        /*
         * Traemos a todos los datos de la base de datos y se los pasamos como objeto a la vista
        */
        $medicamentos = DB::table('medicamentos')
                        ->join('categoria_medicamentos', 'medicamentos.categoria_id', '=', 'categoria_medicamentos.id')
                        ->select('medicamentos.*', 'categoria_medicamentos.name as Categoria', DB::raw('medicamentos.stock * medicamentos.precioInventario as totalInventario'))
                        ->get();

         /*
         * Traemos a todas las Categorias en los que se clasificarán los Medicamentos
        */
        $categorias = DB::table('categoria_medicamentos')
                    ->select(DB::raw('CONCAT(categoria_medicamentos.id, " ) ", categoria_medicamentos.name) as Categorias'), 'categoria_medicamentos.id')
                    ->get();

        return view('farmacia.medicamentos.index', compact('dateCarbon', 'medicamentos', 'categorias'));

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

        $medicamento = new Medicamento;

        $medicamento->categoria_id                  = $request->categoria_id;
        $medicamento->medicamento                   = strtoupper($request->medicamento);
        $medicamento->principioActivo               = strtoupper($request->principioActivo);
        $medicamento->laboratorio                   = strtoupper($request->laboratorio);
        $medicamento->lote                          = strtoupper($request->lote);
        $medicamento->fechaVencimiento              = $request->fechaVencimiento;
        $medicamento->stock                         = $request->stock;
        $medicamento->precioComercio                = $request->precioComercio;
        $medicamento->precioInventario              = $request->precioInventario;
        $medicamento->user_id                       = Auth::user()->id;

        $medicamento->save();

        return redirect('farmacia/medicamentos')->with('info', 'Medicamento Creado con Éxito !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function show(Medicamento $medicamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicamento $medicamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::findOrFail($id);

        $medicamento->categoria_id                  = $request->categoria_id;
        $medicamento->medicamento                   = strtoupper($request->medicamento);
        $medicamento->principioActivo               = strtoupper($request->principioActivo);
        $medicamento->laboratorio                   = strtoupper($request->laboratorio);
        $medicamento->lote                          = strtoupper($request->lote);
        $medicamento->fechaVencimiento              = $request->fechaVencimiento;
        $medicamento->stock                         = $request->stock;
        $medicamento->precioComercio                = $request->precioComercio;
        $medicamento->precioInventario              = $request->precioInventario;
        $medicamento->user_id                       = Auth::user()->id;

        $medicamento->save();

        return redirect('farmacia/medicamentos')->with('info', 'Medicamento Actualizado con Éxito !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicamento  $medicamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicamento = Medicamento::findOrFail($id);

        $medicamento->delete();

        return redirect('farmacia/medicamentos')->with('info', 'Medicamento Eliminado con Éxito !');

    }

    public function movimientoMedicamentos(Request $request)
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        $medicamentos = DB::table('medicamentos')
        ->select(DB::raw('CONCAT(medicamentos.id, " ) ", medicamentos.medicamento, " / ", medicamentos.principioActivo) as Medicamento'), 'medicamentos.id')
        ->get();

        $medicamentosTable = DB::table('medicamentos')
        ->join('categoria_medicamentos', 'medicamentos.categoria_id', '=', 'categoria_medicamentos.id')
        ->select('medicamentos.*', 'categoria_medicamentos.name as Categoria', DB::raw('medicamentos.stock * medicamentos.precioInventario as totalInventario'))
        ->where('medicamentos.id', $request->medicamento_id)
        ->whereBetween('medicamentos.created_at', [$request->fechaInicio, $request->fechaTermino])
        ->get();

        $detalleVentaTable = DB::table('venta_detalle_farmacias')
        ->join('venta_farmacias', 'venta_detalle_farmacias.venta_id', '=', 'venta_farmacias.id')
        ->join('medicamentos', 'venta_detalle_farmacias.medicamento_id', '=', 'medicamentos.id')
        ->select('venta_detalle_farmacias.*', 'medicamentos.medicamento as Medicamento', 'medicamentos.precioInventario as Valor', DB::raw('(venta_detalle_farmacias.cantidad * medicamentos.precioInventario) as SubTotal'))
        ->where('venta_detalle_farmacias.medicamento_id', $request->medicamento_id)
        ->whereBetween('venta_detalle_farmacias.created_at', [$request->fechaInicio, $request->fechaTermino])
        ->get();
        
        return view('farmacia.consultas.movimientoMedicamentos', compact('dateCarbon', 'medicamentos', 'medicamentosTable', 'detalleVentaTable'));

    }

    public function buscarMovMedicamentos(Request $request)
    {
        if ($request->fechaInicio <= $request->fechaTermino) {

            $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

            $medicamentos = DB::table('medicamentos')
            ->select(DB::raw('CONCAT(medicamentos.id, " ) ", medicamentos.medicamento, " / ", medicamentos.principioActivo) as Medicamento'), 'medicamentos.medicamento')
            ->get();

            $medicamentosTable = DB::table('medicamentos')
            ->select('medicamentos.*')
            ->where('medicamentos.medicamento', 'like', $request->medicamentoName.'%')
            ->whereBetween('medicamentos.created_at', [$request->fechaInicio, $request->fechaTermino])
            ->get();

            $detalleVentaTable = DB::table('venta_detalle_farmacias')
            ->join('venta_farmacias', 'venta_detalle_farmacias.venta_id', '=', 'venta_farmacias.id')
            ->join('medicamentos', 'venta_detalle_farmacias.medicamento_id', '=', 'medicamentos.id')
            ->select('venta_detalle_farmacias.*', 'medicamentos.id as ID', 'medicamentos.medicamento as Medicamento', 'medicamentos.principioActivo as PrincipioActivo', 'medicamentos.lote as Lote')
            ->where('medicamentos.medicamento', 'like', $request->medicamentoName.'%')
            ->whereBetween('venta_detalle_farmacias.created_at', [$request->fechaInicio, $request->fechaTermino])
            ->get();

            return view('farmacia.consultas.movimientoMedicamentos', compact('dateCarbon', 'medicamentos', 'medicamentosTable', 'detalleVentaTable'));

        }
        else{

            return back()->with('danger', 'La Fecha de Termino NO puede ser Menor a la de Inicio');
        }

    }
}
