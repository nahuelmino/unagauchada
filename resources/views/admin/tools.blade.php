@extends('layouts.app')

@section('content')
<!--  <div class="container">
        <div class="row">
            <div class="col-md-9">
                <a class="btn btn-orange" href="/admin/rangos">Editar rangos</a>
                <a class="btn btn-orange" href="/admin/categorias">Editar categorías</a>
                <a class="btn btn-orange" href="/admin/balances">Mostrar balances</a>
                <a class="btn btn-orange" href="/admin/listusers">Mostrar usuarios registrados</a>
            </div> <!-- cierre de la columna md-9 -->
   <!--     </div> <!-- cierre del primer row -->
  <!--  </div> <!-- cierre del container -->  
	
	<!-- la nueva vista del panel -->
	    <div class="container">

        <div class="row">

        <!-- parte izquierda de la pantalla, panel de admin -->
            <div class="col-md-3">
                <p class="lead">Panel de control</p>
                <div class="list-group">
                    <a href="/admin/rangos" class="list-group-item">Editar rangos</a>
					<a href="/admin/categorias" class="list-group-item">Editar categorias</a>
                    <a href="/admin/balances" class="list-group-item">Mostrar balances</a>
                    <a href="/admin/listusers" class="list-group-item">Mostrar usuarios registrados</a>
                </div>
            </div>


            <!-- parte derecha de la pantalla con datos -->
            <div class="col-md-9">
                <div class="panel panel-info" style="border-color:orange">
                    <div class="panel-body">
                        <div class="row">
                          <p><h2 align="center"> Por favor seleccione una de las opciones</h2> 
						  <h2 align="center"> del panel a la izquierda</h2>
						  
                          <h2 align="center"> <-------------------------------</h2>
                          </p> 
                        </div>
                    </div>
                </div>
            </div> <!-- cierre de la columna md-9 -->
        </div> <!-- cierre del primer row -->
    </div> <!-- cierre del container -->


@endsection