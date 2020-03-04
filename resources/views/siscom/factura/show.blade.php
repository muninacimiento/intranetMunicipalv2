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

                        <a href="{{ route('factura.index') }}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                        <h4> Factura No.  <input type="text" value="{{ $factura->factura_id }}" readonly class="h4" style="border:0;" name="factura_id" form="1"> </h4>

                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                            <div class="form-row mb-3">

                                <div class="col-md-4 mb-3">

                                    <label class="text-muted">Tipo Documento</label>
                                                                
                                    <h5>{{ $factura->tipoDocumento }}</h5>
                                                            
                                </div>

                                <div class="col-md-3 mb-3">
                                                          
                                    <label class="text-muted">Fecha Oficina de Parte</label> <br>

                                    <h5>{{ date('d-m-Y H:i:s', strtotime($factura->created_at)) }}</h5>

                                </div>

                                <div class="col-md-3 mb-3">
                                
                                    <label class="text-muted">Fecha Recepción C&S</label>
                                                                
                                    <h5>{{ date('d-m-Y H:i:s', strtotime($factura->created_at)) }}</h5> 

                                </div>

                            </div>

                            <div class="form-row mb-3">

                                <div class="col-md-3 mb-3">
                                
                                    <label class="text-muted">Unidad Solicitante</label>
                                                                
                                    <h5>{{ $factura->Dependencia }}</h5> 

                                </div>

                                <div class="col-md-3 mb-3">
                                
                                    <label class="text-muted">No. Órden de Compra</label>
                                                                
                                    <input type="hidden" value="{{ $factura->ordenCompra_id }}" readonly class="h5" style="border:0;" name="ordenCompra_id" form="facturarProductoForm"> 

                                </div>

                                <div class="col-md-3 mb-3">
                                                          
                                    <label class="text-muted">Proveedor</label> <br>

                                    <h5>{{ $factura->RazonSocial }}</h5> 

                                </div>

                                <div class="col-md-3 mb-3">

                                    <label class="text-muted">Factura Gestionada por</label>
                                                                
                                    <h5>{{ $factura->userName }}</h5>
                                                            
                                </div>

                            </div>

                             <hr style="background-color: #d7d7d7">

                            <div class="mt-5 text-center">
                                
                                <h5>Detalle Factura</h5>

                            </div>

                            <div class="mb-5">
                            
                                <table class="display" id="detalleFactura">
                                    
                                    <thead>
                                        
                                        <tr>
                                            
                                            <th style="display: none;">ID</th>
                                            <th>No.Solicitud</th>
                                            <th>Producto</th>
                                            <th>Especificación</th>
                                            <th>Cantidad</th>
                                            <th>ID Órden de Compra</th>
                                            <th>Estado O.C.</th>
                                            <th>Recepcionado?</th>
                                            <th>Licitación</th>
                                            <th>Estado Licitación</th>
                                            <th>Acciones</th>

                                        </tr>

                                    </thead>

                                    <tbody>
                                        
                                        @foreach($detalleSolicituds as $dS)

                                        <tr>
                                            
                                            <td style="display: none;">{{ $dS->id }}</td>
                                            <td>{{ $dS->solicitud_id }}</td>
                                            <td>{{ $dS->Producto }}</td>
                                            <td>{{ $dS->especificacion }}</td>
                                            <td>{{ $dS->cantidad }}</td>
                                            <td>{{ $dS->NoOC }}</td>
                                            <td>{{ $dS->EstadoOC }}</td>

                                            @if($dS->fechaRecepcion == NULL)
                                                 <td>No</td>
                                            @else
                                                 <td>Si</td>
                                            @endif

                                            <td>{{ $dS->NoLicitacion}}</td>
                                            <td>{{ $dS->EstadoLicitacion }}</td>

                                            <td>
                                                
                                                <div class="btn-group" role="group" aria-label="Basic example">

                                                    @if($dS->factura_id == NULL)

                                                    <form method="POST" action="{{ route('factura.update', $dS->id) }}" id="1">

                                                        @csrf
                                                        @method('PUT')

                                                        <input type="hidden" name="flag" value="FacturarProducto">

                                                            <button class="btn btn-primary btn-sm mr-1" type="submit">
                                                            
                                                                <i class="fas fa-check"></i>    

                                                            </button>

                                                    </form>
                                                                    

                                                    @else

                                                        <a href="#" class="btn btn-danger btn-sm mr-1 noFacturar" data-toggle="tooltip" data-placement="bottom" title="Eliminar Producto">
                                                                    
                                                            <i class="far fa-trash-alt"></i>

                                                        </a>                                                    

                                                    @endif

                                                </div>

                                            </td>

                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>     

                            </div>

                            <div class="form-row">

                                <div class="col-md-12 mb-2">
                                        
                                    <form method="POST" action="{{ route('factura.facturarTodos', $dS->ordenCompra_id) }}" id="facturarTodosProductoForm">

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="flag" value="FacturarTodosProductos">
                                        <input type="hidden" value="{{ $factura->id }}" readonly name="factura_id">

                                        <button type="submit" class="btn btn-success btn-block"> 

                                            <i class="fas fa-check-circle"></i>

                                            Confirmar Facturación de TODOS los Productos de la O.C.

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

<!-- Facturar Producto Modal -->
<div class="modal fade" id="facturarProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-tasks"></i> Facturar Producto Recepcionado </p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/factura/facturarProducto/') }}" class="was-validated" id="facturarProductoForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="FacturarProducto">

                <div class="modal-body">
        
                    <div class="col-md-12 mb-3">
                                                
                        <label for="Producto">Producto</label>

                        <input type="text" id="Producto" class="form-control" disabled>
                        
                    </div>

                    <div class="mb-3 form-row">

                        <input type="submit" id="facturarProductos" value="Facturar Producto" class="btn btn-success btn-block">              

                    </div>
                            
                </div>

            </form>
        </div>

    </div>

</div>
<!-- Facturar Producto Modal -->

<!-- Eliminar Producto Facturado Modal -->
<div class="modal fade" id="nofacturarProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-tasks"></i> Eliminar Producto Facturado </p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            <form method="POST" action="#" class="was-validated" id="nofacturarProductoForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="NoFacturarProducto">

                <div class="modal-body">
        
                    <div class="col-md-12 mb-3">
                                                
                        <label class="text-muted">Esta usted seguro de No querer Facturar este Producto? : </label><input type="text" name="Producto" id="productDelete" readonly style="border:0;">
                        
                    </div>

                    <div class="mb-3 form-row">

                        <input type="submit" id="facturarProductos" value="Facturar Producto" class="btn btn-success btn-block">              

                    </div>
                            
                </div>

            </form>
        </div>

    </div>

</div>
<!-- Facturar Producto Modal -->




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
            var table1 = $('#detalleFactura').DataTable({
                "paginate"  : true,

                "ordering": false,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Productos a Facturar, aún...",
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
            table1.on('click', '.facturar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var dataDetalle = table1.row($tr).data();

                console.log(dataDetalle);

                $('#Producto').val(dataDetalle[2]);

                $('#facturarProductoForm').attr('action', '/siscom/factura/facturarProducto/' + dataDetalle[0]);
                $('#facturarProductoModal').modal('show');

            });
            //End Edit Record Detalle Solicitud

            //Start Delete Record Detalle Solicitud 
            table1.on('click', '.noFacturar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var dataDetalle = table1.row($tr).data();

                console.log(dataDetalle);

                $('#productDelete').val(dataDetalle[2]);
                
                $('#nofacturarProductoForm').attr('action', '/siscom/factura/' + dataDetalle[0]);
                $('#nofacturarProductoModal').modal('show');

            });
            //End Delete Record Detalle Solicitud
        
    });


</script>

@endpush