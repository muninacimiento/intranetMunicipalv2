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

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                            <hr style="background-color: #d7d7d7">

                        </div>

                        <div class="mb-5">

                            <div class="mb-5">

                                 <a href="#" data-toggle="modal" data-target="#asignarTODOSModal" title="Asignar Producto a la órden de Compra" disabled>

                                    <button class="btn btn-primary btn-sm float-right">

                                        <i class="fas fa-check-double"></i> 

                                        Asignar a Todos

                                    </button>
                                        

                                </a>
                                    
                                <h5>Detalle Órden de Compra</h5>   

                            </div>
                            

                            <div>

                                <table class="display" id="detalleSolicitud" width="100%">

                                    <thead>

                                        <tr>

                                            <th style="display: none;">ID</th>

                                            <th>No.Solicitud</th>

                                            <th>Producto</th>

                                            <th>Especificación</th>

                                            <th>Cantidad</th>

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

                                            <td>                                                

                                                @if($ds->ordenCompra_id == null)

                                                {!! Form::open(['route'=> ['solicitud.update', $ds->id], 'method' => 'PUT']) !!}

                                                    @csrf

                                                    <input type="hidden" name="flag" value="AsignarOC">

                                                    <input type="hidden" value="{{ $ordenCompra->id }}" name="ordenCompraID" id="ordenCompraID">

                                                    <button class="btn btn-primary btn-sm mr-1">

                                                        <i class="fas fa-check"></i>

                                                    </button>

                                                {!! Form::close() !!}
                                                    
                                                @elseif($ds->ordenCompra_id === $ordenCompra->id)

                                                {!! Form::open(['route'=> ['solicitud.update', $ds->id], 'method' => 'PUT']) !!}

                                                    <input type="hidden" name="flag" value="EliminarOC">

                                                    <button class="btn btn-danger btn-sm mr-1">

                                                        <i class="fas fa-trash-alt"></i>

                                                    </button>

                                                {!! Form::close() !!}

                                                @else

                                                    <label class="text-muted" style="font-size: 0.9em;">Producto Pertenece a otra OC</label>

                                                @endif

                                            </td>

                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <div>

                            <form method="POST" action="{{ route('ordenCompra.update', $ordenCompra->id) }}">

                                @csrf
                                @method('PUT')

                                <input type="hidden" name="flag" value="ConfirmarOC">

                                @if($ordenCompra->Estado === 'Emitida')

                                    <button type="submit" class="btn btn-success btn-block mb-3"> 

                                        <i class="fas fa-check-circle"></i>

                                        Confirmar Órden de Compra

                                    </button>

                                @else

                                    <button type="submit" class="btn btn-success btn-block mb-3" disabled> 

                                        <i class="fas fa-check-circle"></i>

                                        Confirmar Órden de Compra

                                    </button>

                                @endif

                            </form>

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

<!-- UPDATE Modal Detalle Solicitud-->
<div class="modal fade" id="asignarTODOSModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-edit"></i> Agregar Todos los Producto a Órden de Compra  </p>

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

               <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Agregar Producto a la Órden de Compra</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/solicitud') }}" class="was-validated" id="detalleOrdenCompraForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="AsignarOC">

                <div class="modal-body">
        
                    <div class="p-3">
                        
                        <label class="text-muted">Esta usted seguro de querer agregar este Producto? : </label><input type="text"  id="productAdd" readonly style="border:0;">

                        <input type="hidden" value="{{ $ordenCompra->id }}" name="ordenCompraID" id="ordenCompraID">

                    </div>

                    <div class="form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-check-circle"></i>

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

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-times-circle"></i> Eliminar Producto de la Solicitud </p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/solicitud') }}" class="was-validated" id="deleteDetalleForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="EliminarOC">

                <div class="modal-body">

                    <div class="p-3">

                        <label class="text-muted">Esta usted seguro de querer eliminar este Producto? : </label><input type="text" name="Producto" id="productDelete" readonly style="border:0;">

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-danger btn-block" type="submit">

                            <i class="fas fa-times-circle"></i>

                            Eliminar Producto

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

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Nuevo Producto</p>

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

                $('#productAdd').val(dataDetalle[3]);

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

                $('#productDelete').val(dataDetalle[3]);
                
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