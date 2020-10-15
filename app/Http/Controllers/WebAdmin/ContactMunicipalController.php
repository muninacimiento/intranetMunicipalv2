<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ContactMunicipal;
use App\Dependency;
use Carbon\Carbon;

class ContactMunicipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dateCarbon = Carbon::now()->locale('es')->isoFormat('dddd D, MMMM YYYY');
        $contacts = ContactMunicipal::get();
        return view ('webadmin.contactosMunicipales.index', compact('contacts', 'dateCarbon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dependencies = Dependency::pluck('name', 'id');
        return view('webadmin.contactosMunicipales.create', compact('dependencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $contact = ContactMunicipal::create($request->all());
        return redirect()->route('contacts.index')->with('info', 'Contacto Creado Correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = ContactMunicipal::findOrFail($id);
        return view('webadmin.contactosMunicipales.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dependencies = Dependency::pluck('name', 'id');       
        $contact = ContactMunicipal::findOrFail($id);
        return view('webadmin.contactosMunicipales.edit', compact('dependencies', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = ContactMunicipal::findOrFail($id);
        $contact->fill($request->all())->save();

        return redirect()->route('contacts.index')->with('info', 'Contacto Actualizado Correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContactMunicipal::findOrFail($id)->delete();
        return redirect()->route('contacts.index')->with('info', 'Contacto Eliminado Correctamente.');
    }
}
