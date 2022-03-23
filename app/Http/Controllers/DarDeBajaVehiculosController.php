<?php

namespace App\Http\Controllers;

use App\Vehiculos;
use App\Conductor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

class DarDeBajaVehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        $vehiculos = Vehiculos::join('conductors', 'vehiculos.idConductor', 'conductors.id')
        ->select('vehiculos.*', 'conductors.nombre as Conductor')->get();

        $conductores = DB::table('conductors')
        ->select(DB::raw('CONCAT(conductors.id, " ) ", conductors.nombre) as Conductores'), 'conductors.id')
        ->get();
        
        return view('sispam.darDeBaja.index', compact('dateCarbon', 'vehiculos', 'conductores'));
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
        $vehiculo = Vehiculos::findOrFail($id);

        $vehiculo->motivoBaja   = $request->motivoBaja;
        $vehiculo->estado    = 0;

        $vehiculo->save();

        return redirect('sispam/darDeBaja')->with('danger', 'Vehículo dado de Baja con Éxito !');
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
