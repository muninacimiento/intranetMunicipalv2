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
                            <h3>Gestión de Vehiculos</h3>
                            <div class="text-secondary">
                                {{ $dateCarbon }}
                            </div>
                        </div>
                        <!-- Button trigger CrearSolicitudModal -->
                        <div class="col-md-6">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createModalVehiculo">
                                <button class="btn btn-success btn-block boton">
                                    <i class="icofont-plus-square px-1" style=" font-size: 1rem;"></i>
                                    Nuevo Vehículo
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
                        <table class="display" id="vehiculosTable" style="font-size: 0.9em;" width="100%">
                            <thead>
                                <tr class="table-active">
                                    <th style="display: none;">ID Vehículo</th>
                                    <th>Placa Patente</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año</th>
                                    <th style="display: none;">No. Motor</th>
                                    <th style="display: none;">No. Chasis</th>
                                    <th style="display: none;">Rendimiento</th>
                                    <th style="display: none;">Color</th>
                                    <th style="display: none;">Motor</th>
                                    <th>Dado de Alta</th>
                                    <th>Conductor Responsable</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehiculos as $vehiculo)
                                    @if($vehiculo->estado <> 4)
                                    <tr class="table-danger">
                                        <td style="display: none;">{{ $vehiculo->id }}</td>
                                        <td>{{ $vehiculo->patente }}</td>
                                        <td>{{ $vehiculo->marca }}</td>
                                        <td>{{ $vehiculo->modelo }}</td>
                                        <td>{{ $vehiculo->anio }}</td>
                                        <td style="display: none;">{{ $vehiculo->noMotor }}</td>
                                        <td style="display: none;">{{ $vehiculo->noChasis }}</td>
                                        <td style="display: none;">{{ $vehiculo->rendimiento }}</td>
                                        <td style="display: none;">{{ $vehiculo->color }}</td>
                                        <td style="display: none;">{{ $vehiculo->motor }}</td>
                                        <td>{{ date('d-m-Y', strtotime($vehiculo->created_at)) }}</td>
                                        <td>{{ $vehiculo->Conductor }}</td>
                                        @if($vehiculo->estado === 1)
                                            <td>Mantención Requerida "Cambio de Aceite"</td>
                                        @elseif($vehiculo->estado === 2)
                                            <td>Mantención Requerida "Cambio de Correas"</td>
                                        @elseif($vehiculo->estado === 3)
                                            <td>Mantención Requerida "Cambio de Neumáticos"</td>
                                        @endif
                                        <td></td>
                                    </tr>
                                    @else
                                        <tr>
                                            <td style="display: none;">{{ $vehiculo->id }}</td>
                                            <td>{{ $vehiculo->patente }}</td>
                                            <td>{{ $vehiculo->marca }}</td>
                                            <td>{{ $vehiculo->modelo }}</td>
                                            <td>{{ $vehiculo->anio }}</td>
                                            <td style="display: none;">{{ $vehiculo->noMotor }}</td>
                                            <td style="display: none;">{{ $vehiculo->noChasis }}</td>
                                            <td style="display: none;">{{ $vehiculo->rendimiento }}</td>
                                            <td style="display: none;">{{ $vehiculo->color }}</td>
                                            <td style="display: none;">{{ $vehiculo->motor }}</td>
                                            <td>{{ date('d-m-Y', strtotime($vehiculo->created_at)) }}</td>
                                            <td>{{ $vehiculo->Conductor }}</td>
                                            <td>Disponible</td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="#" class="btn btn-primary btn-sm edit" data-toggle="tooltip" data-placement="bottom" title="Modificar Datos del Vehículo">                        
                                                        <i class="icofont-refresh px-1" style=" font-size: 1rem;"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-secondary btn-sm ver" data-toggle="tooltip" data-placement="bottom" title="Ver Datos del Vehículo">                        
                                                        <i class="icofont-eye-alt px-1" style=" font-size: 1rem;"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CREATE Modal Vehículos -->
<div class="modal fade" id="createModalVehiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-plus-square px-1"></i>Nuevo Vehículo</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('VehiculosController@store') }}" class="was-validated" id="vehiculoForm">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-auto mb-3">                                                   
                            <label for="patente">Placa Patente</label>
                            <input type="text" class="form-control" name="placaPatente" placeholder="Placa Patente" required>
                            <div class="invalid-feedback">                                                                           
                                Por favor ingrese la Placa Patente del Vehículo
                            </div>
                        </div>
                        <div class="col-auto mb-3">                                              
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" name="marca" placeholder="Marca" required>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese la Marca del Vehículo
                            </div>
                        </div>
                        <div class="col-auto mb-3">                                              
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" name="modelo" placeholder="Modelo" required>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese el Modelo del Vehiculo
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-auto mb-3">                                                  
                            <label for="anio">Año</label>                   
                            <input type="number" class="form-control" name="anio" placeholder="Año" required>                   
                            <div class="invalid-feedback">                                                                                                                           
                                Por favor ingrese el Año del Vehículo                  
                            </div>                  
                        </div>
                        <div class="col-auto mb-3">                                             
                            <label for="conductor_id">Conductor Responsable</label>
                            <select name="conductor_id" id="conductor_id" class="form-control selectpicker" data-live-search="true" title="Seleccione al Conductor Responsable" required>
                                @foreach($conductores as $conductor)
                                    <option value="{{ $conductor->id }}">{{ $conductor->Conductores }}</option>                  
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-auto mb-3">                                            
                            <label for="no_motor">No. Motor</label>
                            <input type="text" name="no_motor" class="form-control" placeholder="No. Motor" required/>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese el No. Motor del Vehículo
                            </div>
                        </div>
                        <div class="col-auto mb-3">                                                
                            <label for="no_chasis">No. Chasis</label>                   
                            <input type="text" name="no_chasis" class="form-control" placeholder="No. Chasis" required/>                  
                            <div class="invalid-feedback">                                                                                                                         
                                Por favor ingrese el No. del Chasis                 
                            </div>                 
                        </div>              
                        <div class="col-auto mb-3">                                                                                              
                            <label for="rendimiento">Rendimiento</label>              
                            <input type="number" step="0.01" name="rendimiento" class="form-control" placeholder="Rendimiento" required/>              
                            <div class="invalid-feedback">                                                                                                                 
                                Por favor ingrese el Rendimiento del Vehículo             
                            </div>              
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-auto mb-3">
                            <label for="color">Color</label>                                        
                            <input type="text" class="form-control" name="color" placeholder="Color" required>
                            <div class="invalid-feedback">                                                                    
                                Por favor ingrese el Color del Vehículo
                            </div>
                        </div>
                        <div class="col-auto mb-3">
                            <label for="motor">Tipo Combustible</label>                                          
                            <input type="text" class="form-control" name="motor" placeholder="Tipo de Combustible" required>
                            <div class="invalid-feedback">                                                                     
                                Por favor ingrese el Tipo de Combustible
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="vehiculoForm">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Guardar Vehículo
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
<!-- END CREATE Modal Vehículos -->
<!-- UPDATE Modal Vehículos -->
<div class="modal fade" id="updateVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-refresh px-1"></i>Modificar Vehículo</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="updateVehiculoForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="Actualizar">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-auto mb-3">                                  
                            <label for="patente">Placa Patente</label>
                            <input type="text" class="form-control" id="placaPatenteUpdate" name="placaPatente" placeholder="Ingrese la Placa Patente" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la Placa Patente del Vehículo
                            </div>
                        </div>
                        <div class="col-auto mb-3">                                              
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" id="marcaUpdate" name="marca" placeholder="Ingrese la Marca del Vehículo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la Marca del Vehículo
                            </div>
                        </div>
                        <div class="col-auto mb-3">                                            
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" id="modeloUpdate" name="modelo" placeholder="Ingrese el Modelo del Vehículo" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el Modelo del Vehiculo
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-auto mb-3">                                
                            <label for="anio">Año</label> 
                            <input type="number" class="form-control" id="anioUpdate" name="anio" placeholder="Ingrese el Año del Vehículo" required>
                            <div class="invalid-feedback">         
                                Por favor ingrese el Año del Vehículo
                            </div>
                        </div>
                        <div class="col-auto mb-3">                                       
                            <label for="conductor_id">Conductor Responsable</label>
                            <select name="conductor_id" id="conductorUpdate" class="form-control selectpicker" data-live-search="true" title="Seleccione al Conductor Responsable" required>
                                @foreach($conductores as $conductor)
                                    <option value="{{ $conductor->id }}">{{ $conductor->Conductores }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-auto mb-3">                                              
                            <label for="no_motor">No. Motor</label>
                            <input type="text" id="noMotorUpdate" name="no_motor" class="form-control" placeholder="No. Motor" required/>
                            <div class="invalid-feedback">
                                Por favor ingrese el No. Motor del Vehículo
                            </div>
                        </div>
                        <div class="col-auto mb-3">                                            
                            <label for="no_chasis">No. Chasis</label> 
                            <input type="text" id="noChasisUpdate" name="no_chasis" class="form-control" placeholder="Ingrese No. Chasis" required/>
                            <div class="invalid-feedback">
                                Por favor ingrese el No. del Chasis 
                            </div>
                        </div>
                        <div class="col-auto mb-3">
                            <label for="rendimiento">Rendimiento</label>
                            <input type="text" id="rendimientoUpdate" name="rendimiento" class="form-control" placeholder="Ingrese Cilindrada del Vehículo" required/>
                            <div class="invalid-feedback">
                                Por favor ingrese la Cilindrada del Vehículo
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-auto mb-3">
                            <label for="color">Color</label>                         
                            <input type="text" class="form-control" id="colorUpdate" name="color" placeholder="Ingrese el Color del Vehículo" required/>
                            <div class="invalid-feedback">
                                Por favor ingrese el Color del Vehículo
                            </div>
                        </div>
                        <div class="col-auto mb-3">
                            <label for="motor">Tipo Combustible</label>                         
                            <input type="text" class="form-control" id="motorUpdate" name="motor" placeholder="Ingrese el Tipo de Combustible" required/>
                            <div class="invalid-feedback">                                              
                                Por favor ingrese el Tipo de Combustible del Vehículo
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <button class="btn btn-success btn-block boton" type="submit" form="updateVehiculoForm">
                    <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                        Guardar Vehículo
                    </button>
                    <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">
                        <i class="icofont-close-circled px-1" style=" font-size: 1.4rem;"></i>
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Update Vehículos -->
<!-- Show Modal Vehículos -->
<div class="modal fade" id="showVehiculoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-refresh px-1"></i>Ver Detalles del Vehículo</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="showForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="Actualizar">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-auto mb-3">                                  
                            <label for="patente">Placa Patente</label>
                            <input type="text" class="form-control" id="placaPatenteShow" readonly>
                        </div>
                        <div class="col-auto mb-3">                                              
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" id="marcaShow" readonly>
                        </div>
                        <div class="col-auto mb-3">                                            
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" id="modeloShow" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-auto mb-3">                                
                            <label for="anio">Año</label> 
                            <input type="number" class="form-control" id="anioShow" readonly>
                        </div>
                        <div class="col-auto mb-3">                                       
                            <label for="conductor_id">Conductor Responsable</label>
                            <input id="conductorShow" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-auto mb-3">                                              
                            <label for="no_motor">No. Motor</label>
                            <input type="text" id="noMotorShow" readonly>
                        </div>
                        <div class="col-auto mb-3">                                            
                            <label for="no_chasis">No. Chasis</label> 
                            <input type="text" id="noChasisShow" readonly>
                        </div>
                        <div class="col-auto mb-3">
                            <label for="rendimiento">Rendimiento</label>
                            <input type="text" id="rendimientoShow" readonly/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-auto mb-3">
                            <label for="color">Color</label>                         
                            <input type="text" class="form-control" id="colorShow" readonly/>
                        </div>
                        <div class="col-auto mb-3">
                            <label for="motor">Tipo Combustible</label>                         
                            <input type="text" class="form-control" id="motorUpdateShow" readonly />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Show Vehículos -->
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
            //Start Show Record
            table.on('click', '.ver', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                $('#placaPatenteShow').val(data[1]);
                $('#marcaShow').val(data[2]);
                $('#modeloShow').val(data[3]);
                $('#anioShow').val(data[4]);
                $('#noMotorShow').val(data[5]);
                $('#noChasisShow').val(data[6]);
                $('#rendimientoShow').val(data[7]);
                $('#colorShow').val(data[8]);
                $('#motorShow').val(data[9]);
                $('#conductorShow').val(data[11]);

                $('#showVehiculoModal').modal('show');

            });
            //End Show Record
         });    
</script>
@endpush