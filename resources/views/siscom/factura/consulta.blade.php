<!--
/*
 *  JFuentealba @itux
 *  created at June 09, 2020 - 09:49 am
 *  updated at 
 */
-->

@extends('layouts.app')

@section('content')

<div id="allWindow">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-primary shadow">

                <div class="card-header text-center text-white bg-primary">

                    @include('siscom.menu')

                </div>


                <div class="card-body">

                    <div class="row mt-5">

                        <div class="col-md-6 text-center">
                            
                            <h3>Consulta de Facturas Gestionadas</h3>

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

                        <table class="display" id="facturasTable" style="font-size: 0.8em;" width="100%">

                            <thead>

                                <tr class="table-active">

                                    <th style="display:none;">ID</th>

                                    <th>Tipo Documento</th>

                                    <th>No. Factura</th>

                                    <th>IDDOC</th> 

                                    <th>Fecha Of.Partes</th>                                   

                                    <th>Recepción Factura</th>                                    

                                    <th>Estado Factura</th>

                                    <th>No. OC</th>

                                    <th>Proveedor</th>

                                    <th>Total $</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($facturas as $factura)

                                    <tr>

                                        <td style="display: none;">{{ $factura->id }}</td>

                                        <td>{{ $factura->tipoDocumento }}</td>

                                        <td>{{ $factura->factura_id }}</td>

                                        <td>{{ $factura->iddoc }}</td>

                                        <td>{{ date('d-m-Y', strtotime($factura->fechaOficinaParte)) }}</td>

                                        <td>{{ date('d-m-Y', strtotime($factura->created_at)) }}</td>

                                        <td>{{ $factura->Estado }}</td>

                                        <td>{{ $factura->NoOC }}</td>

                                        <td>{{ $factura->RazonSocial }}</td>

                                        <td>{{ $factura->totalFactura }}</td>

                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <a href="{{ route('factura.show', $factura->id) }}" class="btn btn-secondary btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle de la Factura">
                                                    
                                                    <i class="fas fa-eye"></i>

                                                </a>

                                            </div>

                                        </td>

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

<script type="text/javascript">
        
        $(document).ready(function () {

            $( "#fechaOficinaParte" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 1,
            });

            // Start Configuration DataTable
            var table = $('#facturasTable').DataTable({

                "paginate"  : true,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Facturas recepcionadas por su unidad, aún...",
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


