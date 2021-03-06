<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Una Gauchada</title><?php // {{ config('app.name', 'Una Gauchada') }} ?>

    <link rel="icon" href="favicon.png">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"-->
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <style>
        .centered { margin: auto; max-width: 300px;}
        .marg5 {margin-top: 10px;}
        .margle {margin-left:10px; }
        .gauchadabox {  
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden ;
            );}
        

    </style>

    @yield('added_styles')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">

    <nav class="navbar navbar-default navbar-static-top {{ Route::current()->uri === '/' ? 'navbar-home' : '' }}">
        <div class="container-fluid">
            <div class="navbar-header col-md-4">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="img-responsive " src="{{ asset('/img/icon.png') }}" alt="Una Gauchada">
                    <span class="hide-on-tablet">Una Gauchada</span>
                </a>
                <?php //{{ config('app.name', 'Una Gauchada') }}?>
            </div>
            <div class="col-md-5">
                <form class="form-group" role="search" method="GET" 
                    action="{{ (Route::current()->uri === 'gauchadas/user') ? '/gauchadas/user' : '/gauchadas' }}">
                    <div class="input-group marg5">
                        <input type="text" class="form-control" placeholder="Buscar Gauchada..." name="title">
                        <div class="input-group-btn">
                            <button class="btn btn-orange" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('gauchadas') }}">Gauchadas</a></li>
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Menú<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('home') }}"><span class="glyphicon glyphicon-user"></span> Mi perfil</a>
                        </li>
                        @if (Auth::user()->esAdmin())
                        <li>
                            <a href="/admin"><span class="glyphicon glyphicon-cog"></span> Panel de control</a>
                        </li>
                        @else
                        <li><a href="#">Créditos: {{ Auth::user()->credits }}</a></li>
                        <li style="background-color:orange">
                            <a href="{{ route('comprar') }}"><span class="glyphicon glyphicon-usd"></span> Comprar créditos</a>
                        </li>
                        <li>
                            <a href="/gauchadas/create"><span class="glyphicon glyphicon-star"></span>Crear Gauchada</a>
                        </li>
                        <li>
                            <a href="/gauchadas/user"><span class="glyphicon glyphicon-list"></span>Mis Gauchadas</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-log-out"></span>
                                Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                
                                        @else (Auth::guest())
                            <li><a href="{{ route('login') }}">
                            <span class="glyphicon glyphicon-user">
                            </span>Ingresar</a></li>
                            <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-log-in">
                </span>Registrarse</a></li>
                @endif
            </ul>

        </div>
    </nav>
    @if (session()->has('alert'))
    <div class="alert alert-success" role="alert">
        {{ session('alert') }}
    </div>
    @endif
    @if ($errors->has('0'))
    <div class="container-fluid">
        <div class="form-group{{ $errors->has('0') ? ' has-error' : '' }}">
            <span class="help-block">
                <strong>{!! $errors->first('0') !!}</strong>
            </span>
        </div>
    </div>
    @endif
    @yield('content')
    <div class="container">
        <footer>
            <div class="row">
                <div class="col-lg-12 text-right">
                    <p>Una Gauchada 2017</p>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

@yield('added_scripts')

</html>
