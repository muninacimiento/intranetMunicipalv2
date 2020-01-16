<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Caffeinated\Shinobi\Models\Role;
/* Invocamos la clase Carbon para trabajar con fechas */
use Carbon\Carbon;

//Invocamos el Modelo de la Entidad
use App\Dependency;

use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        /*
         * Definimos variable que contendrá la fecha actual del sistema
         */
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');

       /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
       $users = DB::table('users')
                    ->join('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                    ->select('users.*', 'dependencies.name as dependencia')
                    ->orderBy('users.name', 'ASC')
                    ->get();

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('users.index', ["users" => $users, "dateCarbon" => $dateCarbon]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //dd($user);
        
        return view('users.show', compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        $roles = Role::get();

        $dependencies = Dependency::all();

        return view('users.edit', compact('user', 'roles', 'dependencies'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $id)
    {
        
        @if ($request->flag == 'Contraseña') {
            
            $user = User::findOrFail($id);
            $user->password = hash($request->password)

            $user->save();

        }else{

            //Actualizamos al Usuario
            $user->update($request->all());

            //Actualizamos los Roles
            $user->roles()->sync($request->get('roles'));

        }

        

        return redirect()->route('users.index')->with('info', 'Usuario Actualizado con éxito !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
        $user->delete();

        return back()->with('info', 'Usuario Eliminado correctamente !');

    }
}
