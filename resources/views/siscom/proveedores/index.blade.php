<!--
/*
 *  JFuentealba @itux
 *  created at December 26, 2019 - 11:28 pm
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
                            
                            <h3>Gestión de Proveedores</h3>

                            <div class="text-secondary">

                                {{ $dateCarbon }}

                            </div>

                        </div>

                        <!-- Button trigger CrearSolicitudModal -->
                        <div class="col-md-6">
                            
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createProveedorModal">

                                <button class="btn btn-success btn-block boton">

                                    <i class="fas fa-plus"></i>

                                    Nuevo Proveedor

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

                        <table class="display" id="proveedorTable" style="font-size: 0.8em;" width="100%">

                            <thead>

                                <tr class="table-active">

                                    <th>ID</th>

                                    <th>Rut</th>

                                    <th>Razón Social</th>

                                    <th>Alias</th>

                                    <th>Giro</th>

                                    <th style="display: none;">Dirección</th>

                                    <th style="display: none;">Ciudad</th>
                                    
                                    <th>Teléfono</th>

                                    <th>Correo</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($proveedores as $proveedor)

                                <tr>

                                    <td>{{ $proveedor->id }}</td>

                                    <td>{{ $proveedor->rut }}</td>

                                    <td>{{ $proveedor->razonSocial }}</td>

                                    <td>{{ $proveedor->alias }}</td>

                                    <td>{{ $proveedor->giro }}</td>

                                    <td style="display: none;">{{ $proveedor->direccion }}</td>

                                    <td style="display: none;">{{ $proveedor->ciudad }}</td>                                    
                                    
                                    <td>{{ $proveedor->telefono }}</td>

                                    <td>{{ $proveedor->correo }}</td>

                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <a href="#" class="btn btn-outline-primary btn-sm mr-1 edit" data-toggle="tooltip" data-placement="bottom" title="Modificar Proveedor">
                                        
                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <a href="#" class="btn btn-outline-danger btn-sm delete" data-toggle="tooltip" data-placement="bottom" title="Eliminar Proveedor">

                                                    <i class="fas fa-trash"></i>

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

<!-- Modal Create Proveedor -->
<div class="modal fade" id="createProveedorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"> Nueva Proveedor <i class="fas fa-plus-circle"></i></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ action('ProveedoresController@store') }}" class="was-validated" id="proveedorForm">

                @csrf

                <input type="hidden" name="flag" value="CrearProveedor">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="Rut">Rut</label>

                            <input type="text" class="form-control" id="rutCreate" name="rut" placeholder="Ingrese el Rut del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Rut del Proveedor

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="RazonSocial">Razón Social</label>

                            <input type="text" class="form-control" id="razonSocialCreate" name="razonSocial" placeholder="Ingrese el Razón Social del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Razón Social del Proveedor

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Alias">Alias</label>

                            <input type="text" class="form-control" id="aliasCreate" name="alias" placeholder="Ingrese el Alias del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Alias del Proveedor

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Giro">Giro</label>

                            <input type="text" class="form-control" id="giroCreate" name="giro" placeholder="Ingrese el Giro del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Giro del Proveedor

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Dirección">Dirección</label>

                            <input type="text" class="form-control" id="direccionCreate" name="direccion" placeholder="Ingrese el Dirección del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Dirección del Proveedor

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Ciudad">Ciudad</label>

                            <input type="text" class="form-control" id="ciudadCreate" name="ciudad" placeholder="Ingrese el Ciudad del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Ciudad del Proveedor

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Teléfono">Teléfono</label>

                            <input type="text" class="form-control" id="telefonoCreate" name="telefono" placeholder="Ingrese el Teléfono del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Teléfono del Proveedor

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Correo">Correo</label>

                            <input type="email" class="form-control" id="correoCreate" name="correo" placeholder="Ingrese el Correo del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Correo del Proveedor

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <button class="btn btn-success btn-block boton" type="submit" form="proveedorForm">

                            <i class="fas fa-save"></i>

                            Guardar Proveedor

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
<!-- End Modal Create Proveedor -->

<!-- Update Modal Proveedor -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h3 class="modal-title" id="exampleModalLabel"> Actualizar Proveedor <i class="fas fa-edit"></i></h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/proveedores') }}" class="was-validated" id="updateForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Actualizar">

                <div class="modal-body">

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="Rut">Rut</label>

                            <input type="text" class="form-control" id="rutUpdate" name="rut" placeholder="Ingrese el Rut del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Rut del Proveedor

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                                                                              
                            <label for="RazonSocial">Razón Social</label>

                            <input type="text" class="form-control" id="razonSocialUpdate" name="razonSocial" placeholder="Ingrese el Razón Social del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Razón Social del Proveedor

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Alias">Alias</label>

                            <input type="text" class="form-control" id="aliasUpdate" name="alias" placeholder="Ingrese el Alias del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Alias del Proveedor

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Giro">Giro</label>

                            <input type="text" class="form-control" id="giroUpdate" name="giro" placeholder="Ingrese el Giro del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Giro del Proveedor

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Dirección">Dirección</label>

                            <input type="text" class="form-control" id="direccionUpdate" name="direccion" placeholder="Ingrese el Dirección del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Dirección del Proveedor

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Ciudad">Ciudad</label>

                            <input type="text" class="form-control" id="ciudadUpdate" name="ciudad" placeholder="Ingrese el Ciudad del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Ciudad del Proveedor

                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Teléfono">Teléfono</label>

                            <input type="text" class="form-control" id="telefonoUpdate" name="telefono" placeholder="Ingrese el Teléfono del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Teléfono del Proveedor

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                              
                            <label for="Correo">Correo</label>

                            <input type="email" class="form-control" id="correoUpdate" name="correo" placeholder="Ingrese el Correo del Proveedor" required>

                            <div class="invalid-feedback">
                                                                                            
                                Por favor ingrese el Correo del Proveedor

                            </div>

                        </div>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Guardar Proveedor

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
<!-- END Update Modal Proveedor -->

<!-- DELETE Modal Proveedor -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h3 class="modal-title" id="exampleModalLabel"> Eliminar Proveedor <i class="fas fa-times-circle"></i></h3>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/proveedores') }}" class="was-validated" id="deleteForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Eliminar">

                <div class="modal-body">

                    <div class="form-row">                        

                            <label class="col-sm-2 col-form-label text-muted">Rut</label><br>
                                                                        
                            <label class="col-sm-10 col-form-label" id="rutDelete">Rut Proveedor</label>
                                                                     
                    </div>

                    <div class="form-row">

                        <label class="col-sm-2 col-form-label text-muted">Razón Social</label><br>
                                                                        
                        <label class="col-sm-10 col-form-label" id="razonSocialDelete">Razón Social</label>

                    </div>

                    <div class="mb-3 form-row">

                        <button class="btn btn-danger btn-block" type="submit">

                            <i class="fas fa-times-circle"></i> Eliminar Proveedor

                        </button>

                        <a href="{{ url('/siscom/solicitud') }}" class="btn btn-secondary btn-block" type="reset">

                            <i class="fas fa-arrow-left"></i> Atrás

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- End Delete Modal Proveedor -->

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

            // Start Configuration DataTable
            var table = $('#proveedorTable').DataTable({

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

                $('#rutUpdate').val(data[1]);
                $('#razonSocialUpdate').val(data[2]);
                $('#aliasUpdate').val(data[3]);
                $('#giroUpdate').val(data[4]);
                $('#direccionUpdate').val(data[5]);
                $('#ciudadUpdate').val(data[6]);
                $('#telefonoUpdate').val(data[7]);
                $('#correoUpdate').val(data[8]);

                $('#updateForm').attr('action', '/siscom/proveedores/' + data[0]);
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

                document.getElementById('rutDelete').innerHTML = data[1];
                document.getElementById('razonSocialDelete').innerHTML = data[2];
                
                $('#deleteForm').attr('action', '/siscom/proveedores/' + data[0]);
                $('#deleteModal').modal('show');

            });
            //End Delete Record

    });    

</script>

@endpush


