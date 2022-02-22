<!--
/*
 *  JFuentealba @itux
 *  created at Febrary 09, 2022 - 12:12 pm
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
                            <h3>Registros de Carga de Combustible</h3>
                            <div class="text-secondary">
                                {{ $dateCarbon }}
                            </div>
                        </div>
                        <!-- Button trigger IngresarCargaCombustibleModal -->
                        <div class="col-md-6">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createModalCarga">
                                <button class="btn btn-success btn-block boton">
                                    <i class="icofont-plus-square px-1" style=" font-size: 1rem;"></i>
                                    Nueva Carga de Combustible
                                </button>
                            </a>
                        </div>
                    </div>
                    <hr class="my-4">
                    @if (session('info'))
                        <div class="alert alert-success alert-dismissible fade show shadow mb-3" role="alert">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            <strong> {{ session('info') }} </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show shadow mb-3" role="alert">
                            <i class="icofont-exclamation-circle px-1" style=" font-size: 1.4rem;"></i>
                            <strong> {{ session('danger') }} </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div>
                        <table class="display" id="cargaCombustibleTable" style="font-size: 0.9em;" width="100%">
                            <thead>
                                <tr class="table-active">
                                    <th style="display: none;">ID Carga</th>
                                    <th style="display: none;">Año</th>
                                    <th>Placa Patente</th>
                                    <th>Tipo Combustible</th>
                                    <th>Odómetro</th>
                                    <th>Litros Cargados</th>
                                    <th>No. Guía</th>
                                    <th>Total Carga ($)</th>
                                    <th>Obervaciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($combustibles as $combustible)
                                <tr>
                                    <td style="display: none;">{{ $combustible->id }}</td>
                                    <td style="display: none;">{{ $combustible->anio }}</td>
                                    <td>{{ $combustible->Patente }}</td>
                                    <td>{{ $combustible->tipoCombustible }}</td>
                                    <td>{{ $combustible->odometro }}</td>
                                    <td>{{ $combustible->litros }}</td>
                                    <td>{{ $combustible->noGuia }}</td>
                                    <td>{{ $combustible->total }}</td>
                                    <td>{{ $combustible->observaciones }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="#" class="btn btn-primary btn-sm edit" data-toggle="tooltip" data-placement="bottom" title="Modificar Datos de la Carga de Combustible">                        
                                                <i class="icofont-refresh px-1" style=" font-size: 1rem;"></i>
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

<!-- CREATE Modal Vehículos -->
<div class="modal fade" id="createModalCarga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-plus-square px-1"></i>Ingresar Carga de Combustible</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('CombustibleController@store') }}" class="was-validated" id="cargaCombustibleForm">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="patente_id">Patente Vehículo</label>
                            <select name="patente_id" id="patente_id" class="form-control selectpicker" data-live-search="true" title="Seleccione..." required>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->PlacaPatente }}</option>
                                @endforeach
                            </select>                                  
                        </div>
                        <div class="col mb-3">                                            
                            <label for="odometro">Odómetro</label>
                            <input type="number" class="form-control" placeholder="1234567" name="odometro" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el Odómetro
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">                                            
                            <label for="litros">Cantidad de Litros</label>
                            <input type="number" step="0.01" class="form-control" placeholder="40.25" name="litros" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la Cantidad de Litros de la Carga, solo con 2 decimales
                            </div>
                        </div>
                        <div class="col mb-3">                                                      
                            <label for="noGuia">No. Guia</label>
                            <input type="number" class="form-control" placeholder="987654321" name="noGuia" required>
                            <div class="invalid-feedback">                                               
                                Por favor ingrese el Número de la Guia
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">                                    
                            <label for="total">Valor Total de la Guia</label>
                            <input type="number" name="total" placeholder="$ 123456789" class="form-control" required/>
                            <div class="invalid-feedback">                                              
                                Por favor ingrese el Valor Total de la Carga
                            </div>
                        </div>            
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">                                              
                            <label for="observaciones">Observaciones</label> 
                            <textarea type="text" name="observaciones" class="form-control" placeholder="Ingrese una Observación si lo requiere" row="5"></textarea>
                            <div class="invalid-feedback">                                    
                                Por favor ingrese alguna Observación si se requiere
                            </div>
                        </div>      
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="cargaCombustibleForm">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Ingresar Carga de Combustible
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

<!-- Update Modal Vehículos -->
<div class="modal fade" id="cargaCombustibleUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-refresh px-1"></i>Modificar Vehículo</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="cargaCombustibleUpdateForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="Actualizar">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="patente_id">Patente Vehículo</label>
                            <select name="patente_id" id="patente_idUpdate" class="form-control selectpicker" data-live-search="true" title="Seleccione..." required>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->PlacaPatente }}</option>
                                @endforeach
                            </select>                                  
                        </div>
                        <div class="col mb-3">                                            
                            <label for="odometro">Odómetro</label>
                            <input type="number" class="form-control" placeholder="1234567" id="odometroUpdate" name="odometro" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el Odómetro
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">                                            
                            <label for="litros">Cantidad de Litros</label>
                            <input type="number" step="0.01" class="form-control" placeholder="40.25" id="litrosUpdate" name="litros" required>
                            <div class="invalid-feedback">
                                Por favor ingrese la Cantidad de Litros de la Carga, solo con 2 decimales
                            </div>
                        </div>
                        <div class="col mb-3">                                                      
                            <label for="noGuia">No. Guia</label>
                            <input type="number" class="form-control" placeholder="987654321" id="noGuiaUpdate" name="noGuia" required>
                            <div class="invalid-feedback">                                               
                                Por favor ingrese el Número de la Guia
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">                                    
                            <label for="total">Valor Total de la Guia</label>
                            <input type="number" name="total" placeholder="$ 123456789" class="form-control" id="totalUpdate" required/>
                            <div class="invalid-feedback">                                              
                                Por favor ingrese el Valor Total de la Carga
                            </div>
                        </div>            
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">                                              
                            <label for="observaciones">Observaciones</label> 
                            <textarea type="text" name="observaciones" class="form-control" placeholder="Ingrese una Observación si lo requiere" id="observacionesUpdate"></textarea>
                            <div class="invalid-feedback">                                    
                                Por favor ingrese alguna Observación si se requiere
                            </div>
                        </div>      
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="cargaCombustibleUpdateForm">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Actualizar Carga de Combustible
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
            var table = $('#cargaCombustibleTable').DataTable({
                "paginate"  : true,
                "order"     : ([0, 'desc']),
                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Registros de Cargas de Combustible, aún...",
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
                $('#patente_idUpdate').val(data[3]);
                $('#odometroUpdate').val(data[4]);
                $('#litrosUpdate').val(data[5]);
                $('#noGuiaUpdate').val(data[6]);
                $('#totalUpdate').val(data[7]);
                $('#observacionesUpdate').val(data[8]);

                $('#cargaCombustibleUpdateForm').attr('action', '/sispam/cargaCombustibles/' + data[0]);
                $('#cargaCombustibleUpdateModal').modal('show');

            });
            //End Edit Record
         });    
</script>

@endpush