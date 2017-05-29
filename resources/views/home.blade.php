@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Mi perfil</div>

                <div class="panel-body">
                    <div class="input-group" style="margin-bottom: 10px">
                        <span>Créditos: </span><span>{{ Auth::user()->credits }}</span>
                    </div>
                    <a href="{{ route('comprar') }}" class="btn btn-primary btn-orange">Comprar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
