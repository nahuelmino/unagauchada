@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

        <!-- parte izquierda de la pantalla, panel de usuario -->
            <div class="col-md-3">
                <p class="lead">Perfil de usuario</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">Mis datos</a>
                    <a href="/gauchadas/user" class="list-group-item">Mis gauchadas</a>
                </div>
            </div>


            <!-- parte derecha de la pantalla con datos -->
            <div class="col-md-9">
            @if ($errors->has('0'))
                <div class="errors has-error">
                    <span class="help-block">
                        <strong>{!! $errors->first('0') !!}</strong>
                    </span>
                </div>
            @endif
                <div class="panel panel-info" style="border-color:orange">
                    <div class="panel-heading" style="background-color:orange">
                        <h3 class="panel-title" style="color:black">{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> 
                                <a href="#" class="thumbnail">
                                    @if (isset($user['photo']))
                                    <img src="{{ Auth::user()->photo }}" class="img-circle img-responsive">
                                    @else
                                    <img src="/img/usernopic.jpg" class="img-circle img-responsive">
                                    @endif
                                </a>
                            </div>

                            <div class=" col-md-9 col-lg-9 "> 
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Usuario:</td>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de nacimiento:</td>
                                        <td>{{ Auth::user()->date_of_birth }}</td>
                                    </tr>
                                    <tr>
                                        <td>Número de telefono:</td>
                                        <td>{{ Auth::user()->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Mis créditos:</td>
                                        <td>{{ Auth::user()->credits }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a href="/editar-perfil" class="btn btn-orange text-white">Editar</a>
                                <a href="{{ route('comprar') }}" class="btn btn-orange text-white">Comprar mas Creditos!</a>
                                <a href="/cambiar-contrasena" class="btn btn-orange text-white">Cambiar contraseña</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- cierre de la columna md-9 -->
        </div> <!-- cierre del primer row -->
    </div> <!-- cierre del container -->

@endsection