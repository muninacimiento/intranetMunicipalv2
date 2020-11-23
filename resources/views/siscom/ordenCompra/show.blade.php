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

                                                                    
                                    </div>

                                    <div style="font-size: 0.8em;" class="bg-warning rounded-top rounded-bottom shadow p-3" class="col">

                                        <h5 class="text-center">

                                            <i class="fas fa-hourglass-half px-2"></i>

                                            TimeLine Órden de Compra

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

                                             <tr>
                                            
                                                <td><strong>Observación Anulación</strong></td>
                                                <td colspan="4"><em>{{ $ordenCompra->motivoAnulacion }}</em></td>

                                            </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                            <hr style="background-color: #d7d7d7">

                        </div>

                        <div class="mb-5">

                            <div class="mb-5">
                                    
                                <h5>Detalle Órden de Compra</h5>   

                            </div>
                            

                            <div>

                                <table class="display" id="detalleSolicitud" width="100%" style="font-size: 0.9em;">

                                    <thead>

                                        <tr>

                                            <th style="display: none;">ID</th>

                                            <th>No.Solicitud</th>

                                            <th>Producto</th>

                                            <th>Especificación</th>

                                            <th>Cantidad</th>

                                            <th>Recep.?</th>

                                            <th>Fact.?</th>

                                            <th>No. Factura</th>

                                            <th>Estado Factura</th>

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

                                            @if($ds->fechaRecepcion == NULL)

                                                <td>No</td>

                                            @else

                                                <td>Si</td>

                                            @endif

                                            @if($ds->factura_id == NULL)

                                                <td>No</td>

                                            @else

                                                <td>Si</td>

                                            @endif

                                            <td>{{ $ds->NoFactura }}</td>   
                
                                            <td>{{ $ds->estadoFactura }}</td>   

                                            <td>
                                                
                                                <a href="#" class="btn btn-danger btn-sm deleteDetalle" data-toggle="tooltip" data-placement="bottom" title="Eliminar Producto">
                                                                    
                                                    <i class="far fa-trash-alt"></i>

                                                </a>

                                            </td>                                       

                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <div>

                            <a href="{{ route('ordenCompra.index') }}" class="text-decoration-none">

                                <button type="submit" class="btn btn-secondary btn-block"> 

                                    <i class="fas fa-arrow-left"></i>
                                                
                                    Volver

                                </button>

                            </a>

                        </div>

                    </div>
                
                </div>

            </div>

        </div>

    </div>
        
</div>

<!-- DELETE Modal Detalle Solicitud -->
<div class="modal fade" id="deleteDetalleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"> Eliminar Producto de la Solicitud <i class="fas fa-times-circle"></i></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="#" class="was-validated" id="deleteDetalleForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="EliminarOC">

                <div class="modal-body">

                    <p>Esta Ud. segur@ de querer Eliminar el Producto : </p>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">

                            <label class="h5" id="deleteProducto">deleteProducto</label>

                        </div>

                    </div>
                    
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


@endsection

@push('scripts')

<script>
    
    $(document).ready(function () {

        var height = $(window).height();
            $('#allWindow').height(height);

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

        //Start Delete Record Detalle Solicitud 
            table.on('click', '.deleteDetalle', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var dataDetalle = table.row($tr).data();

                console.log(dataDetalle);

                document.getElementById('deleteProducto').innerHTML = dataDetalle[2];
                
                $('#deleteDetalleForm').attr('action', '/siscom/solicitud/' + dataDetalle[0]);
                $('#deleteDetalleModal').modal('show');

            });
            //End Delete Record Detalle Solicitud

        
    });


</script>

@endpush