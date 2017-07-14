@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <a class="btn btn-orange" href="/admin/rangos">Editar rangos</a>
                <a class="btn btn-orange" href="/admin/categorias">Editar categorías</a>
                <a class="btn btn-orange" href="/admin/balances">Mostrar balances</a>
                <a class="btn btn-orange" href="/admin/listusers">Mostrar usuarios registrados</a>
            </div> <!-- cierre de la columna md-9 -->
        </div> <!-- cierre del primer row -->
    </div> <!-- cierre del container -->

@endsection