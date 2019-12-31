@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card border-secondary shadow">

                <div class="card-header text-center text-white bg-secondary">

                    <h3 class="font-weight-lighter">
                    
                        Administración - 

                        <small>Usuarios de la Intranet Municipal</small>

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

                    {!! Form::open(array('url'=>'users', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

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

                                <th>Correo</th>

                                <th>Dependencia</th>

                                <th colspan="3">&nbsp;</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($users as $user)

                            <tr>

                                <td>{{ $user->id }}</td>

                                <td>{{ $user->name }}</td>

                                <td>{{ $user->email }}</td>

                                <!-- <td>{{ date('d-m-Y H:i:s', strtotime($user->created_at)) }}</td>

                                <td>{{ date('d-m-Y H:i:s', strtotime($user->updated_at)) }}</td> -->

                                <td>{{ $user->dependencia }}</td>

                                @can('users.show')

                                <td>

                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="bottom" title="Ver Detalle de este Permiso" style="font-size: 90%;">

                                        <i class="fas fa-eye"></i>

                                        Ver

                                    </a>

                                </td>

                                @endcan

                                @can('users.edit')

                                <td>
                                        
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="bottom" title="Editar este Permiso del Sistema" style="font-size: 90%;">

                                            <i class="fas fa-edit"></i>

                                            Editar

                                        </a>

                                </td>

                                @endcan

                                @can('users.destroy')

                                <td>

                                   {!! Form::open(['route'=> ['users.destroy', $user->id], 'method' => 'DELETE']) !!}

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
                        
                    {{ $users->render() }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
