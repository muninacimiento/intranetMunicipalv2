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

                        <a href="{{action('ContratoController@index')}}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                        <h4> Nombre Contrato: {{ $contrato->nombreContrato }}</h4>

                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                            <div class="container">

                                <div class="form-row">

                                    <div class="col-md-6">

                                    	<div class="form-row">
                                            
                                            <label class="col-sm-3 col-form-label text-muted">Estado Contrato</label>
                                                                        
                                            <label class="col-sm-9 col-form-label">{{ $contrato->Estado }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class="col-sm-3 col-form-label text-muted">Orden de Compra</label>
                                                                        
                                            <label class="col-sm-9 col-form-label">{{ $contrato->NoOC }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class="col-sm-3 col-form-label text-muted">Proveedor</label>
                                                                        
                                            <label class="col-sm-9 col-form-label">{{ $contrato->Proveedor }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class="col-sm-3 col-form-label text-muted">Orden de Compra Enviada al Proveedor</label>
                                                                        
                                            @if($contrato->EnviadaProveedor === 1)

                                            	<label class="col-sm-9 col-form-label">Si</label>

                                            @else
													
												<label class="col-sm-9 col-form-label">No</label>

											@endif

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Fecha Inicio del Contrato</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ date('d-m-Y', strtotime($contrato->fechaInicio)) }}</label>     

                                        </div>

                                        <div class="form-row">
                                        
                                            <label class=" col-sm-3 col-form-label text-muted">Fecha de Término del Contrato</label>

                                            <label class="col-sm-9 col-form-label">{{ date('d-m-Y', strtotime($contrato->fechaTermino)) }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Número Boleta de Garantía</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $contrato->numeroBoleta }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Banco de la Boleta de Garantía</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $contrato->banco }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Monto Boleta de Garantía ($)</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $contrato->montoBoleta }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Tipo Contrato</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $contrato->tipoContrato }}</label>     

                                        </div>

                                    </div>

                                    <div class="col-6">

                                        @if($contrato->estado_id === 3)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#aprobadoCS">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobado por C&S

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadoCS">

                                                <button class="btn btn-danger btn-block mb-1">

                                                    <i class="fas fa-times"></i>

                                                    Rechazado por C&S

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobado por C&S

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazado por C&S

                                                </button>

                                            </a>

                                        @endif

                                        @if($contrato->estado_id === 6)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#aprobadoProfDAF">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobado por Profesional D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadoProfDAF">

                                                <button class="btn btn-danger btn-block mb-1">

                                                    <i class="fas fa-times"></i>

                                                    Rechazado por Profesional D.A.F.

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Aprobado por Profesional D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazado por Profesional D.A.F.

                                                </button>

                                            </a>

                                        @endif

                                        @if($contrato->estado_id === 9)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmadoDAF">

                                                <button class="btn btn-success btn-block mb-1" >

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmado por D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadoDAF">

                                                <button class="btn btn-danger btn-block mb-1" >

                                                    <i class="fas fa-times"></i>

                                                    Rechazado por D.A.F.

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmado por D.A.F.

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazado por D.A.F.

                                                </button>

                                            </a>

                                        @endif

                                        @if($contrato->estado_id === 12)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmadoControl">

                                                <button class="btn btn-success btn-block mb-1" >

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmado por Dirección de Control

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadoControl">

                                                <button class="btn btn-danger btn-block mb-1" >

                                                    <i class="fas fa-times"></i>

                                                    Rechazado por Dirección de Control

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmado por Dirección de Control

                                                </button>

                                            </a>

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-times"></i>

                                                    Rechazado por Dirección de Control

                                                </button>

                                            </a>

                                        @endif

                                        @if($contrato->estado_id === 15)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmadoProveedor">

                                                <button class="btn btn-success btn-block mb-1" >

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmado por el Proveedor

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmado por el Proveedor

                                                </button>

                                            </a>

                                        @endif

                                        @if($contrato->estado_id === 17)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmadoAlcaldia">

                                                <button class="btn btn-success btn-block mb-1" >

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmado por Alcaldía

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmado por Alcaldía

                                                </button>

                                            </a>

                                        @endif

                                        @if($contrato->EnviadaProveedor === 1)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#derivarCopias">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Derivar Copias del Contrato

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Derivar Copias del Contrato

                                                </button>

                                            </a>

                                        @endif

                                    </div>

                                </div>

                            </div>

                            <hr style="background-color: #d7d7d7">

                        </div>

                    </div>
                
                </div>
            </div>

        </div>

    </div>
        
</div>




<!-- Modal Contrato Aprobado por C&S -->
<div class="modal fade" id="aprobadoCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AprobadoC&S">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Aprobación</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Aprobar Contrato

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
<!-- END Modal Contrato Aprobado por C&S -->

<!-- Modal Contrato Rechazado por C&S -->
<div class="modal fade" id="rechazadoCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadoC&S">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Rechazo</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                        <div class="form-group">
                        	
                        	<label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" name="observacion" placeholder="Ingrese el Motivo del porqué va a Rechazar la Contrato" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Contrato

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Órden De Compra

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
<!-- End Modal Contrato Rechazado por C&S -->

<!-- Modal Contrato Aprobado por Profesional DAF -->
<div class="modal fade" id="aprobadoProfDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AprobadoProfDAF">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Aprobación</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Aprobar Órden De Compra

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
<!-- END Modal Contrato Aprobado por Profesional DAF -->

<!-- Modal Contrato Rechazado por Profesional DAF -->
<div class="modal fade" id="rechazadoProfDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadoProfDAF">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Rechazo</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                        <div class="form-group">
                        	
                        	<label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" name="observacion" placeholder="Ingrese el Motivo del porqué va a Rechazar la Contrato" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Contrato

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Órden De Compra

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
<!-- End Modal Contrato Rechazado por Profesional DAF -->

<!-- Modal Contrato Firmado por DAF -->
<div class="modal fade" id="firmadoDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadoPorDAF">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Aprobación</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Contrato por D.A.F.

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
<!-- END Contrato Firmada por DAF -->

<!-- Modal Contrato Rechazado por DAF -->
<div class="modal fade" id="rechazadoDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadoDAF">

                <div class="modal-body">

                	<div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Rechazo</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                        <div class="form-group">
                        	
                        	<label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" name="observacion" placeholder="Ingrese el Motivo del porqué va a Rechazar la Contrato" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Contrato

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Contrato

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
<!-- End Contrato Rechazado por DAF -->

<!-- Modal Contrato Firmado por Direccion de Control -->
<div class="modal fade" id="firmadoControl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadoPorControl">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Aprobación</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Contrato por D. de Control

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
<!-- END Contrato Firmada por Direccion de Control -->

<!-- Modal Contrato Rechazado por Direccion de Control -->
<div class="modal fade" id="rechazadoControl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-down"></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadoControl">

                <div class="modal-body">

                	<div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Rechazo</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                        <div class="form-group">
                        	
                        	<label for="Motivo">Motivo Rechazo</label>

                            <textarea type="text" class="form-control" name="observacion" placeholder="Ingrese el Motivo del porqué va a Rechazar la Contrato" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Contrato

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Rechazar Contrato

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
<!-- End Contrato Rechazado por Direccion de Control -->

<!-- Modal Contrato Firmado por Proveedor -->
<div class="modal fade" id="firmadoProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadoProveedor">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Aprobación</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Contrato por Proveedor

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
<!-- END Contrato Firmada por Proveedor -->

<!-- Modal Contrato Firmado por Alcaldía -->
<div class="modal fade" id="firmadoAlcaldia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>

            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadoAlcaldia">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Aprobación</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Contrato por Alcaldía

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
<!-- END Contrato Firmado Alcaldia -->

<!-- Modal Derivar Copias del Contrato -->
<div class="modal fade" id="derivarCopias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>

            <form method="POST" action="{{ route('contrato.update', $contrato->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="DerivarCopias">

                <div class="modal-body">

                    <div class="form">

                        <div class="form-group">
                                            
                            <label>Nombre Contrato</label>
                                                                        
                            <textarea type="text" readonly style="border:0;" name="nombreContrato" value="{{ $contrato->nombreContrato }}" rows="3" class="form-control">{{ $contrato->nombreContrato }}</textarea>
                            
                            <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">   

                        </div>

                        <div class="form-group">
                                            
                            <label>Fecha Aprobación</label>
                                                                        
                            <input type="text" readonly class="text-muted form-control-plaintext" value="{{ $dateCarbon }}">

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Enviar Copias del Contrato

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
<!-- END Derivar Copias del Contrato -->



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

            // Start Configuration DataTable Detalle Solicitud
            var table = $('#detalleSolicitudValidar').DataTable({
                "paginate"  : true,

                "ordering": false,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Productos en su Solicitud para su validación",
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

            //Comienzo de Excepcion de la Solicitud
            table.on('click', '.aprobadaCS', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#id_excepcion').val(data[1]);

                $('#excepcionForm').attr('action', '/siscom/contrato/enviarExcepcion/' + data[0]);
                $('#enviarProveedorExcepcion').modal('show');

            });
            //Fin Recepción de la Solicitud
    });


</script>

@endpush