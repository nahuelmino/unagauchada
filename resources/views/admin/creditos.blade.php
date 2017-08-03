@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" align="center"> <h4>Cambiar costo del crédito</h4></div>

                <div class="panel-body">
                    <form action="/admin/credits" method="post" class="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="precio_credito">Precio por crédito</label>
                            <input id="precio_credito" type="number" name="precio_credito" class="form-control" value="{{ $precio['unitario'] }}" required min="1">
                        </div>
                        <div class="form-group{{ $errors->has('0') ? ' has-error' : '' }}">
                            <button type="submit" class="btn btn-primary btn-orange">Actualizar</button>

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