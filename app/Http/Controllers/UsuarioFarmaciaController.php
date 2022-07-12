<?php

namespace App\Http\Controllers;

use App\UsuarioFarmacia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

class UsuarioFarmaciaController extends Controller
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
        $usuarios = UsuarioFarmacia::all();

        return view('farmacia.usuarios.index', compact('dateCarbon', 'usuarios'));
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
        
        $usuario = new UsuarioFarmacia;

        $usuario->rut                   = $request->rut;
        $usuario->name                  = $request->name;
        $usuario->direccion             = $request->direccion;
        $usuario->poblacion             = $request->poblacion;
        $usuario->telefono              = $request->telefono;
        $usuario->sistemaPrevisional    = $request->sistemaPrevisional;
        $usuario->user_id               = Auth::user()->id;

      
        $found = DB::table('usuario_farmacias')->where('rut', $usuario->rut = $request->rut)->exists();
        if($found == 0)
            {
                $usuario->save();
                return redirect('farmacia/usuarios')->with('info', 'Usuario Creado con Éxito !');
            } else{
                return redirect('farmacia/usuarios')->with('info', 'Usuario YA Registrado !');
            }


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
     
        $usuario = UsuarioFarmacia::findOrFail($id);

        $usuario->rut                   = $request->rut;
        $usuario->name                  = $request->name;
        $usuario->direccion             = $request->direccion;
        $usuario->poblacion             = $request->poblacion;
        $usuario->telefono              = $request->telefono;
        $usuario->sistemaPrevisional    = $request->sistemaPrevisional;

        $usuario->save();

        return redirect('farmacia/usuarios')->with('info', 'Usuario Actualizado con Éxito !');

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
