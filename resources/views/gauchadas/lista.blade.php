@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		
			<div class="col-md-3">
				<label for="sel1"><p class="lead">Ciudad:</p></label>
				<form class="form-group" role="search" method="GET" action="gauchadas">
					<div class="input-group">
						@foreach ($request as $k => $v)
							@if ($k !== 'location')
								<input type="hidden" name="{{ $k }}" value="{{ $v }}">
							@endif
						@endforeach
						<input type="text" class="form-control" placeholder="Filtrar por ciudad..." name="location">
						<div class="input-group-btn">
							<button class="btn btn-orange" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				</form>
				<label for="sel1"><p class="lead">Categoria:</p></label>
				<form class="form-group" role="search" method="GET" action="gauchadas">
					<div class="input-group">
						<select id="categoria" class="form-control" name="categoria_id">
							@if (! isset($request['categoria_id']))
								<option value="0" selected>Todas</option>
							@else
								<option value="0">Todas</option>
							@endif
							@foreach ($categorias as $categoria)
								@if (isset($request['categoria_id']) && $request['categoria_id'] == $categoria['id'])
									<option value="{{ $categoria->id }}" selected>{{ $categoria->name }}</option>
								@else
									<option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
								@endif
							@endforeach
						</select>
						@foreach ($request as $k => $v)
							@if ($k !== 'categoria_id')
								<input type="hidden" name="{{ $k }}" value="{{ $v }}">
							@endif
						@endforeach
						<div class="input-group-btn">
							<button class="btn btn-orange" type="submit"><i class="glyphicon glyphicon-menu-right"></i></button>
						</div>
					</div>
				</form>
				<form class="form-group" role="search" method="GET" action="gauchadas">
					<div class="input-group">
						@foreach ($request as $k => $v)
							@if ($k !== 'sortByPostulaciones')
								<input type="hidden" name="{{ $k }}" value="{{ $v }}">
							@endif
						@endforeach
						<div class="input-group-btn">
							@if (isset($request['sortByPostulaciones']) && $request['sortByPostulaciones'] === '1')
								<input type="hidden" name="sortByPostulaciones" value="0">
								<button class="btn btn-orange" type="submit">No ordenar</button>
							@else
								<input type="hidden" name="sortByPostulaciones" value="1">
								<button class="btn btn-orange" type="submit">Ordenar por postulaciones</button>
							@endif
						</div>
					</div>
				</form>
				<a class="btn btn-orange" href="/gauchadas">Limpiar filtros</a>

			</div>
			
			<div class="col-md-9">
			<div class="row">
					@if ($errors->has('0'))
						<span class="help-block">
							<strong>{{ $errors->first('0') }}</strong>
						</span>
					@endif
			</div>
				<div class="row">
				
					@forelse ($gauchadas as $gauchada)
						<div class="col-md-4">
							<div class="well single-gauchada">
								<label for="" class="label label-primary bg-orange category-label">
									{{ $gauchada->categoria->name }}
								</label>
								<a href="/gauchadas/{{$gauchada['id'] }}" class="thumbnail">
										@if (isset($gauchada['photo']))
											<img src="{{ $gauchada['photo'] }}" width="150" height="150">
										@else
											<img src="/img/icon.png" width="150" height="150" >
										@endif
								</a>
							<div class="caption">
								<a href="/gauchadas/{{$gauchada['id'] }}"><h4>
									{{ $gauchada['title'] }}
								</a></h4>	
								<p>{{ str_limit($gauchada['description'], 110) }}</p>
							</div>
							@if (Auth::check() && Auth::user()->id === $gauchada['creado_por'])
								@if ($gauchada['postulacions_count'] === 0)
									<a class="btn btn-orange text-white" href="/gauchadas/{{$gauchada['id']}}/edit">Editar</a>
								@else
									<a class="btn btn-orange text-white" disabled>Editar</a>	
								@endif
							<a class="btn btn-orange text-white needs-confirmation" data-confirmation-message="Esta seguro de eliminar esta gauchada?" href="/gauchadas/{{$gauchada['id']}}/delete">X</a>
							@endif
							
							</div>
						</div>
					@empty
					<div class="col-md-12">
						<p>No se encontraron gauchadas.</p>
					</div>
					@endforelse
				</div>
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