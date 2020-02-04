<?php

namespace App\Http\Controllers;

use App\VentaFarmacia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

/* Invocamos la clase DetalleVenta trabajar con el Detalle de la Venta */
use App\VentaDetalleFarmacia;

use DB;

class VentaFarmaciaController extends Controller
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
         * Definimos el Objeto que contendrá TODOS los usuarios del sistema de farmacia
         */
        $usersVenta = DB::table('usuario_farmacias as UsersVenta')
                    ->select(DB::raw('CONCAT(UsersVenta.id, " ) ", UsersVenta.rut, " / ", UsersVenta.name) as Usuario'), 'UsersVenta.id')
                    ->get();

        $venta = DB::table('venta_farmacias as Venta')
                ->join('usuario_farmacias', 'Venta.userFarmacia_id', '=', 'usuario_farmacias.id')
                ->join('users', 'Venta.user_id', '=', 'users.id')
                ->select('Venta.*', 'usuario_farmacias.name as Comprador', 'users.name as Vendedor')
                ->get();

        return view('farmacia.ventas.index', compact('dateCarbon', 'usersVenta', 'venta'));
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
        // Guardamos el ENCABEZADO de la Venta
        if ($request->flag == 'VentaUsuario') {

            try {

                DB::beginTransaction();

                //Instanciamos un objeto VentaUsuario, para capturar los datos del Usuario
                $ventaUsuario = new VentaFarmacia;
                $ventaUsuario->userFarmacia_id             = $request->userFarmacia_id;
                $ventaUsuario->user_id                     = Auth::user()->id;

                $ventaUsuario->save(); 

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }
            
            return redirect('/farmacia/ventas')->with('info', 'Venta Creada con Éxito !');

        }else if ($request->flag == 'DetalleVenta') {

            try {

                DB::beginTransaction();

                //Instanciamos un objeto VentaUsuario, para capturar los datos del Usuario
                $detalleVenta = new VentaDetalleFarmacia;
                $detalleVenta->venta_id                 = $request->venta_id;
                $detalleVenta->medicamento_id           = $request->medicamento_id;
                $detalleVenta->cantidad                 = $request->cantidad;

                $detalleVenta->save(); 

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }
            
            return back()->with('info', 'Producto Agregado con Éxito !');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VentaFarmacia  $ventaFarmacia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        /*
         * Definimos el Objeto que contendrá los datos de la Venta
         */  
        $venta = DB::table('venta_farmacias as Venta')
                ->join('usuario_farmacias', 'Venta.userFarmacia_id', '=', 'usuario_farmacias.id')
                ->join('users', 'Venta.user_id', '=', 'users.id')
                ->select('Venta.*', 'usuario_farmacias.*', 'usuario_farmacias.name as Comprador', 'users.name as Vendedor')
                 ->where('Venta.id', '=', $id)
                ->first();
        /*
         * Definimos el Objeto que contendrá TODOS los Medicamentos
         */
        $medicamentos = DB::table('medicamentos')
                    ->select(DB::raw('CONCAT(medicamentos.id, " ) ", medicamentos.medicamento, " / ", medicamentos.lote, " / ", medicamentos.fechaVencimiento) as Medicamento'), 'medicamentos.id')
                    ->get();

        $detalleVenta = DB::table('venta_detalle_farmacias')
                        ->join('medicamentos', 'venta_detalle_farmacias.medicamento_id', '=', 'medicamentos.id')
                        ->select('venta_detalle_farmacias.*', 'medicamentos.medicamento as Medicamento', 'medicamentos.precioInventario as Valor', DB::raw('(venta_detalle_farmacias.cantidad * medicamentos.precioInventario) as SubTotal'))
                        ->where('venta_detalle_farmacias.venta_id', '=', $id)
                        ->get();

//dd($detalleVenta);


        return view('farmacia.ventas.show', compact('venta', 'medicamentos', 'detalleVenta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VentaFarmacia  $ventaFarmacia
     * @return \Illuminate\Http\Response
     */
    public function edit(VentaFarmacia $ventaFarmacia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VentaFarmacia  $ventaFarmacia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Guardamos el ENCABEZADO de la Venta
        if ($request->flag == 'ActualizarUsuario') {

            try {

                DB::beginTransaction();

                //Instanciamos un objeto VentaUsuario, para capturar los datos del Usuario
                $ventaUsuario = VentaFarmacia::findOrFail($id);
                $ventaUsuario->userFarmacia_id             = $request->userFarmacia_id;
                $ventaUsuario->user_id                     = Auth::user()->id;

                $ventaUsuario->save(); 

                DB::commit();
                
            } catch (Exception $e) {

                DB::rollback();
                
            }
            
            return redirect('/farmacia/ventas')->with('info', 'Venta Actualizada con Éxito !');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VentaFarmacia  $ventaFarmacia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ventaUsuario = VentaFarmacia::findOrFail($id);
        $ventaUsuario->delete();
        return redirect('/farmacia/ventas')->with('info', 'Venta Eliminada con Éxito !');
    }
}
