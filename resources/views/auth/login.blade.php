<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts         -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300&display=swap" rel="stylesheet">
        <!-- Styles         -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">



        <!-- Styles -->
        <style>

            .body {

                font-family: 'Poiret One';

                background: url(../images/teamWork.jpg) no-repeat center;

                background-size: cover;

                min-height: 100vh;

            }

            .header .navbar {
                
                background:transparent !important;

            }

            .form-area{

                font-family: 'Rajdhani';

                color: #fff;

                position: absolute;

                top: 55%;

                left: 25%;

                transform: translate(-50%, -50%);

                width: 400px;

                height: 375;

                background : rgba(0,0,0,0.5);

                border-radius: 25px 25px 25px 25px;

                -moz-border-radius: 25px 25px 25px 25px;

                -webkit-border-radius: 25px 25px 25px 25px;
            }

            .vl {
              
                border-left: 1px solid white;
                
                height: 325px;
            }
            .footer {
                font-family: 'Rajdhani';
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                color: grey;
                text-align: center;
            }

        </style>

    </head>

    <body class="body">

        <div class="header">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                
              <a class="navbar-brand text-muted font-weight-lighter" href="{{ url('/') }}">

                    <img src="{{ asset('images/LogoMunicipal_Mail.png')}}" style="width: 220px;" class="ml-5 mr-3">

                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                
                    <span class="navbar-toggler-icon"></span>
                
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav mr-auto">
                        
                       
                    </ul>

                     <span class="navbar-text">

                     @if (Route::has('login'))

                            <div>

                                @auth

                                    <a href="{{ url('/home') }}" class="text-muted mr-3 text-decoration-none">Inicio</a>

                               
                                @endauth

                            </div>

                        @endif
                    
                    </span>

                </div>

            </nav>
            <div class="text-center"> 
                <h2>< Acceso a la Intranet de la Municipalidad de Nacimiento /></h2>
            </div>
            <div class="container form-area p-3">

                <div class="row">
                

                    <div class="col">
                        
                         <form method="POST" action="{{ route('login') }}">

                            @csrf

                            <div class="text-center mb-2">
                            
                                <h2>
                                
                                    Login
                                
                                </h2>    
                            
                            </div>

                            <div class="form-group row mb-2">

                            
                                <label for="email" class="col-12 col-form-label ">{{ __('Correo Institucional') }}</label>

                                <div class="col-md-12">
                            
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="usuario@nacimiento.cl">

                                    @error('email')
                            
                                        <span class="invalid-feedback" role="alert">
                            
                                            <strong>{{ $message }}</strong>
                            
                                        </span>
                            
                                    @enderror
                            
                                </div>
                            
                            </div>

                            <div class="form-group row mb-3">

                                <label for="password" class="col-12 col-form-label">{{ __('Contraseña') }}</label>

                                <div class="col-md-12">
                                
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="*******************">

                                    @error('password')
                                    
                                        <span class="invalid-feedback" role="alert">
                                    
                                            <strong>{{ $message }}</strong>
                                    
                                        </span>
                                    
                                    @enderror
                            
                                </div>

                            </div>

                            <div class="form-group row mb-2">
                            
                                <div class="col-md-12">
                            
                                    <button type="submit" class="btn btn-success btn-block">


                                    {{ __('Acceder') }}
                                    </button>
                            
                                </div>
                            
                            </div>

                            <div class="form-group row mb-1">
                            
                                <div class="col-md-12 text-center">

                                    @if (Route::has('register'))

                                        <a href="{{ route('register') }}" class="btn btn-primary btn-block mr-5 text-decoration-none">Formulario de Registro</a>

                                    @endif
                            
                                </div>
                            
                            </div>
                    
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </body>
    <footer class="footer mb-2">
        <h6>Copyright &copy; 2022 - Unidad de Informática Municipal - <a href="mailto:juan.fuentealba@gmail.com">#jfuentealba</a> </h6>
    </footer>

</html>