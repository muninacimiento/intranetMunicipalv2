<!--
/*
 *  JFuentealba @itux
 *  created at November 12, 2020 - 3:45 pm
 *  updated at 
 */
-->

@extends('layouts.app')
@section('content')
<div id="allWindow">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card border-primary shadow">
                <div class="card-header text-center text-white bg-primary">
                    @include('siscom.menu')
                </div>
                <div class="card-body">
                    <div class="row py-3">
                        <div class="col text-center">                            
                            <h3>Informe de Solicitudes Recibidas</h3>
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
                    <form class="form-inline" method="GET" action="{{ route('buscar.solicituds') }}">
                        <div class="col"> 
                            <select name="dependencies_id" id="dependencies_id" class="form-control selectpicker" data-live-search="true" title="Seleccione la Dependencia" required>
                                @foreach($dependencies as $dependency)
                                    <option value="{{ $dependency->id }}">{{ $dependency->Dependencias }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col"> 
                            <select name="status_id" id="status_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el Estado" required >
                                @foreach($status as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->Estado }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" id="fechaInicio" name="fechaInicio" class="form-control" placeholder="Fecha de Inicio" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha de Inicio
                            </div>
                        </div>
                        <div class="col">
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
                    <div>
                        <div class="row">                        
                            <div class="col">
                                <table class="table table-striped" id="solicitudsTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Estado</th>
                                            <th>IDDOC</th>
                                            <th>Recepcionada</th>
                                            <th>D&iacute;as Transcurridos</th>
                                            <th>Comprador</th>                                    
                                            <th>Motivo</th>                                    
                                            <th>Tipo</th>
                                            <th>Fecha Actividad</th>                                    
                                            <th>Categoria</th>
                                            <th>Dependencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($solicituds as $solicitud)
                                        <tr>
                                            <td>{{ $solicitud->id }}</td>
                                            <td>{{ $solicitud->Estado }}</td>
                                            <td>{{ $solicitud->iddoc }}</td>
                                            <td>{{ date('d-m-Y H:i:s', strtotime($solicitud->Recepcionada)) }}</td>
                                            <td>{{ Carbon\Carbon::parse($solicitud->Recepcionada)->diffInDays() }}</td>
                                            <td>{{ $solicitud->compradorTitular }}</td>
                                            <td>{{ $solicitud->motivo }}</td>
                                            <td>{{ $solicitud->tipoSolicitud }}</td>
                                            @if($solicitud->fechaActividad === NULL)
                                                <td>No Aplica</td>
                                            @else                                                    
                                                <td>{{ date('d-m-Y', strtotime($solicitud->fechaActividad)) }}</td>
                                            @endif                                                
                                            <td>{{ $solicitud->categoriaSolicitud }}</td>
                                            <td>{{ $solicitud->Dependencia }}</td>
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
            var table = $('#solicitudsTable').DataTable({
                "paginate"  : true,
                "order"     : ([0, 'desc']),
                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Realice una búsqueda de acuerdo a los parámetros, para cargar la tabla...",
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