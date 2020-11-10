@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-secondary shadow">

                <div class="card-header text-center text-white bg-secondary mb-3">

                    <div class="col text-center">
                            
                            <h3 class="font-weight-lighter">Administración de Usuarios de la Intranet Municipal</h3>

                            <div class="text-white">

                                {{ $dateCarbon }}

                            </div>

                        </div>

                </div>


                <div class="card-body">

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

                        <table class="display" id="userTable" style="font-size: 0.9em;" width="100%">

                            <thead>

                                <tr>

                                    <th width="5%">ID</th>

                                    <th>Nombre</th>

                                    <th>Correo</th>

                                    <th>Dependencia</th>

                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($users as $user)

                                <tr>

                                    <td>{{ $user->id }}</td>

                                    <td>{{ $user->name }}</td>

                                    <td>{{ $user->email }}</td>

                                    <td>{{ $user->dependencia }}</td>

                                    <td>
                                        
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            @can('users.show')
                                            <a href="#" class="edit" data-toggle="tooltip" data-placement="bottom" title="Restablecer Contraseña">

                                                <button class="btn btn-outline-primary mx-1" >
                                                    
                                                   <i class="fas fa-key"></i>

                                                </button>   

                                            </a>

                                            <a href="{{ route('users.show', $user->id) }}">

                                                <button class="btn btn-outline-secondary mx-1" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle de este Permiso">
                                                
                                                    <i class="fas fa-eye"></i>

                                                </button>

                                                

                                            </a>
                                            @endcan

                                            @can('users.edit')
                                            <a href="{{ route('users.edit', $user->id) }}" >

                                                <button class="btn btn-outline-primary mx-1" data-toggle="tooltip" data-placement="bottom" title="Editar este Permiso del Sistema">
                                                    
                                                    <i class="fas fa-edit"></i>

                                                </button>

                                            </a>
                                            @endcan

                                            @can('users.destroy')
                                            {!! Form::open(['route'=> ['users.destroy', $user->id], 'method' => 'DELETE']) !!}

                                                <button class="btn btn-outline-danger">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            {!! Form::close() !!}
                                            @endcan
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

<!-- Actualizar Conraseña MODAL -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="fas fa-inbox"></i> Restablecer Contraseña</p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true" class="text-white">&times;</span>

                </button>

            </div>


            <form method="POST" action="{{ url('/siscom/users') }}" class="was-validated" id="passwordForm">

                @csrf
                @method('PUT')

                <input type="hidden" name="flag" value="Contraseña">

                <div class="modal-body">

                    <div class="form-group row mb-3">
                        
                                <label for="password" class="col-md-12 col-form-label">{{ __('Contraseña') }}</label>

                                <div class="col-md-12">
                                
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="******************">

                                    @error('password')

                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>

                                    @enderror
                 
                                </div>
                 
                            </div>

                            <div class="form-group row mb-4">
                  
                                <label for="password-confirm" class="col-md-12 col-form-label">{{ __('Confirmar Contraseña') }}</label>

                                <div class="col-md-12">
                   
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="******************">
                        
                                </div>
                        
                            </div>


                    <div class="mb-3 form-row">

                        <button class="btn btn-success btn-block" type="submit">

                            <i class="fas fa-save"></i>

                            Actualizar Contraseña

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

    <!-- JQuery DataTable -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>

<script>
        
    $(document).ready(function() {

        var table = $('#userTable').DataTable({

            "paginate"  : true,

                "order"     : ([0, 'desc']),

                "language"  : {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "No existen usuarios registrados en la Intranet, aún...",
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

         //Start Edit Record
            table.on('click', '.edit', function () {

                $tr = $(this).closest('tr');

                if ($($tr).hasClass('child')) {

                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                console.log(data);

                

                $('#passwordForm').attr('action', '/siscom/users/' + data[0]);
                $('#passwordModal').modal('show');

            });
            //End Edit Record

    } );

</script>

@endpush