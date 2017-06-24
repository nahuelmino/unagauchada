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
			<h4>Publicado por: {{ \App\User::find($gauchada['creado_por'])->name }} </h4>
		</div>
		<div class="col-md-12">
			<div class="thumbnail">
				@if (isset($gauchada['photo']))
					<img class="img-responsive" style="margin: 0 auto;" src="/storage/{{ $gauchada['photo'] }}" alt="">
                @else
                    <img src="http://placehold.it/200x200" alt="">
				@endif
				<hr>
				<div class="caption-full marg5" style="margin-left:10px;" >
					<p>{{ $gauchada['description'] }}</p>
				</div>
			</div>
			@if (Auth::user())
			<div class="row">
				<div class="col-md-6">
					<div class="well">
						Cantidad de postulantes: {{ $postulacions->count() }}
					</div>
				</div>
				<div class="col-md-6">
					<div class="well">
						@if (!Auth::check())
							<a href="{{ route('login') }}" class="btn btn-block btn-orange">Ingresa para postularte</a>
						@elseif (Auth::user()->esAdmin())
							<a class="btn btn-block text-orange" disabled>Como admin no puedes postularte</a>
						@elseif (Auth::user()->id === $gauchada['creado_por'])
							@if ($postulacions->count() > 0)
								<a class="btn btn-block btn-orange" href="/gauchadas/{{$gauchada['id']}}/postulaciones">Ver postulantes</a>
							@else
								<a class="btn btn-block text-orange" href="/gauchadas/{{$gauchada['id']}}/postulaciones" disabled>Ver postulantes</a>
							@endif
						@elseif ($postulacions->count() > 0)
							<a class="btn btn-block" disabled>Te postulaste</a>
						@else
							<form method="POST" action="/postulaciones/add">
								{{ csrf_field() }}
								<input type="hidden" name="gauchada" value="{{ $gauchada['id'] }}">
								<input type="hidden" name="necesitado" value="{{ $gauchada['creado_por'] }}">
								<button type="submit" class="btn btn-block btn-orange">Postularse!</button>
							</form>
						@endif
					</div>
				</div>
			</div>
			@endif
			<div class="well">
			@foreach ($preguntas as $pregunta)
				<div class="row">
					<div class="col-md-12">
						<span class="pull-right">{{ \App\User::find($pregunta['user_id'])->name }}, {{ $pregunta['created_at']->diffForHumans() }}</span>
						<p>{{ $pregunta['text'] }}</p>
					</div>
				</div>
			@endforeach
			<hr>
			<div class="text-left">
				<a class="btn btn-success">Deja una Pregunta!</a>
			</div>
		</div>
	</div>
</div>
@endsection

			<!--	<div class="row">
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
			</div> <-->