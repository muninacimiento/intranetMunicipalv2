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
        ->join('status_contratos', 'contratos.estado_id', 'status_contratos.id')
        ->select('contratos.*', 'orden_compras.ordenCompra_id as NoOC', 'status_contratos.estado as Estado')
        ->orderBy('contratos.id', 'DESC')->get();

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
                $contrato->estado_id                      = 1;
                $contrato->nombreContrato                 = $request->nombreContrato;
                $contrato->ordenCompra_id                 = $request->ordenCompra_id;
                $contrato->fechaInicio                    = $request->fechaInicio;
                $contrato->fechaTermino                   = $request->fechaTermino;
                $contrato->numeroBoleta                   = $request->numeroBoleta;
                $contrato->banco                          = $request->banco;
                $contrato->montoBoleta                    = $request->montoBoleta;
                $contrato->tipoContrato                   = $request->tipoContrato;
                
                $contrato->save(); //Guardamos el Contrato

//dd($contrato);

                //Guardamos los datos de Movimientos del Contrato
                $move = new MoveContrato;
                $move->contrato_id                  = $contrato->id;
                $move->estadoContrato_id            = 1;
                $move->fecha                        = $contrato->created_at;
                $move->user_id                      = Auth::user()->id;

                $move->save();

                DB::commit();                
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
    public function show($id)
    {        
        $contrato = DB::table('contratos')
        ->join('status_contratos', 'contratos.estado_id', 'status_contratos.id')
        ->join('orden_compras', 'contratos.ordenCompra_id', 'orden_compras.id')
        ->join('proveedores', 'orden_compras.proveedor_id', 'proveedores.id')
        ->select('contratos.*', 'status_contratos.estado as Estado', 'orden_compras.ordenCompra_id as NoOC', 'proveedores.razonSocial as Proveedor')
        ->where('contratos.id', $id)
        ->first();
//dd($contrato);

        $move = DB::table('move_contratos') 
        ->join('status_contratos', 'move_contratos.estadoContrato_id', 'status_contratos.id')               
        ->join('users', 'move_contratos.user_id', 'users.id')
        ->select('move_contratos.*', 'status_contratos.estado as status', 'users.name as name', 'move_contratos.created_at as date')
        ->where('move_contratos.contrato_id', '=', $id)
        ->get();

        $moveBoleta = DB::table('move_boletas') 
        ->join('status_boletas', 'move_boletas.estadoBoleta_id', 'status_boletas.id')               
        ->join('users', 'move_boletas.user_id', 'users.id')
        ->join('boleta_garantias', 'move_boletas.boleta_id', 'boleta_garantias.id')
        ->join('contratos', 'boleta_garantias.contrato_id', 'contratos.id')
        ->select('move_boletas.*', 'status_boletas.estado as status', 'users.name as name', 'move_boletas.created_at as date')
        ->where('contratos.id', '=', $id)
        ->get();
//dd($move);

        return view('siscom.contratos.show', compact('contrato', 'move', 'moveBoleta'));
    }

    public function validar($id)
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');        

        $contrato = DB::table('contratos')
        ->join('status_contratos', 'contratos.estado_id', 'status_contratos.id')
        ->join('orden_compras', 'contratos.ordenCompra_id', 'orden_compras.id')
        ->join('proveedores', 'orden_compras.proveedor_id', 'proveedores.id')
        ->select('contratos.*', 'status_contratos.estado as Estado', 'orden_compras.ordenCompra_id as NoOC', 
                    'orden_compras.enviadaProveedor as EnviadaProveedor', 'proveedores.razonSocial as Proveedor')
        ->where('contratos.id', $id)
        ->first();
//dd($contrato);

        $move = DB::table('move_contratos') 
        ->join('status_contratos', 'move_contratos.estadoContrato_id', 'status_contratos.id')               
        ->join('users', 'move_contratos.user_id', 'users.id')
        ->select('move_contratos.*', 'status_contratos.estado as status', 'users.name as name', 'move_contratos.created_at as date')
        ->where('move_contratos.contrato_id', '=', $id)
        ->get();
//dd($move);

        return view('siscom.contratos.validar', compact('contrato', 'move', 'dateCarbon'));
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
    public function update(Request $request, $id)
    {        
        //Actualizamos el Encabezado de la Órden de Compra
        if ($request->flag == 'Actualizar') {
            $contrato = Contrato::findOrFail($id);
            $contrato->user_id                        = Auth::user()->id;
            $contrato->nombreContrato                 = $request->nombreContrato;
            $contrato->ordenCompra_id                 = $request->ordenCompra_id;
            $contrato->fechaInicio                    = $request->fechaInicio;
            $contrato->fechaTermino                   = $request->fechaTermino;
            $contrato->numeroBoleta                   = $request->numeroBoleta;
            $contrato->banco                          = $request->banco;
            $contrato->montoBoleta                    = $request->montoBoleta;
            $contrato->tipoContrato                   = $request->tipoContrato;
                
            $contrato->save(); //Guardamos el Contrato

            return redirect('/siscom/contratos')->with('info', 'Contrato Actualizado con éxito!');
        }
        // Anular Órden de Compra
        else if ($request->flag == 'Anular') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);
                    $contrato->motivoAnulacion                = $request->motivoAnulacion;
                    $contrato->estado_id                      = 2;

                    $contrato->save();

                    //Guardamos los datos de Movimientos del Contrato
                    $move = new MoveContrato;
                    $move->contrato_id                  = $contrato->id;
                    $move->estadoContrato_id            = 2;
                    $move->fecha                        = $contrato->created_at;
                    $move->user_id                      = Auth::user()->id;

                    $move->save(); 

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Anulado con éxito !');
        }   
        else if ($request->flag == 'RecepcionadoC&S') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);
                        
                    $contrato->estado_id                            = 3;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 22;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return back()->with('info', 'Contrato Recepcionado por C&S con éxito !');
        } 
        else if ($request->flag == 'AprobadoC&S') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    $contrato->estado_id                            = 6;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 4;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Aprobado por C&S con éxito !');
        }

        else if ($request->flag == 'RechazadoC&S') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    $contrato->estado_id                            = 3;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 5;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;
                    $move->observacion                              = $request->observacion;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Rechazado por C&S con éxito !');
        }
        else if ($request->flag == 'AprobadoProfDAF') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    $contrato->estado_id                            = 9;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 7;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                DB::commit();               
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Aprobado por Profesional DAF con éxito !');
        }
        else if ($request->flag == 'RechazadoProfDAF') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    $contrato->estado_id                            = 3;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 8;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;
                    $move->observacion                              = $request->observacion;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Rechazado por Profesional DAF con éxito !');
        }
        else if ($request->flag == 'FirmadoPorDAF') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    if ($contrato->tipoContrato == 'Mayor o Igual a 500 UTM') {
                        
                        $contrato->estado_id                            = 12;
                        $contrato->save();

                        $move = new MoveContrato;
                        $move->contrato_id                              = $contrato->id;
                        $move->estadoContrato_id                        = 10;
                        $move->fecha                                    = $contrato->updated_at;
                        $move->user_id                                  = Auth::user()->id;

                        $move->save();
                    }
                    else{
                        $contrato->estado_id                            = 15;
                        $contrato->save();

                        $move = new MoveContrato;
                        $move->contrato_id                              = $contrato->id;
                        $move->estadoContrato_id                        = 10;
                        $move->fecha                                    = $contrato->updated_at;
                        $move->user_id                                  = Auth::user()->id;

                        $move->save();
                    }                    

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Aprobado por DAF con éxito !');
        }
        else if ($request->flag == 'RechazadoDAF') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    $contrato->estado_id                            = 3;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 11;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;
                    $move->observacion                              = $request->observacion;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Rechazado por DAF con éxito !');
        }
        else if ($request->flag == 'FirmadoPorControl') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    $contrato->estado_id                            = 15;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 13;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Aprobado por Dirección de Control con éxito !');
        }   
        else if ($request->flag == 'RechazadoControl') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    $contrato->estado_id                            = 3;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 14;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;
                    $move->observacion                              = $request->observacion;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Rechazado por Dirección de Control con éxito !');
        }   
        else if ($request->flag == 'FirmadoProveedor') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    $contrato->estado_id                            = 17;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 15;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Firmado por el Proveedor con éxito !');
        }   

        else if ($request->flag == 'FirmadoAlcaldia') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    $contrato->estado_id                            = 19;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 16;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 18;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Contrato Firmado por Alcaldía con éxito !');
        }
        else if ($request->flag == 'DerivarCopias') {
            try {
                DB::beginTransaction();

                    $contrato = Contrato::findOrFail($id);

                    $contrato->estado_id                            = 21;
                    $contrato->save();

                    $move = new MoveContrato;
                    $move->contrato_id                              = $contrato->id;
                    $move->estadoContrato_id                        = 21;
                    $move->fecha                                    = $contrato->updated_at;
                    $move->user_id                                  = Auth::user()->id;

                    $move->save();

                DB::commit();                
            } catch (Exception $e) {
                db::rollback();                
            }
            return redirect('/siscom/contratos')->with('info', 'Copias del Contrato Derivadas con éxito !');
        }  
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
