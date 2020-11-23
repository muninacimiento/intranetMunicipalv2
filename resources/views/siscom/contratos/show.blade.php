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

                        <a href="{{action('ContratoController@index')}}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                        <h4> Nombre Contrato: {{ $contrato->nombreContrato }}</h4>

                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                            <div class="container">

                                <div class="form-row">

                                    <div class="col-md-6">

                                        <div class="form-row">
                                            
                                            <label class="col-sm-3 col-form-label text-muted">Orden de Compra</label>
                                                                        
                                            <label class="col-sm-9 col-form-label">{{ $contrato->NoOC }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class="col-sm-3 col-form-label text-muted">Proveedor</label>
                                                                        
                                            <label class="col-sm-9 col-form-label">{{ $contrato->Proveedor }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Fecha Inicio del Contrato</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ date('d-m-Y', strtotime($contrato->fechaInicio)) }}</label>     

                                        </div>

                                        <div class="form-row">
                                        
                                            <label class=" col-sm-3 col-form-label text-muted">Fecha de Término del Contrato</label>

                                            <label class="col-sm-9 col-form-label">{{ date('d-m-Y', strtotime($contrato->fechaTermino)) }}</label>

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Número Boleta de Garantía</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $contrato->numeroBoleta }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Banco de la Boleta de Garantía</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $contrato->banco }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Monto Boleta de Garantía ($)</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $contrato->montoBoleta }}</label>     

                                        </div>

                                        <div class="form-row">
                                            
                                            <label class=" col-sm-3 col-form-label text-muted">Tipo Contrato</label>
                                                                        
                                            <label class=" col-sm-9 col-form-label">{{ $contrato->tipoContrato }}</label>     

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <hr style="background-color: #d7d7d7">

                            <div class="container">

                                <div class="row">
                                    
                                    <div class="col">
                                        
                                        <div style="font-size: 0.8em;" class="bg-warning rounded-top rounded-bottom shadow p-3">

                                            <h5 class="text-center">

                                                <i class="fas fa-hourglass-half px-2"></i>

                                                TimeLine Contrato

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
                                                        <td>{{ $m->observacion }}</td>

                                                    </tr>

                                                 @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                    <div class="col text-white">
                                    
                                        <div style="font-size: 0.8em;" class="bg-secondary rounded-top rounded-bottom shadow p-3">

                                            <h5 class="text-center">

                                                <i class="fas fa-hourglass-half px-2"></i>

                                                TimeLine Boleta de Garantía 

                                            </h5>
                                            
                                            <table class="table table-striped table-sm table-hover text-white" width="100%">
                                                    
                                                <thead>
                                                    
                                                    <tr>
                                                        
                                                        <th>Fecha</th>
                                                        <th>Estado</th>
                                                        <th>Responsable</th>
                                                        
                                                    </tr>

                                                </thead>

                                                <tbody>

                                                 @foreach($moveBoleta as $mb)
                                                    
                                                    <tr>

                                                        <td>{{ date('d-m-Y H:i:s', strtotime($mb->date)) }}</td>
                                                        <td>{{ $mb->status }}</td>
                                                        <td>{{ $mb->name }}</td>

                                                    </tr>

                                                 @endforeach

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>
                                
                            </div>

                        </div>

                        <div>

                            <a href="{{ route('contratos.index') }}" class="text-decoration-none">

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