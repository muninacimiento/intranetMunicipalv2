<!doctype html>
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

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4cf490c3ec.js"></script>

    <!-- Styles 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- JQuery CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    
    <!-- Styles -->
    <style>

    .   body {

            font-family: 'Quicksand';
            font-size: 1.1em;

        }

        .menu {

            font-size: 1.1em;
        
        }

        .boton {

            font-size: 1em;
        
        }

        .divScroll {

            overflow:scroll;
            height:570px;

        }

        .divScrollX {

            overflow:scroll;
            width: 100%;

        }

        .navGreen{

            background-color: #009732;

        }

    </style>


</head>

<body class="body">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm navGreen">
            <div class="container">
                <a class="navbar-brand text-white font-weight-lighter" href="{{ url('/') }}">

                    <img src="{{ asset('images/MarcaMunicipal_LetrasBlancas.png')}}" style="width: 200px;" class="mr-3">
                    
                    Intranet Municipal

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                        @can('gespro.index')
                        <li class="nav-item">
                            
                            <a href="{{ route('gespro.index') }}" class="nav-link text-white">

                                <i class="fas fa-lightbulb"></i>

                                GesPRO

                            </a>

                        </li>
                        @endcan

                        @can('siscom.index')
                        <li class="nav-item">
                            
                            <a href="{{ route('siscom.index') }}" class="nav-link text-white">

                                <i class="fas fa-cart-plus"></i>

                                SisCoM
                            </a>

                        </li>
                        @endcan

                        @can('farmacia.index')
                        <li class="nav-item">
                            
                            <a href="{{ route('farmacia.index') }}" class="nav-link text-white">

                               <i class="fas fa-heartbeat"></i>

                                Farmacia

                            </a>

                        </li>
                        @endcan

                        @can('users.index')
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                
                                <i class="fas fa-cogs"></i>

                                Administración  

                            </a>

                            <div class="dropdown-menu">

                                @can('users.index')

                                <a class="dropdown-item text-secondary" href="{{ route('users.index') }}">

                                   <i class="fas fa-address-book"></i>

                                    Usuarios

                                </a>

                                @endcan

                                 @can('dependencies.index')

                                <a class="dropdown-item text-secondary" href="{{ route('dependencies.index') }}">

                                   <i class="fas fa-network-wired"></i>

                                    Dependencias Municipales

                                </a>

                                @endcan

                                @can('permissions.index')

                                <a class="dropdown-item text-secondary" href="{{ route('permissions.index') }}">

                                    <i class="fas fa-key"></i>

                                    Permisos

                                </a>

                                @endcan

                                @can('roles.index')

                                <a class="dropdown-item text-secondary" href="{{ route('roles.index') }}">

                                    <i class="fas fa-mask"></i>

                                    Roles

                                </a>

                                @endcan

                            </div>

                        </li>
                        @endcan

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     Bienvenid@, {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="far fa-arrow-alt-circle-left"></i>    {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

@stack('scripts')

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>