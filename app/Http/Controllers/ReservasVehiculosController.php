<?php

namespace App\Http\Controllers;

use App\ResevasVehiculos;
use App\Combustible;
use App\MantencionVehiculos;
use App\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MantencionVehiculo;
use DB;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

class ReservasVehiculosController extends Controller
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
        $reservas = ResevasVehiculos::join('vehiculos', 'resevas_vehiculos.idVehiculo', 'vehiculos.id')
        ->join('conductors', 'resevas_vehiculos.idConductor', 'conductors.id')
        ->select('resevas_vehiculos.*', DB::raw('CONCAT(vehiculos.marca, " - ", vehiculos.patente) as Vehiculo'), 'conductors.nombre as Conductor')
        ->get();

        //El estado=4 corresponde a los vehiculos disponibles para reservas
        $vehiculos = DB::table('vehiculos')
        ->select(DB::raw('CONCAT(vehiculos.marca, " / ", vehiculos.patente) as Vehiculo'), 'vehiculos.id')
        ->where('vehiculos.estado', 4)
        ->get();

        $conductores = DB::table('conductors')
        ->select(DB::raw('CONCAT(conductors.id, " ) ", conductors.nombre) as Conductores'), 'conductors.id')
        ->get();

        return view('sispam.reservas.index', compact('dateCarbon', 'vehiculos', 'reservas', 'conductores'));
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
        //Obtenemos todo el objeto de la últimas mantenciones por tipo del vehículo en cuestion
        $ultimaMantencionAceite = MantencionVehiculos::join('vehiculos', 'mantencion_vehiculos.idVehiculo', 'vehiculos.id')
        ->select('mantencion_vehiculos.*', 'vehiculos.patente as Patente')
        ->where('mantencion_vehiculos.idVehiculo', $request->vehiculo_id)
        ->where('mantencion_vehiculos.tipoMantencion', 1)->get()->last();
        $ultimaMantencionCorrea = MantencionVehiculos::join('vehiculos', 'mantencion_vehiculos.idVehiculo', 'vehiculos.id')
        ->select('mantencion_vehiculos.*', 'vehiculos.patente as Patente')
        ->where('mantencion_vehiculos.idVehiculo', $request->vehiculo_id)
        ->where('mantencion_vehiculos.tipoMantencion', 2)->get()->last();
        $ultimaMantencionNeumaticos = MantencionVehiculos::join('vehiculos', 'mantencion_vehiculos.idVehiculo', 'vehiculos.id')
        ->select('mantencion_vehiculos.*', 'vehiculos.patente as Patente')
        ->where('mantencion_vehiculos.idVehiculo', $request->vehiculo_id)
        ->where('mantencion_vehiculos.tipoMantencion', 3)->get()->last();
        //Obtenemos todo el objeto de la última Carga de Combustible del Vehículo en cuestion
        $ultimaCargaCombustible = Combustible::where('combustibles.idVehiculo', $request->vehiculo_id)->get()->last();
        //Ejecutamos suma de acuerdo al Tipo de Mantención
        $sumaAceite=$ultimaMantencionAceite->odometro + $ultimaMantencionAceite->recomendacionFabricante;
        $sumaCorrea=$ultimaMantencionCorrea->odometro + $ultimaMantencionCorrea->recomendacionFabricante;
        $sumaNeumaticos=$ultimaMantencionNeumaticos->odometro + $ultimaMantencionNeumaticos->recomendacionFabricante;
        //Buscamos el Menor de los 3
        if($sumaAceite < $sumaCorrea){
            if($sumaAceite < $sumaNeumaticos){
                $menor=$sumaAceite;
                $tipo=1;
            }elseif($sumaCorrea > $sumaNeumaticos){
                $menor=$sumaNeumaticos;
                $tipo=3;
            }
        }elseif($sumaAceite < $sumaNeumaticos){
            if($sumaCorrea < $sumaNeumaticos){
                $menor=$sumaCorrea;
                $tipo=2;
            }
        }elseif($sumaCorrea < $sumaNeumaticos){
            $menor=$sumaCorrea;
            $tipo=2;
        }else{
            $menor=$sumaNeumaticos;
            $tipo=3;
        }

        //Comenzamos a Evaluar si el Vehiculo esta habiliatdo para ser Reservado o no
        if($ultimaCargaCombustible->odometro <= ($menor-1000)){
            $reserva = new ResevasVehiculos;
            $reserva->fechaReserva      = $request->fechaCometido;
            $reserva->horaInicio        = $request->horaInicio;
            $reserva->horaTermino       = $request->horaTermino;
            $reserva->iddocSolicitud    = $request->iddoc;
            $reserva->idVehiculo        = $request->vehiculo_id;
            $reserva->idConductor       = $request->conductor_id;
            $reserva->destino           = $request->destino;
            $reserva->materia           = $request->materia;
            $reserva->idUser            = Auth::user()->id;
            $reserva->save();
            return redirect('sispam/reservas')->with('info', 'Reserva de Vehículo Ingresada con Éxito !');
        }elseif(($ultimaCargaCombustible->odometro > ($menor-1000)) && $ultimaCargaCombustible->odometro < $menor){
            $reserva = new ResevasVehiculos;
            $reserva->fechaReserva      = $request->fechaCometido;
            $reserva->horaInicio        = $request->horaInicio;
            $reserva->horaTermino       = $request->horaTermino;
            $reserva->iddocSolicitud    = $request->iddoc;
            $reserva->idVehiculo        = $request->vehiculo_id;
            $reserva->idConductor       = $request->conductor_id;
            $reserva->destino           = $request->destino;
            $reserva->materia           = $request->materia;
            $reserva->idUser            = Auth::user()->id;
            $reserva->save();
            //Enviar MAIL
            if($sumaAceite==$menor){
                Mail::to( 'juan.fuentealba@gmail.com' )
                //->cc('yael.cea@nacimiento.cl')
                //->bcc('erwin.castillo@nacimiento.cl')
                ->send(new MantencionVehiculo($request->vehiculo_id, $ultimaMantencionAceite));
                //Volvemos a la Vista
                return redirect('sispam/reservas')->with('info', 'Reserva de Vehículo Ingresada con Éxito y Mail de Mantención por Cambio de Aceite ha sido Enviado !');
            }elseif($sumaCorrea==$menor){
                Mail::to( 'juan.fuentealba@gmail.com' )
                //->cc('yael.cea@nacimiento.cl')
                //->bcc('erwin.castillo@nacimiento.cl')
                ->send(new MantencionVehiculo($request->vehiculo_id, $ultimaMantencionCorrea));
                //Volvemos a la Vista
                return redirect('sispam/reservas')->with('info', 'Reserva de Vehículo Ingresada con Éxito y Mail de Mantención por Cambio de Correas ha sido Enviado !');
            }elseif($sumaNeumaticos==$menor){
                Mail::to( 'juan.fuentealba@gmail.com' )
                //->cc('yael.cea@nacimiento.cl')
                //->bcc('erwin.castillo@nacimiento.cl')
                ->send(new MantencionVehiculo($request->vehiculo_id, $ultimaMantencionNeumaticos));
                //Volvemos a la Vista
                return redirect('sispam/reservas')->with('info', 'Reserva de Vehículo Ingresada con Éxito y Mail de Mantención por Cambio de Neumáticos ha sido Enviado !');
            }
        }elseif($ultimaCargaCombustible->odometro >= $menor){
            //Acctualizamos el Estado del Vehiculo
            if($tipo == 1){
                $vehiculo = Vehiculos::findOrFail($request->vehiculo_id);
                $vehiculo->estado=1;//Mantenemos la codificación del TipoMantención
                $vehiculo->save();
                return redirect('sispam/reservas')->with('danger', 'El Vehiculo seleccionado no está habilitado para ser reservado, por falta de Cambio de Aceite!');
            }elseif($tipo == 2){
                $vehiculo = Vehiculos::findOrFail($request->vehiculo_id);
                $vehiculo->estado=2;//Mantenemos la codificación del TipoMantención
                $vehiculo->save();
                return redirect('sispam/reservas')->with('danger', 'El Vehiculo seleccionado no está habilitado para ser reservado, por falta de Cambio de Correas!');
            }elseif($tipo == 3){
                $vehiculo = Vehiculos::findOrFail($request->vehiculo_id);
                $vehiculo->estado=3;//Mantenemos la codificación del TipoMantención
                $vehiculo->save();
                return redirect('sispam/reservas')->with('danger', 'El Vehiculo seleccionado no está habilitado para ser reservado, por falta de Cambio de Neumáticos!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsuarioFarmacia  $usuarioFarmacia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

            $reserva = ResevasVehiculos::findOrFail($id);

            $reserva->fechaReserva      = $request->fechaCometido;
            $reserva->horaInicio        = $request->horaInicio;
            $reserva->horaTermino       = $request->horaTermino;
            $reserva->iddocSolicitud    = $request->iddoc;
            $reserva->idVehiculo        = $request->vehiculo_id;
            $reserva->idConductor       = $request->conductor_id;
            $reserva->destino           = $request->destino;
            $reserva->materia           = $request->materia;
            $reserva->idUser            = Auth::user()->id;

            $reserva->save();

            return redirect('sispam/reservas')->with('info', 'Reserva Actualizada con Éxito !');
        }
        elseif ($request->flag == 'Anular') {

            $reserva = ResevasVehiculos::findOrFail($id);

            $reserva->motivoAnulacion   = $request->motivoAnulacion;
            $reserva->estado            = 0;

            $reserva->save();

            return redirect('sispam/reservas')->with('danger', 'Reserva Anulada con Éxito !');
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
    public function consultaReservas(Request $request)
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        $vehiculos = DB::table('vehiculos')
        ->select(DB::raw('CONCAT(vehiculos.id, " ) ", vehiculos.patente) as PlacaPatente'), 'vehiculos.id')
        ->get();

        $reservas = ResevasVehiculos::join('vehiculos', 'resevas_vehiculos.idVehiculo', 'vehiculos.id')
        ->join('conductors', 'resevas_vehiculos.idConductor', 'conductors.id')
        ->select('resevas_vehiculos.*', DB::raw('CONCAT(vehiculos.marca, " - ", vehiculos.patente) as Vehiculo'), 'conductors.nombre as Conductor')
        ->where('resevas_vehiculos.idVehiculo', 'like', $request->vehiculo_id.'%')
        ->whereBetween('resevas_vehiculos.fechaReserva', [$request->fechaInicio, $request->fechaTermino])
        ->get();

        return view('sispam.informes.buscarReservas', compact('dateCarbon', 'reservas', 'vehiculos'));
    }

    public function buscarReservasPorVehiculo(Request $request)
    {
        if ($request->fechaInicio <= $request->fechaTermino) {

            $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

            $vehiculos = DB::table('vehiculos')
            ->select(DB::raw('CONCAT(vehiculos.id, " ) ", vehiculos.patente) as PlacaPatente'), 'vehiculos.id')
            ->get();

            $reservas = ResevasVehiculos::join('vehiculos', 'resevas_vehiculos.idVehiculo', 'vehiculos.id')
            ->join('conductors', 'resevas_vehiculos.idConductor', 'conductors.id')
            ->select('resevas_vehiculos.*', DB::raw('CONCAT(vehiculos.marca, " - ", vehiculos.patente) as Vehiculo'), 'conductors.nombre as Conductor')
            ->where('resevas_vehiculos.idVehiculo', 'like', $request->vehiculo_id.'%')
            ->whereBetween('resevas_vehiculos.fechaReserva', [$request->fechaInicio, $request->fechaTermino])
            ->get();

            return view('sispam.informes.buscarReservas', compact('dateCarbon', 'reservas', 'vehiculos'));
        }
        else{
            return back()->with('danger', 'La Fecha de Termino NO puede ser Menor a la de Inicio');
        }        
    }
}
