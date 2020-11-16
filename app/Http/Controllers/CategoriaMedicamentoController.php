<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;
use App\CategoriaMedicamento;
use App\Medicamento;
use DB;

class CategoriaMedicamentoController extends Controller
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
         * Traemos a todas las Categorias en los que se clasificarán los Medicamentos
        */
        $categorias = CategoriaMedicamento::all();

        return view('farmacia.categoria.index', compact('dateCarbon', 'categorias'));
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
        $categoria = new CategoriaMedicamento;

        $categoria->name                  = strtoupper($request->name);
        $categoria->save();

        return redirect('farmacia/categoria')->with('info', 'Categoría Creada con Éxito !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = CategoriaMedicamento::findOrFail($id);

        $categoria->name                  = strtoupper($request->name);
        $categoria->save();

        return redirect('farmacia/categoria')->with('info', 'Categoría Actualizada con Éxito !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = CategoriaMedicamento::findOrFail($id);
        $categoria->delete();

        return redirect('farmacia/categoria')->with('info', 'Categoría Eliminada con Éxito !');

    }
}
