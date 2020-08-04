<?php

namespace App\Http\Controllers;

use App\Contrato;
use Illuminate\Http\Request;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

use App\OrdenCompra;

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

        return view('siscom.contratos.index', compact('dateCarbon'));
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

                //Guardamos los datos de Movimientos de la OC
                $move = new MoveOC;
                $move->ordenCompra_id               = $oc->id;
                $move->estadoOrdenCompra_id         = 1;
                $move->fecha                        = $oc->created_at;
                $move->user_id                      = Auth::user()->id;

                $move->save(); //Guardamos el Movimiento de la Solicitud    

                DB::commit(); //Ejecutamos ambas sentencias y si todo resulta OK, guarda, sino ejecuta el catch
                
            } catch (Exception $e) {

                DB::rollback();
                
            }
            
            return redirect('/siscom/ordenCompra')->with('info', 'Órden de Compra Creada con Éxito !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contrato  $contrato
     * @return \Illuminate\Http\Response
     */
    public function show(Contrato $contrato)
    {
        //
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
