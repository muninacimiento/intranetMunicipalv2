<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;

use App\Tag;

use Carbon\Carbon;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');
        
        $tags = Tag::orderBy('id', 'DESC')->get();

        return view('webadmin.tags.index', compact('tags', 'dateCarbon'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('webadmin.tags.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagStoreRequest $request)
    {
        
        $tag = Tag::create($request->all());

        return redirect()->route('tags.index')->with('info', 'Etiqueta Creada Correctamente.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $tag = Tag::findOrFail($id);

        return view('webadmin.tags.show', compact('tag'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $tag = Tag::findOrFail($id);

        return view('webadmin.tags.edit', compact('tag'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, $id)
    {
        
        $tag = Tag::findOrFail($id);

        //Validaciones

        $tag->fill($request->all())->save();

        return redirect()->route('tags.index')->with('info', 'Etiqueta Actualizada Correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Tag::findOrFail($id)->delete();

        return redirect()->route('tags.index')->with('info', 'Etiqueta Eliminada Correctamente.');

    }
}
