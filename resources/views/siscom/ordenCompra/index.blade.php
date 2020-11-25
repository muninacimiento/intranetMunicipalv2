<!--
/*
 *  JFuentealba @itux
 *  created at December 26, 2019 - 11:28 pm
 *  updated at January 22, 2010 - 10:18 am
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
                                    <i class="icofont-plus-circle h5"></i> Nueva Órden de Compra
                                </button>
                            </a>                            
                        </div>
                    </div>
                    <hr class="my-4">
                    @if(count($errors))
                        <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">          
                            <ul>
                                @foreach($errors->all() as $error)
                                <li><i class="icofont-close-circled h5"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('info'))
                        <div class="alert alert-success alert-dismissible fade show shadow mb-3" role="alert">                              
                            <i class="icofont-check-circled h5"></i><strong> {{ session('info') }} </strong>                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">                            
                                <span aria-hidden="true">&times;</span>                              
                            </button>
                        </div>                   
                    @endif
                    @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">                              
                            <i class="icofont-check-circled"></i><strong> {{ session('danger') }} </strong>                            
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
                                    <th style="display: none">Mercado Publico</th>
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
                                    <td style="display: none">{{ $oc->mercadoPublico }}</td>
                                    @if( $oc->Estado == 'Anulada' || $oc->Estado == 'Facturada')
                                        <td>
                                            @can('ordenCompra.show')
                                                <a href="{{ route('ordenCompra.show', $oc->id) }}" class="btn btn-secondary btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Órden de Compra">
                                                    <i class="icofont-eye-alt h5"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    @else
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                {{-- Agregar Productos a la Órden de Compra --}}
                                                @can('ordenCompra.asignar')
                                                    @if($oc->Estado === 'Emitida' ||  Auth::user()->name === 'Carolina Medina Ortega')
                                                        <a href="{{ route('ordenCompra.agregarProductos', $oc->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Agregar Productos a la Órden de Compra">
                                                            <i class="icofont-basket h5"></i>
                                                        </a>
                                                    @else
                                                    @endif
                                                @endcan
                                                @can('ordenCompra.show')
                                                    <a href="{{ route('ordenCompra.show', $oc->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver en Detalle la Órden de Compra y Agregar Productos">
                                                        <i class="icofont-eye-alt h5"></i>
                                                    </a>
                                                @endcan
                                                {{-- Recepcionar Órden de Compra por C&S --}}
                                                @can('ordenCompra.recepcionar')
                                                    @if($oc->Estado == 'Confirmada')
                                                        <a href="#" class="btn btn-success btn-sm recepcionar" data-toggle="tooltip" data-placement="bottom" title="Recepcionar Órden de Compra">                                                            
                                                            <i class="icofont-inbox h5"></i>
                                                        </a>
                                                    @else
                                                    @endif
                                                @endcan
                                                {{-- Validar Órden de Compra --}}
                                                @can('ordenCompra.validar')
                                                    @if($oc->Estado == 'Emitida' || $oc->Estado == 'Confirmada' || $oc->Estado == 'Enviada a Proveedor' || $oc->Estado == 'Facturada' || $oc->Estado == 'Parcialmente Facturada')
                                                    @elseif($oc->Estado == 'Productos Recepcionados' && $oc->excepcion === 'No')
                                                    @else
                                                        <a href="{{ route('ordenCompra.validar', $oc->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Válidar Órden de Compra">                                                            
                                                            <i class="icofont-thumbs-up h5"></i>
                                                        </a>
                                                    @endif
                                                @endcan
                                                {{-- Recepcionar Prodcutos de la OC --}}
                                                @can('ordenCompra.recepcionarProducto')
                                                    @if($oc->Estado == 'Emitida' || $oc->Estado == 'Confirmada' || $oc->Estado == 'Recepcionada y en Revisión por C&S' || $oc->Estado == 'Productos Recepcionados' || $oc->Estado == 'Facturada')
                                                    @else
                                                        <a href="{{ route('ordenCompra.recepcionarProductos', $oc->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Recepcionar Productos de la OC">
                                                            <i class="icofont-box h5"></i>
                                                        </a>
                                                    @endif
                                                @endcan
                                                @can('ordenCompra.update')
                                                    @if(($oc->Estado == 'Productos Recepcionados' && $oc->excepcion === 'No') || $oc->Estado == 'Facturada')
                                                    @else
                                                        <a href="#" class="btn btn-primary btn-sm edit" data-toggle="tooltip" data-placement="bottom" title="Actualizar la Órden de Compra">                                                                
                                                            <i class="icofont-edit-alt h5"></i>
                                                        </a>
                                                    @endif
                                                @endcan
                                                @can('ordenCompra.anular')
                                                    @if(($oc->Estado == 'Productos Recepcionados' && $oc->excepcion === 'No') || $oc->Estado == 'Facturada')
                                                    @else
                                                        <a href="#" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="Anular Órden de Compra">                                                                
                                                            <i class="icofont-trash h5"></i>
                                                        </a>
                                                    @endif
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
                                    <th style="display: none">Mercado Público</th>
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

<!-- CREATE Modal Órden de Compra -->
<div class="modal fade" id="createModalOrdenCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-plus-circle h5"></i> Nueva Órden de Compra</p>
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
                        </div>
                        <div class="col-md-6 mb-3">                                                                              
                            <label for="iddoc">IDDOC</label>
                            <input type="number" min="0" class="form-control" id="iddocCreate" name="iddoc" placeholder="Ingrese el IDDOC" required>
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
                                <option>Menor a 10 UTM</option>
                                <option>Mayor o Igual a 10 UTM</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">                                                                              
                            <label for="totalOrdenCompra">Total $</label>
                            <input type="number" min="0" class="form-control" id="totalOrdenCompraCreate" name="totalOrdenCompra" placeholder="Ingrese el Total de su Órden de Compra" required>
                        </div>
                    </div>
                    <div class="form-row">                        
                        <div class="col-md-6 mb-3">                                                                              
                            <label for="tipoOrdenCompra">Tipo de Órden de Compra</label>
                            <select name="tipoOrdenCompra" id="tipoOrdenCompraCreate" class="form-control selectpicker" title="Tipo de Órden de Compra ?" required>
                                <option>Menor a 3 UTM</option>
                                <option>Trato Directo</option>
                                <option>Licitación</option>
                                <option>Convenio Marco / Suministro</option>
                                <option>Compra Ágil</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">                                                                              
                            <label for="mercadoPublico">Mercado Público</label>
                            <select name="mercadoPublico" id="mercadoPublico" class="form-control selectpicker" title="Órden de Compra Mercado Público?" required>
                                <option>Si</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">                                                                              
                            <label for="excepcion">Excepción</label>
                            <select name="excepcion" id="excepcionCreate" class="form-control selectpicker" title="Órden de Compra con Excepción ?" required>
                                <option>Si</option>
                                <option>No</option>
                            </select>
                        </div>                        
                        <div class="col-md-6 mb-5">                                                                              
                            <label for="deptoReceptor">Depto. que Recepciona</label>
                            <select name="deptoReceptor" id="deptoReceptorCreate" class="form-control selectpicker" title="Quién Recepciona los Productos ?" required>
                                <option>Compras y Suministros, Freire #614 Nacimiento</option>
                                <option>Bodega Talleres Municipales, San Martin #649 Nacimiento</option>
                            </select>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="ordenCompraForm">
                            <i class="icofont-download h5"></i> Guardar Órden de Compra                            
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">                            
                            <i class="icofont-arrow-left h5"></i> Cancelar                            
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
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-inbox h5"></i> Recepcionar Órden de Compra</p>
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
                        <label for="fechaRecepcion" class="col-sm-4 col-form-label text-muted">Fecha Recepción</label>
                        <label for="fechaRecepcion" class="col-sm-8 col-form-label">{{ $dateCarbon }}</label>
                    </div>
                    <div class="form-row mb-3">
                        <label for="ID" class="col-sm-4 col-form-label text-muted">No. Órden de Compra</label>
                         <div class="col-sm-8">                             
                            <input type="" name="ordenCompra_id" id="ordenCompra_id" readonly class="form-control-plaintext">                                 
                         </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block" type="submit">
                            <i class="icofont-check-circled h5"></i> Recepcionar Órden de Compra
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left h5"></i> Cancelar                            
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Recepcinoar Solicitud Modal -->

<!-- Update Modal Órden de Compra -->
<div class="modal fade" id="updateOrdenCompraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-edit-alt h5"></i> Actualizar Órden de Compra</p>
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
                                <option>Menor a 10 UTM</option>
                                <option>Mayor o Igual a 10 UTM</option>
                            </select>
                            <div class="invalid-feedback">                                                                                            
                                Por favor ingrese el Valor Estimado de su Órden de Compra
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">                                                                              
                            <label for="totalOrdenCompra">Total $</label>
                            <input type="text" class="form-control" id="totalOrdenCompraUpdate" name="totalOrdenCompra" placeholder="Ingrese el Total de su Órden de Compra" required>
                            <div class="invalid-feedback">                                                                                            
                                Por favor ingrese el Total ($) de su Órden de Compra
                            </div>
                        </div>
                    </div>
                    <div class="form-row">                        
                        <div class="col-md-6 mb-3">                                                                              
                            <label for="tipoOrdenCompra">Tipo de Órden de Compra</label>
                            <select name="tipoOrdenCompra" id="tipoOrdenCompraUpdate" class="form-control selectpicker" title="Tipo de Órden de Compra ?" required>
                                <option>Menor a 3 UTM</option>
                                <option>Trato Directo</option>
                                <option>Licitación</option>
                                <option>Convenio Marco / Suministro</option>
                                <option>Compra Ágil</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">                                                                              
                            <label for="mercadoPublico">Mercado Público</label>
                            <select name="mercadoPublico" id="mercadoPublicoUpdate" class="form-control selectpicker" title="Órden de Compra Mercado Público?" required>
                                <option>Si</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
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
                        <div class="col-md-6 mb-3">                                                                              
                            <label for="deptoReceptor">Depto. que Recepciona</label>
                            <select name="deptoReceptor" id="deptoReceptorUpdate" class="form-control" title="Quién Recepciona los Productos ?" required>
                                <option>Compras y Suministros, Freire #614 Nacimiento</option>
                                <option>Bodega Talleres Municipales, San Martin #649 Nacimiento</option>
                            </select>
                            <div class="invalid-feedback">                                                                                            
                                Por favor indique si su Órden de Compra es con Excepción
                            </div>
                        </div>
                    </div>                    
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="updateOrdenCompraForm">
                            <i class="icofont-download h5"></i> Guardar Órden de Compra
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left h5"></i> Cancelar   
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
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-ui-delete h5"></i> Anular Órden de Compra</p>
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
                    <div class="form-row">
                        <button class="btn btn-danger btn-block" type="submit">
                            <i class="icofont-check-circled h5"></i> Anular Órden de Compra
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left h5"></i> Cancelar   
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
                            "sEmptyTable":     "No existen Órdenes de Compra generadas o asignadas aún...",
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
                if (($('#deptoReceptorUpdate').val(data[13]))=== 'Compras y Suministros') {
                    $('#deptoReceptorUpdate').val();    
                }
                else if (($('#deptoReceptorUpdate').val(data[13]))=== 'Bodega Talleres Municipales'){
                    $('#deptoReceptorUpdate').val();       
                }
                $('#mercadoPublicoUpdate').val(data[14]);

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


