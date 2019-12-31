<?php

namespace App\Http\Controllers;

use App\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

class ProveedoresController extends Controller
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

        $proveedores = Proveedores::all();

        return view('siscom.proveedores.index', compact('proveedores', 'dateCarbon'));
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
        
        $proveedor = new Proveedores;
        
        $proveedor->rut             = $request->rut;
        $proveedor->razonSocial     = $request->razonSocial;
        $proveedor->alias           = $request->alias;
        $proveedor->giro            = $request->giro;
        $proveedor->direccion       = $request->direccion;
        $proveedor->ciudad          = $request->ciudad;
        $proveedor->telefono        = $request->telefono;
        $proveedor->correo          = $request->correo;
        $proveedor->user_id         = Auth::user()->id;
        
        $proveedor->save();

        return redirect('/siscom/proveedores')->with('info', 'Proveedor Guardado con Éxito !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedores $proveedores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedores $proveedores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // Actualizar Proveedor
        if ($request->flag == 'Actualizar') {

            $proveedor = Proveedores::findOrFail($id);

            $proveedor->rut             = $request->rut;
            $proveedor->razonSocial     = $request->razonSocial;
            $proveedor->alias           = $request->alias;
            $proveedor->giro            = $request->giro;
            $proveedor->direccion       = $request->direccion;
            $proveedor->ciudad          = $request->ciudad;
            $proveedor->telefono        = $request->telefono;
            $proveedor->correo          = $request->correo;
            $proveedor->user_id         = Auth::user()->id;
            
            $proveedor->save();

            return redirect('/siscom/proveedores')->with('info', 'Proveedor Actualizado con éxito !');
        }

        // Actualizar Proveedor
        else if ($request->flag == 'Eliminar') {

            $proveedor = Proveedores::findOrFail($id);
            
            $proveedor->delete();

            return redirect('/siscom/proveedores')->with('info', 'Proveedor Eliminado con éxito !');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedores $proveedores)
    {
        //
    }
}
