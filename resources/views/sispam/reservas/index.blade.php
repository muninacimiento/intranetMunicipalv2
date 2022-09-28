<!--
/*
 *  JFuentealba @itux
 *  created at March 10, 2022 - 21:43 am
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
                            <h3>Reserva de Vehiculos</h3>
                            <div class="text-secondary">
                                {{ $dateCarbon }}
                            </div>
                        </div>
                        <!-- Button trigger CrearSolicitudModal -->
                        <div class="col-md-6">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createModalReserva">
                                <button class="btn btn-success btn-block boton">
                                    <i class="icofont-plus-square px-1" style=" font-size: 1rem;"></i>
                                    Generar Reserva
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
                        <table class="table table-striped" id="reservasTable" style="font-size: 0.8em;" width="100%">
                            <thead>
                                <tr class="table-active">
                                    <th style="display: none;">ID Reserva</th>
                                    <th>Fecha Reserva</th>
                                    <th>Fecha Termino</th>
                                    <th>Hora Inicio Cometido</th>
                                    <th>Hora Térmimo Cometido</th>
                                    <th style="display: none;">No.Solicitud</th>
                                    <th>Dep. Solicitante</th>
                                    <th>Vehículo Reservado</th>
                                    <th>Conductor</th>
                                    <th>Destino</th>
                                    <th style="display: none;">Materia</th>
                                    <th style="display: none;">MotivoAnulacion</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservas as $reserva)
                                    @if($reserva->estado === 1)
                                        <tr>
                                            <td style="display: none;">{{ $reserva->id }}</td>
                                            <td>{{ date('d-m-Y', strtotime($reserva->fechaReserva)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($reserva->fecha_termino)) }}</td>
                                            <td>{{ $reserva->horaInicio }}</td>
                                            <td>{{ $reserva->horaTermino }}</td>
                                            <td style="display: none;">{{ $reserva->iddocSolicitud }}</td>
                                            <td>{{ $reserva->dependencia }}</td>
                                            <td>{{ $reserva->Vehiculo }}</td>
                                            <td>{{ $reserva->Conductor }}</td>
                                            <td>{{ $reserva->destino }}</td>
                                            <td style="display: none;">{{ $reserva->materia }}</td>
                                            <td style="display: none;">{{ $reserva->motivoAnulacion }}</td>
                                            <td>
                                                
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="{{ route('reservadoc.pdf', $reserva->id) }}" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Imprimir Solicitud">
                                                        <i class="icofont-printer h5"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-primary btn-sm edit" data-toggle="tooltip" data-placement="bottom" title="Modificar Reserva del Vehículo">                        
                                                        <i class="icofont-refresh px-1" style=" font-size: 1rem;"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm anular" data-toggle="tooltip" data-placement="bottom" title="Anular Reserva del Vehículo">                        
                                                        <i class="icofont-ui-delete px-1" style=" font-size: 1rem;"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @elseif($reserva->estado === 0)
                                        <tr class="table-danger">
                                            <td style="display: none;">{{ $reserva->id }}</td>
                                            <td>{{ date('d-m-Y', strtotime($reserva->fechaReserva)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($reserva->fecha_termino)) }}</td>
                                            <td>{{ $reserva->horaInicio }}</td>
                                            <td>{{ $reserva->horaTermino }}</td>
                                            <td style="display: none;">{{ $reserva->iddocSolicitud }}</td>
                                            <td>{{ $reserva->dependencia }}</td>
                                            <td>{{ $reserva->Vehiculo }}</td>
                                            <td>{{ $reserva->Conductor }}</td>
                                            <td>{{ $reserva->destino }}</td>
                                            <td style="display: none;">{{ $reserva->materia }}</td>
                                            <td style="display: none;">{{ $reserva->motivoAnulacion }}</td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm ver" data-toggle="tooltip" data-placement="bottom" title="Ver Motivo Anulación">                        
                                                    Reserva Anulada
                                                </a>
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
<div class="modal fade" id="createModalReserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-plus-square px-1"></i>Nueva Reserva de Vehículo</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('ReservasVehiculosController@store') }}" class="was-validated" id="reservaForm">
                @csrf
                <div class="modal-body">
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="fechaCometido">Fecha del Cometido</label>
                            <input type="text" id="fechaCometido" name="fechaCometido" class="form-control" placeholder="Cuándo es el Comentido?" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha del Cometido
                            </div>
                        </div>
                        <div class="col">                                              
                            <label for="fechaTermino">Fecha Termino del Cometido</label>
                            <input type="text" id="fechaTermino" name="fechaTermino" class="form-control" placeholder="Termino del Comentido?" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha Termino del Cometido
                            </div>
                        </div>
                        <div class="col">                                               
                            <label for="horaInicio">Hora Inicio del Cometido</label>
                            <input type="time" id="horaInicio" name="horaInicio" class="form-control" placeholder="A qué Hora se desarrollará el Cometido?" required/>
                                <div class="invalid-feedback">                                                                                                        
                                    Por favor ingrese la Hora en que se llevará a cabo el Cometido
                                </div>
                        </div>
                        <div class="col">                                              
                            <label for="horaTermino">Hora Término del Cometido</label>
                            <input type="time" id="horaTermino" name="horaTermino" class="form-control" placeholder="A qué Hora termina el Cometido?" required/>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese la Hora de Término del Cometido
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                         
                            <label for="iddoc">No. Solicitud de Cometido</label>              
                            <input type="number" class="form-control" name="iddoc" placeholder="123456" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el No. Solicitud del Cometido                
                            </div>                 
                        </div>
                        <div class="col">                                           
                            <label for="dependencia">Depedencia</label>
                            <select name="dependencia" id="dependencia" class="form-control selectpicker" data-live-search="true" title="Seleccione dependencia" required>
                                @foreach($dependencias as $dependencia)
                                    <option value="{{ $dependencia->name }}">{{ $dependencia->name }}</option>                        
                                @endforeach
                            </select>
                        </div>
                        <div class="col">                                           
                            <label for="vehiculo_id">Vehiculo a Reservar</label>
                            <select name="vehiculo_id" id="vehiculo_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el Vehículo a Reservar" required>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->Vehiculo }}</option>                        
                                @endforeach
                            </select>
                        </div>
                        <div class="col">                                           
                            <label for="conductor_id">Conductor del Cometido</label>
                            <select name="conductor_id" id="conductor_id" class="form-control selectpicker" data-live-search="true" title="Seleccione al Conductor" required>
                                @foreach($conductores as $conductor)
                                    <option value="{{ $conductor->id }}">{{ $conductor->Conductores }}</option>                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                           
                            <label for="destino">Destino del Cometido</label>
                            <textarea class="form-control" id="destino" name="destino" rows="3" placeholder="Concepción" required/></textarea>
                            <div class="invalid-feedback">                                                                      
                                Por favor ingrese el Destino del Cometido
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="materia">Propósito del Cometido</label>
                            <textarea class="form-control" id="materia" name="materia" rows="3" placeholder="Reunión de Gestión en la Gobernación..." required/></textarea>
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese Propósito del Cometido
                            </div>                
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="reservaForm">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Registrar Reserva
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
<div class="modal fade" id="updateModalReserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-refresh px-1"></i>Modificar Reserva de Vehículo</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="updateReservaForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="Actualizar">
                <div class="modal-body">
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="fechaCometido">Fecha del Cometido</label>
                            <input type="text" id="fechaCometidoUpdate" name="fechaCometido" class="form-control" placeholder="Cuándo es el Comentido?" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha del Cometido
                            </div>
                        </div>
                        <div class="col">                                              
                            <label for="fechaTermino">Fecha Termino del Cometido</label>
                            <input type="text" id="fechaTerminoUpdate" name="fechaTermino" class="form-control" placeholder="Termino del Comentido?" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha Termino del Cometido
                            </div>
                        </div>
                        <div class="col">                                               
                            <label for="horaInicio">Hora Inicio del Cometido</label>
                            <input type="time" id="horaInicioUpdate" name="horaInicio" class="form-control" placeholder="A qué Hora se desarrollará el Cometido?" required/>
                                <div class="invalid-feedback">                                                                                                        
                                    Por favor ingrese la Hora en que se llevará a cabo el Cometido
                                </div>
                        </div>
                        <div class="col">                                              
                            <label for="horaTermino">Hora Término del Cometido</label>
                            <input type="time" id="horaTerminoUpdate" name="horaTermino" class="form-control" placeholder="A qué Hora termina el Cometido?" required/>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese la Hora de Término del Cometido
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                         
                            <label for="iddoc">No. Solicitud de Cometido</label>              
                            <input type="number" class="form-control" id="iddocUpdate" name="iddoc" placeholder="123456" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el No. Solicitud del Cometido                
                            </div>                 
                        </div>
                        <div class="col">                                           
                            <label for="dependencia">Depedencia</label>
                            <select name="dependencia" id="dependenciaUpdate" class="form-control selectpicker" data-live-search="true" title="Seleccione dependencia" required>
                                @foreach($dependencias as $dependencia)
                                    <option value="{{ $dependencia->name }}">{{ $dependencia->name }}</option>                        
                                @endforeach
                            </select>
                        </div>
                        <div class="col">                                           
                            <label for="vehiculo_id">Vehiculo a Reservar</label>
                            <select name="vehiculo_id" id="vehiculo_idUpdate" class="form-control selectpicker" data-live-search="true" title="Seleccione el Vehículo a Reservar" required>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->Vehiculo }}</option>                        
                                @endforeach
                            </select>
                        </div>
                        <div class="col">                                           
                            <label for="conductor_id">Conductor del Cometido</label>
                            <select name="conductor_id" id="conductor_idUpdate" class="form-control selectpicker" data-live-search="true" title="Seleccione al Conductor" required>
                                @foreach($conductores as $conductor)
                                    <option value="{{ $conductor->id }}">{{ $conductor->Conductores }}</option>                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                           
                            <label for="destino">Destino del Cometido</label>
                            <textarea class="form-control" id="destinoUpdate" name="destino" rows="3" placeholder="Concepción" required/></textarea>
                            <div class="invalid-feedback">                                                                      
                                Por favor ingrese el Destino del Cometido
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="materia">Propósito del Cometido</label>
                            <textarea class="form-control" id="materiaUpdate" name="materia" rows="3" placeholder="Reunión de Gestión en la Gobernación..." required/></textarea>
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese Propósito del Cometido
                            </div>                
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="updateReservaForm">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Actualizar Reserva
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

<!-- Delete Modal Reserva -->
<div class="modal fade" id="deleteModalReserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-ui-delete px-1"></i>Anular Reserva de Vehículo</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="deleteReservaForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="Anular">
                <div class="modal-body">
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="fechaCometido">Fecha del Cometido</label>
                            <input readonly type="text" id="fechaCometidoDelete" name="fechaCometido" class="form-control" placeholder="Cuándo es el Comentido?" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha del Cometido
                            </div>
                        </div>
                        <div class="col">                                               
                            <label for="horaInicio">Hora Inicio del Cometido</label>
                            <input readonly type="text" class="form-control" id="horaInicioDelete" name="horaInicio" placeholder="08:15 hrs" required>
                            <div class="invalid-feedback">                                                                        
                                Por favor ingrese la Hora de Inicio del Cometido
                            </div>
                        </div>
                        <div class="col">                                              
                            <label for="horaTermino">Hora Término del Cometido</label>
                            <input readonly type="text" class="form-control" id="horaTerminoDelete" name="horaTermino" placeholder="17:00 hrs" required>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese la Hora de Término del Cometido
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                         
                            <label for="iddoc">No. Solicitud de Cometido</label>              
                            <input readonly type="number" class="form-control" id="iddocDelete" name="iddoc" placeholder="123456" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el No. Solicitud del Cometido                
                            </div>                 
                        </div>
                        <div class="col">                                           
                            <label for="vehiculo_id">Vehiculo a Reservar</label>
                            <input readonly name="vehiculo_id" id="vehiculo_idDelete" class="form-control selectpicker" data-live-search="true" title="Seleccione el Vehículo a Reservar" required>
                        </div>
                        <div class="col">                                           
                            <label for="conductor_id">Vehiculo a Reservar</label>
                            <input readonly name="conductor_id" id="conductor_idDelete" class="form-control selectpicker" data-live-search="true" title="Seleccione al Conductor" required>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                           
                            <label for="destino">Destino del Cometido</label>
                            <textarea readonly class="form-control" id="destinoDelete" name="destino" rows="2" placeholder="Concepción" required/></textarea>
                            <div class="invalid-feedback">                                                                      
                                Por favor ingrese el Destino del Cometido
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="materia">Propósito del Cometido</label>
                            <textarea readonly class="form-control" id="materiaDelete" name="materia" rows="3" placeholder="Reunión de Gestión en la Gobernación..." required/></textarea>
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese Propósito del Cometido
                            </div>                
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                           
                            <label for="motivoAnulacion">Motivo Anulación de la Reserva</label>
                            <textarea class="form-control" id="motivoAnulacionDelete" name="motivoAnulacion" rows="2" placeholder="Reunión Suspendida" required/></textarea>
                            <div class="invalid-feedback">                                                                      
                                Por favor ingrese el Motivo de la Anulación de la Reserva del Vehículo
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-danger btn-block boton" type="submit" form="deleteReservaForm">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Anular Reserva
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
<!-- End Modal Delete Reserva -->

<!-- Delete Modal Reserva -->
<div class="modal fade" id="showModalReserva" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-ui-delete px-1"></i>Anular Reserva de Vehículo</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="deleteReservaForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="Anular">
                <div class="modal-body">
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="fechaCometido">Fecha del Cometido</label>
                            <input readonly type="text" id="fechaCometidoShow" class="form-control">
                        </div>
                        <div class="col">                                               
                            <label for="horaInicio">Hora Inicio del Cometido</label>
                            <input readonly type="text" class="form-control" id="horaInicioShow">
                        </div>
                        <div class="col">                                              
                            <label for="horaTermino">Hora Término del Cometido</label>
                            <input readonly type="text" class="form-control" id="horaTerminoShow">
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                         
                            <label for="iddoc">No. Solicitud de Cometido</label>              
                            <input readonly type="number" class="form-control" id="iddocShow">
                        </div>
                        <div class="col">                                           
                            <label for="vehiculo_id">Vehiculo a Reservar</label>
                            <input readonly name="vehiculo_id" id="vehiculo_idShow" class="form-control">
                        </div>
                        <div class="col">                                           
                            <label for="conductor_id">Vehiculo a Reservar</label>
                            <input readonly name="conductor_id" id="conductor_idShow" class="form-control">
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                           
                            <label for="destino">Destino del Cometido</label>
                            <textarea readonly class="form-control" id="destinoShow" rows="2" /></textarea>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="materia">Propósito del Cometido</label>
                            <textarea readonly class="form-control" id="materiaShow" rows="3" /></textarea>
               
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                           
                            <label for="motivoAnulacion">Motivo Anulación de la Reserva</label>
                            <textarea readonly class="form-control" id="motivoAnulacionShow" rows="2"/></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Show Delete Reserva -->
@endsection

@push('scripts')

    <script type="text/javascript">
        
        $(document).ready(function () 
        {

            $( "#fechaCometido" ).datepicker({
                dateFormat: "yy-mm-dd",
                minDate: "+0d",
                firstDay: 0,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 2,
            });
            $( "#fechaTermino" ).datepicker({
                dateFormat: "yy-mm-dd",
                minDate: "+0d",
                firstDay: 0,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 2,
            });
            $( "#fechaCometidoUpdate" ).datepicker({
                dateFormat: "yy-mm-dd",
                minDate: "+0d",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 2,
            });
            $( "#fechaTerminoUpdate" ).datepicker({
                dateFormat: "yy-mm-dd",
                minDate: "+0d",
                firstDay: 0,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 2,
            });
            // Start Configuration DataTable
          
            var table = $('#reservasTable').DataTable({

                "paginate"  : true,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Cometidos ingresados, aún...",
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
                $('#fechaCometidoUpdate').val(data[1]);
                $('#fechaTerminoUpdate').val(data[2]);
                $('#horaInicioUpdate').val(data[3]);
                $('#horaTerminoUpdate').val(data[4]);
                $('#iddocUpdate').val(data[5]);
                $('#dependenciaUpdate').val(data[6]);
                $('#vehiculo_idUpdate').val(data[7]);
                $('#conductor_idUpdate').val(data[8]);
                $('#destinoUpdate').val(data[9]);
                $('#materiaUpdate').val(data[10]);

                $('#updateReservaForm').attr('action', '/sispam/reservas/' + data[0]);
                $('#updateModalReserva').modal('show');

            });
            //End Edit Record
            //Start Delete Record
            table.on('click', '.anular', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                $('#fechaCometidoDelete').val(data[1]);
                $('#horaInicioDelete').val(data[2]);
                $('#horaTerminoDelete').val(data[3]);
                $('#iddocDelete').val(data[4]);
                $('#vehiculo_idDelete').val(data[5]);
                $('#conductor_idDelete').val(data[6]);
                $('#destinoDelete').val(data[7]);
                $('#materiaDelete').val(data[8]);

                $('#deleteReservaForm').attr('action', '/sispam/reservas/anular/' + data[0]);
                $('#deleteModalReserva').modal('show');

            });
            //End Delete Record
            //Start Show Record
            table.on('click', '.ver', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                $('#fechaCometidoShow').val(data[1]);
                $('#horaInicioShow').val(data[2]);
                $('#horaTerminoShow').val(data[3]);
                $('#iddocShow').val(data[4]);
                $('#vehiculo_idShow').val(data[5]);
                $('#conductor_idShow').val(data[6]);
                $('#destinoShow').val(data[7]);
                $('#materiaShow').val(data[8]);
                $('#motivoAnulacionShow').val(data[9]);

                $('#showModalReserva').modal('show');

            });
            //End Show Record
         });    
</script>

@endpush