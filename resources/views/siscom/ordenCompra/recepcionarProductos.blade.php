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
                        @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">                              
                            <i class="icofont-check-circled h5"></i><strong> {{ session('danger') }} </strong>                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">                            
                                <span aria-hidden="true">&times;</span>                              
                            </button>
                        </div>                   
                        @endif
                        <a href="{{ route('ordenCompra.index') }}" class="btn btn-link text-decoration-none float-right"><i class="icofont-circled-left h5"></i>Volver</a>
                        <h4>Recepcionar Porductos de la Órden de Compra No.  <input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly class="h4" style="border:0;" name="ordenCompraID" id="ordenCompraID" form="detalleOrdenCompraForm"> </h4>
                         <hr style="background-color: #d7d7d7">
                        <div class="py-2">
                            <div class="row mb-3 bg-light rounded-top rounded-bottom p-3">
                                <div class="col">
                                    <div>                                      
                                        <label class="col-sm-6 col-form-label">IDDOC</label>      
                                        <label class="col-sm-6 h5">{{ $ordenCompra->iddoc }}</label>
                                    </div>
                                    <div>                                        
                                        <label class="col-sm-3 col-form-label">Tipo</label>          
                                        <label class="col-sm-9 h5">{{ $ordenCompra->tipoOrdenCompra }}</label>
                                    </div>
                                    <div>                                        
                                        <label class=" col-sm-6 col-form-label">Con Excepción</label>
                                        <label class=" col-sm-6 h5">{{ $ordenCompra->excepcion }}</label>  
                                    </div>
                                </div>
                                <div class="col">
                                    <div>                                      
                                        <label class="col-sm-6 col-form-label">Estado</label>
                                        <label class="col-sm-9 h5">{{ $ordenCompra->Estado }}</label>  
                                    </div>
                                    <div>                                        
                                        <label class=" col-sm-6 col-form-label">Valor Total ($)</label>
                                        <label class=" col-sm-6 h5">{{ $ordenCompra->totalOrdenCompra }}</label>  
                                    </div>
                                    <div>
                                        <label class=" col-sm-6 col-form-label">Depto. que Recepciona</label>
                                        <label class=" col-sm-6 h5">{{ $ordenCompra->deptoRecepcion }}</label>  
                                    </div>
                                </div>
                                <div class="col">
                                    <div>                                      
                                        <label class="col-sm-6 col-form-label">Razón Social</label>
                                        <label class="col-sm-6 h5">{{ $ordenCompra->RazonSocial }}</label>
                                    </div>
                                    <div>                                            
                                        <label class=" col-sm-6 col-form-label">Enviada Proveedor</label>
                                        @if( $ordenCompra->enviadaProveedor == 0 )
                                            <label class=" col-sm-6 h5">No</label>
                                        @elseif( $ordenCompra->enviadaProveedor == 1 )
                                            <label class=" col-sm-6 h5">Si</label>
                                        @endif
                                    </div>
                                </div>
                            </div>                            
                            <hr style="background-color: #d7d7d7">                           
                            <div class="row">
                                <div style="font-size: 0.8em;" class="col bg-warning rounded-top rounded-bottom shadow p-3">
                                    <h5 class="text-center">
                                        <i class="icofont-sand-clock"></i> TimeLine Órden de Compra
                                    </h5>                                
                                    <table class="table table-striped table-sm table-hover" width="100%">                                                
                                        <thead>                                                
                                            <tr>                                                    
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Responsable</th>
                                                <th>Obs. Rechazo</th>                                                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($move as $m)                                                
                                                <tr>

                                                    <td>{{ date('d-m-Y H:i:s', strtotime($m->date)) }}</td>
                                                    <td>{{ $m->status }}</td>
                                                    <td>{{ $m->name }}</td>
                                                    <td>{{ $m->obsRechazoValidacion }}</td>                                                
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr style="background-color: #d7d7d7" class="mb-5">
                            <div class="row">
                                <div class=" col">
                                    <div class="mb-3 float-right">
                                        @if($fullReception != $parcialReception)
                                            <button type="submit" class="btn btn-primary" disabled> 
                                                <i class="icofont-checked h5"></i> Recepcionar Todos de los Productos
                                            </button>
                                        @else
                                            @can('ordenCompra.confirmarRecepcionProductos')                                    
                                            <form method="POST" action="{{ route('ordenCompra.confirmarRecepcion', $ordenCompra->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="flag" value="RecepcionarTodosProductosOC">
                                                <button type="submit" class="btn btn-primary"> 
                                                <i class="icofont-checked h5"></i> Recepcionar Todos de los Productos
                                                </button>
                                            </form>
                                            @endcan
                                        @endif                                           
                                    </div>
                                    <div>
                                        <table class="display" id="detalleOrdenCompra" width="100%" style="font-size: 0.9em">
                                            <thead>
                                                <tr>
                                                    <th style="display: none;">ID</th>
                                                    <th>No. Solicitud</th>
                                                    <th>Producto</th>
                                                    <th>Especificación</th>
                                                    <th>Cantidad Solicitada</th>
                                                    <th>Cantidad Recepcionada</th>
                                                    <th>Saldo</th>
                                                    <th>Observación</th>
                                                    <th>Acciones</th>
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
                                                    <td>{{ $ds->cantidadRecepcionada }}</td>
                                                    <td class="saldo">{{ $ds->Saldo }}</td>
                                                    <td>{{ $ds->obsRecepcion }}</td>
                                                    <td>
                                                        @if($ds->fechaRecepcion === NULL)
                                                        <a href="#" class="btn btn-primary btn-sm recepcionarProducto" data-toggle="tooltip" data-placement="bottom" title="Recepcionar solo este Producto">         
                                                            <i class="icofont-check"></i>
                                                        </a>
                                                        @else
                                                            <label>Producto Recepcionado</label>
                                                        @endif
                                                    </td>   
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="row p-3">                                                
                            <h5 class="text-muted">Saldo Pendiente :&nbsp;&nbsp;</h5>
                            <input type="text" name="saldoPendiente" id="saldoPendiente" readonly style="border: 0;font-size: 1.5em;">
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-2">
                                @if($parcialReception > 0)
                                    <button type="submit" class="btn btn-success btn-block" disabled> 
                                        <i class="icofont-check-circled"></i> Cerrar Proceso de "Recepción de Productos"
                                    </button>
                                @else
                                    @can('ordenCompra.confirmarRecepcionProductos')                                    
                                    <form method="POST" action="{{ route('ordenCompra.confirmarRecepcion', $ordenCompra->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="flag" value="RecepcionarTodosProductosOC">
                                        <button type="submit" class="btn btn-success btn-block">
                                            <i class="icofont-check-circled"></i> Cerrar Proceso de "Recepción de Productos"
                                        </button>
                                    </form>
                                @endcan
                                @endif                                       
                            </div> 
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('ordenCompra.index') }}" class="text-decoration-none">
                                    <button type="submit" class="btn btn-secondary btn-block"> 
                                        <i class="icofont-arrow-left"></i> Volver
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>        
</div>
<!-- Recepcionar Producto Modal -->
<div class="modal fade" id="recepcionarProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-box h5"></i> Entregar Productos de la Solicitud </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="recepcionarProductoForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="RecepcionarProductoOrdenCompra">
                <div class="modal-body">        
                    <div class="col-md-12 mb-3">                                                
                        <label for="Producto">Producto</label>
                        <input type="text" id="Producto" class="form-control" disabled>                        
                    </div>
                    <div class="col-md-12 mb-3">                                                
                        <label for="Cantidad">Cantidad Solicitada</label>
                        <input type="number" name="Cantidad" id="cantidadSolicitada" class="form-control" disabled>
                    </div>
                    <div class="col-md-12 mb-3">                                                
                        <label for="catidadEntregada">Cantidad a Entregar</label>
                        <input type="number" name="cantidadRecepcionada" id="cantidadRecepcionada" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor la Cantidad a Entregar
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">                                                
                        <label for="observacion">Observaciones</label>
                        <textarea name="obsRecepcion" id="obsRecepcion" class="form-control" cols="3" placeholder="Por favor ingrese una observación si no se recepciona la totalidad del Producto o de ser necesaria"></textarea>
                    </div>
                    <div class="form-row"> 
                        <button type="submit" class="btn btn-success btn-block"> 
                            <i class="icofont-check-circled"></i> Recepcionar Producto
                        </button>  
                    </div>                            
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Recepcionar Producto Modal -->
<!-- UPDATE Modal Detalle Solicitud-->
<div class="modal fade" id="updateDetalleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-box h5"></i> Entregar Productos de la Solicitud </p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/siscom/admin') }}" class="was-validated" id="updateDetalleForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="EntregarProductos">
                <div class="modal-body">        
                    <div class="col-md-12 mb-3">                                                
                        <label for="Producto">Producto</label>
                        <input type="text" id="Producto" class="form-control" disabled>                        
                    </div>
                    <div class="col-md-12 mb-3">                                                
                        <label for="Cantidad">Cantidad Solicitada</label>
                        <input type="number" name="Cantidad" id="cantidadSolicitada" class="form-control" disabled>
                    </div>
                    <div class="col-md-12 mb-3">                                                
                        <label for="catidadEntregada">Cantidad a Entregar</label>
                        <input type="number" name="cantidadEntregada" id="cantidadEntregada" class="form-control" required>
                        <div class="invalid-feedback">
                            Por favor la Cantidad a Entregar
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">                                                
                        <label for="observacion">Observaciones</label>
                        <textarea name="observacion" id="observacion" class="form-control" cols="3" placeholder="Por favor ingrese una observación si no se entrega la totalidad del Producto o de ser necesaria"></textarea>
                    </div>
                    <div class="mb-3 form-row">
                        <input type="submit" id="entregarProductos" value="Entregar Productos" class="btn btn-success btn-block">              
                    </div>                            
                </div>
            </form>
        </div>
    </div>
</div>
<!-- UPDATE Modal Detalle Solicitud -->
@endsection

@push('scripts')
<script>    
    $(document).ready(function () {
        var height = $(window).height();
            $('#allWindow').height(height);

            // Start Configuration DataTable Detalle Solicitud
            var table = $('#detalleOrdenCompra').DataTable({
                "paginate"  : true,
                "ordering": false,
                "order"     : ([0, 'desc']),
                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Productos en su Órden de Compra...",
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
            table.on('click', '.recepcionarProducto', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var dataDetalle = table.row($tr).data();
                console.log(dataDetalle);
                $('#Producto').val(dataDetalle[2]);
                $('#cantidadSolicitada').val(dataDetalle[4]);
                $('#observacion').val(dataDetalle[5]);            

                $('#recepcionarProductoForm').attr('action', '/siscom/ordenCompra/' + dataDetalle[0]);
                $('#recepcionarProductoModal').modal('show');

            });
            //End Edit Record Detalle Solicitud
             //Recorremos la Tabla y Sumamos cada Saldo
            var cls = document.getElementById("detalleOrdenCompra").getElementsByTagName("td");
            var sum = 0;
            for (var i = 0; i < cls.length; i++){
                if(cls[i].className == "saldo"){
                    sum += isNaN(cls[i].innerHTML) ? 0 : parseInt(cls[i].innerHTML);
                }
            }
            $('#saldoPendiente').val(sum);            
    });
</script>
@endpush