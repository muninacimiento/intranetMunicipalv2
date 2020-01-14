@extends('layouts.app')

@section('content')

<div id="allWindow">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-primary shadow">

                <div class="card-header text-center text-white bg-primary mb-3">

                    @include('siscom.menu')

                </div>

                    <div class="card-body">

                        @if (session('status'))
    
                            <div class="alert alert-success" role="alert">

                                {{ session('status') }}
                            
                            </div>

                        @endif

                        <a href="{{action('SCM_SolicitudController@index')}}" class="btn btn-link text-decoration-none float-right"> <i class="far fa-arrow-alt-circle-left"></i> Volver</a>

                        <h4> Solicitud No.  <input type="text" value="{{ $solicitud->id }}" readonly class="h4" style="border:0;" name="solicitudID" form="detalleSolicitudForm"> </h4>

                         <hr style="background-color: #d7d7d7">

                        <div class="py-3">

                            <div class="form-row mb-3">

                                <div class="col-md-12 mb-3">

                                    <label class="text-muted">Motivo/Destino</label>
                                                                
                                    <h5>{{ $solicitud->motivo }}</h5>
                                                            
                                </div>

                            </div>

                            <div class="form-row mb-3">

                                <div class="col-md-3 mb-3">
                                                          
                                    <label class="text-muted">Tipo Solicitud</label>

                                    <input type="text" value="{{ $solicitud->tipoSolicitud }}" readonly class="h5" style="border:0;" id="tipoSolicitud">

                                </div>

                                <div class="col-md-3 mb-3">
                                
                                    <label class="text-muted">Categoria Solicitud</label>
                                                                
                                    <h5>{{ $solicitud->categoriaSolicitud }}</h5> 

                                </div>

                                <div class="col-md-3 mb-3">

                                    <label class="text-muted">Fecha Solicitud</label>
                                                                
                                    <h5>{{ date('d-m-Y H:i:s', strtotime($solicitud->updated_at)) }}</h5>
                                                            
                                </div>

                                <div class="col-md-3">

                                    <label class="text-muted">Solicitante</label>
                                                                
                                    <h5>{{ $solicitud->nameUser }}</h5>
                                                            
                                </div>

                            </div>

                            <input type="button" id="more" value="Ver Detalle de su Actividad" onclick="$('.divActividad').slideToggle(function(){$('#more').html($('.divActividad').is(':visible')?'Ver Menos Detalles':'Ver Más Detalles');});" class="btn btn-primary btn-block btn-sm" disabled>

                            <div class="form-row mb-3 divActividad " style="display:none">
                                
                                <table id="actividad" class="display col-md-12" style="font-size: 0.85em;" width="100%">

                                    <thead>

                                        <tr>
                                            <th></th>
                                            <th style="display: none">ID</th>
                                            <th>Actividad</th>
                                            <th>Objetivo</th>
                                            <th width="15%">Fecha</th>
                                            <th width="10%">Hora</th>
                                            <th style="display: none">Lugar</th>
                                            <th style="display: none">Descripción</th>
                                            <th style="display: none">Participantes</th>
                                            <th style="display: none">Cuenta Presupuestaria</th>
                                            <th style="display: none">Cuenta Complementaria</th>
                                            <th style="display: none">Observación</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>
                                                
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Modificar la Solicitud">

                                                    <input type="button" id="btnActividad" value="Editar" class="btn btn-warning btn-sm mr-1 edit" disabled>

                                                </a>
                                            </td>
                                            <td style="display: none">{{ $solicitud->id }}</td>
                                            <td>{{ $solicitud->nombreActividad }}</td>
                                            <td>{{ $solicitud->objetivoActividad}}</td>
                                            <td width="15%">{{ $solicitud->fechaActividad }}</td>
                                            <td width="10%">{{ $solicitud->horaActividad}}</td>
                                            <td style="display: none">{{ $solicitud->lugarActividad}}</td>
                                            <td style="display: none">{{ $solicitud->descripcionActividad}}</td>
                                            <td style="display: none">{{ $solicitud->participantesActividad}}</td>
                                            <td style="display: none">{{ $solicitud->cuentaPresupuestaria}}</td>
                                            <td style="display: none">{{ $solicitud->cuentaComplementaria}}</td>
                                            <td style="display: none">{{ $solicitud->obsActividad}}</td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                            <hr style="background-color: #d7d7d7">

                            <div style="font-size: 0.8em;" class="bg-warning rounded-top rounded-bottom shadow p-3">

                                <h5 class="text-center">

                                    <i class="fas fa-hourglass-half px-2"></i>

                                    TimeLine Solicitud

                                </h5>
                                
                                <table class="table table-striped table-sm table-hover" width="100%">
                                        
                                    <thead>
                                        
                                        <tr>
                                            
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Responsable</th>
                                            <th>Comprador Asignado</th>
                                            <th>Comprador Suplencia</th>
                                            
                                        </tr>

                                    </thead>

                                    <tbody>

                                    @foreach($move as $m)
                                        
                                        <tr>

                                            <td>{{ date('d-m-Y H:i:s', strtotime($m->date)) }}</td>
                                            <td>{{ $m->status }}</td>
                                            <td>{{ $m->name }}</td>
                                            @if($m->status == 'Asignada a Comprador')
                                                <td>{{ $solicitud->compradorTitular }}</td>
                                            @else
                                                <td></td>
                                            @endif

                                            @if($m->status == 'Re-Asignada a Comprador')
                                                <td>{{ $solicitud->compradorSuplencia }}</td>
                                             @else
                                                <td></td>
                                            @endif

                                        </tr>

                                    @endforeach

                                        <tr>
                                            
                                            <td><strong>Observación Anulación</strong></td>
                                            <td colspan="4"><em>{{ $solicitud->motivoAnulacion }}</em></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                           
                            <div class="py-3">

                                <form method="POST" action="{{ action('SCM_SolicitudController@store') }}" class="was-validated" id="detalleSolicitudForm">

                                    @csrf

                                    <input type="hidden" name="flag" value="detalleSolicitud">

                                    <div class="form-row bg-dark p-3 text-white rounded-top">

                                        <h5> 

                                            Detalle de la Solicitud <i class="fas fa-shopping-basket px-2"></i>

                                        </h5>

                                    </div>

                                    <div class="form-row bg-dark p-3 ">
                                        
                                        <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createProductModal">
                                                    
                                            <button class="btn btn-primary btn-sm">
                                            
                                                Nuevo Producto    

                                            </button>

                                        </a>   

                                    </div>                                    

                                    <div class="form-row bg-dark p-2 text-white">

                                        <div class="col-md-8 mb-3">
                                                
                                            <label for="flagIdProducto">Productos</label>

                                            <select name="flagIdProducto" id="flagIdProducto" class="form-control selectpicker" data-live-search="true" title="Seleccione el Producto que desea solicitar..." required>

                                                @foreach($products as $product)

                                                    <option value="{{ $product->id }}">{{ $product->Producto }}</option>
                                                            
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="col-md-2 mb-3">
                                                
                                            <label for="flagCantidad">Cantidad</label>

                                            <input type="number" name="flagCantidad" id="flagCantidad" class="form-control" required>

                                        </div>

                                        <div class="col-md-2 mb-3">
                                                
                                            <label for="flagValorUnitario">Valor Unitario $</label>

                                            <input type="number" name="flagValorUnitario" id="flagValorUnitario" class="form-control" required>

                                        </div>

                                    </div>

                                    <div class="form-row mb-5 bg-dark p-2 text-white rounded-bottom">
                                        
                                        <div class="col-md-12 mb-3">
                                            
                                            <label for="flagEspecificacion">Especificación</label>

                                            <textarea type="text" class="form-control" id="flagEspecificacion" name="flagEspecificacion" placeholder="Ingrese mayor Especificación de su Producto" required></textarea>

                                        </div>

                                        <div class="col-md-12 mb-2">

                                            @if( $solicitud->estado_id < 3)
                                                
                                                <button class="btn btn-block btn-warning" type="submit">

                                                    <i class="fas fa-cart-arrow-down"></i>

                                                    Agregar Producto

                                                </button>

                                            @else

                                                <button class="btn btn-block btn-warning" type="submit" disabled="true">

                                                    <i class="fas fa-cart-arrow-down"></i>

                                                    Agregar Producto

                                                </button>

                                            @endif

                                        </div>

                                    </div>

                                </form>

                                <div>

                                    <table class="display" id="detalleSolicitud" width="100%">

                                        <thead>

                                            <tr>

                                                <th style="display: none;">ID</th>

                                                <th>Producto</th>

                                                <th>Especificación</th>

                                                <th>Cantidad</th>

                                                <th>Valor</th>
                                                        
                                                <th>SubTotal</th>

                                                <th></th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @foreach($detalleSolicitud as $detalle)

                                            <tr>

                                                <td style="display: none;">{{ $detalle->id }}</td>

                                                <td>{{ $detalle->Producto }}</td>

                                                <td>{{ $detalle->especificacion }}</td>

                                                <td>{{ $detalle->cantidad }}</td>

                                                <td>{{ $detalle->valorUnitario }}</td>

                                                <td class="subtotal">{{ $detalle->SubTotal }}</td>  

                                                @if( $solicitud->estado_id < 3)                                             

                                                    <td>
                                                            
                                                        <a href="#" class="btn btn-primary btn-sm editDetalle" data-toggle="tooltip" data-placement="bottom" title="Editar Producto">
                                                                    
                                                            <i class="far fa-edit"></i>

                                                        </a>

                                                        <a href="#" class="btn btn-danger btn-sm deleteDetalle" data-toggle="tooltip" data-placement="bottom" title="Eliminar Producto">
                                                                    
                                                            <i class="far fa-trash-alt"></i>

                                                        </a>

                                                    </td>

                                                @else

                                                    <td></td>

                                                @endif

                                            </tr>

                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                                

                            </div>

                            <div class="form-row">

                                <div class="col-md-12 mb-2">
                                
                                    <form method="POST" action="{{ action('SCM_SolicitudController@update', $solicitud->id) }}">

                                        @csrf

                                        <div class="form-row mb-3">
                                            
                                            <h5 class="text-muted">Total Solicitud :&nbsp;$&nbsp;</h5>

                                            <input type="text" name="totalSolicitud" id="total" readonly style="border: 0;font-size: 1.5em;">

                                            

                                        </div>

                                        <input type="hidden" name="flag" value="Confirmar">

                                        @if( $solicitud->estado_id == 1 || $solicitud->estado_id == 2)

                                            <button type="submit" class="btn btn-success btn-block"> 

                                                <i class="fas fa-check-circle"></i>

                                                Confirmar Solicitud

                                            </button>

                                        @else

                                            <button type="submit" class="btn btn-success btn-block" disabled="true"> 

                                                <i class="fas fa-check-circle"></i>

                                                Confirmar Solicitud

                                            </button>

                                        @endif

                                    </form>    

                                </div>

                                <div class="col-md-12">
                                    
                                    <a href="{{url('/siscom/solicitud')}}" class="text-decoration-none">

                                        <button type="submit" class="btn btn-secondary btn-block"> 

                                            <i class="fas fa-arrow-left"></i>
                                            
                                            Atrás

                                        </button>

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>
                
                </div>
            </div>

        </div>

    </div>
        
</div>

<!-- UPDATE Modal Actividad-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h3 class="modal-title" id="exampleModalLabel">Modificar Datos de la Actividad <i class="fas fa-edit"></i>  </h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            <form method="POST" action="/siscom/solicitud" class="was-validated" id="updateForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Actividad">

                <div class="modal-body">
        
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
                                
                                <option value=""></option>
                                <option value="08:00:00">08:00</option>
                                <option value="09:00:00">09:00</option>
                                <option value="10:00:00">10:00</option>
                                <option value="11:00:00">11:00</option>
                                <option value="12:00:00">12:00</option>
                                <option value="13:00:00">13:00</option>
                                <option value="14:00:00">14:00</option>
                                <option value="15:00:00">15:00</option>
                                <option value="16:00:00">16:00</option>
                                <option value="17:00:00">17:00</option>
                                <option value="18:00:00">18:00</option>
                                <option value="19:00:00">19:00</option>
                                <option value="20:00:00">20:00</option>
                                <option value="21:00:00">21:00</option>
                                <option value="22:00:00">22:00</option>
                                
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

                            <input type="text" class="form-control" name="cuentaComplementaria" id="cuentaComplementaria" placeholder="Cuál es el número de la Cuenta Complementaria ?"  />

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

                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Actualizar Actividad

                        </button>

                    </div>
                            
                </div>

            </form>
        </div>

    </div>

</div>
<!-- UPDATE Modal ACTIVIDAD -->

<!-- UPDATE Modal Detalle Solicitud-->
<div class="modal fade" id="updateDetalleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h3 class="modal-title" id="exampleModalLabel">Modificar Productos de la Solicitud <i class="fas fa-edit"></i>  </h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            <form method="POST" action="/siscom/solicitud" class="was-validated" id="updateDetalleForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="UpdateProducts">

                <div class="modal-body">
        
                    <div class="col-md-12 mb-3">
                                                
                        <label for="Producto">Producto</label>

                        <input type="text" id="Producto" class="form-control" disabled>
                        
                    </div>

                    <div class="col-md-12 mb-3">
                                                
                        <label for="Especificacion">Especificacion</label>

                        <textarea type="text" class="form-control" name="Especificacion" id="Especificacion" required></textarea>
                        
                    </div>

                    <div class="col-md-12 mb-3">
                                                
                        <label for="Cantidad">Cantidad</label>

                        <input type="number" name="Cantidad" id="Cantidad" class="form-control" required>

                    </div>

                    <div class="col-md-12 mb-3">
                                                
                        <label for="ValorUnitario">Valor Unitario $</label>

                        <input type="number" name="ValorUnitario" id="ValorUnitario" class="form-control" required>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Actualizar Producto

                        </button>

                    </div>
                            
                </div>

            </form>
        </div>

    </div>

</div>
<!-- UPDATE Modal Detalle Solicitud -->

<!-- DELETE Modal Detalle Solicitud -->
<div class="modal fade" id="deleteDetalleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h4 class="modal-title" id="exampleModalLabel"> Eliminar Producto de la Solicitud <i class="fas fa-times-circle"></i></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="/siscom/solicitud" class="was-validated" id="deleteDetalleForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="DeleteProduct">

                <div class="modal-body">

                    <p>Esta Ud. segur@ de querer Eliminar el Producto : </p>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">

                            <label class="h5" id="deleteProducto">deleteProducto</label>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button class="btn btn-danger btn-block" type="submit">

                            <i class="fas fa-times-circle"></i> Eliminar Producto

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- End Modal Create Solicitud -->

<!-- Modal Create Product -->
<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"> Nuevo Producto <i class="fas fa-plus-circle"></i></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ action('ProductController@store') }}" class="was-validated" id="createForm">

                @csrf

                

                <div class="modal-body">

                    <div class="col-md-12 mb-3">
                                                
                        <label for="Product">Nuevo Producto</label>
                        
                        <input type="text" name="name" class="form-control" required>

                        <div class="invalid-feedback">
                                                                                                    
                                Por favor ingrese el Producto a solicitar

                            </div>

                    </div>

                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit" form="createForm">

                            <i class="fas fa-save"></i>

                            Guardar Nuevo Producto

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

@endsection

@push('scripts')

<!-- JQuery DataTable -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>

<!-- JQuery DatePicker -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Boostrap Select -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>

<script>
    
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

        var tSolicitud = $('#tipoSolicitud').val();

        if (tSolicitud === "Actividad") {

            $('input[type="button"]').removeAttr('disabled');

        }

          // Start Configuration DataTable Actividad
            var table = $('#actividad').DataTable({
                "paging":   false,
                "ordering": false,
                "info":     false,
                "searching" : false,
            });

            //Start Edit Record
            table.on('click', '.edit', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                $('#nombreActividad').val(data[2]);
                $('#fechaActividad').val(data[4]);
                $('#horaActividad').val(data[5]);
                $('#lugarActividad').val(data[6]);
                $('#objetivoActividad').val(data[3]);
                $('#descripcionActividad').val(data[7]);
                $('#participantesActividad').val(data[8]);
                $('#cuentaPresupuestaria').val(data[9]);
                $('#cuentaComplementaria').val(data[10]);
                $('#obsActividad').val(data[11]);

                $('#updateForm').attr('action', '/siscom/solicitud/' + data[1]);
                $('#exampleModal').modal('show');

            });
            //End Edit Record

            // Start Configuration DataTable Detalle Solicitud
            var table1 = $('#detalleSolicitud').DataTable({
                "paginate"  : true,

                "ordering": false,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen Productos en su Solicitud, aún...",
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

            //Start Edit Record Detalle Solicitud
            table1.on('click', '.editDetalle', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var dataDetalle = table1.row($tr).data();

                console.log(dataDetalle);

                $('#Producto').val(dataDetalle[1]);
                $('#Especificacion').val(dataDetalle[2]);
                $('#Cantidad').val(dataDetalle[3]);
                $('#ValorUnitario').val(dataDetalle[4]);

                $('#updateDetalleForm').attr('action', '/siscom/solicitud/' + dataDetalle[0]);
                $('#updateDetalleModal').modal('show');

            });
            //End Edit Record Detalle Solicitud

            //Start Delete Record Detalle Solicitud 
            table1.on('click', '.deleteDetalle', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var dataDetalle = table1.row($tr).data();

                console.log(dataDetalle);

                document.getElementById('deleteProducto').innerHTML = dataDetalle[1];
                
                $('#deleteDetalleForm').attr('action', '/siscom/solicitud/' + dataDetalle[0]);
                $('#deleteDetalleModal').modal('show');

            });
            //End Delete Record Detalle Solicitud

        //Recorremos la Tabla y Sumamos cada Subtotal
        //var cls = document.getElementById("detalleSolicitud").getElementsByTagName("td");
        //var sum = 0;
        //for (var i = 0; i < cls.length; i++){
        //    if(cls[i].className == "subtotal"){
        //        sum += isNaN(cls[i].innerHTML) ? 0 : parseInt(cls[i].innerHTML);
        //    }
        //}

        //$('#total').val(sum);

        var total = 0;
        $('#detalleSolicitud').DataTable().rows().data().each(function(el, index){
          //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
          total += parseInt(el[5]);
        });

        $('#total').val(total);

        console.log(total);
        
    });


</script>

@endpush