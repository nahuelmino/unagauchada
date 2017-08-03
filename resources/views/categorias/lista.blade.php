@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="col-md-9">
			<div class="row">
				@if ($errors->has('0'))
					<span class="help-block">
						<strong>{{ $errors->first('0') }}</strong>
					</span>
				@endif
			</div>
			<div class="row">
                <a class="btn btn-orange" href="/admin/categorias/add">Agregar</a>
				@foreach ($categorias as $categoria)
			        <div class="container">
			            <div class="row" style="display: flex; align-items: center;">
			                <div class="col-md-4" style="display: flex;">
			                    <h3 style="margin: 10px 20px 10px 0;">{{ $categoria['name'] }}</h3>
			                </div>
			                
			                <div class="col-md-7" style="display: flex;">
			                    <a class="btn btn-orange" href="/admin/categorias/{{ $categoria['id'] }}/edit">Editar</a>
			                    @if ($categoria['gauchadas_count'] > 0)
									<a class="btn btn-orange" disabled title="No se puede eliminar una categoría con postulaciones">X</a>
								@else
									<a class="btn btn-orange needs-confirmation" data-confirmation-message="Esta seguro de eliminar esta categoria?" href="/admin/categorias/{{ $categoria['id'] }}/delete">X</a>
								@endif
			                </div>
			            </div>
			        </div>
				@endforeach
			</div>
		</div>
	</div>
@endsection