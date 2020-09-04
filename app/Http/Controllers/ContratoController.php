<?php

namespace App\Http\Controllers;

use App\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

use App\OrdenCompra;

use App\MoveContrato;

use DB;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

        $contratos = Contrato::join('orden_compras', 'contratos.ordenCompra_id', 'orden_compras.id')
                ->select('contratos.*', 'orden_compras.ordenCompra_id as NoOC')
                ->orderBy('id', 'DESC')->get();

        $ocs = DB::table('orden_compras')
            ->join('status_o_c_s', 'orden_compras.estado_id', 'status_o_c_s.id')
            ->select(DB::raw('CONCAT(orden_compras.id, " ) ", orden_compras.ordenCompra_id, " / ", status_o_c_s.estado) as OC'), 'orden_compras.id')
            ->get();

        return view('siscom.contratos.index', compact('dateCarbon', 'contratos', 'ocs'));
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

                //Comenzamos a capturar desde la vista los datos a guardar los datos del Contrato
                $contrato = new Contrato;
                $contrato->user_id                        = Auth::user()->id;
                $contrato->nombreContrato                 = $request->nombreContrato;
                $contrato->ordenCompra_id                 = $request->ordenCompra_id;
                $contrato->fechaInicio                    = $request->fechaInicio;
                $contrato->fechaTermino                   = $request->fechaTermino;
                $contrato->numeroBoleta                   = $request->numeroBoleta;
                $contrato->banco                          = $request->banco;
                $contrato->montoBoleta                    = $request->montoBoleta;
                
                $contrato->save(); //Guardamos el Contrato

//dd($contrato);

                //Guardamos los datos de Movimientos de la OC
                $move = new MoveContrato;
                $move->contrato_id                  = $contrato->id;
                $move->estadoContrato_id            = 1;
                $move->fecha                        = $contrato->created_at;
                $move->user_id                      = Auth::user()->id;

                $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit(); //Ejecutamos ambas sentencias y si todo resulta OK, guarda, sino ejecuta el catch
                
            } catch (Exception $e) {

                DB::rollback();
                
            }
            
            return redirect('/siscom/contratos')->with('info', 'Contrato Creado con Éxito !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
    {
        echo "SHOW";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contrato $contrato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrato $contrato)
    {
        //
    }
}
