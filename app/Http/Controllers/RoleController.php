<?php

/*
 *  JFuentealba @itux
 *  created at September 23, 2019 - 10:56 pm
 *  updated at 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//Invocamos los modelos de la clase
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use DB;

class RoleController extends Controller
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

       /* Declaramos la variable que contendrá todos los roles existentes en la base de datos */
       $roles = DB::table('roles')
                    ->join('users', 'roles.user_id', '=', 'users.id')
                    ->select('roles.*', 'users.name as userName')
                    ->where('roles.name', 'LIKE', '%'.$search.'%')
                    ->orWhere('roles.slug', 'LIKE', '%'.$search.'%')
                    ->orWhere('roles.description', 'LIKE', '%'.$search.'%')
                    ->orWhere('users.name', 'LIKE', '%'.$search.'%')
                    ->orderBy('roles.id', 'DESC') //a medida que se ingresan nuevos registros, quedan al inicio de la lista
                    ->paginate(10);

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('roles.index', ["roles" => $roles, "searchText" => $search]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $permissions = Permission::get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Guardamos un Rol
        $role = new Role;
        
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;
        $role->user_id = Auth::user()->id;
        
        $role->save();
        //$role = Role::create($request->all());

        //Actualizamos los permisos
        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index')->with('info', 'Rol Guardado con Éxito !');;        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {

        return view('roles.show', compact('role'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

        $permissions = Permission::get();
        
        return view('roles.edit', compact('role', 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        
        //Acualizamos el Rol
        $role->update($request->all());

        //Actualizamos los permisos
        $role->permissions()->sync($request->get('permissions'));

        return redirect()->route('roles.index')->with('info', 'Rol Actualizado con éxito !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        
        $role->delete();

        return back()->with('info', 'Rol Eliminado correctamente !');

    }
}
