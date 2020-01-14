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

                        <a href="{{action('OrdenCompraController@index')}}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                        <h4> Órden de Compra No.  <input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly class="h4" style="border:0;" name="ordenCompraID" id="ordenCompraID" form="detalleOrdenCompraForm"> </h4>

                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                            <div class="container">

                                <div class="form-row">

                                    <div class="col mb-3">

                                        <div class="form-row">
                                            
                                            <label class="col-sm-3 col-form-label text-muted">IDDOC</label>
                                                                        
                                            <label class="col-sm-9 col-form-label">{{ $ordenCompra->iddoc }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Estado Actual</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $ordenCompra->Estado }}</label>     

                                        </div>

                                        <div class="form-row">
                                        
                                            <label class=" col-sm-3 col-form-label text-muted">Razón Social</label>

                                            <label class="col-sm-9 col-form-label">{{ $ordenCompra->RazonSocial }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Tipo</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $ordenCompra->tipoOrdenCompra }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Valor Estimado</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $ordenCompra->valorEstimado }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Valor Total ($)</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $ordenCompra->totalOrdenCompra }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Con Excepción</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $ordenCompra->excepcion }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Enviada Proveedor</label>

                                            @if( $ordenCompra->enviadaProveedor == 0 )
                                                <label class=" col-sm-9 col-form-label">No</label>
                                            @elseif( $ordenCompra->enviadaProveedor == 1 )
                                                <label class=" col-sm-9 col-form-label">Si</label>
                                            @endif

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Depto. que Recepciona</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $ordenCompra->deptoRecepcion }}</label>     

                                        </div>

                                                                    
                                    </div>

                                    <div class="col">

                                        @if(($ordenCompra->Estado == 'Recepcionada y en Revisión por C&S' || $ordenCompra->Estado == 'Revisión por C&S' || $ordenCompra->Estado == 'Enviada a Proveedor') || ($ordenCompra->excepcion === 'Si' && $ordenCompra->Estado == 'Enviada a Proveedor con Excepción'))

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

                                        @if($ordenCompra->Estado == 'En Revisión por Profesional DAF')

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

                                        @if($ordenCompra->Estado == 'En Firma DAF')

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

                                        @if($ordenCompra->Estado == 'En Firma Alcaldía' && $ordenCompra->enviadaProveedor == 0)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmaAlcaldia">

                                                <button class="btn btn-success btn-block mb-1" >

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por Alcaldía

                                                </button>

                                            </a>

                                        @elseif ($ordenCompra->Estado == 'En Firma Alcaldía' && $ordenCompra->enviadaProveedor == 1)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmaAlcaldia1">

                                                <button class="btn btn-success btn-block mb-1" >

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

                                        @if($ordenCompra->Estado == 'En Firma Administración' && $ordenCompra->enviadaProveedor == 0)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmaAdministracion">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Firmada por Administración

                                                </button>

                                            </a>

                                        @elseif($ordenCompra->Estado == 'En Firma Administración' && $ordenCompra->enviadaProveedor == 1)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#firmaAdministracion1">

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

                                        @if($ordenCompra->Estado === 'Lista para Enviar a Proveedor' &&  $ordenCompra->enviadaProveedor == 0)

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#enviarProveedor">

                                                <button class="btn btn-success btn-block mb-3">

                                                    <i class="fas fa-envelope-open-text"></i> 

                                                    Enviar al Proveedor

                                                </button>

                                            </a>

                                        @elseif($ordenCompra->Estado === 'Lista para Enviar a Proveedor' && $ordenCompra->enviadaProveedor == 1)

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-3" disabled>

                                                    <i class="fas fa-envelope-open-text"></i> 

                                                    Enviar al Proveedor

                                                </button>

                                            </a>

                                        @endif

                                    </div>

                                </div>

                            </div>

                            <hr style="background-color: #d7d7d7">

                        </div>

                        <div>
                            <div class="mb-5">
                                    
                                <h5>Detalle Órden de Compra</h5>   

                            </div>
                            

                            <div>

                                <table class="display" id="detalleSolicitud" width="100%">

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

<!-- Modal Estado 3 Órden de Compra -->
<div class="modal fade" id="aprobadaCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AprobadaC&S">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Órden de Compra Aprobada por C&S </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

                            </div>

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
<!-- END Modal Estado 3 Órden de Compra -->

<!-- Modal Estado 4 Órden de Compra -->
<div class="modal fade" id="rechazadaCS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadaC&S">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Órden de Compra Rechazada por C&S </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

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
<!-- End Modal Create Solicitud -->

<!-- Modal Estado 3 Órden de Compra -->
<div class="modal fade" id="aprobadaProfDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AprobadaProfDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Órden de Compra Aprobada por Profesional D.A.F. </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

                            </div>

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
<!-- END Modal Estado 3 Órden de Compra -->

<!-- Modal Estado 4 Órden de Compra -->
<div class="modal fade" id="rechazadaProfDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadaProfDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Órden de Compra Rechazada por Profesional D.A.F. </label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

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
<!-- End Modal Create Solicitud -->

<!-- Modal Órden de Compra Firmada por DAF -->
<div class="modal fade" id="firmaDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadaPorDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Órden de Compra Firmada por D.A.F.</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Órden De Compra por D.A.F.

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
<!-- END Órden de Compra Firmada por DAF -->

<!-- Modal Rechazada por DAF -->
<div class="modal fade" id="rechazadaDAF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RechazadaDAF">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Órden de Compra Rechazada por D.A.F.</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

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
<!-- End Órden de Compra Rechazada por DAF -->

<!-- Modal Órden de Compra Firmada por Alcaldía -->
<div class="modal fade" id="firmaAlcaldia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadaPorAlcaldia">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Órden de Compra Firmada por Alcaldía</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

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
<!-- END Órden de Compra Firmada Alcaldia -->

<!-- Modal Órden de Compra Firmada por Alcaldía1 -->
<div class="modal fade" id="firmaAlcaldia1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadaPorAlcaldia1">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Órden de Compra Firmada por Alcaldía</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

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
<!-- END Órden de Compra Firmada Alcaldia1 -->

<!-- Modal Órden de Compra Firmada por Administracion -->
<div class="modal fade" id="firmaAdministracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadaPorAdministracion">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Órden de Compra Firmada por Administración</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Órden De Compra por Administración

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
<!-- END Órden de Compra Firmada por Administración -->

<!-- Modal Órden de Compra Firmada por Administracion1 -->
<div class="modal fade" id="firmaAdministracion1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FirmadaPorAdministracion1">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Órden de Compra Firmada por Administración</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Firmar Órden De Compra por Administración

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
<!-- END Órden de Compra Firmada por Administración1 -->

<!-- Modal Órden de Compra Firmada por Alcaldía -->
<div class="modal fade" id="enviarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->ordenCompra_id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="EnviarProveedor">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Enviar Órden de Compra al Proveedor</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly style="border:0;" name="ordenCompraID" id="ordenCompraID"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Enviar Órden de Compra

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
<!-- END Órden de Compra Enviada al Proveedor -->

<!-- UPDATE Modal Detalle Solicitud-->
<div class="modal fade" id="asignarTODOSModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h3 class="modal-title" id="exampleModalLabel">Agregar Todos los Producto a Órden de Compra<i class="fas fa-edit"></i>  </h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AsignarTodosOC">

                <div class="modal-body">
        
                    <div class="mb-3">
                        
                        Esta usted seguro de quere agregar TODOS los Productos a esta Órden de Compra ?

                        <input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly class="h4" style="border:0;" name="ordenCompraID" id="ordenCompraID">

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Agregar Producto Órden de Compra

                        </button>

                    </div>
                            
                </div>

            </form>
        </div>

    </div>

</div>

<!-- UPDATE Modal Detalle Solicitud-->
<div class="modal fade" id="asignarOCModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h3 class="modal-title" id="exampleModalLabel">Agregar Producto a Órden de Compra<i class="fas fa-edit"></i>  </h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/solicitud') }}" class="was-validated" id="detalleOrdenCompraForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AsignarOC">

                <div class="modal-body">
        
                    <div>
                        
                        Esta usted seguro ?

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Agregar Producto Órden de Compra

                        </button>

                    </div>
                            
                </div>

            </form>
        </div>

    </div>

</div>
<!-- UPDATE Modal Detalle Solicitud -->

<!-- DELETE Modal Detalle Solicitud -->
<div class="modal fade" id="deleteDetalleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h4 class="modal-title" id="exampleModalLabel"> Eliminar Producto de la Solicitud <i class="fas fa-times-circle"></i></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/solicitud') }}" class="was-validated" id="deleteDetalleForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="EliminarOC">

                <div class="modal-body">

                    <p>Esta Ud. segur@ de querer Eliminar el Producto de la Órden de Compra : </p>
                    
                    <div class="form-row">

                        <button class="btn btn-danger btn-block" type="submit">

                            <i class="fas fa-times-circle"></i> Eliminar Producto

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- End Modal Create Solicitud -->

<!-- Modal Create Product -->
<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"> Nuevo Producto <i class="fas fa-plus-circle"></i></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ action('SCM_SolicitudController@store') }}" class="was-validated" id="createForm">

                @csrf

                <input type="hidden" name="flag" value="Solicitud">

                <div class="modal-body">

                    <div class="col-md-12 mb-3">
                                                
                        <label for="Product">Producto</label>
                        
                        <input type="text" name="Product" class="form-control" required>

                        <div class="invalid-feedback">
                                                                                                    
                                Por favor ingrese el Producto a solicitar

                            </div>

                    </div>

                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit" form="createForm">

                            <i class="fas fa-save"></i>

                            Guardar Solicitud

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
<!-- End Modal Create Solicitud -->

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