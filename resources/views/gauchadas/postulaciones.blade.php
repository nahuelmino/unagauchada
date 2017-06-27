@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="page-header">
                <h1><p class="text-center">{{ $gauchada['title'] }}</p></h1> 
            </div>
    </div>
    @if ($gauchada['aceptado'] === null)
        @foreach ($postulaciones as $postulacion)
            <?php $user = \App\User::find($postulacion['postulante']) ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h3>{{ $user['name'] }}</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        @if($errors->has('ya_aceptado'))
                            <div class="errors has-error">
                                <p>{{ $errors->ya_aceptado }}</p>
                            </div>
                        @endif
                        <a class="btn btn-orange" href="/postulaciones/{{ $postulacion['id'] }}/accept">Aceptar</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <?php $user = \App\User::find($gauchada['aceptado']) ?>
        <div class="panel-body">
            <div class="well" style="width:300px;height:300px; margin-left: auto; margin-right: auto;" align="center">
                @if (isset($user['photo']))
                    <img src="{{ $user['photo'] }}" alt="" width="200" height="200">
                @else
                    <img src="/img/usernopic.jpg" alt="" width="200" height="200">
                @endif
                <h3>{{ $user['name'] }}</h3>
            </div>
            <div class="well" style="width:300px;height:300px; margin-left: auto; margin-right: auto;">
                @if($gauchada->calificada())
                    <p>Calificación: {{ $gauchada->calificacion->name }}</p>
                @else
                <form action="/gauchadas/{{ $gauchada->id }}/calificar" method="post">
                    {{ csrf_field() }}
                    <p>Califica a tu postulante!</p>
                    @foreach($calificaciones as $calificacion)
                        <input type="radio" name="calificacion_id" value="{{ $calificacion->id }}">{{ $calificacion->name }}
                    @endforeach
                    <button class="btn btn-orange text-white">Calificar</button>
                </form>
                @endif
            </div>
        </div>
    @endif
@endsection
                <?php /* ?>
                <!--
                    <form method="POST" action="/postulaciones/accept">
                        {{ csrf_field() }}
                        <input type="hidden" name="gauchada" value="{{ $postulacion['gauchada'] }}">
                        <input type="hidden" name="postulacion" value="{{ $postulacion['id'] }}">
                        <button type="submit" class="btn btn-block btn-orange">Aceptar</button>
                    </form>
                $photoarr = '12';
                if (isset($user['photo']))
                    $photoarr = '6'
                --> <?php */?>