@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-secondary shadow">

                <div class="card-header text-center text-white bg-secondary">

                    <h3 class="font-weight-lighter">
                    
                        Administración - 

                        <small>Dependencias Municipales</small>

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

                    @can('dependencies.create')

                        <div class="form-group mb-3">
                            
                            <a href="{{ route('dependencies.create') }}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Nueva Dependencia Municipal">

                                <i class="fas fa-plus-circle"></i>

                                Nueva Dependencia
                            
                            </a>

                        </div>

                    @endcan
                    

                    {!! Form::open(array('url'=>'dependencies', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

                        <!--Creamos una vista para el formulario de búsqueda
                        más que nada para un código ordenado y fácil de mantener-->
                        @include('search')

                    {{ Form::close() }}

                    <div>

                        <table class="table table-striped table-hover table-responsive font-weight-light">

                        <thead>

                            <tr class="table-active">

                                <th width="5%">ID</th>

                                <th>Nombre</th>

                                <td>Registrada por</th>

                                <th colspan="3">&nbsp;</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($dependencies as $dependency)

                            <tr>

                                <td>{{ $dependency->id }}</td>

                                <td>{{ $dependency->name }}</td>

                                <td>{{ $dependency->userName }}</td>

                                @can('dependencies.show')

                                <td>

                                    <a href="{{ route('dependencies.show', $dependency->id) }}" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle de esta Dependencia Municipal" style="font-size: 90%;">

                                        <i class="fas fa-eye"></i>

                                        Ver

                                    </a>

                                </td>

                                @endcan

                                @can('dependencies.edit')

                                <td>
                                        
                                        <a href="{{ route('dependencies.edit', $dependency->id) }}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Editar esta Dependencia Municipal" style="font-size: 90%;">

                                            <i class="fas fa-edit"></i>

                                            Editar

                                        </a>

                                </td>

                                @endcan

                                @can('dependencies.destroy')

                                <td>

                                   {!! Form::open(['route'=> ['dependencies.destroy', $dependency->id], 'method' => 'DELETE']) !!}

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
                        
                    {{ $dependencies->links() }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
