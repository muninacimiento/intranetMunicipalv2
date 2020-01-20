<!--
/*
 *  JFuentealba @itux
 *  created at December 26, 2019 - 11:28 pm
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
                            
                            <h3>Gestión de Órdenes de Compra</h3>

                            <div class="text-secondary">

                                {{ $dateCarbon }}

                            </div>

                        </div>

                        <!-- Button trigger CrearSolicitudModal -->
                        <div class="col-md-6">
                            
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createModalOrdenCompra">

                                <button class="btn btn-success btn-block boton">

                                    <i class="fas fa-plus"></i>

                                    Nueva Órden de Compra

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

                        <table class="display" id="ordenCompraTable" style="font-size: 0.9em;" width="100%">

                            <thead>

                                <tr class="table-active">

                                    <th style="display: none">ID</th>

                                    <th>ID O.C.</th>

                                    <th>IDDOC</th>

                                    <th>Creada</th>

                                    <th>Estado</th>

                                    <th>Comprador</th>
                                    
                                    <th style="display: none">Tipo</th>

                                    <th style="display: none">Valor Estimado</th>

                                    <th style="display: none">Total $</th>
                                    
                                    <th>Excepción</th>
                                    
                                    <th>Proveedor</th>

                                    <th>Tipo de O.C.</th>

                                    <th style="display: none">Enviada al Proveedor</th>

                                    <th style="display: none">Depto. que Recepciona</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($ordenesCompra as $oc)

                                <tr>

                                    <td style="display: none">{{ $oc->id }}</td>

                                    <td>{{ $oc->ordenCompra_id }}</td>

                                    <td>{{ $oc->iddoc }}</td>

                                    <td>{{ date('d-m-Y H:i:s', strtotime($oc->created_at)) }}</td>

                                    <td>{{ $oc->Estado }}</td>

                                    <td>{{ $oc->Comprador }}</td>

                                    <td style="display: none">{{ $oc->tipoOrdenCompra }}</td>

                                    <td style="display: none">{{ $oc->valorEstimado }}</td>

                                    <td style="display: none">{{ $oc->totalOrdenCompra }}</td>

                                    <td>{{ $oc->excepcion }}</td>
                                    
                                    <td>{{ $oc->RazonSocial }}</td>

                                    <td>{{ $oc->tipoOrdenCompra }}</td>

                                    <td style="display: none">{{ $oc->enviadaProveedor }}</td>

                                    <td style="display: none">{{ $oc->deptoRecepcion }}</td>

                                    @if( $oc->Estado == 'Anulada')

                                        <td>

                                            @can('ordenCompra.show')

                                                <a href="{{ route('ordenCompra.show', $oc->id) }}" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Solicitud">

                                                    <button class="btn btn-secondary btn-sm mr-1">
                                                        
                                                        <i class="fas fa-eye"></i>

                                                    </button>

                                                </a>

                                            @endcan

                                        </td>

                                    @else

                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                {{-- Asignar Solicitud para Registrar los Productos a la Órden de Compra --}}

                                                @can('ordenCompra.asignar')

                                                    @if($oc->Estado === 'Emitida')

                                                        <a href="#" class="asignar" data-toggle="tooltip" data-placement="bottom" title="Asignar Solicitud para Agregar Productos">
                                            
                                                            <button class="btn btn-info btn-sm mr-1 " type="button">
                                                            
                                                                <i class="fas fa-shopping-basket"></i>

                                                            </button>

                                                        </a>

                                                    @else

                                                    @endif

                                                @endcan

                                                @can('ordenCompra.show')

                                                    <a href="{{ route('ordenCompra.show', $oc->id) }}" data-toggle="tooltip" data-placement="bottom" title="Ver en Detalle la Órden de Compra y Agregar Productos">

                                                        <button class="btn btn-secondary btn-sm mr-1" type="button">
                                                            
                                                            <i class="fas fa-eye"></i>

                                                        </button>

                                                    </a>

                                                @endcan

                                                {{-- Recepcionar Órden de Compra por C&S --}}

                                                @can('ordenCompra.recepcionar')

                                                    @if($oc->Estado == 'Confirmada')

                                                        <a href="#" class="recepcionar" data-toggle="tooltip" data-placement="bottom" title="Recepcionar Órden de Compra">

                                                            <button class="btn btn-success btn-sm mr-1" type="button">
                                                            
                                                                <i class="fas fa-clipboard-check"></i>

                                                            </button>

                                                        </a>

                                                    @else

                                                    @endif

                                                @endcan

                                                {{-- Enviar Órden de Compra con EXCEPCION --}}

                                                @can('ordenCompra.enviarExcepcion')

                                                    @if($oc->Estado == 'Recepcionada y en Revisión por C&S' && $oc->excepcion === 'Si')

                                                        <a href="#" class="text-decoration-none excepcion" data-toggle="modal" ata-placement="bottom" title="Enviar Órden de Compra con Excepción">

                                                            <button class="btn btn-danger btn-sm mr-1">
      
                                                                <i class="fas fa-envelope-open-text"></i> 

                                                            </button>

                                                        </a>

                                                    @else

                                                    @endif

                                                @endcan

                                                {{-- Validar Órden de Compra --}}

                                                @can('ordenCompra.validar')

                                                    @if($oc->Estado == 'Emitida' || $oc->Estado == 'Confirmada' || $oc->Estado == 'Enviada a Proveedor')

                                                    @else

                                                        <a href="{{ route('ordenCompra.validar', $oc->id) }}" data-toggle="tooltip" data-placement="bottom" title="Válidar Órden de Compra">
                                            
                                                            <button class="btn btn-warning btn-sm mr-1 " type="button">
                                                            
                                                                <i class="fas fa-thumbs-up"></i>

                                                            </button>

                                                        </a>

                                                    @endif

                                                @endcan

                                                @can('ordenCompra.update')

                                                    <a href="#" class="edit" data-toggle="tooltip" data-placement="bottom" title="Modificar la Órden de Compra">

                                                        <button class="btn btn-primary btn-sm mr-1  " type="button">
                                                            
                                                            <i class="fas fa-edit"></i>

                                                        </button>

                                                    </a>

                                                @endcan

                                                @can('ordenCompra.anular')

                                                    <a href="#" class="delete" data-toggle="tooltip" data-placement="bottom" title="Anular Órden de Compra">

                                                        <button class="btn btn-danger btn-sm " type="button">
                                                            
                                                             <i class="fas fa-trash"></i>

                                                        </button>

                                                    </a>

                                                @endcan

                                            </div>

                                        </td>

                                    @endif

                                </tr>

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr class="table-active">

                                    <th style="display: none">ID</th>

                                    <th>ID O.C.</th>

                                    <th>IDDOC</th>

                                    <th>Creada</th>

                                    <th>Estado</th>

                                    <th>Comprador</th>
                                    
                                    <th style="display: none">Tipo</th>

                                    <th style="display: none">Valor Estimado</th>

                                    <th style="display: none">Total $</th>
                                    
                                    <th>Excepción</th>
                                    
                                    <th>Proveedor</th>

                                    <th>Tipo O.C.</th>

                                    <th style="display: none">Enviada al Proveedor</th>

                                    <th style="display: none">Depto. que Recepciona</th>

                                    <th>Acciones</th>

                                </tr>

                            </tfoot>

                        </table>



                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Modal Órden de Compra Enviada con Excepcion -->
<div class="modal fade" id="enviarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Validar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="#" class="was-validated" id="excepcionForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="EnviarProveedorConExcepcion">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Enviar Órden de Compra con Excepción</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">Id Órden de Compra</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="#" readonly style="border:0;" name="ordenCompraID" id="ordenCompra_id_excepcion"></label>     

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

<!-- CREATE Modal Órden de Compra -->
<div class="modal fade" id="createModalOrdenCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Nueva Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ action('OrdenCompraController@store') }}" class="was-validated" id="ordenCompraForm">

                @csrf

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="id">ID Órden de Compra</label>

                            <input type="text" class="form-control" id="ocCreate" name="ordenCompra_id" placeholder="Ingrese el No. de Órden de Compra" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el No. de Órden de Compra

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="iddoc">IDDOC</label>

                            <input type="text" class="form-control" id="iddocCreate" name="iddoc" placeholder="Ingrese el IDDOC" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el ID del Sistema de Gestión Documental de su Órden de Compra

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-12 mb-3">
                                                
                            <label for="flagIdProveedor">Proveedor</label>

                            <select name="flagIdProveedor" id="flagIdProveedor" class="form-control selectpicker" data-live-search="true" title="Seleccione el Proveedor de su Órden de Compra" required>

                                @foreach($proveedores as $proveedor)

                                    <option value="{{ $proveedor->id }}">{{ $proveedor->RazonSocial }}</option>
                                                                
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="valorEstimado">Valor Estimado</label>

                            <select name="valorEstimado" id="valorEstimadoCreate" class="form-control selectpicker" title="Valor Estimado de su Órden de Compra ?" required>

                                <option>Mayor a 10 UTM</option>
                                <option>Menor o Igual a 10 UTM</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Valor Estimado de su Órden de Compra

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="tipoOrdenCompra">Tipo de Órden de Compra</label>

                            <select name="tipoOrdenCompra" id="tipoOrdenCompraCreate" class="form-control selectpicker" title="Tipo de Órden de Compra ?" required>

                                <option>Menor a 3 UTM</option>
                                <option>Trato Directo</option>
                                <option>Licitación</option>
                                <option>Convenio Marco / Suministro</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor seleccione el Tipo de Órden de Compra

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="totalOrdenCompra">Total $</label>

                            <input type="text" class="form-control" id="totalOrdenCompraCreate" name="totalOrdenCompra" placeholder="Ingrese el Total de su Órden de Compra" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Total ($) de su Órden de Compra

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="excepcion">Excepción</label>

                            <select name="excepcion" id="excepcionCreate" class="form-control selectpicker" title="Órden de Compra con Excepción ?" required>

                                <option>Si</option>
                                <option>No</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor indique si su Órden de Compra es con Excepción

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-6 mb-5">
                                                                              
                            <label for="deptoReceptor">Depto. que Recepciona</label>

                            <select name="deptoReceptor" id="deptoReceptorCreate" class="form-control selectpicker" title="Quién Recepciona los Productos ?" required>

                                <option>Compras y Suministros</option>
                                <option>Bodega Talleres Municipales</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor indique si su Órden de Compra es con Excepción

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit" form="ordenCompraForm">

                            <i class="fas fa-save"></i>

                            Guardar Órden De Compra

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
<!-- END CREATE Modal Órden de Compra -->

<!-- Recepcionar Solicitud MODAL -->
<div class="modal fade" id="recepcionarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-inbox"></i> Recepcionar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/ordenCompra/recepcionar') }}" class="was-validated" id="recepcionarForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Recepcionar">

                <div class="modal-body">

                    <div class="form-row">
                        
                        <label for="fechaRecepcion" class="col-sm-3 col-form-label text-muted">Fecha Recepción</label>

                        <label for="fechaRecepcion" class="col-sm-9 col-form-label">{{ $dateCarbon }}</label>

                    </div>

                    <div class="form-row">

                        <label for="ID" class="col-sm-3 col-form-label text-muted">No. Órden de Compra</label>

                         <div class="col-sm-9">
                             
                            <input type="" name="ordenCompra_id" id="ordenCompra_id" readonly class="form-control-plaintext">
                                 
                         </div>

                    </div>


                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Recepcionar Órden de Compra

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

<!-- Modal Asignar Solicitud Órden de Compra -->
<div class="modal fade" id="asignarSolicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Asignar Solicitud a la Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/ordenCompra/asignar') }}" class="was-validated" id="asignarSolicitudForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Asignar">

                <div class="modal-body">

                    <div class="form-row mb-3">

                        <label for="ID" class="col-sm-4 col-form-label text-muted">No. Órden de Compra</label>

                        <div class="col-sm-8">
                                 
                            <input type="" name="ordenCompra_id_assign" id="ordenCompra_id_assign" readonly class="form-control-plaintext">
                                     
                        </div>

                    </div>

                    <div class="form-row mb-3">
                                                                              
                            <label for="solicitudID" class="col-sm-4 col-form-label text-muted">No. Solicitud</label>

                            <div class="col-sm-8">

                                <input type="text" class="form-control" id="solicitud_id_assign" name="solicitud_id_assign" placeholder="Ingrese el No. de la Solicitud" required>

                                <div class="invalid-feedback">
                                                                                                
                                    Por favor ingrese el No. de la Solicitud a Asignar a la Órden de Compra

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
<!-- End Modal Asignar Solicitud Órden de Compra -->

<!-- Update Modal Órden de Compra -->
<div class="modal fade" id="updateOrdenCompraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-edit"></i> Actualizar Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/ordenCompra') }}" class="was-validated" id="updateOrdenCompraForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Actualizar">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="ocUpdate">ID Órden de Compra</label>

                            <input type="text" class="form-control" id="ordenCompra_id_update" name="ordenCompra_id" placeholder="Ingrese el No. de Órden de Compra" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el No. de Órden de Compra

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="iddoc">IDDOC</label>

                            <input type="text" class="form-control" id="iddocUpdate" name="iddoc" placeholder="Ingrese el IDDOC" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el ID del Sistema de Gestión Documental de su Órden de Compra

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-12 mb-3">
                                                
                            <label for="flagIdProveedor">Proveedor</label>

                            <select name="flagIdProveedor" id="flagIdProveedorUpdate" class="form-control selectpicker" data-live-search="true" title="Seleccione el Proveedor de su Órden de Compra" required>

                                @foreach($proveedores as $proveedor)

                                    <option value="{{ $proveedor->id }}">{{ $proveedor->RazonSocial }}</option>
                                                                
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="valorEstimado">Valor Estimado</label>

                            <select name="valorEstimado" id="valorEstimadoUpdate" class="form-control" title="Valor Estimado de su Órden de Compra ?" required>

                                <option>Mayor a 10 UTM</option>
                                <option>Menor o Igual a 10 UTM</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Valor Estimado de su Órden de Compra

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="tipoOrdenCompra">Tipo de Órden de Compra</label>

                            <select name="tipoOrdenCompra" id="tipoOrdenCompraUpdate" class="form-control" title="Tipo de Órden de Compra ?" required>

                                <option>Menor a 3 UTM</option>
                                <option>Trato Directo</option>
                                <option>Licitación</option>
                                <option>Convenio Marco / Suministro</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor seleccione el Tipo de Órden de Compra

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="totalOrdenCompra">Total $</label>

                            <input type="text" class="form-control" id="totalOrdenCompraUpdate" name="totalOrdenCompra" placeholder="Ingrese el Total de su Órden de Compra" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Total ($) de su Órden de Compra

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="excepcion">Excepción</label>

                            <select name="excepcion" id="excepcionUpdate" class="form-control" title="Órden de Compra con Excepción ?" required>

                                <option>Si</option>
                                <option>No</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor indique si su Órden de Compra es con Excepción

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-6 mb-5">
                                                                              
                            <label for="deptoReceptor">Depto. que Recepciona</label>

                            <select name="deptoReceptor" id="deptoReceptorUpdate" class="form-control" title="Quién Recepciona los Productos ?" required>

                                <option>Compras y Suministros</option>
                                <option>Bodega Talleres Municipales</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor indique si su Órden de Compra es con Excepción

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit" form="updateOrdenCompraForm">

                            <i class="fas fa-edit"></i>

                            Guardar Órden De Compra

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
<!-- End Modal Update Órden de Compra -->

<!-- Anular Modal Órden de Compra -->
<div class="modal fade" id="deleteOrdenCompraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-times-circle"></i> Anular Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/ordenCompra/anular') }}" class="was-validated" id="deleteOrdenCompraForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Anular">

                <div class="modal-body">

                    <div class="form-row mb-3">

                        <label class="col-sm-3 col-form-label text-muted">ID Órden de Compra</label><br>
                                                                        
                        <label class="col-sm-9 col-form-label h5" id="ordenCompra_id_Delete">ID Órden de Compra</label>

                    </div>

                    <div class="form-row mb-3">

                        <label class="col-sm-3 col-form-label text-muted">Fecha Orden de Compra</label><br>
                                                                        
                        <label class="col-sm-9 col-form-label h5" id="fechaOrdenCompra_delete">Fecha Orden de Compra</label>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo Anulación</label>

                            <textarea type="text" class="form-control" id="motivoAnulacion" name="motivoAnulacion" placeholder="Ingrese el Motivo del porqué va a ANULAR la Órden de Compra" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo de la Anulación de la Órden de Compra

                            </div>

                        </div>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-danger btn-block" type="submit">

                            <i class="far fa-times-circle"></i> Anular Órden de Compra

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

<script type="text/javascript">
        
        $(document).ready(function () {
            
            var height = $(window).height();
            $('#allWindow').height(height);

            // Setup - add a text input to each footer cell
            $('#ordenCompraTable tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Buscar">' );
            } );

            // Start Configuration DataTable
            var table = $('#ordenCompraTable').DataTable({

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
                } );
            } );

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

                $('#ordenCompra_id').val(data[1]);

                $('#recepcionarForm').attr('action', '/siscom/ordenCompra/recepcionar/' + data[0]);
                $('#recepcionarModal').modal('show');

            });
            //Fin Recepción de la Solicitud

            //Start Edit Record
            table.on('click', '.asignar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#ordenCompra_id_assign').val(data[1]);

                $('#asignarSolicitudForm').attr('action', '/siscom/ordenCompra/asignar/' + data[0]);
                $('#asignarSolicitudModal').modal('show');

            });
            //End Edit Record

            //Start Edit Record
            table.on('click', '.edit', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#ordenCompra_id_update').val(data[1]);
                $('#iddocUpdate').val(data[2]);
                
                if (($('#tipoOrdenCompraUpdate').val(data[6]))==='Menor a 3 UTM') {

                    $('#tipoOrdenCompraUpdate').val();    
                }
                else if (($('#tipoOrdenCompraUpdate').val(data[6]))==='Trato Directo'){

                    $('#tipoOrdenCompraUpdate').val();       
                }
                else if (($('#tipoOrdenCompraUpdate').val(data[6]))==='Convenio Marco / Suministro'){

                    $('#tipoOrdenCompraUpdate').val();       
                }

                if (($('#valorEstimadoUpdate').val(data[7]))==='Mayor a 10 UTM') {

                    $('#valorEstimadoUpdate').val();    
                }
                else if (($('#valorEstimadoUpdate').val(data[7]))==='Menor o Igual a 10 UTM'){

                    $('#valorEstimadoUpdate').val();       
                }

                $('#totalOrdenCompraUpdate').val(data[8]);

                if (($('#excepcionUpdate').val(data[9])) === 'Si') {

                    $('#excepcionUpdate').val();    
                }
                else if (($('#excepcionUpdate').val(data[9])) === 'No'){

                    $('#excepcionUpdate').val();       
                }

                if (($('#deptoReceptorUpdate').val(data[12]))=== 'Compras y Suministros') {

                    $('#deptoReceptorUpdate').val();    
                }
                else if (($('#deptoReceptorUpdate').val(data[12]))=== 'Bodega Talleres Municipales'){

                    $('#deptoReceptorUpdate').val();       
                }

                $('#updateOrdenCompraForm').attr('action', '/siscom/ordenCompra/' + data[0]);
                $('#updateOrdenCompraModal').modal('show');

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
                
                $('#deleteOrdenCompraForm').attr('action', '/siscom/ordenCompra/anular/' + data[0]);
                $('#deleteOrdenCompraModal').modal('show');

            });
            //End Delete Record
         });    

</script>

@endpush


