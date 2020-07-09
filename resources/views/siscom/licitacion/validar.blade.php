@extends('layouts.app')

@section('content')

<div id="allWindow">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-primary shadow">

                <div class="card-header text-center text-white bg-primary mb-3">

                    @include('siscom.menu')

                </div>

                    <div class="card-body">

                        @if (session('status'))
    
                            <div class="alert alert-success" role="alert">

                                {{ session('status') }}
                            
                            </div>

                        @endif

                        <a href="{{action('LicitacionController@index')}}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                        <h4>No. Licitación <input type="text" value="{{ $licitacion->licitacion_id }}" readonly class="h4" style="border:0;" name="licitacion_id" id="licitacion_id" form="detalleLicitacionForm"> </h4>

                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                            <div class="container">

                                <div class="form-row">

                                    <div class="col-lg">

                                        <div class="form-row">
                                            
                                            <label class="col-sm-6 col-form-label text-muted">Fecha Licitación</label>
                                                                        
                                            <label class="col-sm-6 col-form-label">{{ date('d-m-Y H:i:s', strtotime($licitacion->created_at)) }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class="col-sm-6 col-form-label text-muted">IDDOC</label>
                                                                        
                                            <label class="col-sm-6 col-form-label">{{ $licitacion->iddoc }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-6 col-form-label text-muted">Estado</label>
                                                                        
                                            <label class=" col-sm-6 col-form-label">{{ $licitacion->Estado }}</label>     

                                        </div>

                                        <div class="form-row">
                                        
                                            <label class=" col-sm-6 col-form-label text-muted">Propósito</label>

                                            <label class="col-sm-6 col-form-label">{{ $licitacion->proposito }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-6 col-form-label text-muted">Valor Estimado</label>
                                                                        
                                            <label class=" col-sm-6 col-form-label">{{ $licitacion->valorEstimado }}</label>     

                                        </div>
                                                                    
                                    </div>

                                    <div class="col-sm text-center">

                                        <label class="text-muted">Bases de Licitación</label>

                                        {{-- COMIENZA EL CICLO DE EVALUACIÓN DE LAs BASES --}}

                                        @if($licitacion->Estado == 'Bases Recepcionadas y en Revisión por C&S' || $licitacion->Estado == 'Bases en Revisión por C&S')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#aprobadaCS">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobada por C&S

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadaCS">

                                                <button class="btn btn-danger btn-block mb-1">

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por C&S

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobada por C&S

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por C&S

                                                </button>

                                            </a>

                                        @endif

                                        @if($licitacion->Estado == 'Bases en Revisión por Profesional D.A.F.')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#aprobadaProfDAF">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobada por Profesional D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadaProfDAF">

                                                <button class="btn btn-danger btn-block mb-1">

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por Profesional D.A.F.

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobada por Profesional D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por Profesional D.A.F.

                                                </button>

                                            </a>

                                        @endif

                                        @if($licitacion->Estado == 'Bases en Firma D.A.F.')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmaDAF">

                                                <button class="btn btn-success btn-block mb-1" >

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadaDAF">

                                                <button class="btn btn-danger btn-block mb-1" >

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por D.A.F.

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por D.A.F.

                                                </button>

                                            </a>

                                        @endif

                                        @if($licitacion->Estado == 'Bases en Firma Dirección de Control')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmaControl">

                                                <button class="btn btn-success btn-block mb-1" >

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por Dirección de Control

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadaControl">

                                                <button class="btn btn-danger btn-block mb-1" >

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por Dirección de Control

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por Dirección de Control

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por Dirección de Control

                                                </button>

                                            </a>

                                        @endif

                                        @if($licitacion->Estado == 'Bases en Firma Administración')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmaAdministracion">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por Administración

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por Administración

                                                </button>

                                            </a>

                                        @endif


                                    </div>

                                    {{-- TERMINA EL CICLO DE EVALUACIÓN DE LAS BASES --}}

                                    {{-- COMIENZA EL CICLO DE EVALUACIÓN DE LA ADJUDICACIÓN --}}

                                    <div class="col-sm text-center">

                                        <label class="text-muted">Adjudicación de Licitación</label>

                                        @if($licitacion->Estado == 'Adjudicación Recepcionada y en Revisión por C&S' || $licitacion->Estado == 'Adjudicación en Revisión por C&S')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#adjAprobadaCS">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobada por C&S

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#adjRechazadaCS">

                                                <button class="btn btn-danger btn-block mb-1">

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por C&S

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobada por C&S

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por C&S

                                                </button>

                                            </a>

                                        @endif

                                        @if($licitacion->Estado == 'Adjudicación en Revisión por Profesional D.A.F.')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#adjAprobadaProfDAF">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobada por Profesional D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#adjRechazadaProfDAF">

                                                <button class="btn btn-danger btn-block mb-1">

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por Profesional D.A.F.

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobada por Profesional D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por Profesional D.A.F.

                                                </button>

                                            </a>

                                        @endif

                                        @if($licitacion->Estado == 'Adjudicación en Firma D.A.F.')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#adjFirmaDAF">

                                                <button class="btn btn-success btn-block mb-1" >

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#adjRechazadaDAF">

                                                <button class="btn btn-danger btn-block mb-1" >

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por D.A.F.

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazada por D.A.F.

                                                </button>

                                            </a>

                                        @endif

                                        @if($licitacion->Estado == 'Adjudicación en Firma Alcadía')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#adjFirmaAlcaldia">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por Alcaldía

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por Alcaldía

                                                </button>

                                            </a>

                                        @endif

                                        @if($licitacion->Estado == 'Adjudicación en Firma Administración')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#adjFirmaAdministracion">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por Administración

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por Administración

                                                </button>

                                            </a>

                                        @endif

                                        {{-- TERMINA EL CICLO DE EVALUACIÓN DE LA ADJUDICACIÓN --}}

                                    </div>


                                </div>

                            </div>

                            <hr style="background-color: #d7d7d7">

                        </div>

                        <div>
                            <div class="mb-5">
                                    
                                <h5>Detalle la Licitación</h5>   

                            </div>
                            

                            <div>

                                <table class="display" id="detalleSolicitud" width="100%" style="font-size: 0.9em">

                                    <thead>

                                        <tr>

                                            <th style="display: none;">ID</th>

                                            <th>No. Solicitud</th>

                                            <th>Producto</th>

                                            <th>Especificación</th>

                                            <th>Cantidad</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach($detalleSolicitud as $ds)

                                        <tr>

                                            <td style="display: none;">{{ $ds->id }}</td>

                                            <td>{{ $ds->solicitud_id }}</td>

                                            <td>{{ $ds->Producto }}</td>

                                            <td>{{ $ds->especificacion }}</td>

                                            <td>{{ $ds->cantidad }}</td>                                            

                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                
                </div>
            </div>

        </div>

    </div>
        
</div>

{{-- INICIO EVALUACIÓN BASES DE LICITACIÓN --}}

<!-- Bases de Licitación Aprobada por C&S -->
<div class="modal fade" id="aprobadaCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AprobadaC&S">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Aprobada por C&S </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Aprobar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Bases de Licitación Aprobada por C&S -->

<!-- Bases de Licitación Rechazada por C&S -->
<div class="modal fade" id="rechazadaCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadaC&S">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Rechazada por C&S </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" id="motivoRechazo" name="motivoRechazo" placeholder="Ingrese el Motivo del porqué va a Rechazar la Licitación" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Licitación

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Bases de Licitación Rechazada por C&S -->

<!-- Bases de Licitación Aprobada por Profesional DAF -->
<div class="modal fade" id="aprobadaProfDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AprobadaProfDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Aprobada por Profesional D.A.F. </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Aprobar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Bases de Licitación Aprobada por Profesional DAF -->

<!-- Bases de Licitación Rechazada por Profesional DAF -->
<div class="modal fade" id="rechazadaProfDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadaProfDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Rechazada por Profesional D.A.F. </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" id="motivoRechazo" name="motivoRechazo" placeholder="Ingrese el Motivo del porqué va a Rechazar la Órden de Compra" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Licitación

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Bases de Licitación Rechazada por Profesional DAF -->

<!-- Bases de Licitación Aprobada por DAF -->
<div class="modal fade" id="firmaDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadaPorDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Firmada por D.A.F.</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Licitación por D.A.F.

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Bases de Licitación Aprobada por DAF -->

<!-- Bases de Licitación Rechazada por DAF -->
<div class="modal fade" id="rechazadaDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadaDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Rechazada por D.A.F.</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" id="motivoRechazo" name="motivoRechazo" placeholder="Ingrese el Motivo del porqué va a Rechazar la Órden de Compra" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Licitación

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Bases de Licitación Rechazada por DAF -->

<!-- Bases de Licitación Aprobada por Dirección de Control -->
<div class="modal fade" id="firmaControl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadaPorControl">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Firmada por Dirección de Control</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Licitación por Dirección de Control

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Bases de Licitación Aprobada por Dirección de Control -->

<!-- Bases de Licitación Rechazada por Dirección de Control -->
<div class="modal fade" id="rechazadaControl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadaControl">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Rechazada por Dirección de Control</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" id="motivoRechazo" name="motivoRechazo" placeholder="Ingrese el Motivo del porqué va a Rechazar la Órden de Compra" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Licitación

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Bases de Licitación Rechazada por Dirección de Control -->

<!-- Bases de Licitación Aprobada por Administración -->
<div class="modal fade" id="firmaAdministracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadaPorAdministracion">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Firmada por Administración</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Licitación por Administración

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Bases de Licitación Aprobada por Administración -->

{{-- FIN EVALUACIÓN BASES DE LICITACIÓN --}}

{{-- INICIO EVALUACIÓN ADJUDICACIÓN DE LICITACIÓN --}}

<!-- Adjudicación de Licitación Aprobada por C&S -->
<div class="modal fade" id="adjAprobadaCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AdjAprobadaC&S">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Aprobada por C&S </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Aprobar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Adjudicación de Licitación Aprobada por C&S -->

<!-- Adjudicación de Licitación Rechazada por C&S -->
<div class="modal fade" id="adjRechazadaCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AdjRechazadaC&S">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Rechazada por C&S </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" id="motivoRechazo" name="motivoRechazo" placeholder="Ingrese el Motivo del porqué va a Rechazar la Licitación" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Licitación

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Adjudicación de Licitación Rechazada por C&S -->

<!-- Adjudicación de Licitación Aprobada por Profesional DAF -->
<div class="modal fade" id="adjAprobadaProfDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AdjAprobadaProfDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Aprobada por Profesional D.A.F. </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Aprobar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Adjudicación de Licitación Aprobada por Profesional DAF -->

<!-- Adjudicación de Licitación Rechazada por Profesional DAF -->
<div class="modal fade" id="adjRechazadaProfDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AdjRechazadaProfDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Rechazada por Profesional D.A.F. </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" id="motivoRechazo" name="motivoRechazo" placeholder="Ingrese el Motivo del porqué va a Rechazar la Órden de Compra" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Licitación

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Adjudicación de Licitación Rechazada por Profesional DAF -->

<!-- Adjudicación de Licitación Aprobada por DAF -->
<div class="modal fade" id="adjFirmaDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AdjFirmadaPorDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Firmada por D.A.F.</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Licitación por D.A.F.

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Adjudicacion de Licitación Aprobada por DAF -->

<!-- Adjudicación de Licitación Rechazada por DAF -->
<div class="modal fade" id="adjRechazadaDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AdjRechazadaDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Rechazada por D.A.F.</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" id="motivoRechazo" name="motivoRechazo" placeholder="Ingrese el Motivo del porqué va a Rechazar la Órden de Compra" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Licitación

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Licitación

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Adjudicación de Licitación Rechazada por DAF -->

<!-- Adjudicación de Licitación Aprobada por Alcaldía -->
<div class="modal fade" id="adjFirmaAlcaldia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AdjFirmadaPorAlcaldia">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Firmada por Alcaldía</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Órden De Compra por Alcaldía

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Adjudicación de Licitación Aprobada por Alcaldía -->

<!-- Adjudicación de Licitación Aprobada por Administración -->
<div class="modal fade" id="adjFirmaAdministracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('licitacion.update', $licitacion->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AdjFirmadaPorAdministracion">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Licitación Firmada por Administración</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Licitación</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $licitacion->licitacion_id }}" readonly style="border:0;" name="licitacion_id" id="licitacion_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Licitación por Administración

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Adjudicación de Licitación Aprobada por Administración -->

{{-- FIN EVALUACIÓN ADJUDICACIÓN DE LICITACIÓN --}}

@endsection

@push('scripts')

<!-- JQuery DataTable -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>

<!-- JQuery DatePicker -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Boostrap Select -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

<script>
    
    $(document).ready(function () {

        var height = $(window).height();
            $('#allWindow').height(height);

        $( "#fechaActividad" ).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: "+14d",
            firstDay: 1,
            dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
            numberOfMonths: 2,
        });

        var tSolicitud = $('#tipoSolicitud').val();

        if (tSolicitud === "Actividad") {

            $('input[type="button"]').removeAttr('disabled');

        }

            // Start Configuration DataTable Detalle Solicitud
            var table = $('#detalleSolicitud').DataTable({
                "paginate"  : true,

                "ordering": false,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Productos en su Solicitud, aún...",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     ">>",
                                "sPrevious": "<<"
                            },
                            "oAria": {
                                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            },
                            "buttons": {
                                "copy": "Copiar",
                                "colvis": "Visibilidad"
                            }
                        }
            });

            //Start Edit Record Detalle Solicitud
            table.on('click', '.asignarOC', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var dataDetalle = table.row($tr).data();

                console.log(dataDetalle);

               // $('#Producto').val(dataDetalle[2]);

                $('#detalleOrdenCompraForm').attr('action', '/siscom/solicitud/' + dataDetalle[0]);
                $('#asignarOCModal').modal('show');

            });
            //End Edit Record Detalle Solicitud
            

            //Start Delete Record Detalle Solicitud 
            table.on('click', '.eliminarOC', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var dataDetalle = table.row($tr).data();

                console.log(dataDetalle);
                
                $('#deleteDetalleForm').attr('action', '/siscom/solicitud/' + dataDetalle[0]);
                $('#deleteDetalleModal').modal('show');

            });
            //End Delete Record Detalle Solicitud

        //Recorremos la Tabla y Sumamos cada Subtotal
        var cls = document.getElementById("detalleSolicitud").getElementsByTagName("td");
        var sum = 0;
        for (var i = 0; i < cls.length; i++){
            if(cls[i].className == "subtotal"){
                sum += isNaN(cls[i].innerHTML) ? 0 : parseInt(cls[i].innerHTML);
            }
        }

        $('#total').val(sum);
        
    });


</script>

@endpush