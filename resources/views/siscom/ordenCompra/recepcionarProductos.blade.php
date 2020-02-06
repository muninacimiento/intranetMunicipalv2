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
                              
                            <i class="fas fa-times-circle"></i>
                             
                            <strong> {{ session('danger') }} </strong>
                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                              
                            </button>

                        </div>
                   
                        @endif

                        <a href="{{ route('ordenCompra.index') }}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                        <h4> Órden de Compra No.  <input type="text" value="{{ $ordenCompra->ordenCompra_id }}" readonly class="h4" style="border:0;" name="ordenCompraID" id="ordenCompraID" form="detalleOrdenCompraForm"> </h4>

                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                                <div class="form-row">
                                            
                                            <label class="col-sm-3 col-form-label text-muted">IDDOC</label>
                                                                        
                                            <label class="col-sm-9 col-form-label">{{ $ordenCompra->iddoc }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Estado</label>
                                                                        
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

                            
                            <hr style="background-color: #d7d7d7">
                           
                            <div style="font-size: 0.8em;" class="bg-warning rounded-top rounded-bottom shadow p-3">

                                <h5 class="text-center">

                                    <i class="fas fa-hourglass-half px-2"></i>

                                    TimeLine Solicitud

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

                            <div class="py-5">

                                <div>

                                    <table class="display" id="detalleOrdenCompra" width="100%">

                                        <thead>

                                            <tr>

                                                <th style="display: none;">ID</th>

                                                <th>No. Solicitud</th>

                                                <th>Producto</th>

                                                <th>Especificación</th>

                                                <th>Cantidad</th>

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

                                                <td>{{ $ds->obsRecepcion }}</td>

                                                <td>

                                                    @if($ds->obsRecepcion === NULL)

                                                    <a href="#" class="btn btn-primary btn-sm recepcionarProducto" data-toggle="tooltip" data-placement="bottom" title="Recepcion Producto">
                                                                    
                                                            <i class="fas fa-check"></i>

                                                    </a>

                                                    @else

                                                        <label>Producto Recepcionado con Obervaciones</label>

                                                    @endif

                                                </td>                                         

                                            </tr>

                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                                

                            </div>

                            <div class="form-row">

                                <div class="col-md-12 mb-2">
                                
                                    <form method="POST" action="{{ route('ordenCompra.confirmarRecepcion', $ordenCompra->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="flag" value="RecepcionarTodosProductosOC">

                                        <button type="submit" class="btn btn-success btn-block"> 

                                            <i class="fas fa-check-circle"></i>

                                            Confirmar Recepción de Productos

                                        </button>

                                    </form>    

                                </div>

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

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-tasks"></i> Entregar Productos de la Solicitud </p>

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
                                                
                        <label for="observacion">Observaciones</label>

                        <textarea name="obsRecepcion" id="obsRecepcion" class="form-control" cols="3" placeholder="Por favor ingrese una observación si no se recepciona la totalidad del Producto o de ser necesaria"></textarea>

                    </div>

                    <div class="mb-3 form-row">

                        <input type="submit" id="entregarProductos" value="Recepcionar Producto" class="btn btn-success btn-block">              

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

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-tasks"></i> Entregar Productos de la Solicitud </p>

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

<link rel="stylesheet" type="text/css" href="css/css.css">

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

            
    });


</script>

@endpush