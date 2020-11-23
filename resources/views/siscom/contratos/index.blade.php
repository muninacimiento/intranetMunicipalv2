<!--
/*
 *  JFuentealba @itux
 *  created at July 12, 2020 - 19:23 pm
 *  updated at 
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

                    <div class="row mt-5">

                        <div class="col-md-6 text-center">
                            
                            <h3>Gestión de Contratos</h3>

                            <div class="text-secondary">

                                {{ $dateCarbon }}

                            </div>

                        </div>

                        <!-- Button trigger CrearSolicitudModal -->
                        <div class="col-md-6">
                            
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createModalContrato">

                                <button class="btn btn-success btn-block boton">

                                    <i class="fas fa-plus"></i>

                                    Nuevo Contrato

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

                        <table class="display" id="contratoTable" style="font-size: 0.9em;" width="100%">

                            <thead>

                                <tr class="table-active">

                                    <th style="display: none;">ID Contrato</th>

                                    <th>Nombre Contrato</th>

                                    <th>Estado</th>

                                    <th>Orden de Compra</th>

                                    <th>Inicio Contrato</th>

                                    <th>Término Contrato</th>

                                    <th>Boleta Garantía</th>
                                    
                                    <th>Banco</th>

                                    <th>Monto $</th>

                                    <th>Tipo Contrato</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($contratos as $contrato)

                                <tr>

                                    <td style="display: none;">{{ $contrato->id }}</td>

                                    <td>{{ $contrato->nombreContrato }}</td>

                                    @if($contrato->estado_id === 2)

                                        <td style="color: red;">{{ $contrato->Estado }}</td>

                                    @else

                                        <td>{{ $contrato->Estado }}</td>

                                    @endif

                                    <td>{{ $contrato->NoOC }}</td>

                                    <td>{{ date('d-m-Y', strtotime($contrato->fechaInicio)) }}</td>

                                    <td>{{ date('d-m-Y', strtotime($contrato->fechaTermino)) }}</td>

                                    <td>{{ $contrato->numeroBoleta }}</td>

                                    <td>{{ $contrato->banco }}</td>

                                    <td>{{ $contrato->montoBoleta}}</td>

                                    <td>{{ $contrato->tipoContrato }}</td>

                                    @if($contrato->estado_id === 2)

                                    <td>
                                        
                                        @can('contrato.show')

                                            <a href="{{ route('contrato.show', $contrato->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle del Contrato">
                                                                
                                                <i class="fas fa-eye"></i>

                                            </a>

                                        @endcan

                                    </td>

                                    @else

                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                @can('contrato.show')

                                                    <a href="{{ route('contrato.show', $contrato->id) }}" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle del Contrato">
                                                                
                                                        <i class="fas fa-eye"></i>

                                                    </a>

                                                @endcan

                                                @if($contrato->estado_id === 1)

                                                    @can('contrato.recepcionar')

                                                        <a href="#" class="btn btn-success btn-sm recepcionar" data-toggle="tooltip" data-placement="bottom" title="Recepcionar Contrato">
                                                                            
                                                            <i class="fas fa-clipboard-check"></i>

                                                        </a>

                                                    @endcan

                                                @else

                                                @endif

                                                @if(($contrato->estado_id >= 3 && $contrato->estado_id < 21) || $contrato->estado_id === 22)

                                                    @can('contrato.validar')

                                                        <a href="{{ route('contrato.validar', $contrato->id) }}" class="btn btn-warning btn-sm validar" data-toggle="tooltip" data-placement="bottom" title="Validar  Contrato">
                                                                            
                                                            <i class="fas fa-thumbs-up"></i>

                                                        </a>

                                                    @endcan

                                                @else

                                                @endif

                                                @if($contrato->estado_id === 21)

                                                @else

                                                    @can('contrato.update')

                                                        <a href="#" class="btn btn-primary btn-sm edit" data-toggle="tooltip" data-placement="bottom" title="Modificar el Contrato">
                                                                            
                                                            <i class="fas fa-edit"></i>

                                                        </a>

                                                    @endcan

                                                    @can('contrato.anular')

                                                        <a href="#" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="Anular Contrato">
                                                                            
                                                            <i class="fas fa-trash"></i>

                                                        </a>

                                                    @endcan

                                                @endif

                                            </div>

                                        </td>

                                    @endif

                                </tr>

                                @endforeach

                            </tbody>

                            <tfoot>

                                <tr class="table-active">

                                    <th style="display: none;"></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                    <th></th>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- CREATE Modal Órden de Compra -->
<div class="modal fade" id="createModalContrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-plus-circle"></i> Nuevo Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ action('ContratoController@store') }}" class="was-validated" id="contratoForm">

                @csrf

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="id">Nombre Contrato</label>

                            <input type="text" class="form-control" id="contratoCreate" name="nombreContrato" placeholder="Ingrese el Nonbre del Contrato" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Nombre del Contrato

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="ordenCompra_id">No. Órden de Compra</label>

                            <select name="ordenCompra_id" id="ordenCompra_id" class="form-control selectpicker" data-live-search="true" title="Seleccione el No. de su Órden de Compra" required>

                                @foreach($ocs as $oc)

                                    <option value="{{ $oc->id }}">{{ $oc->OC }}</option>
                                                                
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="nombreActividad">Fecha Inicio Contrato</label>

                            <input type="text" id="fechaInicio" name="fechaInicio" class="form-control" placeholder="Fecha de Inicio del Contrato" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Fecha de Inicio del Contrato

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="nombreActividad">Fecha Término Contrato</label>

                            <input type="text" id="fechaTermino" name="fechaTermino" class="form-control" placeholder="Fecha de Término del Contrato" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Fecha de Término del Contrato

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-4 mb-3">

                            <label for="numeroBoleta">Número de Boleta de Garantía</label>
                                                                              
                            <input type="text" class="form-control" id="numeroBoletaCreate" name="numeroBoleta" placeholder="Ingrese el Número de la Boleta" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Número de la Boleta de Garantía

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label for="banco">Seleccione el Banco...</label>

                            <select name="banco" id="bancoCreate" class="form-control selectpicker" title="Banco" required>

                                <option>Banco de Chile</option>
                                <option>Banco Estado</option>
                                <option>Banco Internacional</option>
                                <option>Scotiabank Chile</option>
                                <option>Banco de Crédito e Inversiones</option>
                                <option>Banco de Crédito e Inversiones</option>
                                <option>Corpbanca</option>
                                <option>Banco Bice</option>
                                <option>HSBC Bank (Chile)</option>
                                <option>Banco Santander</option>
                                <option>Banco Itaú Chile</option>
                                <option>Banco Security</option>
                                <option>Banco Falabella</option>
                                <option>Deutsche Bank</option>
                                <option>Banco RIpley</option>
                                <option>Rabobank Chile</option>
                                <option>Banco Consorcio</option>
                                <option>Banco Penta</option>
                                <option>Banco Paris</option>
                                <option>Banco Bilbao Vizcaya Argentaria (BBVA)</option>
                                <option>Banco BTG Pactual Chile</option>
                                <option>Banco Do Brasil</option>
                                <option>JP Morgan Chase Bank</option>
                                <option>Banco de la Nacion Argentina</option>
                                <option>The Bank of Tokyo-Mitsubishi UFJ</option>

                            </select>
                                                                              
                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Banco de la Boleta de Garantía

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="montoBoleta">Monto de Boleta de Garantía</label>
                                                                              
                            <input type="text" class="form-control" id="montoBoletaCreate" name="montoBoleta" placeholder="Ingrese el Monto de la Boleta" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Monto de la Boleta de Garantía

                            </div>
                        

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-4 mb-3">

                            <label for="tipoContrato">Tipo Contrato</label>

                            <select name="tipoContrato" id="tipoContratoCreate" class="form-control selectpicker" title="Tipo Contrato" required>

                                <option>Menor a 500 UTM</option>
                                <option>Mayor o Igual a 500 UTM</option>

                            </select>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit" form="contratoForm">

                            <i class="fas fa-save"></i>

                            Guardar Contrato

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
<!-- END CREATE Modal Contrato -->

<!-- Update Modal Contrato -->
<div class="modal fade" id="updateContratoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-edit"></i> Modificar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="#" class="was-validated" id="updateContratoForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Actualizar">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="id">Nombre Contrato</label>

                            <input type="text" class="form-control" id="nombreContratoUpdate" name="nombreContrato" placeholder="Ingrese el Nombre del Contrato" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Nombre del Contrato

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="ordenCompra_id">No. Órden de Compra</label>

                            <select name="ordenCompra_id" id="ordenCompra_idUpdate" class="form-control selectpicker" data-live-search="true" title="Seleccione el No. de su Órden de Compra" required>

                                @foreach($ocs as $oc)

                                    <option value="{{ $oc->id }}">{{ $oc->OC }}</option>
                                                                
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="nombreActividad">Fecha Inicio Contrato</label>

                            <input type="text" id="fechaInicioUpdate" name="fechaInicio" class="form-control" placeholder="Fecha de Inicio del Contrato" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Fecha de Inicio del Contrato

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="nombreActividad">Fecha Término Contrato</label>

                            <input type="text" id="fechaTerminoUpdate" name="fechaTermino" class="form-control" placeholder="Fecha de Término del Contrato" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese la Fecha de Término del Contrato

                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-4 mb-3">

                            <label for="numeroBoleta">Número de Boleta de Garantía</label>
                                                                              
                            <input type="text" class="form-control" id="numeroBoletaUpdate" name="numeroBoleta" placeholder="Ingrese el Número de la Boleta" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Número de la Boleta de Garantía

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label for="banco">Seleccione el Banco...</label>

                            <select name="banco" id="bancoUpdate" class="form-control selectpicker" title="Banco" required>

                                <option>Banco de Chile</option>
                                <option>Banco Estado</option>
                                <option>Banco Internacional</option>
                                <option>Scotiabank Chile</option>
                                <option>Banco de Crédito e Inversiones</option>
                                <option>Banco de Crédito e Inversiones</option>
                                <option>Corpbanca</option>
                                <option>Banco Bice</option>
                                <option>HSBC Bank (Chile)</option>
                                <option>Banco Santander</option>
                                <option>Banco Itaú Chile</option>
                                <option>Banco Security</option>
                                <option>Banco Falabella</option>
                                <option>Deutsche Bank</option>
                                <option>Banco RIpley</option>
                                <option>Rabobank Chile</option>
                                <option>Banco Consorcio</option>
                                <option>Banco Penta</option>
                                <option>Banco Paris</option>
                                <option>Banco Bilbao Vizcaya Argentaria (BBVA)</option>
                                <option>Banco BTG Pactual Chile</option>
                                <option>Banco Do Brasil</option>
                                <option>JP Morgan Chase Bank</option>
                                <option>Banco de la Nacion Argentina</option>
                                <option>The Bank of Tokyo-Mitsubishi UFJ</option>

                            </select>
                                                                              
                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Banco de la Boleta de Garantía

                            </div>

                        </div>

                        <div class="col-md-4 mb-3">
                                                                              
                            <label for="montoBoleta">Monto de Boleta de Garantía</label>
                                                                              
                            <input type="text" class="form-control" id="montoBoletaUpdate" name="montoBoleta" placeholder="Ingrese el Monto de la Boleta" required>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Monto de la Boleta de Garantía

                            </div>
                        

                        </div>

                    </div>

                    <div class="form-row">
                        
                        <div class="col-md-4 mb-3">

                            <label for="tipoContrato">Tipo Contrato</label>

                            <select name="tipoContrato" id="tipoContratoUpdate" class="form-control selectpicker" title="Tipo Contrato" required>

                                <option>Menor a 500 UTM</option>
                                <option>Mayor o Igual a 500 UTM</option>

                            </select>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit" form="updateContratoForm">

                            <i class="fas fa-save"></i>

                            Guardar Contrato

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
<!-- End Modal Update Órden de Compra -->

<!-- Anular Modal Órden de Compra -->
<div class="modal fade" id="deleteContratoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="far fa-times-circle"></i> Anular Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="#" class="was-validated" id="deleteContratoForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Anular">
                

                <div class="modal-body">

                    <div class="form-row mb-3">

                        <label class="col-sm-3 col-form-label text-muted">Nombre Contrato</label><br>
                                                                        
                        <label class="col-sm-9 col-form-label h4" id="nombreContratoDelete">nombre_contrato</label>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                                                              
                            <label for="Motivo">Motivo Anulación</label>

                            <textarea type="text" class="form-control" id="motivoAnulacion" name="motivoAnulacion" placeholder="Ingrese el Motivo del porqué va a ANULAR el Contrato" required></textarea>

                            <div class="invalid-feedback">
                                                                                                                            
                                Por favor ingrese el Motivo de la Anulación del Contrato

                            </div>

                        </div>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-danger btn-block" type="submit">

                            <i class="far fa-times-circle"></i> Anular Contrato

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
<!-- End Modal Anular Contrato -->

<!-- Recepcionar Contrato MODAL -->
<div class="modal fade" id="recepcionarContratoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-inbox"></i> Recepcionar Contrato</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="#" class="was-validated" id="recepcionarForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="RecepcionadoC&S">

                <div class="modal-body">

                    <div class="form-row">
                        
                        <label for="fechaRecepcion" class="col-sm-4 col-form-label text-muted">Fecha Recepción</label>

                        <label for="fechaRecepcion" class="col-sm-8 col-form-label">{{ $dateCarbon }}</label>

                    </div>

                    <div class="form-row">

                        <label for="ID" class="col-sm-4 col-form-label text-muted">Nombre Contrato</label>

                         <div class="col-sm-8">
                             
                            <input type="" name="nombreContrato" id="nombreContratoRecepcionar" readonly class="form-control-plaintext">
                                 
                         </div>

                    </div>


                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Recepcionar Contrato

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

@endsection

@push('scripts')

    <script type="text/javascript">
        
        $(document).ready(function () {

            $( "#fechaInicio" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 1,
            });

            $( "#fechaInicioUpdate" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 1,
            });

            $( "#fechaTermino" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 1,
            });

            $( "#fechaTerminoUpdate" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                dayNamesMin: [ "Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                numberOfMonths: 1,
            });

            // Setup - add a text input to each footer cell
            $('#contratoTable tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Buscar">' );
            } );

            // Start Configuration DataTable
            var table = $('#contratoTable').DataTable({

                "paginate"  : true,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Órdenes de Compra generadas o asignadas aún...",
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

                $('#nombreContratoUpdate').val(data[1]);
                $('#ordenCompra_idUpdate').val(data[3]);
                $('#fechaInicioUpdate').val(data[4]);
                $('#fechaTerminoUpdate').val(data[5]);
                $('#numeroBoletaUpdate').val(data[6]);
                $('#bancoUpdate').val(data[7]);
                $('#montoBoletaUpdate').val(data[8]);
                $('#tipoContratoUpdate').val(data[9]);

                $('#updateContratoForm').attr('action', '/siscom/contratos/' + data[0]);
                $('#updateContratoModal').modal('show');

            });
            //End Edit Record

            //Start Delete Record
            table.on('click', '.delete', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                document.getElementById('nombreContratoDelete').innerHTML = data[1];
                
                $('#deleteContratoForm').attr('action', '/siscom/contratos/anular/' + data[0]);
                $('#deleteContratoModal').modal('show');

            });
            //End Delete Record

            //Comienzo de Recepción del Contrato
            table.on('click', '.recepcionar', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#nombreContratoRecepcionar').val(data[1]);

                $('#recepcionarForm').attr('action', '/siscom/contratos/recepcionar/' + data[0]);
                $('#recepcionarContratoModal').modal('show');

            });
            //Fin Recepción del COntrato
            
         });    

</script>

@endpush


