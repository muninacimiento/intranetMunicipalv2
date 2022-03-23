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
                                            <a href="#" class="btn btn-outline-primary btn-sm pass" data-toggle="tooltip" data-placement="bottom" title="Cambiar Clave Usuario">                        
                                                <i class="icofont-key px-1" style=" font-size: 1rem;"></i>
                                            </a>
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle de este Permiso">
                                                <i class="icofont-eye-alt px-1" style=" font-size: 1rem;"></i>
                                            </a>
                                            @endcan
                                            @can('users.edit')
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Editar este Permiso del Sistema">
                                                <i class="icofont-pencil-alt-2 px-1" style=" font-size: 1rem;"></i>
                                            </a>
                                            @endcan
                                            @can('users.destroy')
                                            {!! Form::open(['route'=> ['users.destroy', $user->id], 'method' => 'DELETE']) !!}
                                            <button class="btn btn-outline-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar Usuario del Sistema">
                                                <i class="icofont-ui-delete px-1" style=" font-size: 1rem;"></i>
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
            <div class="modal-header bg-dark text-white">
                <p class="modal-title" id="exampleModalLabel" style="font-size: 1.2em"><i class="icofont-key"></i> Restablecer Contraseña</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <form method="POST" action="#" class="was-validated" id="passwordForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="flag" value="Clave">
                <div class="modal-body">
                    <div class="form-row mb-3">
                        <label for="password" class="col col-form-label">{{ __('Contraseña') }}</label>
                        <div class="col">        
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="******************">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <label for="password-confirm" class="col col-form-label">{{ __('Confirmar Contraseña') }}</label>
                        <div class="col">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="******************">
                        </div>
                    </div>
                    <div class="form-row">
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
            table.on('click', '.pass', function () {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);
                $('#passwordForm').attr('action', '/users/cambioClave/' + data[0]);
                $('#passwordModal').modal('show');
            });
            //End Edit Record
    } );
</script>
@endpush