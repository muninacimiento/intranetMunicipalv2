<!--
/*
 *  JFuentealba @itux
 *  created at March 13, 2022 - 14:43 pm
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
                            <h3>Mantención de Vehiculos</h3>
                            <div class="text-secondary">
                                {{ $dateCarbon }}
                            </div>
                        </div>
                        <!-- Button trigger CrearSolicitudModal -->
                        <div class="col-md-6">
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createModalMantencion">
                                <button class="btn btn-success btn-block boton">
                                    <i class="icofont-plus-square px-1" style=" font-size: 1rem;"></i>
                                    Ingresar Mantención de Vehículo
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
                        <table class="display" id="reservasTable" style="font-size: 0.9em;" width="100%">
                            <thead>
                                <tr class="table-active">
                                    <th style="display: none;">ID Mantención</th>
                                    <th>Fecha Mantención</th>
                                    <th>Vehículo</th>
                                    <th>Tipo Mantención</th>
                                    <th style="display: none;">Descripción</th>
                                    <th>No. Guía/Factura</th>
                                    <th>Orden de Compra</th>
                                    <th>Proveedor</th>
                                    <th style="display: none;">Total Mantención</th>
                                    <th style="display: none;">Observaciones</th>
                                    <th style="display: none;">OtraMantencion</th>
                                    <th style="display: none;">Recomendación Fabricante</th>
                                    <th style="display: none;">Odómetro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mantenciones as $mantencion)
                                    <tr>
                                        <td style="display: none;">{{ $mantencion->id }}</td>
                                        <td>{{ date('d-m-Y', strtotime($mantencion->fechaMantencion)) }}</td>
                                        <td>{{ $mantencion->Vehiculo }}</td>
                                        @if($mantencion->tipoMantencion === 1)
                                            <td>Cambio de Aceite</td>
                                        @elseif($mantencion->tipoMantencion === 2)
                                            <td>Cambio de Correas</td>
                                        @elseif($mantencion->tipoMantencion === 3)
                                            <td>Cambio de Neumáticos</td>
                                        @endif
                                        <td style="display: none;">{{ $mantencion->descripcion }}</td>
                                        <td>{{ $mantencion->noDocumento }}</td>
                                        <td>{{ $mantencion->ordenCompra }}</td>
                                        <td>{{ $mantencion->proveedor }}</td>
                                        <td style="display: none;">{{ $mantencion->total }}</td>
                                        <td style="display: none;">{{ $mantencion->observacion }}</td>
                                        <td style="display: none;">{{ $mantencion->otroTipoMantencion }}</td>
                                        <td style="display: none;">{{ $mantencion->recomendacionFabricante }}</td>
                                        <td style="display: none;">{{ $mantencion->odometro }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="#" class="btn btn-primary btn-sm edit" data-toggle="tooltip" data-placement="bottom" title="Modificar Reserva del Vehículo">                        
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
<!-- CREATE Modal Mantención -->
<div class="modal fade" id="createModalMantencion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-plus-square px-1"></i>Registrar Mantención</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ action('MantencionVehiculosController@store') }}" class="was-validated" id="mantencionForm">
                @csrf
                <div class="modal-body">
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="fechaMantencion">Cuándo se realizó la Mantención</label>
                            <input type="text" id="fechaMantencion" name="fechaMantencion" class="form-control" placeholde="01-01-2022" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha de Realización de la Mantención
                            </div>
                        </div>
                        <div class="col">                                           
                            <label for="vehiculo_id">A qué Vehículo?</label>
                            <select name="vehiculo_id" id="vehiculo_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el Vehículo" required>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->Vehiculo }}</option>                        
                                @endforeach
                            </select>
                        </div>
                        <div class="col">                                               
                            <label for="tipoMantencion">Qué Mantención se Realizó?</label>
                            <select name="tipoMantencion" id="tipoMantencion" class="form-control selectpicker" title="Seleccione el Tipo de Mantención" required>
                                <option value="1">Cambio de Aceite</option>
                                <option value="2">Cambio de Correa</option>
                                <option value="3">Cambio de Neumáticos</option>
                                <option value="4">Otro</option>
                            </select>
                            <div class="invalid-feedback">                                                                        
                                Por favor ingrese el Tipo de Mantención realizado
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="odometro">Odómetro</label>
                            <input type="number" class="form-control" name="odometro" required>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese el Odómetro de Vehículo
                            </div>
                        </div>
                        <div class="col">                                              
                            <label for="otraMantencion">Recomendación del Fabricante</label>
                            <input type="number" class="form-control" name="recomendacionFabricante" placeholder="Si Existe ?">
                        </div>
                        <div class="col">                                              
                            <label for="otraMantencion">Otro Tipo Mantención</label>
                            <input type="text" class="form-control" name="otraMantencion" id="otraMantencion" required disabled>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese Otro Tipo Mantención
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="descripcion">Breve Descripción de la Mantención</label>
                            <input type="text" class="form-control" name="descripcion" placeholder="Mantención Preventiva por kilometraje recomendado alcazado" required>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese una breve Descripción de la Mantención
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                         
                            <label for="noDocumento">No. Guia / Factura</label>              
                            <input type="number" class="form-control" name="noDocumento" placeholder="123456" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el No. de la Guía o Factura               
                            </div>                 
                        </div>
                        <div class="col">                                         
                            <label for="ordenCompra">No. Orden de Compra</label>              
                            <input type="text" class="form-control" name="ordenCompra" placeholder="123456" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el No. de la Orden de Compra             
                            </div>                 
                        </div>
                        <div class="col">                                         
                            <label for="total">Valor de la Mantención $</label>              
                            <input type="number" class="form-control" name="total" placeholder="$12345679" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el Costo Total de la Mantención          
                            </div>                 
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                         
                            <label for="proveedor">Proveedor O.C.</label>              
                            <input type="text" class="form-control" name="proveedor" placeholder="Comercial Jara y CIA" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el Proveedor de la Mantención           
                            </div>                 
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="observacion">Alguna Observación?</label>
                            <textarea class="form-control" id="observacion" name="observacion" rows="3" placeholder="(Opcional)"/></textarea>               
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="mantencionForm">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Registrar Mantención
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
<!-- END CREATE Modal Mantención -->

<!-- Update Modal Mantención -->
<div class="modal fade" id="updateModalMantencion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-refresh px-1"></i>Modificar Registro de Mantención</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="updateMantencionForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="Actualizar">
                <div class="modal-body">
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="fechaMantencion">Cuándo se realizó la Mantención</label>
                            <input type="text" id="fechaMantencionUpdate" name="fechaMantencion" class="form-control" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha de Realización de la Mantención
                            </div>
                        </div>
                        <div class="col">                                           
                            <label for="vehiculo_id">A qué Vehículo?</label>
                            <select name="vehiculo_id" id="vehiculo_idUpdate" class="form-control"  title="Seleccione el Vehículo" required>
                                <option value=""></option>                        
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->Vehiculo }}</option>                        
                                @endforeach
                            </select>
                        </div>
                        <div class="col">                                               
                            <label for="tipoMantencion">Qué Mantención se Realizó?</label>
                            <select name="tipoMantencion" id="tipoMantencionUpdate" class="form-control" title="Seleccione el Tipo de Mantención" required>
                                <option value=""></option>
                                <option value="1">Cambio de Aceite</option>
                                <option value="2">Cambio de Correa</option>
                                <option value="3">Cambio de Neumáticos</option>
                                <option value="4">Otro</option>
                            </select>
                            <div class="invalid-feedback">                                                                        
                                Por favor ingrese el Tipo de Mantención realizado
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="odometro">Odómetro</label>
                            <input type="number" class="form-control" name="odometro" id="odometroUpdate" required>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese el Odómetro de Vehículo
                            </div>
                        </div>
                        <div class="col">                                              
                            <label for="otraMantencion">Recomendación del Fabricante</label>
                            <input type="number" class="form-control" name="recomendacionFabricante" id="recomendacionFabricanteUpdate">
                        </div>
                        <div class="col">                                              
                            <label for="otraMantencion">Otro Tipo Mantención</label>
                            <input type="text" class="form-control" name="otraMantencion" id="otraMantencionUpdate" required disabled>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese Otro Tipo Mantención
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="descripcion">Breve Descripción de la Mantención</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcionUpdate" required>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese una breve Descripción de la Mantención
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                         
                            <label for="noDocumento">No. Guia / Factura</label>              
                            <input type="number" class="form-control" name="noDocumento" id="noDocumentoUpdate" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el No. de la Guía o Factura               
                            </div>                 
                        </div>
                        <div class="col">                                         
                            <label for="ordenCompra">No. Orden de Compra</label>              
                            <input type="text" class="form-control" name="ordenCompra" id="ordenCompraUpdate" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el No. de la Orden de Compra             
                            </div>                 
                        </div>
                        <div class="col">                                         
                            <label for="total">Valor de la Mantención $</label>              
                            <input type="number" class="form-control" name="total" id="totalUpdate" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el Costo Total de la Mantención          
                            </div>                 
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                         
                            <label for="proveedor">Proveedor O.C.</label>              
                            <input type="text" class="form-control" name="proveedor" id="proveedorUpdate" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el Proveedor de la Mantención           
                            </div>                 
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="observacion">Alguna Observación?</label>
                            <textarea class="form-control" id="observacionUpdate" name="observacion" rows="3" placeholder="(Opcional)"/></textarea>               
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="updateMantencionForm">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Registrar Mantención
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
                            <label for="fechaMantencion">Cuándo se realizó la Mantención</label>
                            <input type="text" id="fechaMantencion" name="fechaMantencion" class="form-control" placeholde="01-01-2022" required/>
                            <div class="invalid-feedback">                                                                                                        
                                Por favor ingrese la Fecha de Realización de la Mantención
                            </div>
                        </div>
                        <div class="col">                                           
                            <label for="vehiculo_id">A qué Vehículo?</label>
                            <select name="vehiculo_id" id="vehiculo_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el Vehículo" required>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->Vehiculo }}</option>                        
                                @endforeach
                            </select>
                        </div>
                        <div class="col">                                               
                            <label for="tipoMantencion">Qué Mantención se Realizó?</label>
                            <select name="tipoMantencion" id="tipoMantencion" class="form-control selectpicker" title="Seleccione el Tipo de Mantención" required>
                                <option value="1">Cambio de Aceite</option>
                                <option value="2">Cambio de Correa</option>
                                <option value="3">Cambio de Neumáticos</option>
                                <option value="4">Otro</option>
                            </select>
                            <div class="invalid-feedback">                                                                        
                                Por favor ingrese el Tipo de Mantención realizado
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-4">                                              
                            <label for="otraMantencion">Otro Tipo Mantención</label>
                            <input type="text" class="form-control" name="otraMantencion" id="otraMantencion" required disabled>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese Otro Tipo Mantención
                            </div>
                        </div>
                        <div class="col-md-8">                                              
                            <label for="descripcion">Breve Descripción de la Mantención</label>
                            <input type="text" class="form-control" name="descripcion" placeholder="Mantención Preventiva por kilometraje recomendado alcazado" required>
                            <div class="invalid-feedback">                                                                       
                                Por favor ingrese una breve Descripción de la Mantención
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                         
                            <label for="noDocumento">No. Guia / Factura</label>              
                            <input type="number" class="form-control" name="noDocumento" placeholder="123456" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el No. de la Guía o Factura               
                            </div>                 
                        </div>
                        <div class="col">                                         
                            <label for="ordenCompra">No. Orden de Compra</label>              
                            <input type="text" class="form-control" name="ordenCompra" placeholder="123456" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el No. de la Orden de Compra             
                            </div>                 
                        </div>
                        <div class="col">                                         
                            <label for="total">Valor de la Mantención $</label>              
                            <input type="number" class="form-control" name="total" placeholder="$12345679" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el Costo Total de la Mantención          
                            </div>                 
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                         
                            <label for="proveedor">Proveedor O.C.</label>              
                            <input type="text" class="form-control" name="proveedor" placeholder="Comercial Jara y CIA" required>               
                            <div class="invalid-feedback">                                                                                                                        
                                Por favor ingrese el Proveedor de la Mantención           
                            </div>                 
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">                                              
                            <label for="observacion">Alguna Observación?</label>
                            <textarea class="form-control" id="observacion" name="observacion" rows="3" placeholder="(Opcional)"/></textarea>               
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="btn btn-success btn-block boton" type="submit" form="mantencionForm">
                        <i class="icofont-check-circled px-1" style=" font-size: 1.4rem;"></i>
                            Registrar Mantención
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
            $( "#fechaMantencion" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 2,
            });
            $( "#fechaMantencionUpdate" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
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
                $('#fechaMantencionUpdate').val(data[1]);
                $('#vehiculo_idUpdate').val(data[2]);
                $('#tipoMantencionUpdate').val(data[3]);
                $('#descripcionUpdate').val(data[4]);
                $('#noDocumentoUpdate').val(data[5]);
                $('#ordenCompraUpdate').val(data[6]);
                $('#proveedorUpdate').val(data[7]);
                $('#totalUpdate').val(data[8]);
                $('#observacionesUpdate').val(data[9]);
                $('#otraMantencionUpdate').val(data[10]);
                $('#recomendacionFabricanteUpdate').val(data[11]);
                $('#odometroUpdate').val(data[12]);

                $('#updateMantencionForm').attr('action', '/sispam/mantenciones/' + data[0]);
                $('#updateModalMantencion').modal('show');

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
            document.getElementById("tipoMantencion").onchange = function() {habilitarOtraMantencion()};
            document.getElementById("tipoMantencionUpdate").onchange = function() {habilitarOtraMantencionUpdate()};

            function habilitarOtraMantencion(){
                var option = $('#tipoMantencion').val();
                if (option === '4') {
                    enabledOtraMantencion();
                } else {
                    disabledOtraMantencion();
                }
            }
            function enabledOtraMantencion(){
                $('#otraMantencion').prop("disabled", false);
            }
            function disabledOtraMantencion(){
                $('#otraMantencion').prop("disabled", true);
            }
            function habilitarOtraMantencionUpdate(){
                var option = $('#tipoMantencionUpdate').val();
                if (option === '4') {
                    enabledOtraMantencionUpdate();
                } else {
                    disabledOtraMantencionUpdate();
                }
            }
            function enabledOtraMantencionUpdate(){
                $('#otraMantencionUpdate').prop("disabled", false);
            }
            function disabledOtraMantencionUpdate(){
                $('#otraMantencionUpdate').prop("disabled", true);
            }
         });    
</script>

@endpush