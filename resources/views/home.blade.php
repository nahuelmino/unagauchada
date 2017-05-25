@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="input-group" style="margin-bottom: 10px">
                        <span>Créditos: </span><span>{{ $user->credits }}</span>
                    </div>
                    <form action="/compras" method="post" class="form">
                        {{ csrf_field() }}<!--
                        <div class="form-group">
                            <label for="compra_creditos">Comprar creditos</label>
                            <input id="compra_creditos" type="number" name="cantidad_creditos" class="form-control">
                        </div>-->
                        <input id="compra_creditos" type="hidden" name="cantidad_creditos" class="form-control" value=1>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Comprar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
