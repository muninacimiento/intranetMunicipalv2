<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\MantencionVehiculos;
use App\Vehiculos;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

class MantencionVehiculosController extends Controller
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
        $mantenciones = MantencionVehiculos::join('vehiculos', 'mantencion_vehiculos.idVehiculo', 'vehiculos.id')
        ->select('mantencion_vehiculos.*', DB::raw('CONCAT(vehiculos.marca, " - ", vehiculos.patente) as Vehiculo'))
        ->get();

        $vehiculos = DB::table('vehiculos')
        ->select(DB::raw('CONCAT(vehiculos.marca, " / ", vehiculos.patente) as Vehiculo'), 'vehiculos.id')
        ->get();

        return view('sispam.mantenciones.index', compact('dateCarbon', 'mantenciones', 'vehiculos'));

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
        $mantencion = new MantencionVehiculos;

        $mantencion->fechaMantencion            = $request->fechaMantencion;
        $mantencion->idVehiculo                 = $request->vehiculo_id;
        $mantencion->tipoMantencion             = $request->tipoMantencion;
        $mantencion->descripcion                = $request->descripcion;
        $mantencion->noDocumento                = $request->noDocumento;
        $mantencion->ordenCompra                = $request->ordenCompra;
        $mantencion->proveedor                  = $request->proveedor;
        $mantencion->total                      = $request->total;
        $mantencion->observaciones              = $request->observaciones;
        $mantencion->otroTipoMantencion         = $request->otraMantencion;
        $mantencion->recomendacionFabricante    = $request->recomendacionFabricante;
        $mantencion->odometro                   = $request->odometro;
        $mantencion->idUser                     = Auth::user()->id;

        $mantencion->save();

        $vehiculo = Vehiculos::findOrFail($request->vehiculo_id);
        $vehiculo->estado                       = 4; 
        $vehiculo->save();

        return redirect('sispam/mantenciones')->with('info', 'Matención Registrada con Éxito !');
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
        $mantencion = MantencionVehiculos::findOrFail($id);

        $mantencion->fechaMantencion            = $request->fechaMantencion;
        $mantencion->idVehiculo                 = $request->vehiculo_id;
        $mantencion->tipoMantencion             = $request->tipoMantencion;
        $mantencion->descripcion                = $request->descripcion;
        $mantencion->noDocumento                = $request->noDocumento;
        $mantencion->ordenCompra                = $request->ordenCompra;
        $mantencion->proveedor                  = $request->proveedor;
        $mantencion->total                      = $request->total;
        $mantencion->observaciones              = $request->observaciones;
        $mantencion->otroTipoMantencion         = $request->otraMantencion;
        $mantencion->recomendacionFabricante    = $request->recomendacionFabricante;
        $mantencion->odometro                   = $request->odometro;
        $mantencion->idUser                     = Auth::user()->id;

        $mantencion->save();

        return redirect('sispam/mantenciones')->with('info', 'Matención Actualizada con Éxito !');
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
    //Funcion que me retorna el rendimiento del vehiculo por el rango de fechas solicitado
    public function consultaMantenciones(Request $request)
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        $vehiculos = DB::table('vehiculos')
        ->select(DB::raw('CONCAT(vehiculos.id, " ) ", vehiculos.patente) as PlacaPatente'), 'vehiculos.id')
        ->get();

        $mantenciones = MantencionVehiculos::join('vehiculos', 'mantencion_vehiculos.idVehiculo', 'vehiculos.id')
        ->select('mantencion_vehiculos.*', DB::raw('CONCAT(vehiculos.marca, " / ", vehiculos.patente) as Vehiculo'))
        ->where('mantencion_vehiculos.idVehiculo', 'like', $request->vehiculo_id.'%')
        ->whereBetween('mantencion_vehiculos.fechaMantencion', [$request->fechaInicio, $request->fechaTermino])
        ->get();

        return view('sispam.informes.buscarMantenciones', compact('dateCarbon', 'mantenciones', 'vehiculos'));
    }

    public function buscarMantencionesPorVehiculo(Request $request)
    {
        if ($request->fechaInicio <= $request->fechaTermino) {

            $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

            $vehiculos = DB::table('vehiculos')
            ->select(DB::raw('CONCAT(vehiculos.id, " ) ", vehiculos.patente) as PlacaPatente'), 'vehiculos.id')
            ->get();

            $mantenciones = MantencionVehiculos::join('vehiculos', 'mantencion_vehiculos.idVehiculo', 'vehiculos.id')
            ->select('mantencion_vehiculos.*', DB::raw('CONCAT(vehiculos.marca, " / ", vehiculos.patente) as Vehiculo'))
            ->where('mantencion_vehiculos.idVehiculo', 'like', $request->vehiculo_id.'%')
            ->whereBetween('mantencion_vehiculos.fechaMantencion', [$request->fechaInicio, $request->fechaTermino])
            ->get();

            return view('sispam.informes.buscarMantenciones', compact('dateCarbon', 'mantenciones', 'vehiculos'));
        }
        else{
            return back()->with('danger', 'La Fecha de Termino NO puede ser Menor a la de Inicio');
        }        
    }
}
