<!--
/*
 *  JFuentealba @itux
 *  created at December 26, 2019 - 11:28 pm
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
                            
                            <h3>Gestión de Facturas</h3>

                            <div class="text-secondary">

                                {{$dateCarbon}}

                            </div>

                        </div>

                        <!-- Button trigger CrearSolicitudModal -->
                        <div class="col-md-6">
                            
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createFacturaModal">

                                <button class="btn btn-success btn-block boton">

                                    <i class="fas fa-file-invoice-dollar px-2"></i>

                                    Nueva Factura

                                </button>

                            </a>
                            
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

                                    <th>Recepción Factura</th>

                                    <th>Fecha Recepción Of.Partes</th>

                                    <th>Estado Factura</th>

                                    <th>Días Trasncurridos (Por Estado)</th>

                                    <th>Días Transcurridos (Total)</th>

                                    <th>No. OC</th>

                                    <th>Proveedor</th>

                                    <th>Total $</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($facturas as $factura)

                                    @foreach($moveFacturas as $move)

                                        @if($factura->id === $move->factura_id)

                                        @if($factura->estado_id === $move->estadoFactura_id)

                                            <tr>

                                                <td style="display: none;">{{ $factura->id }}</td>

                                                <td>{{ $factura->tipoDocumento }}</td>

                                                <td>{{ $factura->factura_id }}</td>

                                                <td>{{ $factura->iddoc }}</td>

                                                <td>{{ date('d-m-Y', strtotime($factura->created_at)) }}</td>

                                                <td>{{ date('d-m-Y', strtotime($factura->fechaOficinaParte)) }}</td>

                                                <td>{{ $factura->Estado }}</td>

                                                {{-- Días Transcurridos por Estado --}}

                                                        @if($factura->estado_id === 1)

                                                            @if( Carbon\Carbon::parse($move->created_at)->diffInDays() <= 1)

                                                                <td style="background-color : #59d634 !important;color: white;text-align: center;">
                                                                    
                                                                    {{ Carbon\Carbon::parse($move->created_at)->diffInDays() }}

                                                                </td>

                                                            @elseif( Carbon\Carbon::parse($move->created_at)->diffInDays() > 1 && Carbon\Carbon::parse($move->created_at)->diffInDays() <= 2 )

                                                                <td style="background-color : #eac50b !important;color: black; text-align: center;">
                                                                    
                                                                    {{ Carbon\Carbon::parse($move->created_at)->diffInDays() }}

                                                                </td>

                                                            @elseif( Carbon\Carbon::parse($move->created_at)->diffInDays() > 2)

                                                                <td style="background-color : #ea0b0b !important;color: white;text-align: center;">
                                                                    
                                                                    {{ Carbon\Carbon::parse($move->created_at)->diffInDays() }}

                                                                </td>

                                                            @endif

                                                        @elseif($factura->estado_id === 2)

                                                            @if( Carbon\Carbon::parse($move->created_at)->diffInDays() <= 3)

                                                                <td style="background-color : #59d634 !important;color: white;text-align: center;">
                                                                    
                                                                    {{ Carbon\Carbon::parse($move->created_at)->diffInDays() }}

                                                                </td>

                                                            @elseif( Carbon\Carbon::parse($move->created_at)->diffInDays() > 3 && Carbon\Carbon::parse($move->created_at)->diffInDays() <= 5 )

                                                                <td style="background-color : #eac50b !important;color: black; text-align: center;">
                                                                    
                                                                    {{ Carbon\Carbon::parse($move->created_at)->diffInDays() }}

                                                                </td>

                                                            @elseif( Carbon\Carbon::parse($move->created_at)->diffInDays() > 5)

                                                                <td style="background-color : #ea0b0b !important;color: white;text-align: center;">
                                                                    
                                                                    {{ Carbon\Carbon::parse($move->created_at)->diffInDays() }}

                                                                </td>

                                                            @endif

                                                        @elseif($factura->estado_id === 3)

                                                            @if( Carbon\Carbon::parse($move->created_at)->diffInDays() <= 1)

                                                                <td style="background-color : #59d634 !important;color: white;text-align: center;">
                                                                    
                                                                    {{ Carbon\Carbon::parse($move->created_at)->diffInDays() }}

                                                                </td>

                                                            @elseif( Carbon\Carbon::parse($move->created_at)->diffInDays() > 1 && Carbon\Carbon::parse($move->created_at)->diffInDays() <= 2 )

                                                                <td style="background-color : #eac50b !important;color: black; text-align: center;">
                                                                    
                                                                    {{ Carbon\Carbon::parse($move->created_at)->diffInDays() }}

                                                                </td>

                                                            @elseif( Carbon\Carbon::parse($move->created_at)->diffInDays() > 2)

                                                                <td style="background-color : #ea0b0b !important;color: white;text-align: center;">
                                                                    
                                                                    {{ Carbon\Carbon::parse($move->created_at)->diffInDays() }}

                                                                </td>

                                                            @endif

                                                        @endif


                                                {{-- Días Trasncurridos en su Totalidad --}}

                                                    @if( Carbon\Carbon::parse($factura->created_at)->diffInDays() <= 15)

                                                        <td style="background-color : #59d634 !important;color: white;text-align: center;">
                                                                    
                                                            {{ Carbon\Carbon::parse($factura->created_at)->diffInDays() }}

                                                        </td>

                                                    @elseif( Carbon\Carbon::parse($factura->created_at)->diffInDays() > 15 &&  Carbon\Carbon::parse($factura->created_at)->diffInDays() <= 30)

                                                        <td style="background-color : #eac50b !important;color: black; text-align: center;">
                                                                    
                                                            {{ Carbon\Carbon::parse($factura->created_at)->diffInDays() }}

                                                        </td>

                                                    @elseif( Carbon\Carbon::parse($factura->created_at)->diffInDays() > 30)

                                                        <td style="background-color : #ea0b0b !important;color: white;text-align: center;">
                                                                    
                                                            {{ Carbon\Carbon::parse($factura->created_at)->diffInDays() }}

                                                        </td>

                                                    @endif

                                                {{-- Fin Días Trasncurridos en su Totalidad --}}

                                                <td>{{ $factura->NoOC }}</td>

                                                <td>{{ $factura->RazonSocial }}</td>

                                                <td>{{ $factura->totalFactura }}</td>

                                                <td>

                                                    <div class="btn-group" role="group" aria-label="Basic example">

                                                        <a href="{{ route('factura.show', $factura->id) }}" class="btn btn-secondary btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle de la Factura">
                                                    
                                                            <i class="fas fa-eye"></i>

                                                        </a>

                                                        {{-- Validar fACTURA --}}

                                                        @if($factura->Estado === 'Enviada a Pago')

                                                        @else

                                                        <a href="{{ route('factura.validar', $factura->id) }}" data-toggle="tooltip" data-placement="bottom" title="Válidar Factura">
                                                        
                                                            <button class="btn btn-warning btn-sm mr-1 " type="button">
                                                                        
                                                                <i class="fas fa-thumbs-up"></i>

                                                            </button>

                                                        </a>

                                                        @endif

                                                        @if($factura->Estado === 'Enviada a Pago')

                                                        @else

                                                        <a href="#" class="btn btn-primary btn-sm mr-1 edit" data-toggle="tooltip" data-placement="bottom" title="Modificar Factura">
                                                    
                                                            <i class="fas fa-edit"></i>

                                                        </a>

                                                        @endif

                                                        @if($factura->Estado === 'Enviada a Pago')

                                                        @else

                                                            {!! Form::open(['route'=> ['factura.destroy', $factura->id], 'method' => 'DELETE']) !!}

                                                                <button class="btn btn-danger btn-sm delete" style="font-size: 90%;">

                                                                    <i class="fas fa-trash"></i>

                                                                </button>

                                                            {!! Form::close() !!}


                                                        @endif

                                                    </div>

                                                </td>

                                            </tr>

                                        @endif

                                        @endif

                                    @endforeach

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Modal Create Factura -->
<div class="modal fade" id="createFacturaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-file-invoice-dollar"></i> Nueva Factura</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ action('FacturaController@store') }}" class="was-validated" id="facturaForm">

                @csrf

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="factura">No. Factura</label>

                            <input type="text" class="form-control" id="facturaCreate" name="factura_id" placeholder="000124578" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Número de la Factura

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Iddoc">IDDOC</label>

                            <input type="text" class="form-control" id="iddocCreate" name="iddoc" placeholder="456123" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el IDDOC del Sistema de Correspondencia

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-sm-6 mb-3">

                            <label for="nombreActividad">Fecha Oficina de Parte</label>

                            <input type="text" id="fechaOficinaParte_Created" name="fechaOficinaParte" class="form-control" placeholder="Fecha de Recepción en Oficina de Parte?" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Fecha de Recepción de Oficina de Parte

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="tipoDocumento">Tipo Documento</label>

                            <select name="tipoDocumento" id="tipoDocumentoCreate" class="form-control selectpicker" title="Tipo Documento ?" required>

                                <option>Factura</option>
                                <option>Boleta</option>
                                <option>Recibo</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Tipo de Documento

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                
                            <label for="proveedor_id">Proveedor</label>

                            <select name="proveedor_id" id="proveedor_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el Proveedor de su Órden de Compra" required>

                                @foreach($proveedores as $proveedor)

                                    <option value="{{ $proveedor->id }}">{{ $proveedor->RazonSocial }}</option>
                                                                
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">
                                                
                            <label for="ordenCompra_id">No. Órden de Compra</label>

                            <select name="ordenCompra_id" id="ordenCompra_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el No. de su Órden de Compra" required>

                                @foreach($ocs as $oc)

                                    <option value="{{ $oc->id }}">{{ $oc->OC }}</option>
                                                                
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="total">Total $</label>

                            <input type="text" class="form-control" id="totalCreate" name="totalFactura" placeholder="$ 123456789" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Total de la Factura

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Guardar Factura

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
<!-- End Modal Create Proveedor -->

<!-- Update Modal Proveedor -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h3 class="modal-title" id="exampleModalLabel"> Actualizar Factura <i class="fas fa-edit"></i></h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="#" class="was-validated" id="updateForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Actualizar">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="factura">No. Factura</label>

                            <input type="text" class="form-control" id="facturaUpdate" name="factura_id" placeholder="000124578" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Número de la Factura

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Iddoc">IDDOC</label>

                            <input type="text" class="form-control" id="iddocUpdate" name="iddoc" placeholder="456123" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el IDDOC del Sistema de Correspondencia

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-sm-6 mb-3">

                            <label for="nombreActividad">Fecha Oficina de Parte</label>

                            <input type="text" id="fechaOficinaUpdate" name="fechaOficinaParte" class="form-control" placeholder="Fecha de Recepción en Oficina de Parte?" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Fecha de Recepción de Oficina de Parte

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="tipoDocumento">Tipo Documento</label>

                            <select name="tipoDocumento" id="tipoDocumentoUpdate1" class="custom-select" required>

                                <option>Factura</option>
                                <option>Boleta</option>
                                <option>Recibo</option>

                            </select>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Tipo de Documento

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                
                            <label for="proveedor_id">Proveedor</label>

                            <select name="proveedor_id" id="proveedor_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el Proveedor de su Órden de Compra" required>

                                @foreach($proveedores as $proveedor)

                                    <option value="{{ $proveedor->id }}">{{ $proveedor->RazonSocial }}</option>
                                                                
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">
                                                
                            <label for="ordenCompra_id">No. Órden de Compra</label>

                            <select name="ordenCompra_id" id="ordenCompra_idUpdate" class="form-control selectpicker" data-live-search="true" title="Seleccione el No. de su Órden de Compra" required>

                                @foreach($ocs as $oc)

                                    <option value="{{ $oc->id }}">{{ $oc->OC }}</option>
                                                                
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="total">Total $</label>

                            <input type="text" class="form-control" id="totalUpdate" name="totalFactura" placeholder="$ 123456789" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Total de la Factura

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Guardar Factura

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
<!-- END Update Modal Factura -->

<!-- DELETE Modal Factura -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h3 class="modal-title" id="exampleModalLabel"> Eliminar Factura <i class="fas fa-times-circle"></i></h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="#" class="was-validated" id="deleteForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Eliminar">

                <div class="modal-body">

                    <div class="form-row">                        

                            <label class="col-sm-4 col-form-label text-muted">Tipo de Documento</label><br>
                                                                        
                            <label class="col-sm-6 col-form-label" id="rutDelete">Tipo de Documento</label>
                                                                     
                    </div>

                    <div class="form-row">

                        <label class="col-sm-4 col-form-label text-muted">No. Factura</label><br>
                                                                        
                        <label class="col-sm-6 col-form-label" id="razonSocialDelete">No. Factura</label>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-danger btn-block" type="submit">

                            <i class="fas fa-times-circle"></i> Eliminar Factura

                        </button>

                        <a href="{{ url('/siscom/solicitud') }}" class="btn btn-secondary btn-block" type="reset">

                            <i class="fas fa-arrow-left"></i> Atrás

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- End Delete Modal Proveedor -->

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

<script type="text/javascript">
        
        $(document).ready(function () {

            $( "#fechaOficinaParte_Created" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 1,
            });

            $( "#fechaOficinaParte_Updated" ).datepicker({
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

            //Start Edit Record
            table.on('click', '.edit', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                
                
                $('#tipoDocumentoUpdate1').val(data[1]);
                $('#facturaUpdate').val(data[2]);
                $('#iddocUpdate').val(data[4]);
                $('#fechaOficinaUpdate').val(data[5]);
                $('#totalUpdate').val(data[8]);

                $('#updateForm').attr('action', '/siscom/factura/' + data[0]);
                $('#updateModal').modal('show');

            });
            //End Edit Record

            //Start Delete Record
            table.on('click', '.delete', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                document.getElementById('rutDelete').innerHTML = data[1];
                document.getElementById('razonSocialDelete').innerHTML = data[2];
                
                $('#deleteForm').attr('action', '/siscom/factura/' + data[0]);
                $('#deleteModal').modal('show');

            });
            //End Delete Record

    });    

</script>

@endpush


