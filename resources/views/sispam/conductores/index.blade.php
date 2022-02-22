<!--
/*
 *  JFuentealba @itux
 *  created at Febrary 07, 2022 - 11:47 am
 *  updated at 
 */
-->
@extends('layouts.app')
@section('content')
<div id="allWindow">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-warning shadow">
                <div class="card-header text-center text-dark bg-warning">
                    @include('sispam.menu')
                </div>
                <div class="card-body">
                    <div class="row mt-5">
                        <div class="col-md-6 text-center">
                            <h3>Listado de Conductores de Vehiculos MUnicipales</h3>
                            <div class="text-secondary">
                                {{ $dateCarbon }}
                            </div>
                        </div>
                        <!-- Button trigger CrearSolicitudModal -->
                        <div class="col-md-6">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createModalConductor">
                                <button class="btn btn-success btn-block boton">
                                    <i class="icofont-plus-square px-1" style=" font-size: 1rem;"></i>
                                    Nuevo Conductor
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
                    @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">
                            <i class="far fa-times-circle"></i>
                            <strong> {{ session('danger') }} </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div>
                        <table class="display" id="conductoresTable" style="font-size: 0.9em;" width="100%">
                            <thead>
                                <tr class="table-active">
                                    <th style="display: none;">ID Conductor</th>
                                    <th>Rut</th>
                                    <th>Nombre Completo</th>
                                    <th>Registrado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($conductores as $conductor)
                                <tr>
                                    <td style="display: none;">{{ $conductor->id }}</td>
                                    <td>{{ $conductor->rut }}</td>
                                    <td>{{ $conductor->nombre }}</td>
                                    <td>{{ date('d-m-Y', strtotime($conductor->created_at)) }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="#" class="btn btn-primary btn-sm edit" data-toggle="tooltip" data-placement="bottom" title="Modificar Datos del Conductor">                        
                                                <i class="icofont-refresh px-1" style=" font-size: 1rem;"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="Eliminar Datos del Conductor"> 
                                            <i class="icofont-ui-delete px-1" style=" font-size: 1rem;"></i>
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


<!-- CREATE Modal Conductor -->
<div class="modal fade" id="createModalConductor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-plus-square px-1"></i>Nuevo Conductor</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ConductoresController@store') }}" class="was-validated" id="conductorForm">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">                                    
                            <label for="rut">Rut</label>
                            <input type="text" class="form-control" name="rut" placeholder="Rut Conductor" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el Rut del Conductor (12345678-9)
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">                                               
                            <label for="nombre">Nombre Completo</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre Conductor" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el Nombre Completo del Conductor
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="conductorForm">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Guardar Conductor
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close-circled px-1" style=" font-size: 1.4rem;"></i>
                            Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END CREATE Modal Conductor-->

<!-- Update Modal Conductor -->
<div class="modal fade" id="updateModalConductor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-refresh px-1"></i>Modificar datos del Conductor</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="updateFormConductor">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="Actualizar">
                <div class="modal-body">
                    <div class="form-row mb-3">
                        <div class="col-md-4 mb-3">                                  
                            <label for="rut">Rut</label>
                            <input type="text" class="form-control" id="rutUpdate" name="rut" placeholder="Rut Conductor" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el Rut del Conductor
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">                                              
                            <label for="nombre">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombreUpdate" name="nombre" placeholder="Nombre Completo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el Nombre del Conductor
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="updateFormConductor">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Guardar Conductor
                        </button>
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close-circled px-1" style=" font-size: 1.4rem;"></i>
                            Cancelar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Update Vehículos -->
@endsection

@push('scripts')

    <script type="text/javascript">
        
        $(document).ready(function () 
        {
            // Start Configuration DataTable
            var table = $('#conductoresTable').DataTable({

                "paginate"  : true,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Conductores Resgistrados en el Sistema, aún...",
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

            //Start Edit Record
            table.on('click', '.edit', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                $('#rutUpdate').val(data[1]);
                $('#nombreUpdate').val(data[2]);

                $('#updateFormConductor').attr('action', '/sispam/conductores/' + data[0]);
                $('#updateModalConductor').modal('show');

            });
            //End Edit Record
         });    
</script>

@endpush