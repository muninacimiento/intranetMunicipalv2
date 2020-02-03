<?php

namespace App\Http\Controllers;

use App\Medicamento;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

use App\CategoriaMedicamento;

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
                        ->select('medicamentos.*', 'categoria_medicamentos.name as Categoria')
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
        $medicamento->medicamento                   = $request->medicamento;
        $medicamento->principioActivo               = $request->principioActivo;
        $medicamento->laboratorio                   = $request->laboratorio;
        $medicamento->lote                          = $request->lote;
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
        $medicamento->medicamento                   = $request->medicamento;
        $medicamento->principioActivo               = $request->principioActivo;
        $medicamento->laboratorio                   = $request->laboratorio;
        $medicamento->lote                          = $request->lote;
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
}
