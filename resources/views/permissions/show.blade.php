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

                    	@if (session('status'))
	
	                        <div class="alert alert-success" role="alert">

                            	{{ session('status') }}
                        	
                        	</div>

                    	@endif

                    	 <h4> Detalles Permiso del Sistema: </h4>

                         <hr style="background-color: #d7d7d7">

                    	<div class="py-3">

                    		<div class="form-row mb-3">

                                <div class="col-md-2 mb-3">
                                                          
                                    <label class="text-muted">ID</label>

                                    <h5 >{{ $permission->id }}</h5>

                                </div>

                                <div class="col-md-10 mb-3">

                                    <label class="text-muted">Nombre</label>
                                                                
                                    <h5>{{ $permission->name }}</h5>
                                                            
                                </div>

                            </div>

                            <div class="form-row mb-3">

                                <div class="col-md-4 mb-3">
                                                          
                                    <label class="text-muted">Ruta</label>

                                    <h5 >{{ $permission->slug }}</h5>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="text-muted">Creado</label>
                                                                
                                    <h5>{{ $permission->created_at }}</h5>
                                                            
                                </div>

                                <div class="col-md-4 mb-3">

                                    <label class="text-muted">Actualizado</label>
                                                                
                                    <h5>{{ $permission->updated_at }}</h5>
                                                            
                                </div>

                            </div>

                            <div class="form-row mb-3">

                            	<div>
                            	
                            		<label class="text-muted">Descripción</label>
                                                                
                                	<h5>{{ $permission->description }}</h5>	

                            	</div>
                                                            
                            </div>

                            <div class="form-row mb-3">

                                <div>
                                
                                    <label class="text-muted">Registrado por</label>
                                                                
                                    <h5>{{ $permission->user->name }}</h5> 

                                </div>
                                                            
                            </div>

                            <div class="form-row">

                                <a href="{{ route('permissions.index') }}" class="btn btn-secondary btn-block" type="button">

                                    <i class="fas fa-arrow-left"></i>

                                        Atrás

                                </a>

                            </div>

                    	</div>

                	</div>
            	
            	</div>
        	</div>

    	</div>

    </div>
    	
</div>
@endsection