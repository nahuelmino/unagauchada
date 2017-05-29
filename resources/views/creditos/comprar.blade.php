@extends('layouts.app')

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
                            <input id="compra_creditos" type="text" name="num_tarjeta" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx" required>
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
