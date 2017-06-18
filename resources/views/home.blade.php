@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

        <!-- parte izquierda de la pantalla, panel de usuario -->
            <div class="col-md-3">
                <p class="lead">Perfil de usuario</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">Mis datos</a>
                    <a href="#" class="list-group-item">Mis gauchadas</a>
                    <a href="#" class="list-group-item">Mis postulaciones</a>
                </div>
            </div>


            <!-- parte derecha de la pantalla con datos -->
            <div class="col-md-9">
                <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Nombre de usuario</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src=# class="img-circle img-responsive"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Usuario:</td>
                        <td>Email de usuario</td>
                      </tr>
                      <tr>
                        <td>Fecha de nacimiento:</td>
                        <td>Fecha de nacimiento</td>
                      </tr>
                      <tr>
                        <td>Número de telefono:</td>
                        <td>221******</td>
                      </tr>
                      <tr>
                          <td>Contraseña:</td>
                          <td>********</td>
                      </tr>
                      <tr>
                          <td>Tarjeta asociada:</td>
                          <td>********</td>
                      </tr>
                    </tbody>
                  </table>
            </div> <!-- cierre de la columna md-9 -->
        </div> <!-- cierre del primer row -->
    </div> <!-- cierre del container -->

@endsection