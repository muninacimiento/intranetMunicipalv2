<!--
/*
 *  JFuentealba @itux
 *  created at December 23, 2019 - 3:45 pm
 *  updated at December 23, 2019 - 3:47 pm
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
                    <div class="row">
                        <div class="col-md-12 text-center">                            
                            <h3>Consulta de las Solicitudes Realizadas</h3>
                            <div class="text-secondary">
                                {{ $dateCarbon }}
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    @if (session('info'))
                        <div class="alert alert-success alert-dismissible fade show shadow mb-3" role="alert">                              
                            <i class="icofont-check-circled h5"></i><strong> {{ session('info') }} </strong>                            
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">                            
                                <span aria-hidden="true">&times;</span>                              
                            </button>
                        </div>                   
                    @endif                    
                    <div class="form-row mb-5 col-md-12">
                        <table class="display" id="solicitudsTable" style="font-size: 0.9em;" width="100%">
                            <thead>
                                <tr class="table-active">
                                    <th>ID</th>
                                    <th>Estado</th>
                                    <th>IDDOC</th>
                                    <th>Creada</th>
                                    <th>Comprador</th>                                    
                                    <th>Motivo</th>                                    
                                    <th>Tipo</th>                                    
                                    <th>Categoria</th>
                                    <th>Dependencia</th>
                                    <th style="display: none">Decreto Programa</th>
                                    <th style="display: none">Nombre Programa</th>
                                    <th >Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($solicituds as $solicitud)
                                <tr>
                                    <td>{{ $solicitud->id }}</td>
                                    <td>{{ $solicitud->estado }}</td>
                                    <td>{{ $solicitud->iddoc }}</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($solicitud->created_at)) }}</td>
                                    <td>{{ $solicitud->compradorTitular }}</td>
                                    <td>{{ $solicitud->motivo }}</td>
                                    <td>{{ $solicitud->tipoSolicitud }}</td>                                    
                                    <td>{{ $solicitud->categoriaSolicitud }}</td>
                                    <td>{{ $solicitud->name }}</td>
                                    <td style="display: none">{{ $solicitud->decretoPrograma }}</td>
                                    <td style="display: none">{{ $solicitud->nombrePrograma }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            {{-- Visualizar Solicitud--}}
                                            @can('admin.show')
                                                @if($solicitud->categoriaSolicitud === 'Stock de Oficina' || $solicitud->categoriaSolicitud === 'Stock de Aseo' || $solicitud->categoriaSolicitud === 'Stock de Gas')
                                                    <a href="{{ route('admin.showStock', $solicitud->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Solicitud">
                                                        <i class="icofont-eye-alt h5"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.showConsulta', $solicitud->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Solicitud">
                                                        <i class="icofont-eye-alt h5"></i>
                                                    </a>
                                                @endif
                                            @endcan
                                            @if($solicitud->estado_id === 11 && $solicitud->categoriaSolicitud === 'Stock de Oficina')
                                                <a href="{{ route('reporteEntregaStock.pdf', $solicitud->id) }}" class="btn btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="Imprimir Reporte Entrega Stock">
                                                    <i class="icofont-printer h5"></i>    
                                                </a>
                                            @else
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-active">
                                    <th>ID</th>
                                    <th>Estado</th>
                                    <th>IDDOC</th>
                                    <th>Creada</th>
                                    <th>Comprador</th>                                    
                                    <th>Motivo</th>                                    
                                    <th>Tipo</th>                                    
                                    <th>Categoria</th>
                                    <th>Dependencia</th>
                                    <th style="display: none">Decreto Programa</th>
                                    <th style="display: none">Nombre Programa</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
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

            var height = $(window).height();
            $('#allWindow').height(height);

            // Setup - add a text input to each footer cell
            $('#solicitudsTable tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Buscar">' );
            } );


            // Start Configuration DataTable
            var table = $('#solicitudsTable').DataTable({
                "paginate"  : true,
                "order"     : ([0, 'desc']),
                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen solicitudes generadas por su unidad, aún...",
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

             // Apply the search
            table.columns().every( function () {
                var that = this;         
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

           
    });    

</script>

@endpush


