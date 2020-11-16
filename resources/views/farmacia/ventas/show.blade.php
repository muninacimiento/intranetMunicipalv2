@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-danger shadow">

                <div class="card-header text-center text-white bg-danger mb-3">

                    @include('farmacia.menu')

                </div>

                    <div class="card-body">

                        @if (session('info'))
    
                            <div class="alert alert-success" role="alert">

                                <i class="fas fa-check-circle"></i>

                                {{ session('info') }}
                            
                            </div>

                        @endif

                        @if (session('danger'))

                        <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">
                              
                            <i class="fas fa-times-circle"></i>
                             
                            <strong> {{ session('danger') }} </strong>
                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                              
                            </button>

                        </div>
                   
                        @endif

                        <a href="{{action('VentaFarmaciaController@index')}}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                        <h4> No. Venta <input type="text" value="{{ $venta->id }}" readonly class="h4" style="border:0;" name="venta_id" form="detalleVentaForm"> </h4>

                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                            <div class="form-row mb-3">

                                <div class="col-md-8 mb-3">

                                    <label class="text-muted">Usuario</label>
                                                                
                                    <h4>{{ $venta->Comprador }}</h4>
                                                            
                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="text-muted">Fecha Venta</label> <br>

                                    <h5>{{ date('d-m-Y', strtotime($venta->created_at)) }}</h5> 
                                                            
                                </div>

                            </div>

                            <div class="form-row mb-3">

                                <div class="col-md-6 mb-3">
                                
                                    <label class="text-muted">Dirección</label>
                                                                
                                    <h5>{{ $venta->direccion }}</h5> 

                                </div>

                                <div class="col-md-3 mb-3">

                                    <label class="text-muted">Teléfono</label>
                                                                
                                    <h5>{{ $venta->telefono }}</h5>
                                                            
                                </div>

                                <div class="col-md-3">

                                    <label class="text-muted">Vended@r</label>
                                                                
                                    <h5>{{ $venta->Vendedor }}</h5>
                                                            
                                </div>

                            </div>

                            
                            <hr style="background-color: #d7d7d7">
                           
                            <div class="py-3">

                                <form method="POST" action="{{ action('VentaFarmaciaController@store') }}" class="was-validated" id="detalleVentaForm">

                                    @csrf

                                    <input type="hidden" name="flag" value="DetalleVenta">

                                    <div class="form-row bg-dark p-3 text-white rounded-top">

                                        <h5> 

                                            <i class="fas fa-shopping-basket px-2"></i> Detalle de la Venta

                                        </h5>

                                    </div>

                                    <div class="form-row bg-dark p-2 text-white">

                                        <div class="col-md-10 mb-3">
                                                
                                            <label for="Medicamentos">Medicamentos</label>

                                            <select name="medicamento_id" id="medicamento_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el Medicamento que desea vender..." required>

                                                @foreach($medicamentos as $medicamento)

                                                    <option value="{{ $medicamento->id }}">{{ $medicamento->Medicamento }}</option>
                                                            
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="col-md-2 mb-3">
                                                
                                            <label for="cantidad">Cantidad</label>

                                            <input type="number" min="0" name="cantidad" id="cantidad" class="form-control" required>

                                        </div>

                                    </div>

                                    <div class="form-row mb-5 bg-dark p-2 text-white rounded-bottom">

                                        <div class="col-md-12 mb-2">
                                                
                                            <button class="btn btn-block btn-warning" type="submit">

                                                <i class="fas fa-cart-arrow-down"></i>

                                                Agregar Medicamento

                                            </button>

                                        </div>

                                    </div>

                                </form>

                                <div class="py-5">

                                    <table class="display" id="detalleVenta" width="100%">

                                        <thead>

                                            <tr>

                                                <th style="display: none;">ID</th>

                                                <th>Medicamento</th>

                                                <th>Cantidad</th>

                                                <th>Valor</th>
                                                        
                                                <th>SubTotal</th>

                                                <th>Acciones</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach($detalleVenta as $dv)

                                            <tr>

                                                <td style="display: none;">{{ $dv->id }}</td>

                                                <td>{{ $dv->Medicamento }}</td>

                                                <td>{{ $dv->cantidad }}</td>

                                                <td>{{ $dv->Valor }}</td>

                                                <td class="subtotal">{{ $dv->SubTotal }}</td>  

                                                <td>
                                                            
                                                    <a href="#" class="btn btn-primary btn-sm editDetalle" data-toggle="tooltip" data-placement="bottom" title="Editar Producto">
                                                                    
                                                        <i class="far fa-edit"></i>

                                                    </a>

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

                            <form class="form-inline float-right mt-3">
                                            
                                <label class="my-1 mr-2 h5 text-muted" for="inlineFormCustomInput">Total Venta : $ </label>

                                <input type="text" name="totalVenta" id="total" readonly style="border: 0;font-size: 2em;" size="15">   

                            </form>

                            <div class="col-md-12">
                                    
                                <a href="{{url('/farmacia/ventas')}}" class="text-decoration-none">

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

<!-- Actualizar Medicamento Detalle Venta-->
<div class="modal fade" id="updateMedicamentoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-edit"></i> Modificar Medicamento de la Venta</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            <form method="POST" action="/farmacia/ventas" class="was-validated" id="updateMedicamentoForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="UpdateMedicamento">

                <div class="modal-body">
        
                    <div class="col-md-12 mb-3">
                                                
                        <label for="Medicamento">Medicamento</label>

                        <input type="text" id="MedicamentoUpdate" class="form-control" disabled>
                        
                    </div>

                    <div class="col-md-12 mb-3">
                                                
                        <label for="Cantidad">Cantidad</label>

                        <input type="number" name="cantidad" id="CantidadUpdate" class="form-control" required>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Actualizar Medicamento

                        </button>

                    </div>
                            
                </div>

            </form>
        </div>

    </div>

</div>
<!-- Actualizar Medicamento Detalle Venta-->

<!-- DELETE Modal Detalle Solicitud -->
<div class="modal fade" id="deleteMedicamentoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-times-circle"></i> Eliminar Medicamento de la Venta </p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="#" class="was-validated" id="deleteMedicamentoForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="DeleteMedicamento">

                <div class="modal-body">

                    <p>Esta Ud. segur@ de querer Eliminar el Medicamento : </p>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">

                            <label class="h5" id="deleteProducto">deleteProducto</label>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-danger btn-block" type="submit">

                            <i class="fas fa-times-circle"></i> Eliminar Medicamento

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- End Modal Delete Solicitud -->

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
        
            // Start Configuration DataTable Detalle Solicitud
            var table = $('#detalleVenta').DataTable({
                "paginate"  : false,

                "ordering": false,

                "searching": false,

                "info" : false,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Productos en su Venta aún...",
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
            table.on('click', '.editDetalle', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var dataDetalle = table.row($tr).data();

                console.log(dataDetalle);

                $('#MedicamentoUpdate').val(dataDetalle[1]);
                $('#CantidadUpdate').val(dataDetalle[2]);

                $('#updateMedicamentoForm').attr('action', '/farmacia/ventas/medicamento/' + dataDetalle[0]);
                $('#updateMedicamentoModal').modal('show');

            });
            //End Edit Record Detalle Solicitud

            //Start Delete Record Detalle Solicitud 
            table.on('click', '.deleteDetalle', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var dataDetalle = table.row($tr).data();

                console.log(dataDetalle);

                document.getElementById('deleteProducto').innerHTML = dataDetalle[1];
                
                $('#deleteMedicamentoForm').attr('action', '/farmacia/ventas/medicamento/' + dataDetalle[0]);
                $('#deleteMedicamentoModal').modal('show');

            });
            //End Delete Record Detalle Solicitud

        //Recorremos la Tabla y Sumamos cada Subtotal
        //var cls = document.getElementById("detalleSolicitud").getElementsByTagName("td");
        //var sum = 0;
        //for (var i = 0; i < cls.length; i++){
        //    if(cls[i].className == "subtotal"){
        //        sum += isNaN(cls[i].innerHTML) ? 0 : parseInt(cls[i].innerHTML);
        //    }
        //}

        //$('#total').val(sum);

        var total = 0;
        $('#detalleVenta').DataTable().rows().data().each(function(el, index){
          //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
          total += parseInt(el[4]);
        });

        $('#total').val(total);

        console.log(total);
        
    });


</script>

@endpush