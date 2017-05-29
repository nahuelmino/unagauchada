@extends('layouts.app')

@section('added_styles')
    <link rel="stylesheet" href="/css/welcome.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="flex-center full-height home-background">
            <div class="content">
                <div class="title m-b-md text-orange">
                    Bienvenidos a Una Gauchada!
                    <div class="btn-group">
                        <a class="btn btn-orange highlighted home-button" href="{{ route('login') }}">Iniciar Sesión</a>
                        <a class="btn btn-orange highlighted home-button" href="{{ route('register') }}">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
