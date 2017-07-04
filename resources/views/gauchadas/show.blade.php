@extends('layouts.app')

@section('content')
<div class="container">
        <div class="page-header">
            <h1><p class="text-center">{{ $gauchada['title'] }}</p></h1> 
        </div>
</div>
<div class="container">
	<div class="row">
		@if(!Auth::check() || (Auth::check() && Auth::user()->id !== $gauchada['creado_por']))
		<div class="col-md-12">
			<h4>Publicado por: {{ \App\User::find($gauchada['creado_por'])->name }} </h4>
		</div>
		@else
		<div class="col-md-12">
			<a href="#" class="btn btn-orange">Finalizar gauchada</a>
		</div>
		@endif
		<div class="col-md-12">
			<div class="thumbnail">
				@if (isset($gauchada['photo']))
					<img class="img-responsive" style="margin: 0 auto;" src="{{ $gauchada['photo'] }}" alt="">
                @else
                    <img src="/img/icon.png">
				@endif
				<hr>
				<div class="caption-full marg5" style="margin-left:10px;" >
					<p>{{ $gauchada['description'] }}</p>
				</div>
			</div>
				<div class="row">
					@if (Auth::check() && Auth::user()->id === $gauchada['creado_por'])
					<div class="col-md-9">
						<div class="well">
							Cantidad de postulantes: {{ $postulacions->count() }}
						</div>
					</div>
					@endif
					<div class="col-md-3">
							@if (!Auth::check())
								<div class="well">
									<a href="{{ route('login') }}" class="btn btn-block btn-orange">Ingresa para postularte</a>
								</div>
							@elseif (Auth::user()->esAdmin())
							<div class="well">
								<a class="btn btn-block text-orange" disabled>Como admin no puedes postularte</a>
							</div>
							@elseif (Auth::user()->id === $gauchada['creado_por'])
								@if ($postulacions->count() > 0)
									<div class="well">
										<a class="btn btn-block btn-orange" href="/gauchadas/{{$gauchada['id']}}/postulaciones">Ver postulantes</a>
									</div>
								@endif
							@elseif ($postulacions->count() > 0)
								<div class="well">
									<a class="btn btn-block" disabled>Te postulaste</a>
								</div>
							@else
								<div class="well">
									<form method="POST" action="/postulaciones/add">
										{{ csrf_field() }}
										<input type="hidden" name="gauchada" value="{{ $gauchada['id'] }}">
										<input type="hidden" name="necesitado" value="{{ $gauchada['creado_por'] }}">
										<button type="submit" class="btn btn-block btn-orange">Postularse!</button>
									</form>
								</div>
							@endif
							
					</div>
				</div>
			@if (count($preguntas) > 0)
			<div class="well">
				@foreach ($preguntas as $pregunta)
					<div class="row">
						<div class="col-md-12">
							<span class="pull-right">{{ \App\User::find($pregunta['user_id'])->name }}, {{ $pregunta['created_at']->diffForHumans() }}</span>
							<p>{{ $pregunta['text'] }}</p>
							@if (isset($pregunta['respuesta']))
								<ul style="list-style: none;">
									<small><li>{{ $pregunta['respuesta']['text'] }} &nbsp &nbsp {{ $pregunta['respuesta']['created_at']->diffForHumans() }}</li></small>
								</ul>
							@else
							@if(Auth::check() && Auth::user()->id == $gauchada['creado_por'])
							<form action="/preguntas/{{ $pregunta->id }}" method="post">
								{{ csrf_field() }}
								<div class="form-group">
									<textarea name="respuesta" class="form-control" cols="30" rows="2" placeholder="Deja una respuesta" required></textarea>
								</div>
								<button type="submit" class="btn btn-orange">Responder</button>
							</form>
							@endif
							@endif
						</div>
					</div>
					@if (!($loop->first || $loop->last))
					<hr>
					@endif
				@endforeach
			</div>
			@endif
			@if(Auth::check() && Auth::user()->id !== $gauchada['creado_por'])
				<form method="POST" action="/preguntas">
					<p>Deja una Pregunta!</p>
					{{ csrf_field() }}
					<input type="hidden" name="gauchada_id" value="{{ $gauchada->id }}">
					<textarea name="pregunta" id="text" class="form-control" value="{{ old('text') }}" placeholder="Deja una pregunta..." required></textarea>
					<p></p>
					<button type="submit" class="btn btn-orange">Preguntar</button>
				</form>
			@endif
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