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

                                            <a href="{{ route('users.show', $user->id) }}">

                                                <button class="btn btn-outline-secondary mx-1" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle de este Permiso">
                                                
                                                    <i class="fas fa-eye"></i>

                                                </button>

                                                

                                            </a>

                                            <a href="{{ route('users.edit', $user->id) }}" >

                                                <button class="btn btn-outline-primary mx-1" data-toggle="tooltip" data-placement="bottom" title="Editar este Permiso del Sistema">
                                                    
                                                    <i class="fas fa-edit"></i>

                                                </button>

                                                

                                            </a>

                                            {!! Form::open(['route'=> ['users.destroy', $user->id], 'method' => 'DELETE']) !!}

                                                <button class="btn btn-outline-danger">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            {!! Form::close() !!}

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

@endsection

@push('scripts')

    <!-- JQuery DataTable -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>

<script>
        
    $(document).ready(function() {

        $('#userTable').DataTable({

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

    } );

</script>

@endpush