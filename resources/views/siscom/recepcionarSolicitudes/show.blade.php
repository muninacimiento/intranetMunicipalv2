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
                        <h4>Recepcionar Solicitud No.  <input type="text" value="{{ $solicitud->id }}" readonly class="h4" style="border:0;" name="solicitudID" form="detalleSolicitudForm"> </h4>
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
                                    <label class="text-muted">Tipo Solicitud</label> <br>
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
                            <hr style="background-color: #d7d7d7">
                            <div style="font-size: 0.8em;" class="bg-warning rounded-top rounded-bottom shadow p-3 mb-5">
                                <h5 class="text-center">
                                <i class="icofont-sand-clock"></i> TimeLine Solicitud
                                </h5>                                
                                <table class="table table-striped table-sm table-hover" style="font-size: 1.2em" width="100%">                                        
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
                                        <tr>                                            
                                            <td><strong>Observación Rechazo</strong></td>
                                            <td colspan="4"><em>{{ $solicitud->obsRechazo }}</em></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                           
                            <div>
                                <div class="mb-2 h5">Productos de la Solicitud</div> <br>
                                <div class="col">
                                    <table class="display" id="detalleSolicitud" width="100%" style="font-size: 0.9em">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">ID</th>
                                                <th>Producto</th>
                                                <th>Especificación</th>
                                                <th>Cantidad</th>
                                                <th>Valor</th>                                                        
                                                <th>SubTotal</th>
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="col-md-12">
                                    
                                    <a href="{{ route('admin.recepcionarSolicitud') }}" class="text-decoration-none">

                                        <button type="submit" class="btn btn-secondary btn-block"> 

                                            <i class="icofont-arrow-left"></i>
                                            
                                            Volver

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