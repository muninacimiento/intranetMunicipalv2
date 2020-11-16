<?php

namespace App\Http\Controllers;
use App\BoletaGarantia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;
use App\MoveBoleta;
use App\Contrato;
use DB;

class BoletaGarantiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        $boletas = BoletaGarantia::join('contratos', 'boleta_garantias.contrato_id', 'contratos.id')
        ->join('status_boletas', 'boleta_garantias.estado_id', 'status_boletas.id')
        ->select('boleta_garantias.*', 'contratos.nombreContrato as NombreContrato', 'status_boletas.estado as Estado')
        ->orderBy('boleta_garantias.id', 'DESC')->get();

        $contratos = Contrato::join('status_contratos', 'contratos.estado_id', 'status_contratos.id')
        ->select(DB::raw('CONCAT(contratos.id, " ) ", contratos.nombreContrato, " / ", status_contratos.estado) as Contratos'), 'contratos.id')
        ->get();

        return view('siscom.boletasGarantia.index', compact('dateCarbon', 'boletas', 'contratos'));
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
        try {

                DB::beginTransaction();

                $boleta = new BoletaGarantia;
                $boleta->user_id                        = Auth::user()->id;
                $boleta->estado_id                      = 1;
                $boleta->contrato_id                    = $request->contrato_id;
                $boleta->numeroBoleta                   = $request->numeroBoleta;
                $boleta->banco                          = $request->banco;
                $boleta->montoBoleta                    = $request->montoBoleta;
                                
                $boleta->save();

                $move = new MoveBoleta;
                $move->boleta_id                  = $boleta->id;
                $move->estadoBoleta_id            = 1;
                $move->fecha                        = $boleta->created_at;
                $move->user_id                      = Auth::user()->id;

                $move->save();

                DB::commit();
                
            } catch (Exception $e) {
                DB::rollback();                
            }
            
            return redirect('/siscom/boletasGarantia')->with('info', 'Boleta Recepcionada con Éxito !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BoletaGarantia  $boletaGarantia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');
        
        $boleta = BoletaGarantia::join('contratos', 'boleta_garantias.contrato_id', 'contratos.id')
        ->join('status_boletas', 'boleta_garantias.estado_id', 'status_boletas.id')
        ->select('boleta_garantias.*', 'contratos.nombreContrato as NombreContrato', 'status_boletas.estado as Estado')
        ->first();

        $move = DB::table('move_boletas') 
        ->join('status_boletas', 'move_boletas.estadoBoleta_id', 'status_boletas.id')               
        ->join('users', 'move_boletas.user_id', 'users.id')
        ->select('move_boletas.*', 'status_boletas.estado as status', 'users.name as name', 'move_boletas.created_at as date')
        ->where('move_boletas.boleta_id', '=', $id)
        ->get();

        return view('siscom.boletasGarantia.show', compact('boleta', 'move', 'dateCarbon'));
    }

    public function validar($id)
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');
        
        $boleta = BoletaGarantia::join('contratos', 'boleta_garantias.contrato_id', 'contratos.id')
        ->join('status_boletas', 'boleta_garantias.estado_id', 'status_boletas.id')
        ->select('boleta_garantias.*', 'contratos.nombreContrato as NombreContrato', 'status_boletas.estado as Estado')
        ->first();

        $move = DB::table('move_boletas') 
        ->join('status_boletas', 'move_boletas.estadoBoleta_id', 'status_boletas.id')               
        ->join('users', 'move_boletas.user_id', 'users.id')
        ->select('move_boletas.*', 'status_boletas.estado as status', 'users.name as name', 'move_boletas.created_at as date')
        ->where('move_boletas.boleta_id', '=', $id)
        ->get();

        return view('siscom.boletasGarantia.validar', compact('boleta', 'move', 'dateCarbon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BoletaGarantia  $boletaGarantia
     * @return \Illuminate\Http\Response
     */
    public function edit(BoletaGarantia $boletaGarantia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BoletaGarantia  $boletaGarantia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        if ($request->flag == 'Actualizar') {

                $boleta = new BoletaGarantia;
                $boleta->user_id                        = Auth::user()->id;
                $boleta->estado_id                      = 1;
                $boleta->contrato_id                    = $request->contrato_id;
                $boleta->numeroBoleta                   = $request->numeroBoleta;
                $boleta->banco                          = $request->banco;
                $boleta->montoBoleta                    = $request->montoBoleta;
                                
                $boleta->save();

            return redirect('/siscom/boletasGarantia')->with('info', 'Boleta Actualizada con éxito!');
        }
        else if ($request->flag == 'EnviarACustodia') {

            try {

                DB::beginTransaction();

                    $boleta = BoletaGarantia::findOrFail($id);
                        
                    $boleta->estado_id                              = 3;
                    $boleta->save();

                    $move = new MoveBoleta;
                    $move->boleta_id                                = $boleta->id;
                    $move->estadoBoleta_id                          = 2;
                    $move->fecha                                    = $boleta->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }

            return redirect('/siscom/boletasGarantia')->with('info', 'Boleta Enviada a Custodia con éxito!');
        } 
        else if ($request->flag == 'SolicitudDevolucion') {

            try {

                DB::beginTransaction();

                    $boleta = BoletaGarantia::findOrFail($id);
                        
                    $boleta->estado_id                              = 4;
                    $boleta->save();

                    $move = new MoveBoleta;
                    $move->boleta_id                                = $boleta->id;
                    $move->estadoBoleta_id                          = 3;
                    $move->fecha                                    = $boleta->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/boletasGarantia')->with('info', 'Se ha Recepcionado la Solicitud de Devolución con éxito!');
        } 
        else if ($request->flag == 'DevolverBoleta') {

            try {

                DB::beginTransaction();

                    $boleta = BoletaGarantia::findOrFail($id);
                        
                    $boleta->estado_id                              = 5;
                    $boleta->save();

                    $move = new MoveBoleta;
                    $move->boleta_id                                = $boleta->id;
                    $move->estadoBoleta_id                          = 4;
                    $move->fecha                                    = $boleta->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/boletasGarantia')->with('info', 'Se ha Devuelto la Boleta de Garnatía con éxito!');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BoletaGarantia  $boletaGarantia
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoletaGarantia $boletaGarantia)
    {
        //
    }
}
