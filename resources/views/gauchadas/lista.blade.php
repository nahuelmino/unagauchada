@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<form class="form-group" role="search" method="GET" action="gauchadas">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Filtrar por ciudad..." name="location">
						<div class="input-group-btn">
							<button class="btn btn-orange" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-2">
				Filtrar por categoría:
			</div>
			<div class="col-md-2">
				<form class="form-group" role="search" method="GET" action="gauchadas">
					<div class="input-group">
	                    <select id="categoria" class="form-control" name="categoria_id">
	                        <option value="0" selected>Todas</option>
		                    @foreach ($categorias as $categoria)
		                        <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
		                    @endforeach
						</select>
						<div class="input-group-btn">
							<button class="btn btn-orange" type="submit"><i class="glyphicon glyphicon-menu-right"></i></button>
						</div>
					</div>
				</form>
			</div>
			@if (Auth::check() && !Auth::user()->esAdmin())
				<div class="col-md-4 text-right">
						<a class="btn btn-orange highlighted" href="/gauchadas/create">Nueva Gauchada</a>
				</div>
			@endif
		</div>
	</div>
	<div class="container">
		<div class="row">
			@foreach ($gauchadas as $gauchada)
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								<a href="/gauchadas/{{$gauchada['id']}}">{{ $gauchada['title'] }}</a>
								<label for="" class="label label-primary bg-orange pull-right">
									{{ $gauchada->categoria->name }}
								</label>
							</h3>
						</div>
						<div class="panel-body">
							@if (isset($gauchada['photo']))
								<a href="/gauchadas/{{$gauchada['id']}}"><div class="thumbnail">
									<img src="{{ $gauchada['photo'] }}" alt="">
								</div></a>
							@endif
							{{ $gauchada['description'] }}
						</div>
						<div class="panel-footer">
							<a class="btn btn-orange text-white" href="/gauchadas/{{$gauchada['id']}}">Ver</a>
							@if (Auth::check() && Auth::user()->id === $gauchada['creado_por'])
								@if (Auth::user()->cant_postulaciones(request()->gauchada) === 0)
									<a class="btn btn-orange text-white" href="/gauchadas/{{$gauchada['id']}}/edit">Editar</a>
								@endif
								<a class="btn btn-orange text-white" href="/gauchadas/{{$gauchada['id']}}/delete">X</a>
							@endif
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 text-center">
				{{ $gauchadas->links() }}
			</div>
		</div>
	</div>
@endsection