@extends('layouts.app')

@section('content')
<div class="container">
        <div class="page-header">
            <h1><p class="text-center">{{ $gauchada['title'] }}</p></h1> 
        </div>
</div>
<div class="container">

    <div class="row">

        <div class="col-md-12 form-group">
            @if (isset($gauchada['photo']))
                <img class="img-responsive" style="margin: 0 auto;" src="{{ $gauchada['photo'] }}" alt="">
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>{{ $gauchada['description'] }}</p>
        </div>
    </div>
</div>
@if (Auth::check() && !Auth::user()->esAdmin())
    <div class="row">
        <div class="col-md-10 text-right">
            <form method="POST" action="/gauchadas/postulate">
                {{ csrf_field() }}
                <input type="hidden" name="gauchada" value="{{ $gauchada['id'] }}">
                <input type="hidden" name="necesitado" value="{{ $gauchada['creado_por'] }}">
                <button type="submit" class="btn btn-primary btn-orange">Postularse</button>
            </form>
        </div>
    </div>
@endif
            <!--div class="row">

            <div class="col-md-6">
                <div class="well">
                    <p class="text-left">Cantidad de Postulantes:</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="well">
                    <a href="#" class="btn btn-info btn-block" role="button ">Postularse!</a> 
                </div>
            </div>
            </div>


                <div class="well">

                    <div class="text-right">
                        <a class="btn btn-success">Deja una Pregunta!</a>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            Anonymous
                            <span class="pull-right">10 days ago</span>
                            <p>This product was great in terms of quality. I would definitely buy another!</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            Anonymous
                            <span class="pull-right">12 days ago</span>
                            <p>I've alredy ordered another one!</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            Anonymous
                            <span class="pull-right">15 days ago</span>
                            <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    
    <div class="container">

        <hr>
    
    
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>unaGauchada 2017</p>
                </div>
            </div>
        </footer>

    </div>
                <a class="btn btn-orange highlighted" href="/gauchadas/{{ $gauchada['id'] }}/postulate"></a>
-->
@endsection