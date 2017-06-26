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
                        <a class="btn btn-orange" href="/postulaciones/{{ $postulacion['id'] }}/accept">Aceptar</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <?php $user = \App\User::find($gauchada['aceptado']) ?>
        <div class="panel-body">
            <div class="well" style="width:240px;height:240px;">
                @if (isset($user['photo']))
                    <img src="{{ $user['photo'] }}" alt="" width="200" height="200">
                @else
                    <img src="http://placehold.it/200x200" alt="">
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