<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Caffeinated\Shinobi\Models\Role;
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
       /* Declaramos una variable para realizar búsquedas en nuestros formularios */
       $search = trim($request->get('searchText')); //searchText variable enviada desde el formulario

       /* Declaramos la variable que contendrá todos los permisos existentes en la base de datos */
       $users = DB::table('users')
                    ->join('dependencies', 'users.dependency_id', '=', 'dependencies.id')
                    ->select('users.*', 'dependencies.name as dependencia')
                    ->where('users.name', 'LIKE', '%'.$search.'%')
                    ->orWhere('users.email', 'LIKE', '%'.$search.'%')
                    ->orWhere('dependencies.name', 'LIKE', '%'.$search.'%')
                    ->orderBy('users.name', 'ASC') //a medida que se ingresan nuevos registros, quedan al inicio de la lista
                    ->paginate(10);

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('users.index', ["users" => $users, "searchText" => $search]);
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

        return view('users.edit', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        //Actualizamos al Usuario
        $user->update($request->all());

        //Actualizamos los Roles
        $user->roles()->sync($request->get('roles'));

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
