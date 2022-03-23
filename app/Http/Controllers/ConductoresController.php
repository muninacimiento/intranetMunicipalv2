<?php

namespace App\Http\Controllers;

use App\Conductor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

class ConductoresController extends Controller
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
        $conductores = Conductor::orderBy('rut', 'ASC')->get();
        return view('sispam.conductores.index', compact('dateCarbon', 'conductores'));
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
        
        $conductor = new Conductor;

        $conductor->rut      = $request->rut;
        $conductor->nombre        = $request->nombre;
        //$vehiculo->idUser       = Auth::user()->id;

        $conductor->save();

        return redirect('sispam/conductores')->with('info', 'Conductor Registrado con Éxito !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UsuarioFarmacia  $usuarioFarmacia
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioFarmacia $usuarioFarmacia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UsuarioFarmacia  $usuarioFarmacia
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuarioFarmacia $usuarioFarmacia)
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
     

            $conductor = Conductor::findOrFail($id);

            $conductor->rut      = $request->rut;
            $conductor->nombre        = $request->nombre;

            $conductor->save();

            return redirect('sispam/conductores')->with('info', 'Conductor Actualizado con Éxito !');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UsuarioFarmacia  $usuarioFarmacia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $usuario = UsuarioFarmacia::findOrFail($id);
        $usuario->delete();

        return redirect('farmacia/usuarios')->with('info', 'Usuario Eliminado con Éxito !');


    }
}
