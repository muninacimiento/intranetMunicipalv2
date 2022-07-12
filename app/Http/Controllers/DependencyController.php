<?php

namespace App\Http\Controllers;
use App\Dependency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/* Invocamos el modelo de la Entidad */
use App\Permission;
use Illuminate\Support\Facades\DB;

class DependencyController extends Controller
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
        $dependencies = DB::table('dependencies')
        ->join('users', 'dependencies.user_id', '=', 'users.id')
        ->select('dependencies.*', 'users.name as userName')
        ->where('dependencies.id', 'LIKE', '%'.$search.'%')
        ->orWhere('dependencies.name', 'LIKE', '%'.$search.'%')
        ->orWhere('users.name', 'LIKE', '%'.$search.'%')
        ->orderBy('dependencies.id', 'ASC') //a medida que se ingresan nuevos registros, quedan al inicio de la lista
        ->paginate(10);
//dd($permission);

        /* Retornamos a la vista los resultados psanadolos por parametros */
        return view('dependencies.index', ["dependencies" => $dependencies, "searchText" => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('dependencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dependencies = new Dependency;
        
        $dependencies->name = $request->name;
        $dependencies->user_id = Auth::user()->id;
        
        $dependencies->save();

        return redirect()->route('dependencies.index')->with('info', 'Dependencia Municipal Guardada con Éxito !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dependency  $dependency
     * @return \Illuminate\Http\Response
     */
    public function show(Dependency $dependency)
    {
        return view('dependencies.show', compact('dependency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dependency  $dependency
     * @return \Illuminate\Http\Response
     */
    public function edit(Dependency $dependency)
    {
        return view('dependencies.edit', compact('dependency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dependency  $dependency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dependency $dependency)
    {
        $dependency->update($request->all());

        return redirect()->route('dependencies.index')->with('info', 'Dependencia Municipal Actualizada con éxito !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dependency  $dependency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependency $dependency)
    {
        $dependency->delete();

        return back()->with('info', 'Dependencia Municipal Eliminada correctamente !');
    }
}
