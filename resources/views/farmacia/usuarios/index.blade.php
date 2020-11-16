<!--
/*
 *  JFuentealba @itux
 *  created at December 23, 2019 - 3:45 pm
 *  updated at December 23, 2019 - 3:47 pm
 */
-->

@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col">

            <div class="card border-danger shadow">

                <div class="card-header text-center text-white bg-danger">

                    @include('farmacia.menu')

                </div>


                <div class="card-body">

                    <div class="row py-3">

                        <div class="col-md-6 text-center">
                            
                            <h3>Gestión de Usuarios</h3>

                            <div class="text-secondary">

                                {{ $dateCarbon }}

                            </div>

                        </div>

                        <!-- Button trigger Crear Usuario -->
                        <div class="col-md-6">
                            
                            <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#createUserModal">

                                <button class="btn btn-warning btn-block boton">

                                    <i class="fas fa-user-plus px-2"></i>

                                    Nuevo Usuario

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

                        <table class="display" id="userTable" style="font-size: 0.8em;">

                            <thead>

                                <tr class="table-active">

                                    <th>ID</th>

                                    <th>Rut</th>

                                    <th>Nombre</th>

                                    <th>Dirección</th>

                                    <th>Población</th>
                                    
                                    <th>Teléfono</th>

                                    <th>Previsión</th>

                                    <th>Registrado</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($usuarios as $usuario)

                                <tr>

                                    <td>{{ $usuario->id }}</td>

                                    <td>{{ $usuario->rut }}</td>

                                    <td>{{ $usuario->name }}</td>

                                    <td>{{ $usuario->direccion }}</td>

                                    <td>{{ $usuario->poblacion }}</td>

                                    @if($usuario->telefono == 0)

                                        <td style="color: white;background: red;">N/R (*)</td>

                                    @else

                                        <td>{{ $usuario->telefono }}</td>

                                    @endif

                                    <td>{{ $usuario->sistemaPrevisional  }}</td>

                                    <td>{{ date('d-m-Y', strtotime( $usuario->created_at ) }}</td>

                                    <td>

                                        <div class="btn-group" role="group">

                                            <a href="#" class="btn btn-warning btn-sm mr-1 actualizar" data-toggle="tooltip" data-placement="bottom" title="Actualizar Usuario">
                                                    
                                                <i class="fas fa-pencil-alt"></i>

                                            </a>

                                            {!! Form::open(['route'=> ['usuarioFarmacia.destroy', $usuario->id], 'method' => 'DELETE']) !!}

                                                <button class="btn btn-danger btn-sm mr-1">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            {!! Form::close() !!}

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                            <tfoot>

                                <tr class="table-active">

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                </tr>

                            </tfoot>

                        </table>

                        <div class="p-2" style="color: red;">

                            * N/R = No Registrado

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Creación Nuevo Usuario -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        
        <div class="modal-content">
            
            <div class="modal-header bg-warning">
                
                <p class="modal-title" id="tituloLabel" style="font-size: 1.2em"><i class="fas fa-user-plus px-2"></i> Nuevo Usuario</p>
                    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        
                    <span aria-hidden="true">&times;</span>
                
                </button>

            </div>
        
            <form method="POST" action="{{ action('UsuarioFarmaciaController@store') }}" class="was-validated" id="userForm">

                @csrf
            
            <div class="modal-body">
                
                <div class="form-row">

                    <div class="col-md-4 mb-3">
                                                                              
                        <label for="id">Rut Usuario</label>

                        <input type="text" class="form-control" id="rut" name="rut" placeholder="12.3456.789.0" required>

                        <div class="invalid-feedback">

                            Por favor Ingrese el Rut

                        </div>
                    
                    </div>

                    <div class="col-md-8 mb-3">
                                                                              
                        <label for="name">Nombre</label>

                        <input type="text" class="form-control" id="userName" name="name" placeholder="Viviana La Regla" required>

                        <div class="invalid-feedback">

                            Por favor Ingrese el Nombre
                        
                        </div>

                    </div>

                </div>

                <div class="form-row">

                    <div class="col-md-6 mb-3">
                                                                              
                        <label for="direccion">Dirección</label>

                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Freire 614" required>

                        <div class="invalid-feedback">
                                                                                                        
                            Por favor ingrese la Dirección

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">
                                                                              
                        <label for="poblacion">Población</label>

                        <input type="text" class="form-control" id="poblacion" name="poblacion" placeholder="Centro" required>

                        <div class="invalid-feedback">
                                                                                                        
                            Por favor ingrese la Población 
                        
                        </div>

                    </div>

                </div>

                <div class="form-row">
                        
                    <div class="col-md-6 mb-3">
                                                                              
                        <label for="telefono">Teléfono</label>

                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="987654321" required>

                        <div class="invalid-feedback">
                                                                                                        
                            Por favor ingrese un Teléfono 

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">
                                                                              
                        <label for="sistemaPrevisional">Sistema Previsional</label>

                        <select name="sistemaPrevisional" id="sistemaPrevisional" class="form-control selectpicker" title="Seleccione..." required>

                            <option>Fonasa - A</option>
                            <option>Fonasa - B</option>
                            <option>Fonasa - C</option>
                            <option>Fonasa - D</option>
                            <option>Isapre</option>
                            <option>Dipreca</option>
                            <option>No Sabe</option>

                        </select>

                    </div>

                </div>
                
                <div class="form-row">

                    <button type="submit" class="btn btn-success btn-block">

                        <i class="fas fa-check-circle"></i>

                        Guardar Usuario

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
<!-- Crear Nuevo Usuario -->

<!-- Actualizar Usuario -->
<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        
        <div class="modal-content">
            
            <div class="modal-header bg-warning">
                
                <p class="modal-title" id="tituloLabel" style="font-size: 1.2em"><i class="fas fa-user-edit px-2"></i> Actualizar Usuario</p>
                    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        
                    <span aria-hidden="true">&times;</span>
                
                </button>

            </div>
        
            <form method="POST" action="#" class="was-validated" id="updateUserForm">

                @csrf

                @method('PUT')
            
                <div class="modal-body">
                
                    <div class="form-row">

                        <div class="col-md-4 mb-3">
                                                                                  
                            <label for="id">Rut Usuario</label>

                            <input type="text" class="form-control" id="rutUpdate" name="rutUpdate" placeholder="12.3456.789.0" required>

                            <div class="invalid-feedback">

                                Por favor Ingrese el Rut

                            </div>
                        
                        </div>

                        <div class="col-md-8 mb-3">
                                                                                  
                            <label for="name">Nombre</label>

                            <input type="text" class="form-control" id="userNameUpdate" name="name" placeholder="Viviana La Regla" required>

                            <div class="invalid-feedback">

                                Por favor Ingrese el Nombre
                            
                            </div>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                                                                                  
                            <label for="direccion">Dirección</label>

                            <input type="text" class="form-control" id="direccionUpdate" name="direccion" placeholder="Freire 614" required>

                            <div class="invalid-feedback">
                                                                                                            
                                Por favor ingrese la Dirección

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                                  
                            <label for="poblacion">Población</label>

                            <input type="text" class="form-control" id="poblacionUpdate" name="poblacion" placeholder="Centro" required>

                            <div class="invalid-feedback">
                                                                                                            
                                Por favor ingrese la Población 
                            
                            </div>

                        </div>

                    </div>

                    <div class="form-row">
                            
                        <div class="col-md-6 mb-3">
                                                                                  
                            <label for="telefono">Teléfono</label>

                            <input type="text" class="form-control" id="telefonoUpdate" name="telefono" placeholder="987654321" required>

                            <div class="invalid-feedback">
                                                                                                            
                                Por favor ingrese un Teléfono 

                            </div>

                        </div>

                        <div class="col-md-6 mb-3">
                                                                                  
                            <label for="sistemaPrevisional">Sistema Previsional</label>

                            <select name="sistemaPrevisional" id="sistemaPrevisionalUpdate" class="form-control selectpicker" title="Seleccione..." required>

                                <option>Fonasa - A</option>
                                <option>Fonasa - B</option>
                                <option>Fonasa - C</option>
                                <option>Fonasa - D</option>
                                <option>Isapre</option>
                                <option>Dipreca</option>
                                <option>No Sabe</option>

                            </select>

                        </div>

                    </div>
                    
                    <div class="form-row">

                        <button type="submit" class="btn btn-success btn-block">

                            <i class="fas fa-check-circle"></i>

                            Guardar Usuario

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
<!-- Actualizar Usuario -->

@endsection

@push('scripts')

    <!-- JQuery DataTable -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>

    <!-- JQuery DatePicker -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

$(document).ready(function () {

    // Start Configuration DataTable
    var table = $('#userTable').DataTable({

        "paginate"  : true,

        "order"     : ([0, 'desc']),

        "language"  : {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No existen Usuarios registrados aún...",
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
    table.on('click', '.actualizar', function () {

        $tr = $(this).closest('tr');

        if ($($tr).hasClass('child')) {

            $tr = $tr.prev('.parent');

        }

        var data = table.row($tr).data();

        console.log(data);

        $('#rutUpdate').val(data[1]);
        $('#userNameUpdate').val(data[2]);
        $('#direccionUpdate').val(data[3]);
        $('#poblacionUpdate').val(data[4]);
        $('#telefonoUpdate').val(data[5]);

        if (($('#sistemaPrevisionalUpdate').val(data[6]))==='Si') {

            $('#sistemaPrevisionalUpdate').val();    
        
        }
        else if (($('#sistemaPrevisionalUpdate').val(data[6]))==='No'){

            $('#sistemaPrevisionalUpdate').val();       
    
        }

        $('#updateUserForm').attr('action', '/farmacia/usuarios/' + data[0]);
        $('#updateUserModal').modal('show');

    });
    //End Edit Record
});

</script>

@endpush