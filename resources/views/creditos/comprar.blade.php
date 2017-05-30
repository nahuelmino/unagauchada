@extends('layouts.app')

@section('added_styles')
    @include('plugins.datepicker.styles')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Comprar créditos</div>

                <div class="panel-body">
                    <form action="/compras" method="post" class="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nombre_completo">Nombre completo:</label>
                            <input id="nombre_completo" name="nombre_completo" class="form-control" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="compra_creditos">Número de tarjeta:</label>
                            <input id="compra_creditos" type="text" name="num_tarjeta" class="form-control numbers-only" placeholder="Ingresa los 16 numeros de tu tarjeta" required>
                        </div>
                        <div class="form-group">
                            <label for="codigo_verification">Código de verificacion</label>
                            <input id="codigo_verification" type="text" class="form-control numbers-only" name="codigo_verificacion" minlength="3" maxlength="3" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha inicio</label>
                            <input id="fecha_inicio" type="text" name="fecha_inicio" class="form-control datepicker" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_expiracion">Fecha de expiracion</label>
                            <input id="fecha_expiracion" type="text" name="fecha_expiracion" class="form-control datepicker" required>
                        </div>
                        <div class="form-group{{ $errors->has('0') ? ' has-error' : '' }}">
                            <button type="submit" class="btn btn-primary btn-orange">Comprar</button>

                            @if ($errors->has('0'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('0') }}</strong>
                                </span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('added_scripts')
    @include('plugins.datepicker.scripts')
@endsection