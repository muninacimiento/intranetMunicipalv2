<!--
/*
 *  JFuentealba @itux
 *  created at October 24, 2019 - 10:00 am
 *  updated at 
 */
-->

@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-primary shadow">

                <div class="card-header text-center text-white bg-primary">

                    @include('siscom.menu')

                </div>

                <div class="card-body">

                    @if (session('info'))

                        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                              
                            <strong> {{ session('info') }} </strong>
                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                              
                            </button>

                        </div>
                   
                    @endif

                    <h4> Modificación de la Solicitud </h4>

                    <hr style="background-color: #d7d7d7">

                    <div class="form-row mb-3">

                        <div class="col-md-3 mb-3">

                            <label class="text-muted">No. Solicitud</label>
                                                                
                            <h5>{{ $solicitud->id }}</h5>
                                                            
                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="text-muted">Fecha Solicitud</label>
                                                                
                            <h5>{{ date('d-m-Y H:i:s', strtotime($solicitud->created_at)) }}</h5>
                                                            
                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="text-muted">Solicitante</label>
                                                                
                            <h5>{{ $solicitud->nameUser }}</h5>
                                                            
                        </div>

                    </div>

                    

                    <div class="py-3">

                        <form method="POST" action="{{ route('siscom.solicitudGeneral.update', $solicitud->id) }}" class="was-validated">

                            @method('PUT')

                            @csrf                        

                            <div class="form-row">

                                <div class="col-md-12 mb-3">
                                                                                                              
                                    <label for="Motivo">Motivo</label>

                                    <textarea type="text" class="form-control" id="motivo" name="motivo" placeholder="Ingrese el Motivo de su Solicitud" value="{{ $solicitud->motivo }}" required>{{ $solicitud->motivo }}</textarea>

                                    <div class="invalid-feedback">
                                                                                                                            
                                        Por favor ingrese el Motivo de la Solicitud

                                    </div>

                                </div>

                            </div>

                            <div class="form-row mb-5">

                                <div class="col-md-6 mb-3">

                                    <label for="tipoSolicitud">Tipo Solicitud</label>

                                    <select name="tipoSolicitud" class="custom-select" required>

                                        @foreach($tipoSolicituds as $tipoSolicitud)

                                            <option value="{{ $tipoSolicitud->id }}" 

                                                @if($tipoSolicitud->id === $solicitud->tipoSolicitud_id) 

                                                    selected 

                                                @endif >

                                                {{ $tipoSolicitud->tipo }}</option>
                             
                                        @endforeach

                                    </select>

                                    <div class="invalid-feedback">
                                                                                                                            
                                        Por favor ingrese el Tipo de Solicitud

                                    </div>
                                                                                                        
                                </div>  

                                <div class="col-md-6 mb-3" >

                                    <label for="categoriaSolicitud">Categoria Solicitud</label>

                                    <select name="categoriaSolicitud" class="custom-select" required>

                                        @foreach($categoriaSolicituds as $categoriaSolicitud)

                                            <option value="{{ $categoriaSolicitud->id }}" 

                                                @if($categoriaSolicitud->id === $solicitud->categoriaSolicitud_id) 

                                                    selected 

                                                @endif >

                                               {{ $categoriaSolicitud->categoria }}</option>

                                        @endforeach

                                    </select>
                                                                                                                        
                                    <div class="invalid-feedback">
                                                                                                                            
                                        Por favor ingrese la Categoria de la Solicitud

                                    </div>
                                                                                                            
                                </div>  

                            </div>

                            <div class="mb-3 form-row">

                                <button class="btn btn-success btn-block" type="submit">

                                    <i class="fas fa-edit"></i>

                                    Guardar Solicitud

                                </button>

                                <a href="{{ route('siscom.solicitudGeneral.index') }}" class="btn btn-secondary btn-block" type="reset">

                                    <i class="fas fa-arrow-left"></i>

                                    Atrás

                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection