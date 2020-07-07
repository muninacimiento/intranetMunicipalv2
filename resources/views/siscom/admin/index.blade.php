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
                            
                            <h3>Administración de las Solicitudes Realizadas</h3>

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

                    
                    <div>

                        <table class="display" id="solicitudsTable" style="font-size: 0.9em;" width="100%">

                            <thead>

                                <tr class="table-active">

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

                                    <th style="display: none">Decreto Programa</th>

                                    <th style="display: none">Nombre Programa</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($solicituds as $solicitud)

                                    @foreach($fechaRecepcion as $recepcionada)

                                        @if($solicitud->id === $recepcionada->id)

                                            <tr>

                                                <td>{{ $solicitud->id }}</td>

                                                <td>{{ $solicitud->estado }}</td>

                                                <td>{{ $solicitud->iddoc }}</td>

                                                <td>{{ date('d-m-Y H:i:s', strtotime($recepcionada->created_at)) }}</td>

                                                @if( Carbon\Carbon::parse($recepcionada->created_at)->diffInDays() <= 7)

                                                    <td style="background-color : #59d634 !important;color: white;text-align: center;">
                                                    
                                                        {{ Carbon\Carbon::parse($recepcionada->created_at)->diffInDays() }}

                                                    </td>

                                                @elseif( Carbon\Carbon::parse($recepcionada->created_at)->diffInDays() > 7 &&  Carbon\Carbon::parse($recepcionada->created_at)->diffInDays() <= 10)

                                                    <td style="background-color : #eac50b !important;color: black; text-align: center;">
                                                    
                                                        {{ Carbon\Carbon::parse($recepcionada->created_at)->diffInDays() }}

                                                    </td>

                                                @elseif( Carbon\Carbon::parse($recepcionada->created_at)->diffInDays() > 10)

                                                    <td style="background-color : #ea0b0b !important;color: white;text-align: center;">
                                                    
                                                        {{ Carbon\Carbon::parse($recepcionada->created_at)->diffInDays() }}

                                                    </td>

                                                @endif

                                                <td>{{ $solicitud->compradorTitular }}</td>

                                                <td>{{ $solicitud->motivo }}</td>

                                                @if($solicitud->tipoSolicitud === 'Actividad')

                                                    <td style="background-color : #483D8B !important;color: white;">{{ $solicitud->tipoSolicitud }}</td>

                                                @else

                                                    <td>{{ $solicitud->tipoSolicitud }}</td>
                                                
                                                @endif

                                                @if($solicitud->fechaActividad === NULL)

                                                    <td>No Aplica</td>

                                                @else
                                                    
                                                    <td style="background-color : #483D8B !important;color: white;">{{ date('d-m-Y', strtotime($solicitud->fechaActividad)) }}</td>

                                                @endif
                                                
                                                <td>{{ $solicitud->categoriaSolicitud }}</td>

                                                <td>{{ $solicitud->name }}</td>

                                                <td style="display: none">{{ $solicitud->decretoPrograma }}</td>

                                                <td style="display: none">{{ $solicitud->nombrePrograma }}</td>

                                                @if( $solicitud->estado == 'Anulada' || $solicitud->estado == 'Creada')

                                                    <td>

                                                        @can('admin.show')

                                                            <a href="{{ route('admin.show', $solicitud->id) }}" class="btn btn-outline-secondary btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Solicitud">

                                                                <i class="fas fa-eye"></i>

                                                            </a>

                                                        @endcan

                                                    </td>

                                                @else

                                                    <td>

                                                        <div class="btn-group" role="group">

                                                            {{-- Visualizar Solicitud--}}

                                                            @can('admin.show')

                                                                @if($solicitud->estado === 'En Proceso de Entrega' || $solicitud->estado === 'Solicitud Entregada Completamente')

                                                                    <a href="{{ route('admin.stock', $solicitud->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Solicitud">

                                                                        <i class="fas fa-eye"></i>

                                                                    </a>

                                                                @else

                                                                    <a href="{{ route('admin.show', $solicitud->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Solicitud">

                                                                        <i class="fas fa-eye"></i>

                                                                    </a>

                                                                @endif

                                                            @endcan

                                                            {{--Habilitar Entrega Stock--}}

                                                            @can('admin.stock')

                                                                @if(($solicitud->estado === 'Asignada a Comprador' || $solicitud->estado === 'Re-Asignada a Comprador') && ($solicitud->categoriaSolicitud === 'Stock de Oficina' || $solicitud->categoriaSolicitud === 'Stock de Aseo' || $solicitud->categoriaSolicitud === 'Stock de Gas'))
                                                                    
                                                                    <a href="#" class="btn btn-primary btn-sm entregar" data-toggle="tooltip" data-placement="bottom" title="Entregar Productos Stock">
                                                            
                                                                        <i class="fas fa-dolly"></i>

                                                                    </a>

                                                                @else

                                                                @endif

                                                            @endcan

                                                            {{--Habilitar Asignacion--}}

                                                            @can('admin.asignar')

                                                                @if($solicitud->estado === 'Recepcionada' && $solicitud->categoriaSolicitud != 'Stock de Aseo')

                                                                    <a href="#" class="btn btn-warning btn-sm asignar" data-toggle="tooltip" data-placement="bottom" title="Asignar Solicitud">
                                                            
                                                                        <i class="fas fa-inbox"></i>

                                                                    </a>

                                                                @else

                                                                @endif

                                                            {{--Habilitar ReAsignacion--}}

                                                                @if($solicitud->categoriaSolicitud === 'Stock de Aseo')

                                                                @elseif( $solicitud->estado === 'Asignada a Comprador' || $solicitud->estado === 'En Proceso de Entrega' || $solicitud->estado === 'En Proceso de Compra')

                                                                    <a href="#" class="btn btn-dark btn-sm reasignar" data-toggle="tooltip" data-placement="bottom" title="ReAsignar Solicitud">
                                                            
                                                                        <i class="fas fa-inbox"></i>

                                                                    </a>

                                                                @endif

                                                             @endcan

                                                            {{-- Preguntamos si tiene Decreto de Programa para poder determinar que EDICIÓN se debe hacer --}}

                                                            @can('admin.update')

                                                                @if($solicitud->decretoPrograma === NULL)

                                                                    <a href="#" class="btn btn-primary btn-sm editInterna" data-toggle="tooltip" data-placement="bottom" title="Modificar la Solicitud">
                                                            
                                                                        <i class="fas fa-edit"></i>

                                                                    </a>

                                                                @else

                                                                    <a href="#" class="btn btn-primary btn-sm editPrograma" data-toggle="tooltip" data-placement="bottom" title="Modificar la Solicitud">
                                                            
                                                                        <i class="fas fa-edit"></i>

                                                                    </a>

                                                                @endif

                                                            @endcan

                                                            @can('admin.anular')

                                                                @if($solicitud->estado === 'Solicitud Entregada Completamente' || $solicitud->estado === 'Solicitud Gestionada Completamente')

                                                                @else

                                                                    <a href="#" class="btn btn-danger btn-sm anular" data-toggle="tooltip" data-placement="bottom" title="Anular Solicitud">

                                                                        <i class="fas fa-trash"></i>

                                                                    </a>

                                                                @endif

                                                            @endcan

                                                        </div>

                                                    </td>

                                                @endif

                                            </tr>
                                        
                                        
                                        @endif

                                    @endforeach
       

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr class="table-active">

                                    <th>ID</th>

                                    <th>Estado</th>

                                    <th>IDDOC</th>

                                    <th>Recepcionada</th>

                                    <th>D&iacute;as Transcurridos</th>

                                    <th>Comprador</th>
                                    
                                    <th>Motivo</th>
                                    
                                    <th>Tipo</th>
                                    
                                    <th>Categoria</th>

                                    <th>Fecha Actividad</th>

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

<!-- Confirmar Entrega de Productos Solicitud -->
<div class="modal fade" id="confirmarEntregaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        
        <div class="modal-content">
            
            <div class="modal-header bg-primary text-white">
                
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-check-circle"></i> Confirmar Entrega</p>
                    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        
                    <span aria-hidden="true">&times;</span>
                
                </button>

            </div>
        
            <form method="POST" action="{{ url('/siscom/admin') }}" class="was-validated" id="entregarForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="EntregarSolicitud">
            
            <div class="modal-body">
                
                <label class="text-muted">Está ud. segur@ de comenzar el Proceso de Entrega ?</label>

                <div class="form-row mb-5">

                    <label for="ID" class="col-sm-3 col-form-label text-muted">No. Solicitud</label>

                    <div class="col-sm-9">
                             
                        <input type="" name="solicitud_id_Entrega" id="solicitud_id_Entrega" readonly class="form-control-plaintext">
                                 
                    </div>

                </div>

                <div class="form-row">

                    <button type="submit" class="btn btn-primary btn-block">

                        <i class="fas fa-check-circle"></i>

                        Si, entregar!

                    </button>
                
                    <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                        <i class="fas fa-arrow-left"></i>

                        Cancelar

                    </button>

                </div>
            
            </div>

            </form>

        </div>

    </div>

</div>
<!-- END Confirmar Entrega de Productos Solicitud -->

<!-- Recepcionar Solicitud MODAL -->
<div class="modal fade" id="recepcionarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"> Recepcionar Solicitud <i class="fas fa-edit"></i></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/admin/recepcionar') }}" class="was-validated" id="recepcionarForm">

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

                            <input type="nummber" name="iddoc" required class="form-control">

                            <div class="invalid-feedback">

                                Por favor Ingrese el IDDOC del Sistema de Gestión Documental

                            </div>

                        </div>
                        
                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Recepcionar Solicitud

                        </button>


                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- End Recepcinoar Solicitud Modal -->

<!-- Asignar Solicitud Modal -->
<div class="modal fade" id="asignarSolicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"> Asignar Solicitud <i class="fas fa-inbox"></i></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/admin/asignar') }}" class="was-validated" id="asignarForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Asignar">

                <div class="modal-body">

                    <div class="form-row">
                        
                        <label for="fechaRecepcion" class="col-sm-4 col-form-label text-muted">Fecha Recepción</label>

                        <label for="fechaRecepcion" class="col-sm-8 col-form-label">{{ $dateCarbon }}</label>

                    </div>

                    <div class="form-row">

                        <label for="ID" class="col-sm-4 col-form-label text-muted">No. Solicitud</label>

                        <div class="col-sm-8">
                             
                            <input type="" name="solicitud_id" id="solicitud_id" readonly class="form-control-plaintext">
                                 
                        </div>
                        
                    </div>

                    <div class="form-row mb-5">

                        <label for="ID" class="col-sm-4 col-form-label text-muted">Compador</label>

                        <div class="col-sm-8">

                            <select name="compradorTitular" id="compradorTitular" class="custom-select" required>

                                <option value="">Seleccione al Comprador...</option>

                                <option>Fabiola Macaya</option>
                                <option>Marcela Torres</option>
                                <option>Luis Arancibia</option>
                                <option>Cecilia Castro S</option>
                                <option>Mónica Alvarez</option>

                            </select>

                             <div class="invalid-feedback">

                                Por favor seleccione al Comprador aquien le asignará esta Solicitud

                            </div>

                        </div>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-warning btn-block" type="submit">

                            <i class="fas fa-check-circle"></i> Asignar Solicitud

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- End Asignar Solicitud Modal -->

<!-- REAsignar Solicitud Modal -->
<div class="modal fade" id="reasignarSolicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"> Re-Asignar Solicitud <i class="fas fa-inbox"></i></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/admin/reasignar') }}" class="was-validated" id="reasignarForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="ReAsignar">

                <div class="modal-body">

                    <div class="form-row">
                        
                        <label for="fechaRecepcion" class="col-sm-4 col-form-label text-muted">Fecha Recepción</label>

                        <label for="fechaRecepcion" class="col-sm-8 col-form-label">{{ $dateCarbon }}</label>

                    </div>

                    <div class="form-row">

                        <label for="ID" class="col-sm-4 col-form-label text-muted">No. Solicitud</label>

                        <div class="col-sm-8">
                             
                            <input type="" name="solicitud_id" id="solicitud_id_reasignar" readonly class="form-control-plaintext">
                                 
                        </div>
                        
                    </div>

                    <div class="form-row mb-5">

                        <label for="ID" class="col-sm-4 col-form-label text-muted">Compador</label>

                        <div class="col-sm-8">

                            <select name="compradorSuplencia" id="compradorSuplencia" class="custom-select" required>

                                <option value="">Seleccione al Comprador...</option>

                                <option>Fabiola Macaya</option>
                                <option>Marcela Torres</option>
                                <option>Luis Arancibia</option>
                                <option>Cecilia Castro S</option>
                                <option>Mónica Alvarez</option>

                            </select>

                             <div class="invalid-feedback">

                                Por favor seleccione al Comprador aquien le asignará esta Solicitud

                            </div>

                        </div>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-warning btn-block" type="submit">

                            <i class="fas fa-check-circle"></i> ReAsignar Solicitud

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- End Asignar Solicitud Modal -->

<!-- Actualizamos Solicitud de Gestión Interna -->
<div class="modal fade" id="updateSolicitudInterna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h3 class="modal-title" id="exampleModalLabel"> Actualizar Solicitud <i class="fas fa-edit"></i></h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/solicitud') }}" class="was-validated" id="updateFormInterna">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="ActualizarInterna">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="Motivo">Motivo</label>

                            <textarea type="text" class="form-control" id="motivo_update_interna" name="motivo" placeholder="Ingrese el Motivo de su Solicitud" required></textarea>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Motivo de la Solicitud

                            </div>

                        </div>

                    </div>

                    <div class="form-row mb-5">

                        <div class="form-group col-md-6 mb-3">

                            <label for="tipoSolicitud">Tipo Solicitud</label>

                            <select name="tipoSolicitud" id="tipoSolicitud_update_interna" class="custom-select" required>

                                <option>Operacional</option>
                                <option>Actividad</option>

                            </select>

                            <div class="invalid-feedback">

                                Por favor seleccione el Tipo de Solicitud

                            </div>

                        </div>

                        <div class="form-group col-md-6 mb-3">

                            <label for="categoriaSolicitud">Categoria Solicitud</label>

                            <select name="categoriaSolicitud" id="categoriaSolicitud_update_interna" class="custom-select" required>

                                <option>Stock de Oficina</option>
                                <option>Stock de Aseo</option>                                
                                <option>Stock de Gas</option>                               
                                <option>Compra</option>                                

                            </select>
                                                                                        
                            <div class="invalid-feedback">
                                                                                            
                                Por favor seleccione la Categoria de la Solicitud

                            </div>
                                                                            
                        </div>  

                    </div>

                    <div class="form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Guardar Solicitud

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Actualizamos Solicitud de Gestión Interna -->

<!-- Actualizamos Solicitud de Gestión de Programa -->
<div class="modal fade" id="updateSolicitudPrograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h3 class="modal-title" id="exampleModalLabel"> Actualizar Solicitud <i class="fas fa-edit"></i></h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/solicitud') }}" class="was-validated" id="updateFormPrograma">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="ActualizarPrograma">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="Motivo">Motivo</label>

                            <textarea type="text" class="form-control" id="motivo_update_programa" name="motivo" placeholder="Ingrese el Motivo de su Solicitud" required></textarea>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Motivo de la Solicitud

                            </div>

                        </div>

                    </div>

                    <div class="form-row mb-5">

                        <div class="form-group col-md-6 mb-3">

                            <label for="tipoSolicitud">Tipo Solicitud</label>

                            <select name="tipoSolicitud" id="tipoSolicitud_update_programa" class="custom-select" required>

                                <option>Operacional</option>
                                <option>Actividad</option>

                            </select>

                            <div class="invalid-feedback">

                                Por favor seleccione el Tipo de Solicitud

                            </div>

                        </div>

                        <div class="form-group col-md-6 mb-3">

                            <label for="categoriaSolicitud">Categoria Solicitud</label>

                            <select name="categoriaSolicitud" id="categoriaSolicitud_update_programa" class="custom-select" required>

                                <option>Stock de Oficina</option>
                                <option>Stock de Aseo</option>                                
                                <option>Stock de Gas</option>                               
                                <option>Compra</option>                                

                            </select>
                                                                                        
                            <div class="invalid-feedback">
                                                                                            
                                Por favor seleccione la Categoria de la Solicitud

                            </div>
                                                                            
                        </div>  

                    </div>

                    <div class="form-row mb-5">

                        <div class="col-md-6">
                                                                                          
                            <label for="decretoActividad">No. Decreto del Programa</label>

                            <input type="text" id="decretoPrograma_update_programa" name="decretoPrograma" class="form-control" placeholder="Cuál es el Número de su Decreto?" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el No. de Decreto de su Programa

                            </div>

                        </div>

                        <div class="col-md-6">
                                                                                          
                            <label for="nombrePrograma">Nombre del Programa 

                                <small class="text-muted">(Programa Presupuestario)</small>

                            </label>

                            <input type="text" id="nombrePrograma_update_programa" name="nombrePrograma" class="form-control" placeholder="Cuál es el Nombre del Programa a Ejecutar?" required/>
                            
                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Nombre de su Programa

                            </div>

                        </div>
                    
                    </div>

                    <div class="form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Guardar Solicitud

                        </button>

                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- ACtualizamos Solicitud de Gestión de Programa -->

<!-- Anular Modal Solicitud -->
<div class="modal fade" id="anularSolicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"> Anular Solicitud <i class="fas fa-inbox"></i></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/admin/anular') }}" class="was-validated" id="anularForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Anular">

                <div class="modal-body">

                    <div class="form-row mb-3">

                        <div class="col-md-3 mb-3">

                            <label class="text-muted">No. Solicitud</label><br>
                                                                        
                            <label class="h5" id="noSolicitud">No Solicitud</label>
                                                                     
                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="text-muted">Fecha Solicitud</label><br>
                                                                        
                            <label class="h5" id="fechaSolicitud">Fecha Solicitud</label>
                                                                    
                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="text-muted">Fecha Solicitud</label><br>
                                                                        
                            <label class="h5" id="tipoSolicitud_anular">Tipo Solicitud</label>
                                                                    
                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="text-muted">Fecha Solicitud</label><br>
                                                                        
                            <label class="h5" id="categoriaSolicitud_anular">Categoria Solicitud</label>
                                                                    
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo</label>

                            <textarea type="text" class="form-control" id="motivoAnulacion" name="motivoAnulacion" placeholder="Ingrese el Motivo del porqué va a ANULAR su Solicitud" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo de la Anulación de su Solicitud

                            </div>

                        </div>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-danger btn-block" type="submit">

                            <i class="fas fa-times-circle"></i> Anular Solicitud

                        </button>

                        
                        <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" aria-label="Close">

                            <i class="fas fa-arrow-left"></i>

                            Cancelar

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- End Modal Anular Solicitud -->

@endsection

@push('scripts')

    <!-- JQuery DataTable -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>

<!-- JQuery DatePicker -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
        
        $(document).ready(function () {

            var height = $(window).height();
            $('#allWindow').height(height);


            $( "#fechaActividad" ).datepicker({
                dateFormat: "yy-mm-dd",
                minDate: "+14d",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 2,
            });

            $( "#fechaDecreto" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
            });

            disableEncabezado();

            disableActividad();

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

            //Start Edit Record
            table.on('click', '.editInterna', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#motivo_update_interna').val(data[5]);

                if (($('#tipoSolicitud_update_interna').val(data[6]))==='Solicitud General') {

                    $('#tipoSolicitud_update_interna').val();    
                }
                else if (($('#tipoSolicitud_update_interna').val(data[6]))==='Solicitud de Actividad'){

                    $('#tipoSolicitud_update_interna').val();       
                }
                
                if (($('#categoriaSolicitud_update_interna').val(data[7]))==='Stock de Oficina') {

                    $('#categoriaSolicitud_update_interna').val();    
                }
                else if (($('#categoriaSolicitud_update_interna').val(data[7]))==='Stock de Aseo'){

                    $('#categoriaSolicitud_update_interna').val();       
                }
                else if (($('#categoriaSolicitud_update_interna').val(data[7]))==='Stock de Gas'){

                    $('#categoriaSolicitud_update_interna').val();       
                }
                else if (($('#categoriaSolicitud_update_interna').val(data[7]))==='Compra'){

                    $('#categoriaSolicitud_update_interna').val();       
                }               

                $('#updateFormInterna').attr('action', '/siscom/solicitud/' + data[0]);
                $('#updateSolicitudInterna').modal('show');

            });
            //End Edit Record

            //Start Edit Record
            table.on('click', '.editPrograma', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#motivo_update_programa').val(data[5]);

                if (($('#tipoSolicitud_update_programa').val(data[6]))==='Solicitud General') {

                    $('#tipoSolicitud_update_programa').val();    
                }
                else if (($('#tipoSolicitud_update_programa').val(data[6]))==='Solicitud de Actividad'){

                    $('#tipoSolicitud_update_programa').val();       
                }
                
                if (($('#categoriaSolicitud_update_programa').val(data[7]))==='Stock de Oficina') {

                    $('#categoriaSolicitud_update_programa').val();    
                }
                else if (($('#categoriaSolicitud_update_programa').val(data[7]))==='Stock de Aseo'){

                    $('#categoriaSolicitud_update_programa').val();       
                }
                else if (($('#categoriaSolicitud_update_programa').val(data[7]))==='Stock de Gas'){

                    $('#categoriaSolicitud_update_programa').val();       
                }
                else if (($('#categoriaSolicitud_update_programa').val(data[7]))==='Compra'){

                    $('#categoriaSolicitud_update_programa').val();       
                }

                $('#decretoPrograma_update_programa').val(data[8]);
                $('#nombrePrograma_update_programa').val(data[9]);
               

                $('#updateFormPrograma').attr('action', '/siscom/solicitud/' + data[0]);
                $('#updateSolicitudPrograma').modal('show');

            });
            //End Edit Record

            //Comienzo de Confirmar Entrega Productos de la Solicitud
            table.on('click', '.entregar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#solicitud_id_Entrega').val(data[0]);

                $('#entregarForm').attr('action', '/siscom/admin/' + data[0]);
                $('#confirmarEntregaModal').modal('show');

            });
            //Fin Confirmar Entrega Productos de la Solicitud

            //Comienzo de Recepción de la Solicitud
            table.on('click', '.recepcionar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#solicitudID').val(data[0]);

                $('#recepcionarForm').attr('action', '/siscom/admin/recepcionar/' + data[0]);
                $('#recepcionarModal').modal('show');

            });
            //Fin Recepción de la Solicitud

            //Comienzo de Asignación de la Solicitud
            table.on('click', '.asignar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#solicitud_id').val(data[0]);
                
                $('#asignarForm').attr('action', '/siscom/admin/asignar/' + data[0]);
                $('#asignarSolicitudModal').modal('show');

            });
            //Fin Asignación de la Solicitud

            //Comienzo de Asignación de la Solicitud
            table.on('click', '.reasignar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#solicitud_id_reasignar').val(data[0]);
                
                $('#reasignarForm').attr('action', '/siscom/admin/reasignar/' + data[0]);
                $('#reasignarSolicitudModal').modal('show');

            });
            //Fin Asignación de la Solicitud

            //Comienzo de la Anulación de la Solicitud
            table.on('click', '.anular', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                document.getElementById('noSolicitud').innerHTML = data[0];
                document.getElementById('fechaSolicitud').innerHTML = data[3];
                document.getElementById('tipoSolicitud_anular').innerHTML = data[6];
                document.getElementById('categoriaSolicitud_anular').innerHTML = data[7];
                
                $('#anularForm').attr('action', '/siscom/admin/anular/' + data[0]);
                $('#anularSolicitudModal').modal('show');

            });
            //Fin Anulación de la Solicitud

            //LLenar Select CategoriaSolicitud dependiendo de la seleccion en TipoSolicitud
        var options = {
        
            Operacional : ["Stock de Oficina", "Stock de Aseo", "Stock de Gas", "Compra"],
            Actividad : ["Compra"]
        }

        $(function(){

            var fillCategoria = function(){

                var selected = $('#tipoSolicitud_create').val();

                $('#categoriaSolicitud_create').empty();

                options[selected].forEach(function(element,index){

                    $('#categoriaSolicitud_create').append('<option value="'+element+'">'+element+'</option>');

                });

                if (selected === "") {

                    disableActividad();

                } else if (selected === "Operacional") {

                    disableActividad();

                } else if (selected === "Actividad") {

                    enableActividad();

                } 
        
            }

            $('#tipoSolicitud_create').change(fillCategoria);

            fillCategoria();

            
        });

        document.getElementById("areaGestion").onchange = function() {habilitarEncabezado()};

        function habilitarEncabezado(){

            var option = $('#areaGestion').val();

            if (option === '') {

                disableEncabezado();

            } else if (option === 'Interna') {

                enableInterna();

            } else if (option === 'Programa') {

                enablePrograma();

            }


        }

        function disableEncabezado(){

            $('#motivo_create').prop("disabled", true);
            $('#tipoSolicitud_create').prop("disabled", true);
            $('#categoriaSolicitud_create').prop("disabled", true);
            $('#decretoPrograma_create').prop("disabled", true);
            $('#nombrePrograma_create').prop("disabled", true);
        }


        function enableInterna(){

            $('#motivo_create').prop("disabled", false);
            $('#tipoSolicitud_create').prop("disabled", false);
            $('#categoriaSolicitud_create').prop("disabled", false);
            $('#decretoPrograma_create').prop("disabled", true);
            $('#nombrePrograma_create').prop("disabled", true);
        }

        function enablePrograma(){

            $('#motivo_create').prop("disabled", false);
            $('#tipoSolicitud_create').prop("disabled", false);
            $('#categoriaSolicitud_create').prop("disabled", false);
             $('#decretoPrograma_create').prop("disabled", false);
            $('#nombrePrograma_create').prop("disabled", false);

        }

        function disableActividad() {
            
            $('#nombreActividad').prop("disabled", true);
            $('#fechaActividad').prop("disabled", true);
            $('#horaActividad').prop("disabled", true);
            $('#lugarActividad').prop("disabled", true);
            $('#objetivoActividad').prop("disabled", true);
            $('#descripcionActividad').prop("disabled", true);
            $('#participantesActividad').prop("disabled", true);
            $('#cuentaPresupuestaria').prop("disabled", true);
            $('#cuentaComplementaria').prop("disabled", true);
            $('#obsActividad').prop("disabled", true);

        }

        function enableActividad(){

            $('#nombreActividad').prop("disabled", false);
            $('#fechaActividad').prop("disabled", false);
            $('#horaActividad').prop("disabled", false);
            $('#lugarActividad').prop("disabled", false);
            $('#objetivoActividad').prop("disabled", false);
            $('#descripcionActividad').prop("disabled", false);
            $('#participantesActividad').prop("disabled", false);
            $('#cuentaPresupuestaria').prop("disabled", false);
            $('#cuentaComplementaria').prop("disabled", false);
            $('#obsActividad').prop("disabled", false);

        }

        

    });    

</script>

@endpush


