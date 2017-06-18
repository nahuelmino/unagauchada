@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Perfil de usuario</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">Mis datos</a>
                    <a href="#" class="list-group-item">Mis gauchadas</a>
                    <a href="#" class="list-group-item">Mis postulaciones</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Nombre de usuario</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>
                
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
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