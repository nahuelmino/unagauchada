@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="page-header">
                <h1><p class="text-center">{{ $gauchada['title'] }}</p></h1> 
            </div>
    </div>
    @foreach ($postulaciones as $postulacion)
        <?php
            $user = \App\User::find($postulacion['postulante']);
            $photoarr = '12';
            if (isset($user['photo']))
                $photoarr = '6'
        ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-title text-center">
                    <h3>{{ $user['name'] }}</h3>
                </div>
                <div class="panel-body">
                    <div class="well" style="width:240px;height:240px;">
                        @if (isset($user['photo']))
                            <img src="/storage/{{ $user['photo'] }}" alt="" width="200" height="200">
                        @endif
                    </div>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-orange" href="/gauchadas/accept">Aceptar</a>
                </div>
            </div>
        </div>
    @endforeach
@endsection