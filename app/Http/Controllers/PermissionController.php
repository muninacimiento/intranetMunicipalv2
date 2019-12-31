<?php

/*
 *  JFuentealba @itux
 *  created at September 13, 2019 - 16:25 pm
 *  updated at 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
/* Invocamos el modelo de la Entidad */
use App\Permission;
use App\User;
use DB;

class PermissionController extends Controller
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
       $permission = DB::table('permissions')
                    ->join('users', 'permissions.user_id', '=', 'users.id')
                    ->select('permissions.*', 'users.name as userName')
                    ->where('permissions.id', 'LIKE', '%'.$search.'%')
                    ->orWhere('permissions.name', 'LIKE', '%'.$search.'%')
                    ->orWhere('permissions.slug', 'LIKE', '%'.$search.'%')
                    ->orWhere('permissions.description', 'LIKE', '%'.$search.'%')
                    ->orWhere('users.name', 'LIKE', '%'.$search.'%')
                    ->orderBy('permissions.id', 'DESC') //a medida que se ingresan nuevos registros, quedan al inicio de la lista
                    ->paginate(10);

                    //dd($permission);

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('permissions.index', ["permissions" => $permission, "searchText" => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        $permissions = new Permission;
        
        $permissions->name = $request->name;
        $permissions->slug = $request->slug;
        $permissions->description = $request->description;
        $permissions->user_id = Auth::user()->id;
        
        $permissions->save();

        return redirect()->route('permissions.index')->with('info', 'Permiso Guardado con Éxito !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {

        return view('permissions.show', compact('permission'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        
        return view('permissions.edit', compact('permission'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {

        $permission->update($request->all());

        return redirect()->route('permissions.index')->with('info', 'Permiso Actualizado con éxito !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        
        $permission->delete();

        return back()->with('info', 'Permiso Eliminado correctamente !');
    }
}
