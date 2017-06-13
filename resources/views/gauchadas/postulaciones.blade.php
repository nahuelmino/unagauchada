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
        <div class="col-md-{{ $photoarr }}">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="panel-title">
                        {{ $user['name'] }}
                    </h3>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-orange" href="/gauchadas/accept">Aceptar</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @if (isset($user['photo']))
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="thumbnail">
                            <img src="{{ $user['photo'] }}" alt="">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
@endsection