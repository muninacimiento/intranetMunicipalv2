<!--
/*
 *  JFuentealba @itux
 *  created at November 16, 2020 - 3:45 pm
 *  updated at 
 */
-->

@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col">

            <div class="card border-danger shadow">

                <div class="card-header text-center text-white bg-danger">

                    @include('farmacia.menu')

                </div>


                <div class="card-body">

                    <div class="row py-3">

                        <div class="col text-center">
                            
                            <h3>Gestión de Medicamentos Sin Stock</h3>

                            <div class="text-secondary">

                                {{ $dateCarbon }}

                            </div>

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

                    
                    <div>

                        <table class="display" id="medicamentosTable" style="font-size: 0.8em;">

                            <thead>

                                <tr class="table-active">

                                    <th>ID</th>

                                    <th>Categoria</th>

                                    <th>Medicamento</th>

                                    <th>Principio Activo</th>

                                    <th>Laboratorio</th>

                                    <th>Lote</th>
                                    
                                    <th>Fecha Vencimiento</th>
                                    
                                    <th>Stock</th>

                                    <th>$ Inventario</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($medicamentos as $medicamento)

                                <tr>

                                    <td>{{ $medicamento->id }}</td>

                                    <td>{{ $medicamento->Categoria }}</td>

                                    <td>{{ $medicamento->medicamento }}</td>

                                    <td>{{ $medicamento->principioActivo }}</td>

                                    <td>{{ $medicamento->laboratorio }}</td>

                                    <td>{{ $medicamento->lote }}</td>

                                    <td>{{ date('d-m-Y', strtotime( $medicamento->fechaVencimiento )) }}</td>

                                    <td>{{ $medicamento->stock }}</td>

                                    <td>{{ $medicamento->precioInventario  }}</td>

                                </tr>

                            @endforeach

                            </tbody>

                            <tfoot>

                                <tr class="table-active">

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                            </tfoot>

                        </table>

                        <form class="form-inline float-right mt-3">
                                            
                            <label class="my-1 mr-2 h5 text-muted" for="inlineFormCustomInput">Total Inventario Sin Stock: $ </label>

                            <input type="text" name="totalInventario" id="total" readonly style="border: 0;font-size: 1.5em;">

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


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

    // Start Configuration DataTable
    var table = $('#medicamentosTable').DataTable({

        "paginate"  : true,

        "order"     : ([0, 'desc']),

        "language"  : {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No existen Medicamentos registrados, aún...",
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

    var total = 0;
        $('#medicamentosTable').DataTable().rows().data().each(function(el, index){
          //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
          total += parseInt(el[8]);
        });

        $('#total').val(total);

        console.log(total);
});

</script>

@endpush