<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts 
        <script src="{{ asset('js/app.js') }}" defer></script>
        -->

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/4cf490c3ec.js"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
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
                
                background-color: transparent !important;

            }

            .form-area{

                font-family: 'Rajdhani';

                color: #fff;

                position: absolute;

                top: 55%;

                left: 25%;

                transform: translate(-50%, -50%);

                width: 400px;

                height: 470px;

                background : rgba(0,0,0,0.5);

                border-radius: 25px 25px 25px 25px;

                -moz-border-radius: 25px 25px 25px 25px;

                -webkit-border-radius: 25px 25px 25px 25px;
            }

            .vl {
              
                border-left: 1px solid white;
                
                height: 450px;
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
                
              <a class="navbar-brand text-secondary font-weight-lighter" href="{{ url('/') }}">

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

                                    <a href="{{ url('/home') }}" class="text-secondary mr-3 text-decoration-none">Inicio</a>

                                

                                @endauth

                            </div>

                        @endif
                    
                    </span>

                </div>

            </nav>

            <div class="container form-area p-3">

                <div class="row">

                    <div class="col">
                        
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="text-center mb-3">
                                <h2>
                                    Formulario de Registro
                                </h2>    
                                <div class="text-white"> < Quiero acceder a la Intranet Municipal /> </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre Completo">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="dependencySelect" class="form-control selectpicker" data-live-search="true" title="Por favor, seleecione su Dependencia Municipal">
                                    @foreach($dependencies as $dependency)
                                        <option value="{{ $dependency->id }}">{{ $dependency->Dependencias }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo Institucional">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme Contraseña">
                                </div>
                        
                            </div>

                            <div class="form-group row mb-2">
                         
                                <div class="col-md-12">
                         
                                    <button type="submit" class="btn btn-success btn-block">
                         
                                        {{ __('Regístrese') }}
                         
                                </button>
                         
                                </div>
                         
                            </div>

                            <div class="form-group row mb-3">
                            
                                <div class="col-md-12 text-center">

                                        <a href="{{ route('login') }}" class="btn btn-primary btn-block mr-5 text-decoration-none">Login</a>

                            
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

<!-- JQuery CSS -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- JQuery DataTable -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js" ></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
    <!-- JQuery DatePicker -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Boostrap Select -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html> 