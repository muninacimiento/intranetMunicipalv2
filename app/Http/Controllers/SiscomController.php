<?php

/*
 *  JFuentealba @itux
 *  created at September 9, 2019 - 16:20 pm
 *  updated at January 27, 2020 - 12:59 pm
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Licitacion;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

class SiscomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtenemos la Fecha Actual del Sistema
        //$dateCarbon = Carbon::now()->isoFormat('Y-m-d');

        //$l = DB::table('licitacions')

        //Consultar por las licitaciones con fecha de cierre igual a Carbon->now
        $licitacion = Licitacion::where('fechaCierre', '=', Carbon::now()->format('Y-m-d'))->where('estado_id', '=', 18);

        //dd($licitacion);
            
            //Cambiar Estado de la Licitacion a Cerrada
            $licitacion->update(['estado_id' => 19]); 

        return view('siscom.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
