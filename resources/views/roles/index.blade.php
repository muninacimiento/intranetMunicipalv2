@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-secondary shadow">

                <div class="card-header text-center text-white bg-secondary">

                    <h3 class="font-weight-lighter">
                    
                        Administración - 

                        <small>Roles de la Intranet Municipal</small>

                    </h3>

                </div>

                <div class="card-body">

                    @if (session('info'))

                    <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                          
                        <strong> {{ session('info') }} </strong>
                        
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        
                            <span aria-hidden="true">&times;</span>
                          
                        </button>

                    </div>
                   
                    @endif

                    @can('roles.create')

                        <div class="form-group mb-3">
                            
                            <a href="{{ route('roles.create') }}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo Rol del Sistema">

                                <i class="fas fa-plus-circle"></i>

                                Nuevo Rol
                            
                            </a>

                        </div>

                    @endcan
                    

                    
                    <div>

                        <table id="roleTable" class="display">

                        <thead>

                            <tr>

                                <th width="5%">ID</th>

                                <th>Nombre</th>

                                <th>Ruta de Acceso</th>

                                <th>Descripción</th>

                                <th>Registrado por</th>

                                <th colspan="3">&nbsp;</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($roles as $role)

                            <tr>

                                <td>{{ $role->id }}</td>

                                <td>{{ $role->name }}</td>

                                <td>{{ $role->slug }}</td>

                                <td>{{ $role->description }}</td>

                                <td>{{ $role->userName }}</td>

                                @can('roles.show')

                                <td>

                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle de este Permiso" style="font-size: 90%;">

                                        <i class="fas fa-eye"></i>

                                        Ver

                                    </a>

                                </td>

                                @endcan

                                @can('roles.edit')

                                <td>
                                        
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Editar este Permiso del Sistema" style="font-size: 90%;">

                                            <i class="fas fa-edit"></i>

                                            Editar

                                        </a>

                                </td>

                                @endcan

                                @can('roles.destroy')

                                <td>

                                   {!! Form::open(['route'=> ['roles.destroy', $role->id], 'method' => 'DELETE']) !!}

                                        <button class="btn btn-outline-danger" style="font-size: 90%;">

                                            <i class="fas fa-trash"></i>

                                            Eliminar

                                        </button>

                                   {!! Form::close() !!}

                                </td>

                                @endcan

                            </tr>

                            @endforeach

                        </tbody>

                    </table>
                        
                    {{$roles->render()}}

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

<!-- JQuery DatePicker -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
        
        $(document).ready(function () {

        // Start Configuration DataTable
            var table = $('#roleTable').DataTable({

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

    });    

</script>

@endpush