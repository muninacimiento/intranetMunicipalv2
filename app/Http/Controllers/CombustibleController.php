<?php

namespace App\Http\Controllers;

use App\Combustible;
use App\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

class CombustibleController extends Controller
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
        $combustibles = Combustible::join('vehiculos', 'combustibles.idVehiculo', 'vehiculos.id')
        ->select('combustibles.*', 'vehiculos.patente as Patente', 'vehiculos.motor as tipoCombustible')
        ->where('combustibles.anio', Carbon::now()->format('Y'))
        ->orderBy('combustibles.id', 'DESC')->get();

        $vehiculos = DB::table('vehiculos')
        ->select(DB::raw('CONCAT(vehiculos.id, " ) ", vehiculos.patente) as PlacaPatente'), 'vehiculos.id')
        ->get();

        return view('sispam.cargaCombustibles.index', compact('dateCarbon', 'vehiculos', 'combustibles'));
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
        $ultimaCarga = Combustible::where('combustibles.idVehiculo', $request->patente_id)->get()->last();

        //dd($ultimaCarga->odometro);
        
        if($ultimaCarga == null || ($ultimaCarga->odometro < $request->odometro)){
            
            $combustible = new Combustible;
            $combustible->anio         = Carbon::now()->format('Y');
            $combustible->idVehiculo   = $request->patente_id;
            $combustible->odometro     = $request->odometro;
            $combustible->litros       = $request->litros;
            $combustible->noGuia       = $request->noGuia;
            $combustible->total        = $request->total;
            $combustible->observaciones= $request->observaciones;
            $combustible->idUser       = Auth::user()->id;

            $combustible->save();
            return redirect('sispam/cargaCombustibles')->with('info', 'Carga Combustible Registrada con Éxito !');
        }else{
            return redirect('sispam/cargaCombustibles')->with('danger', 'Odómetro NO puede ser menor a la última carga registrada de esta patente, por favor revise nuevamente la guia...');
        }

        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsuarioFarmacia  $usuarioFarmacia
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
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

            $combustible = Combustible::findOrFail($id);

            $combustible->anio         = Carbon::now()->format('Y');
            $combustible->idVehiculo      = $request->patente_id;
            $combustible->odometro     = $request->odometro;
            $combustible->litros       = $request->litros;
            $combustible->noGuia       = $request->noGuia;
            $combustible->total        = $request->total;
            $combustible->observaciones= $request->observaciones;
            $combustible->idUser       = Auth::user()->id;

            $combustible->save();

            return redirect('sispam/cargaCombustibles')->with('info', 'Carga Combustible Actualizada con Éxito !');
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
