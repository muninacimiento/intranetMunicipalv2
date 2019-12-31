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
                
                    @if (session('status'))
                
                        <div class="alert alert-success" role="alert">
                
                            {{ session('status') }}
                
                        </div>
                
                    @endif

                    <h4> Editar Usuario del Sistema: <small class="text-muted">{{ $user->name }}</small> </h4>

                    <hr style="background-color: #d7d7d7">

                    <div class="py-3">

                       {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'class' => 'needs-validation']) !!}

                            @include('users.partials.form')

                        {!! Form::close() !!}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

<script>

    //Funcion que no permite guardar el formulario si no cumple con las validaciones establecidas en él
    (function() {
        
        'use strict';
        
        window.addEventListener('load', function() {
                           
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
                                
            var validation = Array.prototype.filter.call(forms, function(form) {
                                  
                form.addEventListener('submit', function(event) {
                    
                    if (form.checkValidity() === false) {
                        
                        event.preventDefault();
                        
                        event.stopPropagation();
                    
                    }
                    
                    form.classList.add('was-validated');
                                      
                }, false);
                                
            });

        }, false);
                        
    })();

</script>
