<?php

namespace App\Http\Controllers;

use App\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

class VehiculosController extends Controller
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
        $vehiculos = Vehiculos::join('conductors', 'vehiculos.idConductor', 'conductors.id')
        ->select('vehiculos.*', 'conductors.nombre as Conductor')
        ->where('vehiculos.estado', 1)
        ->orderBy('vehiculos.id', 'DESC')->get();

        $conductores = DB::table('conductors')
        ->select(DB::raw('CONCAT(conductors.id, " ) ", conductors.nombre) as Conductores'), 'conductors.id')
        ->get();

        return view('sispam.vehiculos.index', compact('dateCarbon', 'vehiculos', 'conductores'));
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
        
        $vehiculo = new Vehiculos;

        $vehiculo->patente      = $request->placaPatente;
        $vehiculo->marca        = $request->marca;
        $vehiculo->modelo       = $request->modelo;
        $vehiculo->anio         = $request->anio;
        $vehiculo->noMotor      = $request->no_motor;
        $vehiculo->noChasis     = $request->no_chasis;
        $vehiculo->rendimiento  = $request->rendimiento;
        $vehiculo->color        = $request->color;
        $vehiculo->motor        = $request->motor;
        $vehiculo->idConductor  = $request->conductor_id;
        $vehiculo->idUser       = Auth::user()->id;

        $vehiculo->save();

        return redirect('sispam/vehiculos')->with('info', 'Vehículo Ingresado al Parque Municipal con Éxito !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsuarioFarmacia  $usuarioFarmacia
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        $vehiculos = Vehiculos::join('conductors', 'vehiculos.idConductor', 'conductors.id')
        ->select('vehiculos.*', 'conductors.nombre as Conductor')
        ->orderBy('vehiculos.id', 'DESC')->get();

        $conductores = DB::table('conductors')
        ->select(DB::raw('CONCAT(conductors.id, " ) ", conductors.nombre) as Conductores'), 'conductors.id')
        ->get();
        
        return view('sispam.vehiculos.darDeBaja', compact('dateCarbon', 'vehiculos', 'conductores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsuarioFarmacia  $usuarioFarmacia
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UsuarioFarmacia  $usuarioFarmacia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
        //Actualizamos los Datos del Vehículo
        if ($request->flag == 'Actualizar') {

            $vehiculo = Vehiculos::findOrFail($id);

            $vehiculo->patente      = $request->placaPatente;
            $vehiculo->marca        = $request->marca;
            $vehiculo->modelo       = $request->modelo;
            $vehiculo->anio         = $request->anio;
            $vehiculo->noMotor      = $request->no_motor;
            $vehiculo->noChasis     = $request->no_chasis;
            $vehiculo->rendimiento  = $request->rendimiento;
            $vehiculo->color        = $request->color;
            $vehiculo->motor        = $request->motor;
            $vehiculo->idConductor  = $request->conductor_id;

            $vehiculo->save();

            return redirect('sispam/vehiculos')->with('info', 'Vehículo Actualizado con Éxito !');
        }
        elseif ($request->flag == 'DarDeBaja') {

            $vehiculo = Vehiculos::findOrFail($id);

            $vehiculo->motivoBaja   = $request->motivoBaja;
            $vehiculo->estado    = 0;

            $vehiculo->save();

            return redirect('sispam/vehiculos/darDeBaja')->with('danger', 'Vehículo dado de Baja con Éxito !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsuarioFarmacia  $usuarioFarmacia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
