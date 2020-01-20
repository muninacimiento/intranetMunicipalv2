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

                        <a href="{{action('SCM_AdminSolicitudController@index')}}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                         <h4> Solicitud No.  <input type="text" value="{{ $solicitud->id }}" readonly class="h4" style="border:0;" name="solicitudID" form="detalleSolicitudForm"> </h4>

                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                            <div class="form-row mb-3">

                                <div class="col-md-12 mb-3">

                                    <label class="text-muted">Motivo</label>
                                                                
                                    <h5>{{ $solicitud->motivo }}</h5>
                                                            
                                </div>

                            </div>

                            <div class="form-row mb-3">

                                <div class="col-md-3 mb-3">
                                                          
                                    <label class="text-muted">Tipo Solicitud</label>

                                    <input type="text" value="{{ $solicitud->tipoSolicitud }}" readonly class="h5" style="border:0;" id="tipoSolicitud">

                                </div>

                                <div class="col-md-3 mb-3">
                                
                                    <label class="text-muted">Categoria Solicitud</label>
                                                                
                                    <h5>{{ $solicitud->categoriaSolicitud }}</h5> 

                                </div>

                                <div class="col-md-3 mb-3">

                                    <label class="text-muted">Fecha Solicitud</label>
                                                                
                                    <h5>{{ date('d-m-Y H:i:s', strtotime($solicitud->updated_at)) }}</h5>
                                                            
                                </div>

                                <div class="col-md-3">

                                    <label class="text-muted">Solicitante</label>
                                                                
                                    <h5>{{ $solicitud->nameUser }}</h5>
                                                            
                                </div>

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
                                            <th>Comprador Asignado</th>
                                            <th>Comprador Suplencia</th>
                                            
                                        </tr>

                                    </thead>

                                    <tbody>

                                     @foreach($move as $m)
                                        
                                        <tr>

                                            <td>{{ date('d-m-Y H:i:s', strtotime($m->date)) }}</td>
                                            <td>{{ $m->status }}</td>
                                            <td>{{ $m->name }}</td>
                                            @if($m->status == 'Asignada a Comprador')
                                                <td>{{ $solicitud->compradorTitular }}</td>
                                            @else
                                                <td></td>
                                            @endif

                                            @if($m->status == 'Re-Asignada a Comprador')
                                                <td>{{ $solicitud->compradorSuplencia }}</td>
                                             @else
                                                <td></td>
                                            @endif

                                        </tr>

                                     @endforeach

                                    </tbody>

                                </table>

                            </div>

                            <div class="py-5">

                                <div>

                                    <table class="display" id="detalleSolicitud" width="100%">

                                        <thead>

                                            <tr>

                                                <th>ID</th>

                                                <th>Producto</th>

                                                <th>Cantidad Solicitada</th>

                                                <th>Cantidad Entregada</th>

                                                <th>Saldo</th>

                                                <th>Observaciones</th>

                                                <th>Acciones</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach($detalleSolicitud as $detalle)

                                            <tr>

                                                <td>{{ $detalle->id }}</td>

                                                <td>{{ $detalle->Producto }}</td>

                                                <td>{{ $detalle->cantidad }}</td>

                                                <td>{{ $detalle->cantidadEntregada }}</td>

                                                <td>{{ $detalle->Saldo }}</td>

                                                <td>{{ $detalle->obsEntrega }}</td>

                                                <td>

                                                    @if($solicitud->estado === 'Solicitud Entregada Completamente')

                                                    @elseif($detalle->cantidad === $detalle->cantidadEntregada)
                                                    
                                                        <label class="text-muted" style="font-size: 0.9em;">Producto Entregado en su Totalidad</label>

                                                    @else

                                                        <a href="#" class="btn btn-primary btn-sm editDetalle" data-toggle="tooltip" data-placement="bottom" title="Entregar Producto">
                                                                    
                                                            <i class="fas fa-tasks"></i>

                                                        </a>

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
                                
                                    <form method="POST" action="{{ route('admin.cerrar', $solicitud->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="flag" value="Cerrar">

                                        @if($solicitud->estado === 'Solicitud Entregada Completamente')

                                            <button type="submit" class="btn btn-success btn-block" disabled> 

                                                <i class="fas fa-check-circle"></i>

                                                Cerrar Solicitud

                                            </button>

                                        @else

                                            <button type="submit" class="btn btn-success btn-block"> 

                                                <i class="fas fa-check-circle"></i>

                                                Cerrar Solicitud

                                            </button>

                                        @endif

                                    </form>    

                                </div>

                                <div class="col-md-12">
                                    
                                    <a href="{{url('/siscom/admin')}}" class="text-decoration-none">

                                        <button type="submit" class="btn btn-secondary btn-block"> 

                                            <i class="fas fa-arrow-left"></i>
                                            
                                            Atrás

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
        
</div>


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

        $( "#fechaActividad" ).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: "+14d",
            firstDay: 1,
            dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
            numberOfMonths: 2,
        });

            // Start Configuration DataTable Detalle Solicitud
            var table1 = $('#detalleSolicitud').DataTable({
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
            table1.on('click', '.editDetalle', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var dataDetalle = table1.row($tr).data();

                console.log(dataDetalle);

                $('#Producto').val(dataDetalle[1]);
                $('#cantidadSolicitada').val(dataDetalle[2]);
                $('#cantidadEntregada').val(dataDetalle[3]);
                $('#observacion').val(dataDetalle[5]);            

                $('#updateDetalleForm').attr('action', '/siscom/admin/' + dataDetalle[0]);
                $('#updateDetalleModal').modal('show');

            });
            //End Edit Record Detalle Solicitud

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