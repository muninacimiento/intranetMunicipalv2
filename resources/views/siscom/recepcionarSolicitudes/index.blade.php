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
                            <h3>Recepcionar las Solicitudes Realizadas</h3>
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
                                            <a href="{{ route('admin.showRecepcionar', $solicitud->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Solicitud">
                                                <i class="icofont-eye-alt h5"></i>
                                            </a>
                                            {{--Habilitar Recepcion--}}
                                            @can('admin.recepcionarSolicitud')
                                                @if($solicitud->estado === 'Pendiente')
                                                    <a href="#" class="btn btn-success btn-sm recepcionar" data-toggle="tooltip" data-placement="bottom" title="Recepcionar Solicitud">                                                                
                                                        <i class="icofont-checked h5"></i>
                                                    </a>                                                    
                                                @else
                                                @endif
                                            @endcan
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

<!-- Recepcionar Solicitud MODAL -->
<div class="modal fade" id="recepcionarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-checked h5"></i> Recepcionar Solicitud</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/siscom/admin') }}" class="was-validated" id="recepcionarForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="Recepcionar">
                <div class="modal-body">
                    <div class="form-row">                        
                        <label for="fechaRecepcion" class="col-sm-4 col-form-label text-muted">Fecha Recepción</label>
                        <label for="fechaRecepcion" class="col-sm-8 col-form-label">{{ $dateCarbon }}</label>
                    </div>
                    <div class="form-row">
                        <label for="ID" class="col-sm-4 col-form-label text-muted">No. Solicitud</label>
                         <div class="col-sm-8">                             
                            <input type="" name="solicitudID" id="solicitudID" readonly class="form-control-plaintext">                                 
                         </div>
                    </div>
                    <div class="form-row mb-5">                
                        <label for="iddoc" class="col-sm-4 col-form-label text-muted">IDDOC</label>
                         <div class="col-sm-8">
                            <input type="number" name="iddoc" required class="form-control">
                            <div class="invalid-feedback">
                                Por favor Ingrese el IDDOC del Sistema de Gestión Documental
                            </div>
                        </div>                        
                    </div>
                    <div class="mb-3 form-row">
                        <button class="btn btn-success btn-block" type="submit">
                            <i class="icofont-checked"></i> Recepcionar Solicitud
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-arrow-left"></i> Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Recepcinoar Solicitud Modal -->

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

            //Comienzo de Recepción de la Solicitud
            table.on('click', '.recepcionar', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);

                $('#solicitudID').val(data[0]);

                $('#recepcionarForm').attr('action', '/siscom/admin/' + data[0]);
                $('#recepcionarModal').modal('show');

            });
            //Fin Recepción de la Solicitud
    });    

</script>

@endpush


