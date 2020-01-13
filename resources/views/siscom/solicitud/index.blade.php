<!--
/*
 *  JFuentealba @itux
 *  created at September 10, 2019 - 11:46 am
 *  updated at October 24, 2019 - 10:07 am
 */
-->

@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-primary shadow">

                <div class="card-header text-center text-white bg-primary">

                    @include('siscom.menu')

                </div>


                <div class="card-body">

                    <div class="row mt-5">

                        <div class="col-md-6 text-center">
                            
                            <h3>Listado de Solicitudes Realizadas</h3>

                            <div class="text-secondary">

                                {{ $dateCarbon }}

                            </div>

                        </div>

                        <!-- Button trigger CrearSolicitudModal -->
                        <div class="col-md-6">
                            
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createSolicitudModal">

                                <button class="btn btn-success btn-block boton">

                                    <i class="fas fa-plus"></i>

                                    Nueva Solicitud

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

                    
                    <div>

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

                                    <th style="display: none">Decreto Programa</th>

                                    <th style="display: none">Nombre Programa</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($solicituds as $solicitud)

                                <tr>

                                    <td>{{ $solicitud->id }}</td>

                                    <td>{{ $solicitud->estado }}</td>

                                    <td>{{ $solicitud->iddoc }}</td>

                                    <td>{{ date('d-m-Y H:i:s', strtotime($solicitud->updated_at)) }}</td>

                                    <td>{{ $solicitud->compradorTitular }}</td>

                                    <td>{{ $solicitud->motivo }}</td>

                                    <td>{{ $solicitud->tipoSolicitud }}</td>
                                    
                                    <td>{{ $solicitud->categoriaSolicitud }}</td>

                                    <td style="display: none">{{ $solicitud->decretoPrograma }}</td>

                                    <td style="display: none">{{ $solicitud->nombrePrograma }}</td>

                                    @if( $solicitud->estado == 'Anulada')

                                        <td>

                                                <a href="{{ route('solicitud.show', $solicitud->id) }}" class="btn btn-outline-secondary btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="Ver el Detalle de la Solicitud">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                        </td>

                                    @else

                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                @if( $solicitud->estado == 'Creada')

                                                @else

                                                    <a href="{{ route('solicitud.pdf', $solicitud->id) }}" class="btn btn-outline-success btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="Imprimir Solicitud">

                                                        <i class="fas fa-print"></i>

                                                    </a>

                                                @endif

                                                <a href="{{ route('solicitud.show', $solicitud->id) }}" class="btn btn-outline-secondary btn-sm mr-1" data-toggle="tooltip" data-placement="bottom" title="Ver en Detalle la Solicitud y Agregar Productos">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="#" class="btn btn-outline-primary btn-sm mr-1 edit" data-toggle="tooltip" data-placement="bottom" title="Modificar la Solicitud">
                                        
                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <a href="#" class="btn btn-outline-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="Anular Solicitud">

                                                    <i class="fas fa-trash"></i>

                                                </a>

                                            </div>

                                        </td>

                                    @endif

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

<!-- Modal Create Solicitud -->
<div class="modal fade" id="createSolicitudModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"> Nueva Solicitud <i class="fas fa-plus-circle"></i></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ action('SCM_SolicitudController@store') }}" class="was-validated" id="createForm">

                @csrf

                <input type="hidden" name="flag" value="Solicitud">

                <div class="modal-body">

                    <div class="divScroll">

                        <h5 class="text-muted text-center mb-5">Encabezado de la Solicitud</h5>

                        <div class="form-row">

                            <div class="col-md-4">
                            </div>
                                
                            <div class="form-group col-md-4 mb-3 text-center">

                                <select name="areaGestion" id="areaGestion" class="custom-select" required>

                                    <option value="">Seleccione el Área de Gestión</option>

                                    <option value="Interna">Interna</option>
                                    <option value="Programa">Programa</option>

                                </select>

                                <div class="invalid-feedback">

                                    Por favor seleccione el Área de Gestión Presupuestaria

                            </div>

                            <div class="col-md-4">
                            </div>

                        </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-12 mb-3">
                                                                                  
                                <label for="Motivo">Motivo</label>

                                <textarea type="text" class="form-control" id="motivo_create" name="motivo" placeholder="Ingrese el Motivo de su Solicitud" required disabled></textarea>

                                <div class="invalid-feedback">
                                                                                                
                                    Por favor ingrese el Motivo de la Solicitud

                                </div>

                            </div>

                        </div>

                        <div class="form-row mb-3">

                            <div class="form-group col-md-6 mb-3">

                                <label for="tipoSolicitud">Tipo Solicitud</label>

                                <select name="tipoSolicitud" id="tipoSolicitud_create" class="custom-select" required>

                                    <option value="">Selecciones el Tipo de Solicitud</option>

                                    <option value="Operacional">Operacional</option>
                                    <option value="Actividad">Actividad</option>

                                </select>

                                <div class="invalid-feedback">

                                    Por favor seleccione el Tipo de Solicitud

                                </div>

                            </div>

                            <div class="form-group col-md-6">

                                <label for="categoriaSolicitud">Categoria Solicitud</label>

                                <select name="categoriaSolicitud" id="categoriaSolicitud_create" class="custom-select" required>

                                </select>
                                                                                            
                                <div class="invalid-feedback">
                                                                                                
                                    Por favor seleccione la Categoria de la Solicitud

                                </div>
                                                                                
                            </div>  

                        </div>

                        <div class="form-row mb-5">

                            <div class="col-md-6">
                                                                                          
                                <label for="decretoActividad">No. Decreto del Programa</label>

                                <input type="text" id="decretoPrograma_create" name="decretoPrograma" class="form-control" placeholder="Cuál es el Número de su Decreto?" required/>

                                <div class="invalid-feedback">
                                                                                                        
                                    Por favor ingrese el No. de Decreto de su Programa

                                </div>

                            </div>

                            <div class="col-md-6">
                                                                                          
                                <label for="nombrePrograma">Nombre del Programa 

                                    <small class="text-muted">(Programa Presupuestario)</small>

                                </label>

                                <input type="text" id="nombrePrograma_create" name="nombrePrograma" class="form-control" placeholder="Cuál es el Nombre del Programa a Ejecutar?" required/>

                                <div class="invalid-feedback">
                                                                                                        
                                    Por favor ingrese el Nombre de su Programa

                                </div>

                            </div>

                        </div>


    <!-- ### Form ACTIVIDADES ### -->

                        <div class="mr-5">
                            
                            <h5 class="text-muted text-center">

                                Detalle de la Actividad

                                <small>(si corresponde)</small>

                            </h5>

                        </div>
                        
                            <div class="form-row mb-3">

                                <div class="col-md-12">
                                                                                          
                                    <label for="nombreActividad">Nombre de la Actividad</label>

                                    <textarea type="text" class="form-control" name="nombreActividad" id="nombreActividad" placeholder="Cuál es el Nombre de su Actividad ?" required></textarea>

                                    <div class="invalid-feedback">
                                                                                                        
                                        Por favor ingrese el Nombre de su Actividad

                                    </div>

                                </div>

                            </div>

                            <div class="form-row mb-3">

                                <div class="col-sm-6">

                                    <label for="nombreActividad">Fecha de la Actividad</label>

                                    <input type="text" id="fechaActividad" name="fechaActividad" class="form-control" placeholder="Cuál es la Fecha de su Actividad?" required/>

                                    <div class="invalid-feedback">
                                                                                                        
                                        Por favor ingrese la Fecha de su Actividad

                                    </div>

                                </div>

                                <div class="col-sm-6">

                                    <label for="horaActividad">Hora de la Actividad</label>

                                    <select name="horaActividad" id="horaActividad" class="form-control" required title="A qué Hora se desarrollará su Actividad?">
                                    
                                        <option></option>
                                        <option>08:00</option>
                                        <option>09:00</option>
                                        <option>10:00</option>
                                        <option>11:00</option>
                                        <option>12:00</option>
                                        <option>13:00</option>
                                        <option>14:00</option>
                                        <option>15:00</option>
                                        <option>16:00</option>
                                        <option>17:00</option>
                                        <option>18:00</option>
                                        <option>19:00</option>
                                        <option>20:00</option>
                                        <option>21:00</option>
                                        <option>22:00</option>
                                    
                                    </select>

                                    <div class="invalid-feedback">
                                                                                                        
                                        Por favor ingrese la Hora en que comenzará su Actividad

                                    </div>

                                </div>

                            </div>

                            <div class="form-row mb-3">

                                <div class="col-md-12">
                                                                                          
                                    <label for="lugarActividad">Lugar de la Actividad</label>

                                    <textarea type="text" class="form-control" name="lugarActividad" id="lugarActividad" placeholder="Dónde se llevará acabo su Actividad ?" required></textarea>

                                    <div class="invalid-feedback">
                                                                                                        
                                        Por favor ingrese el Lugar donde se llevará acabo su Actividad

                                    </div>

                                </div>

                            </div>

                            <div class="form-row mb-3">

                                <div class="col-md-12">
                                                                                          
                                    <label for="objetivoActividad">Objetivo de la Actividad</label>

                                    <textarea type="text" class="form-control" name="objetivoActividad" id="objetivoActividad" placeholder="Cuál es el Propósito u Objetivo de su Actividad ?" required></textarea>

                                    <div class="invalid-feedback">
                                                                                                        
                                        Por favor ingrese el Objetivo de su Actividad

                                    </div>

                                </div>

                            </div>

                            <div class="form-row mb-3">

                                <div class="col-md-12">
                                                                                          
                                    <label for="descripcionActividad">Descripción de la Actividad</label>

                                    <textarea type="text" class="form-control" name="descripcionActividad" id="descripcionActividad" placeholder="Por favor, describa con mayor detalle su Actividad" required></textarea>

                                    <div class="invalid-feedback">
                                                                                                       
                                        Por favor ingrese la Descripción de su Actividad

                                    </div>

                                </div>

                            </div>

                            <div class="form-row mb-3">

                                <div class="col-md-12">
                                                                                          
                                    <label for="participantesActividad">Participantes de la Actividad</label>

                                    <textarea type="text" class="form-control" name="participantesActividad" id="participantesActividad" placeholder="Qué Autoridad, Organización, Persona Natural o Jurídica, por ejemplo,  particaparán de su Actividad" required></textarea>

                                    <div class="invalid-feedback">
                                                                                                        
                                        Por favor ingrese los Participantes de su Actividad

                                    </div>

                                </div>

                            </div>                            

                            <div class="form-row mb-3">

                                <div class="col-md-6">

                                    <label for="cuentaPresupuestaria">Cuenta Presupuestaria</label>

                                    <select name="cuentaPresupuestaria" id="cuentaPresupuestaria" class="custom-select" required>

                                        <option value="">Selecciones la Cuenta Presupuestaria</option>

                                        <option value="Municipal">Municipal</option>

                                        <option value="Complementaria">Complementaria</option>

                                    </select>

                                    <div class="invalid-feedback">
                                                                                                            
                                        Por favor ingrese la Cuenta Presupuestaria de su Actividad

                                    </div>

                                </div>

                                <div class="col-md-6">
                                                                                       
                                    <label for="cuentaComplementaria">No. de Cuenta Complementaria</label>

                                    <input type="text" class="form-control" name="cuentaComplementaria" id="cuentaComplementaria" placeholder="Cuál es el número de la Cuenta Complementaria ?" />

                                    <div class="invalid-feedback">
                                                                                                        
                                        Por favor ingrese el No. de la Cuenta Complementaria

                                    </div>

                                </div>
                                    
                            </div>

                            <div class="form-row mb-3">

                                <div class="col-md-12">
                                                                                          
                                    <label for="obsActividad">Observaciones de la Actividad</label>

                                    <textarea type="text" class="form-control" name="obsActividad" id="obsActividad" placeholder="Tiene alguna Observación que quiera indicar...  ?" required></textarea>

                                    <div class="invalid-feedback">
                                                                                                        
                                        Por favor ingrese las Observaciones de su Actividad, si las tuviera

                                    </div>

                                </div>

                            </div>

                    </div>

                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit" form="createForm">

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
<!-- End Modal Create Solicitud -->

<!-- Update Modal Solicitud -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h3 class="modal-title" id="exampleModalLabel"> Actualizar Solicitud <i class="fas fa-edit"></i></h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/solicitud') }}" class="was-validated" id="updateForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Actualizar">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="Motivo">Motivo</label>

                            <textarea type="text" class="form-control" id="motivo_update" name="motivo" placeholder="Ingrese el Motivo de su Solicitud" required></textarea>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Motivo de la Solicitud

                            </div>

                        </div>

                    </div>

                    <div class="form-row mb-5">

                        <div class="form-group col-md-6 mb-3">

                            <label for="tipoSolicitud">Tipo Solicitud</label>

                            <select name="tipoSolicitud" id="tipoSolicitud_update" class="custom-select" required>

                                <option>Operacional</option>
                                <option>Actividad</option>

                            </select>

                            <div class="invalid-feedback">

                                Por favor seleccione el Tipo de Solicitud

                            </div>

                        </div>

                        <div class="form-group col-md-6 mb-3">

                            <label for="categoriaSolicitud">Categoria Solicitud</label>

                            <select name="categoriaSolicitud" id="categoriaSolicitud_update" class="custom-select" required>

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

                            <input type="text" id="decretoPrograma_update" name="decretoPrograma" class="form-control" placeholder="Cuál es el Número de su Decreto?" required/>

                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el No. de Decreto de su Programa

                            </div>

                        </div>

                        <div class="col-md-6">
                                                                                          
                            <label for="nombrePrograma">Nombre del Programa 

                                <small class="text-muted">(Programa Presupuestario)</small>

                            </label>

                            <input type="text" id="nombrePrograma_update" name="nombrePrograma" class="form-control" placeholder="Cuál es el Nombre del Programa a Ejecutar?" required/>
                            
                            <div class="invalid-feedback">
                                                                                                        
                                Por favor ingrese el Nombre de su Programa

                            </div>

                        </div>
                    
                    </div>

                    <div class="mb-3 form-row" id="guardarForm">

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
<!-- End Modal Create Solicitud -->

<!-- DELETE Modal Solicitud -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h3 class="modal-title" id="exampleModalLabel"> Anular Solicitud <i class="fas fa-times-circle"></i></h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/solicitud') }}" class="was-validated" id="deleteForm">

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

                        <a href="/siscom/solicitud" class="btn btn-secondary btn-block" type="reset">

                            <i class="fas fa-arrow-left"></i> Atrás

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- End Modal Create Solicitud -->

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

            $( "#fechaActividad" ).datepicker({
                dateFormat: "yy-mm-dd",
                minDate: "+16d",
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

            //Start Edit Record
            table.on('click', '.edit', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#motivo_update').val(data[5]);

                if (($('#tipoSolicitud_update').val(data[6]))==='Solicitud General') {

                    $('#tipoSolicitud_update').val();    
                }
                else if (($('#tipoSolicitud_update').val(data[6]))==='Solicitud de Actividad'){

                    $('#tipoSolicitud_update').val();       
                }
                
                if (($('#categoriaSolicitud_update').val(data[7]))==='Stock de Oficina') {

                    $('#categoriaSolicitud_update').val();    
                }
                else if (($('#categoriaSolicitud_update').val(data[7]))==='Stock de Aseo'){

                    $('#categoriaSolicitud_update').val();       
                }
                else if (($('#categoriaSolicitud_update').val(data[7]))==='Stock de Gas'){

                    $('#categoriaSolicitud_update').val();       
                }
                else if (($('#categoriaSolicitud_update').val(data[7]))==='Compra'){

                    $('#categoriaSolicitud_update').val();       
                }

                $('#decretoPrograma_update').val(data[8]);
                $('#nombrePrograma_update').val(data[9]);
               

                $('#updateForm').attr('action', '/siscom/solicitud/' + data[0]);
                $('#updateModal').modal('show');

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

                document.getElementById('noSolicitud').innerHTML = data[0];
                document.getElementById('fechaSolicitud').innerHTML = data[3];
                document.getElementById('tipoSolicitud_anular').innerHTML = data[6];
                document.getElementById('categoriaSolicitud_anular').innerHTML = data[7];
                
                $('#deleteForm').attr('action', '/siscom/solicitud/' + data[0]);
                $('#deleteModal').modal('show');

            });
            //End Delete Record

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


