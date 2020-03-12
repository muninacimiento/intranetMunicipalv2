<!--
/*
 *  JFuentealba @itux
 *  created at January 15, 2020 - 12:18 pm
 *  updated at 
 */
-->

@extends('layouts.app')

@section('content')

<div id="allWindow">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-primary shadow">

                <div class="card-header text-center text-white bg-primary">

                    @include('siscom.menu')

                </div>


                <div class="card-body">

                    <div class="row mt-5">

                        <div class="col-md-6 text-center">
                            
                            <h3>Gestión de Licitaciones</h3>

                            <div class="text-secondary">

                                {{ $dateCarbon }}

                            </div>

                        </div>

                        <!-- Button trigger CrearSolicitudModal -->
                        <div class="col-md-6">
                            
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createModalLicitacion">

                                <button class="btn btn-success btn-block boton">

                                    <i class="fas fa-plus"></i>

                                    Nueva Licitación

                                </button>

                            </a>
                            
                        </div>

                    </div>

                    <hr class="my-4">

                    @if (session('info'))

                        <div class="alert alert-success alert-dismissible fade show shadow mb-3" role="alert">
                              
                            <i class="fas fa-check-circle"></i>
                             
                            <strong> {{ session('info') }} </strong>
                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                              
                            </button>

                        </div>
                   
                    @endif

                    @if (session('danger'))

                        <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">
                              
                            <i class="far fa-times-circle"></i>
                             
                            <strong> {{ session('danger') }} </strong>
                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                              
                            </button>

                        </div>
                   
                    @endif

                    
                    <div>

                        <table class="display" id="licitacionTable" style="font-size: 0.9em;" width="100%">

                            <thead>

                                <tr class="table-active">

                                    <th style="display: none">ID</th>

                                    <th>ID Licitación</th>

                                    <th>No OC</th>

                                    <th>IDDOC</th>

                                    <th>Creada</th>

                                    <th>Estado</th>

                                    <th>Fecha Publicación</th>
                                    
                                    <th>Fecha de Cierre</th>

                                    <th>Fecha de Resolución</th>

                                    <th>Valor Estimado</th>

                                    <th>Propósito</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($licitaciones as $licitacion)

                                <tr>

                                    <td style="display: none">{{ $licitacion->id }}</td>

                                    <td>{{ $licitacion->licitacion_id }}</td>

                                    @if($licitacion->NoOC === NULL)

                                        <td>N/A</td>

                                    @else

                                        <td>{{ $licitacion->NoOC }}</td>

                                    @endif

                                    <td>{{ $licitacion->iddoc }}</td>

                                    <td>{{ date('d-m-Y H:i:s', strtotime($licitacion->created_at)) }}</td>

                                    <td>{{ $licitacion->Estado }}</td>

                                    <td>{{ date('d-m-Y H:i:s', strtotime($licitacion->fechaPublicacion)) }}</td>

                                    <td>{{ date('d-m-Y', strtotime($licitacion->fechaCierre)) }}</td>

                                     @if($licitacion->fechaResolucion === NULL)

                                        <td></td>

                                    @else

                                        <td>{{ date('d-m-Y', strtotime($licitacion->fechaResolucion)) }}</td>

                                    @endif

                                    <td>{{ $licitacion->valorEstimado }}</td>

                                    <td>{{ $licitacion->proposito }}</td>  

                                    <td>

                                        @if($licitacion->Estado === 'Anulada' || $licitacion->Estado === 'Adjudicada' || $licitacion->Estado === 'Desierta' || $licitacion->Estado === 'Inadmisible' || $licitacion->Estado === 'Revocada')

                                            <a href="{{ route('licitacion.show', $licitacion->id) }}" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Licitación">

                                                <button class="btn btn-secondary btn-sm mr-1">
                                                            
                                                    <i class="fas fa-eye"></i>

                                                </button>

                                            </a>
                                        @else

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                {{-- Asignar Solicitud para Registrar los Productos a la Órden de Compra --}}

                                                        @if($licitacion->Estado === 'Creada')

                                                            <a href="#" class="asignar" data-toggle="tooltip" data-placement="bottom" title="Asignar Solicitud para Agregar Productos">
                                                
                                                                <button class="btn btn-info btn-sm mr-1 " type="button">
                                                                
                                                                    <i class="fas fa-shopping-basket"></i>

                                                                </button>

                                                            </a>

                                                        @else

                                                        @endif

                                                <a href="{{ route('licitacion.show', $licitacion->id) }}" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Licitación">

                                                    <button class="btn btn-secondary btn-sm mr-1">
                                                                
                                                        <i class="fas fa-eye"></i>

                                                    </button>

                                                </a>

                                                {{-- Recepcionar Licitacion por C&S --}}

                                                    @if($licitacion->Estado == 'Confirmada')

                                                        <a href="#" class="recepcionar" data-toggle="tooltip" data-placement="bottom" title="Recepcionar Licitación">

                                                            <button class="btn btn-success btn-sm mr-1" type="button">
                                                            
                                                                <i class="fas fa-clipboard-check"></i>

                                                            </button>

                                                        </a>

                                                    @else

                                                    @endif

                                                    {{-- Recepcionar Adjudicacion Licitacion por C&S --}}

                                                    @if($licitacion->Estado == 'Cerrada')

                                                        <a href="#" class="recepcionarADJ" data-toggle="tooltip" data-placement="bottom" title="Recepcionar Adjudicacion de Licitación">

                                                            <button class="btn btn-success btn-sm mr-1" type="button">
                                                            
                                                                <i class="fas fa-clipboard-check"></i>

                                                            </button>

                                                        </a>

                                                    @else

                                                    @endif

                                                {{-- Validar Licitación --}}

                                                @can('licitacion.validar')

                                                    @if($licitacion->Estado == 'Creada' || $licitacion->Estado == 'Confirmada' || $licitacion->Estado == 'Lista para Publicar' || $licitacion->Estado == 'Publicada' || $licitacion->Estado == 'Cerrada' || $licitacion->Estado == 'Lista para Adjudicar')

                                                    @else

                                                        <a href="{{ route('licitacion.validar', $licitacion->id) }}" data-toggle="tooltip" data-placement="bottom" title="Válidar Licitación">
                                            
                                                            <button class="btn btn-warning btn-sm mr-1 " type="button">
                                                            
                                                                <i class="fas fa-thumbs-up"></i>

                                                            </button>

                                                        </a>

                                                    @endif

                                                @endcan

                                                {{-- Publicar Licitación --}}

                                                @can('licitacion.publicar')

                                                    @if($licitacion->Estado == 'Lista para Publicar')

                                                        <a href="#" class="publicar" data-toggle="tooltip" data-placement="bottom" title="Publicar Licitación">
                                                
                                                            <button class="btn btn-light btn-sm mr-1 " type="button">
                                                                
                                                                <i class="fas fa-cloud-upload-alt"></i>

                                                            </button>

                                                        </a>

                                                    @else

                                                    @endif

                                                @endcan

                                                {{-- Resolver Licitación --}}

                                                @can('licitacion.resolucion')

                                                    @if($licitacion->Estado <> 'Lista para Adjudicar')

                                                    @else

                                                        <a href="#" class="resolver" data-toggle="tooltip" data-placement="bottom" title="Válidar Licitación">
                                                
                                                            <button class="btn btn-danger btn-sm mr-1 " type="button">
                                                                
                                                                <i class="fas fa-gavel"></i>

                                                            </button>

                                                        </a>

                                                    @endif

                                                @endcan

                                                @if($licitacion->Estado == 'Lista para Adjudicar')

                                                @else

                                                    <a href="#" class="edit" data-toggle="tooltip" data-placement="bottom" title="Modificar la Órden de Compra">

                                                        <button class="btn btn-primary btn-sm mr-1  " type="button">
                                                                    
                                                            <i class="fas fa-edit"></i>

                                                        </button>

                                                    </a>

                                                    <a href="#" class="delete" data-toggle="tooltip" data-placement="bottom" title="Anular Órden de Compra">

                                                        <button class="btn btn-danger btn-sm " type="button">
                                                                    
                                                            <i class="fas fa-trash"></i>

                                                        </button>

                                                    </a>

                                                @endif

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr class="table-active">

                                    <th style="display: none"></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>
                                    
                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- CREATE Modal Licitación -->
<div class="modal fade" id="createModalLicitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Nueva Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ action('LicitacionController@store') }}" class="was-validated" id="licitacionForm">

                @csrf

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="id">ID Licitación</label>

                            <input type="text" class="form-control" name="licitacion_id" placeholder="Ingrese el No. de la Licitación" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el No. de Licitación

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="iddoc">IDDOC</label>

                            <input type="text" class="form-control" name="iddoc" placeholder="Ingrese el IDDOC" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el ID del Sistema de Gestión Documental de Licitación

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="valorEstimado">Valor Estimado</label>

                            <select name="valorEstimado" class="form-control selectpicker" title="Valor Estimado de la Licitación ?" required>

                                <option>Mayor o Igual a 500 UTM</option>
                                <option>Mayor a 100 y Menor a 500 UTM</option>
                                <option>Menor o Igual a 100 UTM</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Valor Estimado de la Licitación

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="Proposito">Propósito</label>

                            <textarea type="text" class="form-control" name="proposito" placeholder="Ingrese el Porpósito de la Licitación" required></textarea>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Propósito de la Licitación

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Guardar Licitación

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
<!-- END CREATE Modal Licitación -->

<!-- Modal Asignar Solicitud a la Licitacion -->
<div class="modal fade" id="asignarLicitacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Asignar Solicitud a la Licitacion</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/licitacion') }}" class="was-validated" id="asignarSolicitudForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Asignar">

                <div class="modal-body">

                    <div class="form-row mb-3">

                        <label for="ID" class="col-sm-4 col-form-label text-muted">No. Licitación</label>

                        <div class="col-sm-8">
                                 
                            <input type="" name="licitacion_id_assign" id="licitacion_id_assign" readonly class="form-control-plaintext">
                                     
                        </div>

                    </div>

                    <div class="form-row mb-3">
                                                                              
                            <label for="solicitudID" class="col-sm-4 col-form-label text-muted">No. Solicitud</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="solicitud_id_assign" name="solicitud_id_assign" placeholder="Ingrese el No. de la Solicitud" required>

                                <div class="invalid-feedback">
                                                                                                
                                    Por favor ingrese el No. de la Solicitud a Asignar a la Licitación

                                </div>

                            </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit" form="asignarSolicitudForm">

                            <i class="fas fa-save"></i>

                            Asignar Solicitud

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
<!-- End Modal Asignar Solicitud a Licitacion -->

<!-- Recepcionar Licitacion MODAL -->
<div class="modal fade" id="recepcionarLicitacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-inbox"></i> Recepcionar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/licitacion') }}" class="was-validated" id="recepcionarLicitacionForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RecepcionarLicitacion">

                <div class="modal-body">

                    <div class="form-row">
                        
                        <label for="fechaRecepcion" class="col-sm-3 col-form-label text-muted">Fecha Recepción</label>

                        <label for="fechaRecepcion" class="col-sm-9 col-form-label">{{ $dateCarbon }}</label>

                    </div>

                    <div class="form-row">

                        <label for="ID" class="col-sm-3 col-form-label text-muted">No. de Licitación</label>

                         <div class="col-sm-9">
                             
                            <input type="" name="licitacion_id" id="licitacion_id_recepcionar" readonly class="form-control-plaintext">
                                 
                         </div>

                    </div>


                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Recepcionar Licitación

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
<!-- End Recepcinoar Solicitud Modal -->

<!-- Recepcionar Licitacion MODAL -->
<div class="modal fade" id="recepcionarADJLicitacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-inbox"></i> Recepcionar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/licitacion') }}" class="was-validated" id="recepcionarADJLicitacionForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RecepcionarAdjudicacionLicitacion">

                <div class="modal-body">

                    <div class="form-row">
                        
                        <label for="fechaRecepcion" class="col-sm-6 col-form-label text-muted">Fecha Recepción</label>

                        <label for="fechaRecepcion" class="col-sm-6 col-form-label">{{ $dateCarbon }}</label>

                    </div>

                    <div class="form-row">

                        <label for="ID" class="col-sm-6 col-form-label text-muted">No. de Licitación</label>

                         <div class="col-sm-6">
                             
                            <input type="" name="licitacion_id" id="licitacion_id_recepcionarADJ" readonly class="form-control-plaintext">
                                 
                         </div>

                    </div>


                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Recepcionar Adjudicaciòn de Licitación

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
<!-- End Recepcinoar Adjudicacion Licitacion Modal -->

<!-- Publicar Licitacion MODAL -->
<div class="modal fade" id="publicarLicitacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
 
        <div class="modal-content">

            <div class="modal-header bg-light">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-cloud-upload-alt"></i> Publicar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/licitacion') }}" class="was-validated" id="publicarLicitacionForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="PublicarLicitacion">

                <div class="modal-body">

                    <div class="form-row mb-3">
                        
                        <label for="fechaRecepcion" class="col-sm-4 col-form-label text-muted">Fecha Publicación</label>

                        <label for="fechaRecepcion" class="col-sm-8 col-form-label">{{ $dateCarbon }}</label>

                    </div>

                    <div class="form-row mb-3">

                        <label for="ID" class="col-sm-4 col-form-label text-muted">No. de Licitación</label>

                         <div class="col-sm-8">
                             
                            <input type="" name="licitacion_id" id="licitacion_id_publicar" readonly class="form-control-plaintext">
                                 
                         </div>

                    </div>

                    <div class="form-row mb-3">

                        <label for="ID" class="col-sm-4 col-form-label text-muted">Fecha de Cierre</label>

                         <div class="col-sm-8">
                             
                            <input type="text" id="fechaCierre" name="fechaCierre" class="form-control" placeholder="Cuál es la Fecha de Cierre de la Licitación?" required/>

                                    <div class="invalid-feedback">
                                                                                                        
                                        Por favor ingrese la Fecha Cierre de su Licitación

                                    </div>
                                 
                         </div>

                    </div>


                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Publicar Licitación

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
<!-- Publicar Licitación Modal -->

<!-- Resolver Licitacion MODAL -->
<div class="modal fade" id="resolverLicitacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
 
        <div class="modal-content">

            <div class="modal-header bg-danger">

                <p class="modal-title text-white" id="exampleModalLabel" style="font-size: 1.2em" ><i class="fas fa-gavel"></i> Resolver Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/licitacion') }}" class="was-validated" id="resolverLicitacionForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="ResolverLicitacion">

                <div class="modal-body">

                    <div class="form-row mb-3">

                        <label for="ID" class="col-form-label text-muted">No. de Licitación</label>
                             
                        <input type="" name="licitacion_id" id="licitacion_id_resolver" readonly class="form-control-plaintext">

                    </div>


                    <div class="form-row mb-3">
                                                
                        <label for="ordenCompra_id">No. Órden de Compra</label>

                        <select name="ordenCompra_id" id="ordenCompra_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el No. de su Órden de Compra">

                            @foreach($ocs as $oc)

                                <option value="{{ $oc->id }}">{{ $oc->OC }}</option>
                                                                
                            @endforeach

                        </select>

                    </div>

                    <div class="form-row mb-3">
                                                                              
                        <label for="valorEstimado" class="col-form-label text-muted">Resolución</label>

                        <select name="Resolucion" class="form-control selectpicker" title="Resolución de la Licitación?" required>

                            <option>Adjudicada</option>
                            <option>Desierta</option>
                            <option>Inadmisible</option>
                            <option>Revocada</option>

                        </select>

                        <div class="invalid-feedback">
                                                                                            
                            Por favor ingrese el Valor Estimado de la Licitación

                        </div>

                    </div>

                    <div class="form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-check-circle"></i>

                            Resolver Licitación

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
<!-- Resolver Licitación Modal -->

<!-- UPDATE Modal Licitación -->
<div class="modal fade" id="updateModalLicitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Actualizar Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/licitacion') }}" class="was-validated" id="licitacionFormUpdate">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Actualizar">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="id">ID Licitación</label>

                            <input type="text" class="form-control" id="licitacion_id_Update" name="licitacion_id" placeholder="Ingrese el No. de la Licitación" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el No. de Licitación

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="iddoc">IDDOC</label>

                            <input type="text" class="form-control" id="iddocUpdate" name="iddoc" placeholder="Ingrese el IDDOC" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el ID del Sistema de Gestión Documental de Licitación

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="valorEstimado">Valor Estimado</label>

                            <select id="valorEstimadoUpdate" name="valorEstimado" class="form-control" title="Valor Estimado de la Licitación ?" required>

                                <option>Mayor o Igual a 500 UTM</option>
                                <option>Mayor a 100 y Menor a 500 UTM</option>
                                <option>Menor o Igual a 100 UTM</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Valor Estimado de la Licitación

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="Proposito">Propósito</label>

                            <textarea type="text" class="form-control" id="propositoUpdate" name="proposito" placeholder="Ingrese el Porpósito de la Licitación" required></textarea>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Propósito de la Licitación

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Guardar Licitación

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
<!-- END UPDATE Modal Licitación -->

<!-- Anular Modal Licitacion -->
<div class="modal fade" id="deleteLicitacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-times-circle"></i> Anular Licitación</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="#" class="was-validated" id="deleteLicitacionForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AnularLicitacion">

                <div class="modal-body">

                    <div class="form-row mb-3">

                        <label class="col-sm-3 col-form-label text-muted">ID Licitación</label><br>
                                                                        
                        <label class="col-sm-9 col-form-label h5" id="ordenCompra_id_Delete">ID Licitacion</label>

                    </div>

                    <div class="form-row mb-3">

                        <label class="col-sm-3 col-form-label text-muted">Fecha Licitación</label><br>
                                                                        
                        <label class="col-sm-9 col-form-label h5" id="fechaOrdenCompra_delete">Fecha Licitación</label>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo Anulación</label>

                            <textarea type="text" class="form-control" id="motivoAnulacion" name="motivoAnulacion" placeholder="Ingrese el Motivo del porqué va a ANULAR la Licitación" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo de la Anulación de la Licitación

                            </div>

                        </div>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-danger btn-block" type="submit">

                            <i class="far fa-times-circle"></i> Anular Licitación

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
<!-- End Modal Anular Licitacion -->

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

<script type="text/javascript">
        
        $(document).ready(function () {
            
            var height = $(window).height();
            $('#allWindow').height(height);

            $( "#fechaCierre" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
            });

            // Setup - add a text input to each footer cell
            $('#licitacionTable tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Buscar">' );
            } );

            // Start Configuration DataTable
            var table = $('#licitacionTable').DataTable({

                "paginate"  : true,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Órdenes de Compra generadas por su unidad, aún...",
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
            //End Configuration DataTable

             // Apply the search
            table.columns().every( function () {
                var that = this;
         
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }

                });

            });
            //END Applu the Search

            //Start Edit Record
            table.on('click', '.edit', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#licitacion_id_Update').val(data[1]);
                $('#iddocUpdate').val(data[2]);
                
                if (($('#valorEstimadoUpdate').val(data[8]))==='Mayor a 100 UTM') {

                    $('#valorEstimadoUpdate').val();    
                }
                else if (($('#valorEstimadoUpdate').val(data[8]))==='Menor o Igual a 100 UTM'){

                    $('#valorEstimadoUpdate').val();       
                }

                $('#propositoUpdate').val(data[9]);


                $('#licitacionFormUpdate').attr('action', '/siscom/licitacion/' + data[0]);
                $('#updateModalLicitacion').modal('show');

            });
            //End Edit Record

            //Comienzo de Excepcion de la Solicitud
            table.on('click', '.excepcion', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#ordenCompra_id_excepcion').val(data[1]);

                $('#excepcionForm').attr('action', '/siscom/ordenCompra/' + data[0]);
                $('#enviarProveedor').modal('show');

            });
            //Fin Recepción de la Solicitud

            //Comienzo de Recepción de la Solicitud
            table.on('click', '.recepcionar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#licitacion_id_recepcionar').val(data[1]);

                $('#recepcionarLicitacionForm').attr('action', '/siscom/licitacion/' + data[0]);
                $('#recepcionarLicitacionModal').modal('show');

            });
            //Fin Recepción de la Solicitud

             //Comienzo de Recepción de la Adjudicacion de Licitacion
            table.on('click', '.recepcionarADJ', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#licitacion_id_recepcionarADJ').val(data[1]);

                $('#recepcionarADJLicitacionForm').attr('action', '/siscom/licitacion/' + data[0]);
                $('#recepcionarADJLicitacionModal').modal('show');

            });
            //Fin Recepción de la Solicitud

            //Comienzo de Publicar la Licitación
            table.on('click', '.publicar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#licitacion_id_publicar').val(data[1]);

                $('#publicarLicitacionForm').attr('action', '/siscom/licitacion/publicar/' + data[0]);
                $('#publicarLicitacionModal').modal('show');

            });
            //Fin de la Publicacion de la Licitacion

            //Comienzo de la Resolucion de la Licitación
            table.on('click', '.resolver', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#licitacion_id_resolver').val(data[1]);

                $('#resolverLicitacionForm').attr('action', '/siscom/licitacion/resolucion/' + data[0]);
                $('#resolverLicitacionModal').modal('show');

            });
            //Fin de la Resolucion de la Licitacion

            //Start Edit Record
            table.on('click', '.asignar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#licitacion_id_assign').val(data[1]);

                $('#asignarSolicitudForm').attr('action', '/siscom/licitacion/' + data[0]);
                $('#asignarLicitacionModal').modal('show');

            });
            //End Edit Record

            

            //Start Delete Record
            table.on('click', '.delete', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                document.getElementById('ordenCompra_id_Delete').innerHTML = data[1];
                document.getElementById('fechaOrdenCompra_delete').innerHTML = data[3];
                
                $('#deleteLicitacionForm').attr('action', '/siscom/licitacion/anular/' + data[0]);
                $('#deleteLicitacionModal').modal('show');

            });
            //End Delete Record
         });    

</script>

@endpush


