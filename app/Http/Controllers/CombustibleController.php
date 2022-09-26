<?php

namespace App\Http\Controllers;

use App\Combustible;
use App\Vehiculos;
use App\MantencionVehiculos;
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
        //Obtenemos todo el objeto de la última mantención del vehículo en cuestion
        //$disponibilidad = MantencionVehiculos::where('mantencion_vehiculos.idVehiculo', $request->patente_id)->get()->last();

        $ultimaCarga = Combustible::where('combustibles.idVehiculo', $request->patente_id)->get()->last();
        if($ultimaCarga == null){
            
            $combustible = new Combustible;
            $combustible->fechaCarga   = $request->fechaCarga;
            $combustible->idVehiculo   = $request->patente_id;
            $combustible->odometro     = $request->odometro;
            $combustible->litros       = $request->litros;
            $combustible->kilometraje  = 0;
            $combustible->noGuia       = $request->noGuia;
            $combustible->total        = $request->total;
            $combustible->observaciones= $request->observaciones;
            $combustible->idUser       = Auth::user()->id;

            $combustible->save();
            
            return redirect('sispam/cargaCombustibles')->with('info', 'Carga Combustible Registrada con Éxito !');
        }elseif($ultimaCarga->odometro < $request->odometro){

            $combustible = new Combustible;
            $combustible->fechaCarga   = $request->fechaCarga;
            $combustible->idVehiculo   = $request->patente_id;
            $combustible->odometro     = $request->odometro;
            $combustible->litros       = $request->litros;
            $combustible->kilometraje  = ($request->odometro-$ultimaCarga->odometro);
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
        //$ultimaCarga = Combustible::where('combustibles.idVehiculo', $request->patente_id)->get()->last();
        //$newUltimaCarga = Combustible::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
        
        //Actualizamos los Datos del Vehículo
        if ($request->flag == 'Actualizar') {

            $combustible = Combustible::findOrFail($id);
            $newUltimaCarga = Combustible::where('id', '<', $combustible->id)->orderBy('id', 'desc')->first();

            $combustible->odometro  = 0;
            $combustible->update();
            
            $newCombustible = Combustible::findOrFail($id);

            $newCombustible->fechaCarga   = $request->fechaCarga;
            $newCombustible->idVehiculo   = $request->patente_id;
            $newCombustible->odometro     = $request->odometro;
            $newCombustible->litros       = $request->litros;
            $newCombustible->noGuia       = $request->noGuia;
            $newCombustible->total        = $request->total;
            $newCombustible->observaciones= $request->observaciones;
            $newCombustible->idUser       = Auth::user()->id;

            $newCombustible->update();

            $updateCombustible = Combustible::findOrFail($id);
            $updateCombustible->kilometraje  = ($request->odometro-$newUltimaCarga->odometro);
            $updateCombustible->update();

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
    //Funcion que me retorna el rendimiento del vehiculo por el rango de fechas solicitado
    public function consultaRendimiento(Request $request)
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

            //$medicamentos = DB::table('medicamentos')
            //->select(DB::raw('CONCAT(medicamentos.id, " ) ", medicamentos.medicamento, " / ", medicamentos.principioActivo) as Medicamento'), 'medicamentos.medicamento')
            //->get();
            
            $vehiculos = DB::table('vehiculos')
            ->select(DB::raw('CONCAT(vehiculos.id, " ) ", vehiculos.patente) as PlacaPatente'), 'vehiculos.id')
            ->get();

            $rendimientosVehiculo = DB::table('combustibles')
            ->join('vehiculos', 'combustibles.idVehiculo', 'vehiculos.id')
            ->select('combustibles.*', 'vehiculos.patente as Patente')
            ->where('vehiculos.patente', 'like', $request->medicamentoName.'%')
            ->whereBetween('combustibles.fechaCarga', [$request->fechaInicio, $request->fechaTermino])
            ->get();

            //$detalleVentaTable = DB::table('venta_detalle_farmacias')
            //->join('venta_farmacias', 'venta_detalle_farmacias.venta_id', 'venta_farmacias.id')
            //->join('medicamentos', 'venta_detalle_farmacias.medicamento_id', 'medicamentos.id')
            //->select('venta_detalle_farmacias.*', 'medicamentos.id as ID', 'medicamentos.medicamento as Medicamento', 'medicamentos.principioActivo as PrincipioActivo', 'medicamentos.lote as Lote')
            //->where('medicamentos.medicamento', 'like', $request->medicamentoName.'%')
            //->whereBetween('venta_detalle_farmacias.created_at', [$request->fechaInicio, $request->fechaTermino])
            //->get();

            return view('sispam.informes.rendimiento', compact('dateCarbon', 'rendimientosVehiculo', 'vehiculos'));
    }

    public function buscarRendimientoPorVehiculo(Request $request)
    {
        if ($request->fechaInicio <= $request->fechaTermino) {

            $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

            //$medicamentos = DB::table('medicamentos')
            //->select(DB::raw('CONCAT(medicamentos.id, " ) ", medicamentos.medicamento, " / ", medicamentos.principioActivo) as Medicamento'), 'medicamentos.medicamento')
            //->get();

            $vehiculos = DB::table('vehiculos')
            ->select(DB::raw('CONCAT(vehiculos.id, " ) ", vehiculos.patente) as PlacaPatente'), 'vehiculos.id')
            ->get();

            $rendimientosVehiculo = DB::table('combustibles')
            ->join('vehiculos', 'combustibles.idVehiculo', 'vehiculos.id')
            ->select('combustibles.*', (DB::raw('CONCAT(vehiculos.marca, " / ", vehiculos.patente) as Vehiculo')), 'vehiculos.motor as Combustible', 
            (DB::raw('ROUND(combustibles.kilometraje / combustibles.litros, 2) as Rendimiento')))
            ->where('combustibles.idVehiculo', $request->vehiculo_id)
            ->whereBetween('combustibles.fechaCarga', [$request->fechaInicio, $request->fechaTermino])
            ->get();

            //$detalleVentaTable = DB::table('venta_detalle_farmacias')
            //->join('venta_farmacias', 'venta_detalle_farmacias.venta_id', 'venta_farmacias.id')
            //->join('medicamentos', 'venta_detalle_farmacias.medicamento_id', 'medicamentos.id')
            //->select('venta_detalle_farmacias.*', 'medicamentos.id as ID', 'medicamentos.medicamento as Medicamento', 'medicamentos.principioActivo as PrincipioActivo', 'medicamentos.lote as Lote')
            //->where('medicamentos.medicamento', 'like', $request->medicamentoName.'%')
            //->whereBetween('venta_detalle_farmacias.created_at', [$request->fechaInicio, $request->fechaTermino])
            //->get();

            return view('sispam.informes.rendimiento', compact('dateCarbon', 'rendimientosVehiculo', 'vehiculos'));
        }
        else{
            return back()->with('danger', 'La Fecha de Termino NO puede ser Menor a la de Inicio');
        }        
    }
}
