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
                        <a href="{{ route('admin.consulta') }}" class="btn btn-link text-decoration-none float-right"><i class="icofont-arrow-left h5"></i> Volver</a>
                         <h4> Solicitud No.  <input type="text" value="{{ $solicitud->id }}" readonly class="h4" style="border:0;" name="solicitudID" form="detalleSolicitudForm"> </h4>
                         <hr style="background-color: #d7d7d7">
                        <div class="py-3">
                            <div class="form-row mb-3">
                                <div class="col-md-12 mb-3">
                                    <label class="text-muted">Motivo/Destino</label>                                                                
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
                            <div style="font-size: 0.8em;" class="bg-warning rounded-top rounded-bottom shadow p-3 mb-5">
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
                                        <tr>                                            
                                            <td><strong>Observación Anulación</strong></td>
                                            <td colspan="4"><em>{{ $solicitud->motivoAnulacion }}</em></td>
                                        </tr>
                                        <tr>                                            
                                            <td><strong>Observación Rechazo</strong></td>
                                            <td colspan="4"><em>{{ $solicitud->obsRechazo }}</em></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="py-3">
                                <div>
                                    <table class="display" id="detalleSolicitud" width="100%" style="font-size: 0.9em">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">ID</th>
                                                <th>Producto</th>
                                                <th>Especificación</th>
                                                <th>Cantidad</th>
                                                <th>Valor</th>                                                        
                                                <th>SubTotal</th>
                                                <th>Órden de Compra</th>
                                                <th>Estado O.C.</th>
                                                <th>Licitación</th>
                                                <th>Estado Licitación</th>
                                                <th>Recep.?</th>
                                                <th>Fact.?</th>
                                                <th>No. Factura</th>
                                                <th style="display: none;">Observacion Actualizacion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($detalleSolicitud as $detalle)
                                            @if($detalle->obsActualizacion === NULL)
                                                <tr>
                                                    <td style="display: none;">{{ $detalle->id }}</td>
                                                    <td>{{ $detalle->Producto }}</td>
                                                    <td>{{ $detalle->especificacion }}</td>
                                                    <td>{{ $detalle->cantidad }}</td>
                                                    <td>{{ $detalle->valorUnitario }}</td>
                                                    <td class="subtotal">{{ $detalle->SubTotal }}</td>  
                                                    <td>{{ $detalle->NoOC }}</td>
                                                    <td>{{ $detalle->EstadoOC }}</td>
                                                    @if($detalle->NoLicitacion == NULL)
                                                        <td>Sin Licitación</td>
                                                    @else
                                                        <td>{{ $detalle->NoLicitacion}}</td>
                                                    @endif
                                                    @if($detalle->EstadoLicitacion == NULL)
                                                        <td>No Aplica</td>
                                                    @else
                                                        <td>{{ $detalle->EstadoLicitacion }}</td>
                                                    @endif
                                                    @if($detalle->fechaRecepcion == NULL)
                                                        <td>No</td>
                                                    @else
                                                        <td>Si</td>
                                                    @endif
                                                    @if($detalle->factura_id == NULL)
                                                        <td>No</td>
                                                    @else
                                                        <td>Si</td>
                                                    @endif
                                                    <td>{{ $detalle->NoFactura }}</td>   
                                                    <td style="display: none;">{{ $detalle->obsActualizacion }}</td>
                                                </tr>
                                            @else
                                                <tr style="background-color:  #ef8207  ;color: white;">
                                                    <td style="display: none;">{{ $detalle->id }}</td>
                                                    <td>{{ $detalle->Producto }}</td>
                                                    <td>{{ $detalle->especificacion }}</td>
                                                    <td>{{ $detalle->cantidad }}</td>
                                                    <td>{{ $detalle->valorUnitario }}</td>
                                                    <td class="subtotal">{{ $detalle->SubTotal }}</td>  
                                                    <td>{{ $detalle->NoOC }}</td>
                                                    <td>{{ $detalle->EstadoOC }}</td>
                                                    <td>{{ $detalle->NoLicitacion}}</td>
                                                    <td>{{ $detalle->EstadoLicitacion }}</td>
                                                    @if($detalle->fechaRecepcion == NULL)
                                                        <td>No</td>
                                                    @else
                                                        <td>Si</td>
                                                    @endif
                                                    @if($detalle->factura_id == NULL)
                                                        <td>No</td>
                                                    @else
                                                        <td>Si</td>
                                                    @endif
                                                    <td>{{ $detalle->NoFactura }}</td>   
                                                    <td style="display: none;">{{ $detalle->obsActualizacion }}</td>
                                                </tr>
                                            @endif                                            
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">                                    
                                    <a href="{{ route('admin.consulta') }}" class="text-decoration-none">
                                        <button type="submit" class="btn btn-secondary btn-block"> 
                                            <i class="icofont-arrow-left"></i> Atrás
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

@endsection

@push('scripts')

<script>
    
    $(document).ready(function () {

        var height = $(window).height();
            $('#allWindow').height(height);

          // Start Configuration DataTable Actividad
            var table = $('#actividad').DataTable({
                "paging":   false,
                "ordering": false,
                "info":     false,
                "searching" : false,
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
            }):

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