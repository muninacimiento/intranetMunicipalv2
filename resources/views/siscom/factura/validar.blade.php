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

                        <a href="{{route('factura.index')}}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                        <h4> Factura No.  <input type="text" value="{{ $factura->factura_id }}" readonly class="h4" style="border:0;" name="factura_id" id="factura_id" form="validarFacturaForm">

                        </h4>

                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                            <div class="container">

                                <div class="row">
                                    
                                    <div class="col">
                                        
                                        <div class="form-row mb-3">

                                            <div class="col-md-6 mb-3">

                                                <label class="text-muted">Tipo Documento</label>
                                                                                            
                                                <h5>{{ $factura->tipoDocumento }}</h5>

                                            </div>
                                                                                    
                                        </div>

                                        <div class="form-row mb-3">

                                            <div class="col-md-6 mb-3">
                                                                                  
                                                <label class="text-muted">Fecha Oficina de Parte</label> <br>

                                                <h5>{{ date('d-m-Y H:i:s', strtotime($factura->created_at)) }}</h5>

                                            </div>

                                        </div>

                                         <div class="form-row mb-3">

                                            <div class="col-md-6 mb-3">
                                                        
                                                <label class="text-muted">Fecha Recepción C&S</label>
                                                                                            
                                                <h5>{{ date('d-m-Y H:i:s', strtotime($factura->created_at)) }}</h5> 

                                            </div>

                                        </div>

                                         <div class="form-row mb-3">

                                            <div class="col-md-6 mb-3">
                                                        
                                                <label class="text-muted">Unidad Solicitante</label>
                                                                                            
                                                <h5>{{ $factura->Dependencia }}</h5> 

                                            </div>

                                        </div>

                                        <div class="form-row mb-3">

                                            <div class="col-md-6 mb-3" style="display: none;">
                                                        
                                                <label class="text-muted">No. Órden de Compra</label>
                                                                                            
                                                <input type="hidden" value="{{ $factura->ordenCompra_id }}" readonly class="h5" style="border:0;" name="ordenCompra_id" form="facturarProductoForm"> 

                                            </div>

                                        </div>

                                        <div class="form-row mb-3">

                                            <div class="col-md-6 mb-3">
                                                                                  
                                                <label class="text-muted">Proveedor</label> <br>

                                                <h5>{{ $factura->RazonSocial }}</h5> 

                                            </div>

                                        </div>

                                        <div class="form-row mb-3">

                                            <div class="col-md-6 mb-3">

                                                <label class="text-muted">Factura Gestionada por</label>
                                                                                            
                                                <h5>{{ $factura->userName }}</h5>

                                            </div>
                                                                                    
                                        </div>

                                    </div>

                                    <div class="col">

                                        @if($factura->Estado == 'Recepcionada')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#enviarVB">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Enviar a Visto Bueno

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Enviar a Visto Bueno

                                                </button>

                                            </a>

                                            

                                        @endif

                                        @if($factura->Estado == 'Enviada VB')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#recepcionarVB">

                                                <button class="btn btn-success btn-block mb-1">

                                                    <i class="fas fa-check-double"></i> 

                                                    Recepcionada con Visto Bueno

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Recepcionada con Visto Bueno

                                                </button>

                                            </a>

                                        @endif

                                        @if($factura->Estado == 'Recepcionada con VB')

                                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#enviarPago">

                                                <button class="btn btn-success btn-block mb-1" >

                                                    <i class="fas fa-check-double"></i> 

                                                    Enviada a Pago

                                                </button>

                                            </a>

                                        @else

                                            <a href="#" class="text-decoration-none">

                                                <button class="btn btn-secondary btn-block mb-1" disabled>

                                                    <i class="fas fa-check-double"></i> 

                                                    Enviada a Pago

                                                </button>

                                            </a>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div>
                            
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
                                            <th>Órden de Compra</th>
                                            <th>Estado O.C.</th>
                                            <th>Recepcionado?</th>
                                            <th>Licitación</th>
                                            <th>Estado Licitación</th>

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



<!-- Modal Estado 3 Órden de Compra -->
<div class="modal fade" id="enviarVB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Factura</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('factura.update', $factura->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="EnviadaVB">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Facrtura Enviada a Visto Bueno</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">ID Factura</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $factura->id }}" readonly style="border:0;" name="factura_id" id="factura_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Enviar Factura a VB

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
<!-- END Modal Estado 3 Órden de Compra -->

<div class="modal fade" id="recepcionarVB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Factura</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('factura.update', $factura->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RecepcionarVB">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Factura Recepcionada con Visto Bueno</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">ID Factura</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $factura->id }}" readonly style="border:0;" name="factura_id" id="factura_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Recepcionar Factura con VB

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

<div class="modal fade" id="enviarPago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered " role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-thumbs-up"></i> Validar Factura</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ route('factura.update', $factura->id) }}" class="was-validated">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="EnviarPago">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="p-3">
                                                                              
                            <label for="id" class="text-center">Enviadar Factura a Pago</label>

                            <div class="form-row">
                                            
                                <label class=" col-sm-6 col-form-label text-muted">ID Factura</label>
                                                                        
                                <label class=" col-sm-6 col-form-label"><input type="text" value="{{ $factura->id }}" readonly style="border:0;" name="factura_id" id="factura_id"></label>     

                            </div>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit">

                            <i class="fas fa-save"></i>

                            Enviar Factura a Pago

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
            var table = $('#detalleFactura').DataTable({
                "paginate"  : true,

                "ordering": false,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Productos en su Solicitud para su validación",
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

            //Comienzo de Excepcion de la Solicitud
            table.on('click', '.excepcion', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#ordenCompra_id_excepcion').val(data[1]);

                $('#excepcionForm').attr('action', '/siscom/ordenCompra/enviarExcepcion/' + data[0]);
                $('#enviarProveedorExcepcion').modal('show');

            });
            //Fin Recepción de la Solicitud
    });


</script>

@endpush