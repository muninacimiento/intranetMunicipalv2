@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-secondary shadow">

                <div class="card-header text-center text-white bg-secondary">

                    <h3 class="font-weight-lighter">
                    
                        Administración - 

                        <small>Permisos de la Intranet Municipal</small>

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

                    @can('permissions.create')

                        <div class="form-group mb-3">
                            
                            <a href="{{ route('permissions.create') }}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo Permiso del Sistema">

                                <i class="fas fa-plus-circle"></i>

                                Nuevo Permiso
                            
                            </a>

                        </div>

                    @endcan
                    

                    {!! Form::open(array('url'=>'permissions', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

                        <!--Creamos una vista para el formulario de búsqueda
                        más que nada para un código ordenado y fácil de mantener-->
                        @include('search')

                    {{ Form::close() }}

                    <div class="col-md-2 col-md-4 col-md-6 col-md-8 col-md-10 col-md-12">

                        <table class="table table-striped table-hover table-responsive font-weight-light">

                        <thead>

                            <tr class="table-active">

                                <th width="5%">ID</th>

                                <th>Nombre</th>

                                <th>Ruta de Acceso</th>

                                <th>Descripción</th>

                                <th>Registrado por</th>

                                <th colspan="3">&nbsp;</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($permissions as $permission)

                            <tr>

                                <td>{{ $permission->id }}</td>

                                <td>{{ $permission->name }}</td>

                                @if($permission->slug == 'gespro.index')

                                    <td style="background-color : #ffff99 !important;">{{ $permission->slug }}</td>

                                @else

                                    <td class="text-white" style="background-color : #000 !important;">{{ $permission->slug }}</td>

                                @endif

                                <td>{{ $permission->description }}</td>

                                @if($permission->userName == 'Juan Fuentealba')

                                    <td style="background-color : #ffff99 !important;">{{ $permission->userName }}</td>

                                @else

                                    <td style="background-color : #000 !important;">{{ $permission->userName }}</td>

                                @endif

                                @can('permissions.show')

                                <td>

                                    <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle de este Permiso" style="font-size: 90%;">

                                        <i class="fas fa-eye"></i>

                                        Ver

                                    </a>

                                </td>

                                @endcan

                                @can('permissions.edit')

                                <td>
                                        
                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Editar este Permiso del Sistema" style="font-size: 90%;">

                                            <i class="fas fa-edit"></i>

                                            Editar

                                        </a>

                                </td>

                                @endcan

                                @can('permissions.destroy')

                                <td>

                                   {!! Form::open(['route'=> ['permissions.destroy', $permission->id], 'method' => 'DELETE']) !!}

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
                        
                    {{ $permissions->links() }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


