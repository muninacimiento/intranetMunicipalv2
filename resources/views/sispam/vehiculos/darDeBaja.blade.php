<!--
/*
 *  JFuentealba @itux
 *  created at Febrary 08, 2022 - 10:15 pm
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
                    <div class="row mt-2">
                        <div class="col-md-12 text-center mb-3">
                            <h3>Gestión de Baja de los Vehiculos Municipales</h3>
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
                    <div>
                        <table class="display" id="vehiculosTable" style="font-size: 0.9em;" width="100%">
                            <thead>
                                <tr class="table-active">
                                    <th style="display: none;">ID Vehículo</th>
                                    <th>Placa Patente</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año</th>
                                    <th>No. Motor</th>
                                    <th>No. Chasis</th>
                                    <th>Rendimiento</th>
                                    <th>Color</th>
                                    <th>Motor</th>
                                    <th>Dado de Alta</th>
                                    <th>Conductor Responsable</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehiculos as $vehiculo)
                                <tr>
                                    <td style="display: none;">{{ $vehiculo->id }}</td>
                                    <td>{{ $vehiculo->patente }}</td>
                                    <td>{{ $vehiculo->marca }}</td>
                                    <td>{{ $vehiculo->modelo }}</td>
                                    <td>{{ $vehiculo->anio }}</td>
                                    <td>{{ $vehiculo->noMotor }}</td>
                                    <td>{{ $vehiculo->noChasis }}</td>
                                    <td>{{ $vehiculo->rendimiento }}</td>
                                    <td>{{ $vehiculo->color }}</td>
                                    <td>{{ $vehiculo->motor }}</td>
                                    <td>{{ date('d-m-Y', strtotime($vehiculo->created_at)) }}</td>
                                    <td>{{ $vehiculo->Conductor }}</td>
                                    <td>
                                        @if($vehiculo->estado == 1)
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="#" class="btn btn-danger btn-sm edit" data-toggle="tooltip" data-placement="bottom" title="Modificar Datos del Vehículo">                        
                                                    <i class="icofont-refresh px-1" style=" font-size: 1rem;"></i>
                                                </a>
                                            </div>
                                        @else
                                            <div>Vehículo dado de Baja</div>
                                        @endif
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

<!-- Update Modal Vehículos -->
<div class="modal fade" id="updateVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-refresh px-1"></i>Formulario de Baja Vehículo Municipal</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="updateVehiculoForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="DarDeBaja">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">                                  
                            <label for="patente">Placa Patente</label>
                            <input readonly type="text" class="form-control" id="placaPatenteUpdate" name="placaPatente" placeholder="Ingrese la Placa Patente" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la Placa Patente del Vehículo
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">                                              
                            <label for="marca">Marca</label>
                            <input readonly type="text" class="form-control" id="marcaUpdate" name="marca" placeholder="Ingrese la Marca del Vehículo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la Marca del Vehículo
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">                                            
                            <label for="modelo">Modelo</label>
                            <input readonly type="text" class="form-control" id="modeloUpdate" name="modelo" placeholder="Ingrese el Modelo del Vehículo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el Modelo del Vehiculo
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">                                
                            <label for="anio">Año</label> 
                            <input readonly type="number" class="form-control" id="anioUpdate" name="anio" placeholder="Ingrese el Año del Vehículo" required>
                            <div class="invalid-feedback">         
                                Por favor ingrese el Año del Vehículo
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">                                              
                            <label for="no_motor">No. Motor</label>
                            <input readonly type="text" id="noMotorUpdate" name="no_motor" class="form-control" placeholder="No. Motor" required/>
                            <div class="invalid-feedback">
                                Por favor ingrese el No. Motor del Vehículo
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">                                            
                            <label for="no_chasis">No. Chasis</label> 
                            <input readonly type="text" id="noChasisUpdate" name="no_chasis" class="form-control" placeholder="Ingrese No. Chasis" required/>
                            <div class="invalid-feedback">
                                Por favor ingrese el No. del Chasis 
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="rendimiento">Rendimiento</label>
                            <input readonly type="text" id="rendimientoUpdate" name="rendimiento" class="form-control" placeholder="Ingrese Cilindrada del Vehículo" required/>
                            <div class="invalid-feedback">
                                Por favor ingrese la Cilindrada del Vehículo
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="color">Color</label>                         
                            <input readonly type="text" class="form-control" id="colorUpdate" name="color" placeholder="Ingrese el Color del Vehículo" required/>
                            <div class="invalid-feedback">
                                Por favor ingrese el Color del Vehículo
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="motor">Tipo Combustible</label>                         
                            <input readonly type="text" class="form-control" id="motorUpdate" name="motor" placeholder="Ingrese el Tipo de Combustible" required/>
                            <div class="invalid-feedback">                                              
                                Por favor ingrese el Tipo de Combustible del Vehículo
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="motivoBaja">Motivo de la Baja del Vehículo</label>
                            <input type="textarea" id="motivoBajaUpdate" name="motivoBaja" class="form-control" placeholder="Motivo" required/>
                            <div class="invalid-feedback">
                                Por favor ingrese el Motivo de la Baja del Vehículo
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                    <button class="btn btn-danger btn-block boton" type="submit" form="updateVehiculoForm">
                    <i class="icofont-swoosh-down px-1" style=" font-size: 1.4rem;"></i>
                        Dar de Baja el Vehículo
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
            var table = $('#vehiculosTable').DataTable({
                "paginate"  : true,
                "order"     : ([0, 'desc']),
                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Vehículos en el Parque Automotriz, aún...",
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
                $('#placaPatenteUpdate').val(data[1]);
                $('#marcaUpdate').val(data[2]);
                $('#modeloUpdate').val(data[3]);
                $('#anioUpdate').val(data[4]);
                $('#noMotorUpdate').val(data[5]);
                $('#noChasisUpdate').val(data[6]);
                $('#rendimientoUpdate').val(data[7]);
                $('#colorUpdate').val(data[8]);
                $('#motorUpdate').val(data[9]);
                $('#conductorUpdate').val(data[11]);

                $('#updateVehiculoForm').attr('action', '/sispam/vehiculos/' + data[0]);
                $('#updateVehiculoModal').modal('show');

            });
            //End Edit Record
         });    
</script>

@endpush