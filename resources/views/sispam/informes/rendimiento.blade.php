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
            <div class="card border-warning shadow">
                <div class="card-header text-center bg-warning">
                    @include('sispam.menu')
                </div>
                <div class="card-body">
                    <div class="row py-3">
                        <div class="col text-center">                            
                            <h3>Informe de Rendimiento por Vehículo Municipal</h3>
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
                    <form class="form-inline" method="GET" action="{{ route('combustibles.buscarRendimiento') }}">
                        <div class="col"> 
                            <select name="vehiculo_id" id="vehiculo_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el Vehículo" required>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->PlacaPatente }}</option>
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
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">ID</th>
                                            <th>Fecha de Carga</th>
                                            <th>Vehículo</th>
                                            <th>Combustible</th>                                            
                                            <th>Litros</th>
                                            <th>Odómetro</th>
                                            <th>Kilometraje</th>
                                            <th>Rendimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rendimientosVehiculo as $rendimiento)
                                        <tr>
                                            <td style="display:none;">{{ $rendimiento->id }}</td>
                                            <td>{{ date('d-m-Y', strtotime($rendimiento->fechaCarga)) }}</td>
                                            <td>{{ $rendimiento->Vehiculo }}</td>
                                            <td>{{ $rendimiento->Combustible }}</td>
                                            <td>{{ $rendimiento->litros }}</td>
                                            <td>{{ $rendimiento->odometro }}</td>
                                            <td>{{ $rendimiento->kilometraje }}</td>
                                            <td>{{ $rendimiento->Rendimiento }}</td>
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
        });
    </script>
@endpush    