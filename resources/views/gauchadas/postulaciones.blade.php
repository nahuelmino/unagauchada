@extends('layouts.app')

@section('content')
    <div class="container">
            <div class="page-header">
                <h1><p class="text-center">{{ $gauchada['title'] }}</p></h1> 
            </div>
    </div>
    @php
        $aceptado = \App\User::find($gauchada['aceptado']);
    @endphp
    @if($aceptado !== null)
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="padding-left: 0; padding-right: 8px;">
                <div class="well" style="display: flex; flex-direction: column; justify-content: center; height: 120px;">
                    <h2>{{ $aceptado['name'] }}</h2>                    
                    <h4><span>Puntos: <strong>{{ $aceptado['score'] }}</strong></span></h4>
                </div>
            </div>
            <div class="col-md-6" style="padding-left: 8px; padding-right: 0;">
                <div class="well" style="display: flex; align-items: center; height: 120px;">
                @if($gauchada->calificada())
                    <p>Calificación: <strong>{{ $gauchada->calificacion->name }}</strong></p>
                @else
                <form action="/gauchadas/{{ $gauchada->id }}/calificar" method="post" style="width: 100%;">
                    {{ csrf_field() }}
                    <p>Califica a tu postulante!</p>
                    <div class="inputs"  style="display: flex; justify-content: space-between;">
                    
                        @foreach($calificaciones as $calificacion)
                        <div class="radio-with-label" style="display: flex; align-items: center;">
                            <input type="radio" style="margin-right:4px;" name="calificacion_id" value="{{ $calificacion->id }}">{{ $calificacion->name }}
                        </div>
                        @endforeach
                    
                        <button class="btn btn-orange text-white">Calificar</button>
                    </div>
                    
                </form>
                @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    @foreach ($postulaciones as $postulacion)
        @php
            $user = \App\User::find($postulacion['postulante'])
        @endphp
        @if($aceptado === null || ($aceptado !== null && $aceptado->id !== $user->id))
        <div class="container">
            <div class="row" style="display: flex; align-items: center;">
                <div class="col-md-3" style="display: flex; align-items: center;">
                    <h3 style="margin: 10px 20px 10px 0;">{{ $user['name'] }}</h3>
                    <h6 style="margin: 0;">Puntos: <strong>{{ $user['score'] }}</strong></span></h6>  
                </div>
                
                <div class="col-md-9" style="display: flex; align-items: center;">
                    @if($errors->has('ya_aceptado'))
                        <div class="errors has-error">
                            <p>{{ $errors->ya_aceptado }}</p>
                        </div>
                    @endif
                    @if($aceptado === null)
                    <a class="btn btn-orange" href="/postulaciones/{{ $postulacion['id'] }}/accept">Aceptar</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
    @endforeach
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