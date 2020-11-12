<!--
/*
 *  JFuentealba @itux
 *  created at November 12, 2020 - 3:45 pm
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
                            
                            <h3>Consulta de Movimientos de Medicamentos</h3>

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

                    @if (session('danger'))

                        <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">
                              
                            <i class="far fa-times-circle"></i>
                             
                            <strong> {{ session('danger') }} </strong>
                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                              
                            </button>

                        </div>
                   
                    @endif

                    <form class="form-inline" method="GET" action="{{ route('consultas.buscarMovMedicamentos') }}">

                        <div class="col-sm-3">
                            
                            <input type="text" id="medicamentoName" name="medicamentoName" class="form-control" placeholder="Medicamento a Buscar" required/>

                        </div>

                        <div class="col-sm-3">

                            <input type="text" id="fechaInicio" name="fechaInicio" class="form-control" placeholder="Fecha de Inicio" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Fecha de Inicio

                            </div>

                        </div>

                        <div class="col-sm-3">

                            <input type="text" id="fechaTermino" name="fechaTermino" class="form-control" placeholder="Fecha de Termino" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Fecha de Termino

                            </div>

                        </div>

                        <div class="col-sm-3">
                            
                            <button type="submit" class="btn btn-warning btn-block">Consultar</button>

                        </div>

                    </form>

                    <hr>

                    <div class="container">

                        <div class="row">
                        
                            <div class="col">

                                <table class="display" id="medicamentosTable" style="font-size: 0.8em;" width="100%">

                                    <thead>

                                        <tr class="table-active">

                                            <th>ID</th>

                                            <th>Medicamento</th>

                                            <th>Principio Activo</th>

                                            <th>Lote</th>
                                            
                                            <th>Stock</th>

                                            <th>Fecha Vencimiento</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach($medicamentosTable as $medicamento)

                                        <tr>

                                            <td>{{ $medicamento->id }}</td>

                                            <td>{{ $medicamento->medicamento }}</td>

                                            <td>{{ $medicamento->principioActivo }}</td>

                                            <td>{{ $medicamento->lote }}</td>

                                            <td>{{ $medicamento->stock }}</td>

                                            <td>{{ date('d-m-Y', strtotime($medicamento->fechaVencimiento)) }}</td>

                                        </tr>

                                    @endforeach

                                    </tbody>

                                </table>
                        
                            </div>
                        
                            <div class="col">

                                <table class="display" id="detalleVenta" style="font-size: 0.8em;" width="100%">

                                    <thead>

                                        <tr class="table-active">

                                            <th>ID</th>

                                            <th>Medicamento</th>

                                            <th>Principio Activo</th>

                                            <th>Lote</th>

                                            <th>Cantidad</th>

                                            <th>Fecha Venta</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach($detalleVentaTable as $dv)

                                        <tr>

                                            <td>{{ $dv->ID }}</td>

                                            <td>{{ $dv->Medicamento }}</td>

                                            <td>{{ $dv->PrincipioActivo }}</td>

                                            <td>{{ $dv->Lote }}</td>

                                            <td>{{ $dv->cantidad }}</td>

                                            <td>{{ date('d-m-Y', strtotime($dv->created_at)) }}</td>

                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>
                            
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

    <!-- JQuery CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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

    <script type="text/javascript">
        
        $(document).ready(function () {

            $( "#fechaInicio" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
            });

            $( "#fechaTermino" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
            });

            // Start Configuration DataTable
            var table = $('#medicamentosTable').DataTable({

                "searching": false,

                "order"     : ([0, 'desc']),

                "language"  : {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "No existen Medicamentos para mostrar",
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

            // Start Configuration DataTable Detalle Solicitud
            var table = $('#detalleVenta').DataTable({

                "searching": false,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existe su Medicamento en Ventas en el rango seleccionado",
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

        });

    </script>

@endpush    