@extends('layouts.app')

@section('content')
<div class="container">
        <div class="page-header">
            <h1><p class="text-center">{{ $gauchada['title'] }}</p></h1> 
        </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="thumbnail">
				@if (isset($gauchada['photo']))
					<img class="img-responsive marg5"; src="/storage/{{ $gauchada['photo'] }}" alt="">
				@endif
				<hr>
				<div class="caption-full marg5" style="margin-left:10px;" >
					<p">{{ $gauchada['description'] }}</p>
				</div>
			</div>
			@if (Auth::user())
			<div class="row">
				<div class="col-md-6">
					<div class="well" style="height:75px"> 
						<p style="margin-top: 8px">Cantidad de postulantes: {{ Auth::user()->cant_postulaciones($gauchada['id']) }}</p>
					</div>
				</div>
				<div class="col-md-6" >
					<div class="well" style="height:75px">
						@if (Auth::check() && !Auth::user()->esAdmin())
							@if (Auth::user()->cant_postulaciones($gauchada['id']) === 0)
								<form method="POST" action="/gauchadas/postulate">
									{{ csrf_field() }}
									<input type="hidden" name="gauchada" value="{{ $gauchada['id'] }}">
									<input type="hidden" name="necesitado" value="{{ $gauchada['creado_por'] }}">
									<button type="submit" class="btn btn-block btn-orange">Postularse!</button>
								</form>
							@else
								<button type="submit" class="btn btn-block" disabled>Te postulaste</button>
							@endif
						@endif
					</div>
				</div>
			</div>
			@endif
			<div class="well">
				<div class="row">
					<div class="col-md-12">
						<span class="pull-right">Anonymous, 10 days ago</span>
						<p>Estás libre la semana que viene?</p>
					</div>
					<ul>
						<small><li>Hola. Si, a partir del miércoles</li></small>
					</ul>
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
			<hr>
			<div class="text-left">
				<a class="btn btn-success">Deja una Pregunta!</a>
			</div>
		</div>
	</div>
</div>
@endsection
