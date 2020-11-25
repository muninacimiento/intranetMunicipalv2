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
                        <a href="{{action('OrdenCompraController@index')}}" class="btn btn-link text-decoration-none float-right"><i class="icofont-circled-left h5"></i>Volver</a>
                        <h4> Validar Órden de Compra No.  <input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly class="h4" style="border:0;" name="ordenCompraID" id="ordenCompraID" form="detalleOrdenCompraForm"></h4>
                        <hr style="background-color: #d7d7d7">
                        <div class="py-3">
                            <div class="container-fluid">
                                <div class="row mb-3 bg-light rounded-top rounded-bottom p-3">
                                    <div class="col">
                                        <div>                                      
                                            <label class="col-sm-6 col-form-label text-muted">IDDOC</label>      
                                            <label class="col-sm-6 h5">{{ $ordenCompra->iddoc }}</label>
                                        </div>
                                        <div>                                        
                                            <label class="col-sm-3 col-form-label text-muted">Tipo</label>          
                                            <label class="col-sm-9 h5">{{ $ordenCompra->tipoOrdenCompra }}</label>
                                        </div>
                                        <div>                                        
                                            <label class=" col-sm-6 col-form-label text-muted">Con Excepción</label>
                                            <label class=" col-sm-6 h5">{{ $ordenCompra->excepcion }}</label>  
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>                                      
                                            <label class="col-sm-6 col-form-label text-muted">Estado</label>
                                            <label class="col-sm-9 h5">{{ $ordenCompra->Estado }}</label>  
                                        </div>
                                        <div>                                        
                                            <label class=" col-sm-6 col-form-label text-muted">Valor Total ($)</label>
                                            <label class=" col-sm-6 h5">{{ $ordenCompra->totalOrdenCompra }}</label>  
                                        </div>
                                        <div>
                                            <label class=" col-sm-6 col-form-label text-muted">Depto. que Recepciona</label>
                                            <label class=" col-sm-6 h5">{{ $ordenCompra->deptoRecepcion }}</label>  
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>                                      
                                            <label class="col-sm-6 col-form-label text-muted">Razón Social</label>
                                            <label class="col-sm-6 h5">{{ $ordenCompra->RazonSocial }}</label>
                                        </div>
                                        <div>                                            
                                            <label class=" col-sm-6 col-form-label text-muted">Enviada Proveedor</label>
                                            @if( $ordenCompra->enviadaProveedor == 0 )
                                                <label class=" col-sm-6 h5">No</label>
                                            @elseif( $ordenCompra->enviadaProveedor == 1 )
                                                <label class=" col-sm-6 h5">Si</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr style="background-color: #d7d7d7">
                                <div class="row bg-dark rounded-top rounded-bottom p-3">
                                    <div class="col">
                                        <div>
                                            @if(($ordenCompra->Estado == 'Recepcionada y en Revisión por C&S' || $ordenCompra->Estado == 'Revisión por C&S' || $ordenCompra->Estado == 'Enviada a Proveedor' || $ordenCompra->Estado == 'Productos Recepcionados' || $ordenCompra->Estado == '  Productos Parcialmente Recepcionados') || ($ordenCompra->excepcion === 'Si' && $ordenCompra->Estado == 'Enviada a Proveedor con Excepción'))
                                                <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#aprobadaCS">
                                                    <button class="btn btn-success btn-block mb-1">
                                                    <i class="icofont-check-circled h5"></i> Aprobada por C&S
                                                    </button>
                                                </a>
                                                <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadaCS">
                                                    <button class="btn btn-danger btn-block mb-1">
                                                    <i class="icofont-close-circled h5"></i> Rechazada por C&S
                                                    </button>
                                                </a>
                                            @else
                                                <a href="#" class="text-decoration-none">
                                                    <button class="btn btn-secondary btn-block mb-1" disabled>
                                                    <i class="icofont-check-circled h5"></i>Aprobada por C&S
                                                    </button>
                                                </a>
                                                <a href="#" class="text-decoration-none">
                                                    <button class="btn btn-secondary btn-block mb-1" disabled>
                                                    <i class="icofont-close-circled h5"></i> Rechazada por C&S
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            @if($ordenCompra->Estado == 'En Revisión por Profesional DAF')
                                                <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#aprobadaProfDAF">
                                                    <button class="btn btn-success btn-block mb-1">
                                                    <i class="icofont-check-circled h5"></i> Aprobada por Profesional D.A.F.
                                                    </button>
                                                </a>
                                                <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadaProfDAF">
                                                    <button class="btn btn-danger btn-block mb-1">
                                                    <i class="icofont-close-circled h5"></i> Rechazada por Profesional D.A.F.
                                                    </button>
                                                </a>
                                            @else
                                                <a href="#" class="text-decoration-none">
                                                    <button class="btn btn-secondary btn-block mb-1" disabled>
                                                    <i class="icofont-check-circled h5"></i> Aprobada por Profesional D.A.F.
                                                    </button>
                                                </a>
                                                <a href="#" class="text-decoration-none">
                                                    <button class="btn btn-secondary btn-block mb-1" disabled>
                                                    <i class="icofont-close-circled h5"></i> Rechazada por Profesional D.A.F.
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            @if($ordenCompra->Estado == 'En Firma DAF')
                                                <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmaDAF">
                                                    <button class="btn btn-success btn-block mb-1" >
                                                    <i class="icofont-check-circled h5"></i> Firmada por D.A.F.
                                                    </button>
                                                </a>
                                                <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#rechazadaDAF">
                                                    <button class="btn btn-danger btn-block mb-1" >
                                                    <i class="icofont-close-circled h5"></i> Rechazada por D.A.F.
                                                    </button>
                                                </a>
                                            @else
                                                <a href="#" class="text-decoration-none">
                                                    <button class="btn btn-secondary btn-block mb-1" disabled>
                                                    <i class="icofont-check-circled h5"></i> Firmada por D.A.F.
                                                    </button>
                                                </a>
                                                <a href="#" class="text-decoration-none">
                                                    <button class="btn btn-secondary btn-block mb-1" disabled>
                                                    <i class="icofont-close-circled h5"></i>Rechazada por D.A.F.
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            @if($ordenCompra->Estado == 'En Firma Alcaldía')
                                                <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmaAlcaldia">
                                                    <button class="btn btn-success btn-block mb-1" >
                                                    <i class="icofont-check-circled h5"></i> Firmada por Alcaldía
                                                    </button>
                                                </a>
                                            @else
                                                <a href="#" class="text-decoration-none">
                                                    <button class="btn btn-secondary btn-block mb-1" disabled>
                                                    <i class="icofont-check-circled h5"></i> Firmada por Alcaldía
                                                    </button>
                                                </a>
                                            @endif
                                            @if($ordenCompra->Estado == 'En Firma Administración')
                                                <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmaAdministracion">
                                                    <button class="btn btn-success btn-block mb-1">
                                                    <i class="icofont-check-circled h5"></i> Firmada por Administración
                                                    </button>
                                                </a>
                                            @else
                                                <a href="#" class="text-decoration-none">
                                                    <button class="btn btn-secondary btn-block mb-1" disabled>
                                                    <i class="icofont-check-circled h5"></i> Firmada por Administración
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row bg-dark rounded-top rounded-bottom p-3">
                                    <div class="col">
                                        @can('ordenCompra.enviarExcepcion')
                                            @if($ordenCompra->excepcion === 'Si' && $ordenCompra->enviadaProveedor === 0 && $ordenCompra->estado_id > 1)
                                                <a href="#" class="text-decoration-none" data-placement="bottom" title="Enviar Órden de Compra con Excepción" data-toggle="modal" data-target="#enviarProveedorExcepcion">
                                                    <button class="btn btn-warning btn-lg">                      
                                                        <i class="icofont-email h5"></i> Enviar al Proveedor con Excepción
                                                    </button>
                                                </a>
                                            @else
                                                <a href="#" class="text-decoration-none" data-placement="bottom" title="Enviar Órden de Compra con Excepción Deshabilitado!" data-toggle="modal" data-target="#">
                                                    <button class="btn btn-warning btn-block" disabled>                      
                                                    <i class="icofont-email h5"></i> Enviar al Proveedor con Excepción
                                                    </button>
                                                </a>
                                            @endif
                                        @endcan
                                    </div>
                                    <div class="col">
                                        @if($ordenCompra->Estado === 'Lista para Enviar a Proveedor' &&  $ordenCompra->enviadaProveedor == 0)
                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#enviarProveedor">
                                                <button class="btn btn-success btn-block">
                                                    <i class="icofont-email h5"></i> Enviar al Proveedor
                                                </button>
                                            </a>
                                        @else
                                            <a href="#" class="text-decoration-none" title="Enviar Órden de Compra al Proveedor Deshabilitado!" data-toggle="modal" data-target="#enviarProveedor">
                                                <button class="btn btn-success btn-block" disabled>
                                                    <i class="icofont-email h5"></i> Enviar al Proveedor
                                                </button>
                                            </a>
                                        @endif
                                    </div>
                                </div> 
                                <hr style="background-color: #d7d7d7" class="mb-4">
                                <div class="row">
                                    <div class="col">  
                                        <div class="mb-3">
                                            <h4>Detalle Órden de Compra</h4>  
                                        </div>  
                                        <div>
                                            <table class="display" id="detalleSolicitudValidar" width="100%" style="font-size: 0.9em">
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
        </div>
    </div>        
</div>

<!-- Modal Órden de Compra Enviada con Excepcion -->
<div class="modal fade" id="enviarProveedorExcepcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-check-circled h5"></i> Validar Órden de Compra</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated" id="excepcionForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="EnviarProveedorConExcepcion">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="p-3">                                                                              
                            <label for="id" class="text-center">Enviar Órden de Compra con Excepción</label>
                            <div class="form-row">                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompra_id_excepcion" class="h5"></label>     
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit">
                            <i class="icofont-email"></i> Enviar Órden de Compra
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Órden de Compra Enviada al Proveedor --> 
<!-- Modal Estado 3 Órden de Compra -->
<div class="modal fade" id="aprobadaCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-check-circled h5"></i> Validar Órden de Compra</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="AprobadaC&S">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="p-3">                                                                              
                            <label for="id" class="text-center">Órden de Compra Aprobada por C&S </label>
                            <div class="form-row">                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID" class="h5" size="13"></label>     
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit">
                            <i class="icofont-check-circled"></i> Aprobar Órden De Compra
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal Estado 3 Órden de Compra -->
<!-- Modal Estado 4 Órden de Compra -->
<div class="modal fade" id="rechazadaCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-close-circled h5"></i> Validar Órden de Compra</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="RechazadaC&S">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="p-3">                                                                              
                            <label for="id" class="text-center">Órden de Compra Rechazada por C&S </label>
                            <div class="form-row">                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID" class="h5" size="13"></label>     
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">                                                                                                              
                            <label for="Motivo">Motivo Rechazo</label>
                            <textarea type="text" class="form-control" id="motivoRechazo" name="motivoRechazo" placeholder="Ingrese el Motivo del porqué va a Rechazar la Órden de Compra" required></textarea>
                            <div class="invalid-feedback">                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Órden de Compra
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit">
                            <i class="icofont-close-circled"></i> Rechazar Órden De Compra
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Create Solicitud -->
<!-- Modal Estado 3 Órden de Compra -->
<div class="modal fade" id="aprobadaProfDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i></i> Validar Órden de Compra</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="AprobadaProfDAF">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="p-3">                                                                              
                            <label for="id" class="text-center">Órden de Compra Aprobada por Profesional D.A.F. </label>
                            <div class="form-row">                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID" class="h5" size="13"></label>     
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit">
                            <i class="icofont-check-circled"></i> Aprobar Órden De Compra
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Modal Estado 3 Órden de Compra -->
<!-- Modal Estado 4 Órden de Compra -->
<div class="modal fade" id="rechazadaProfDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><<i class="icofont-close-circled h5"></i> Validar Órden de Compra</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="RechazadaProfDAF">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="p-3">                                                                              
                            <label for="id" class="text-center">Órden de Compra Rechazada por Profesional D.A.F. </label>
                            <div class="form-row">                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID" class="h5" size="13"></label>     
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">                                                                                                              
                            <label for="Motivo">Motivo Rechazo</label>
                            <textarea type="text" class="form-control" id="motivoRechazo" name="motivoRechazo" placeholder="Ingrese el Motivo del porqué va a Rechazar la Órden de Compra" required></textarea>
                            <div class="invalid-feedback">                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Órden de Compra
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit">
                            <i class="icofont-close-circled"></i> Rechazar Órden De Compra
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Create Solicitud -->
<!-- Modal Órden de Compra Firmada por DAF -->
<div class="modal fade" id="firmaDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-check-circled h5"></i> Validar Órden de Compra</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="FirmadaPorDAF">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="p-3">                                                                              
                            <label for="id" class="text-center">Órden de Compra Firmada por D.A.F.</label>
                            <div class="form-row">                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID" class="h5" size="13"></label>     
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit">
                            <i class="icofont-check-circled"></i> Firmar Órden De Compra por D.A.F.
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Órden de Compra Firmada por DAF -->

<!-- Modal Rechazada por DAF -->
<div class="modal fade" id="rechazadaDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-close-circled h5"></i> Validar Órden de Compra</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="RechazadaDAF">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="p-3">                                                                              
                            <label for="id" class="text-center">Órden de Compra Rechazada por D.A.F.</label>
                            <div class="form-row">                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID" class="h5" size="13"></label>     
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">                                                                                                              
                            <label for="Motivo">Motivo Rechazo</label>
                            <textarea type="text" class="form-control" id="motivoRechazo" name="motivoRechazo" placeholder="Ingrese el Motivo del porqué va a Rechazar la Órden de Compra" required></textarea>
                            <div class="invalid-feedback">                                                                                                                            
                                Por favor ingrese el Motivo del Rechazo de la Órden de Compra
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit">
                            <i class="icofont-close-circled"></i> Rechazar Órden De Compra
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Órden de Compra Rechazada por DAF -->
<!-- Modal Órden de Compra Firmada por Alcaldía -->
<div class="modal fade" id="firmaAlcaldia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-check-circled h5"></i> Validar Órden de Compra</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="FirmadaPorAlcaldia">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="p-3">                                                                              
                            <label for="id" class="text-center">Órden de Compra Firmada por Alcaldía</label>
                            <div class="form-row">                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID" class="h5" size="13"></label>     
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit">
                        <i class="icofont-check-circled"></i> Firmar Órden De Compra por Alcaldía
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Órden de Compra Firmada Alcaldia -->
<!-- Modal Órden de Compra Firmada por Administracion -->
<div class="modal fade" id="firmaAdministracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-check-circled h5"></i> Validar Órden de Compra</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="FirmadaPorAdministracion">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="p-3">                                                                              
                            <label for="id" class="text-center">Órden de Compra Firmada por Administración</label>
                            <div class="form-row">                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID" class="h5" size="13"></label>     
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit">
                            <i class="icofont-check-circled"></i>Firmar Órden De Compra por Administración
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Órden de Compra Firmada por Administración -->
<!-- Modal Órden de Compra Enviar Órden de Compra -->
<div class="modal fade" id="enviarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-email h5"></i> Validar Órden de Compra</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="EnviarProveedor">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="p-3">                                                                              
                            <label for="id" class="text-center">Enviar Órden de Compra al Proveedor</label>
                            <div class="form-row">                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>                                                                       
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID" class="h5" size="13"></label>     
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit">
                            <i class="icofont-email"></i> Enviar Órden de Compra
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END Órden de Compra Enviada al Proveedor -->
@endsection

@push('scripts')
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
            table.on('click', '.excepcion', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                $('#ordenCompra_id_excepcion').val(data[1]);
                $('#excepcionForm').attr('action', '/siscom/ordenCompra/enviarExcepcion/' + data[0]);
                $('#enviarProveedorExcepcion').modal('show');
            });
            //Fin Recepción de la Solicitud
    });
</script>

@endpush