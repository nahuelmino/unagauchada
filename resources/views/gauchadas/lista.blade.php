@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<form class="form-group" role="search" method="GET" action="gauchadas">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Buscar Gauchada..." name="title">
						<div class="input-group-btn">
							<button class="btn btn-orange" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4 col-md-offset-4 text-right">
				@if (Auth::check())
					<a class="btn btn-orange highlighted" href="/gauchadas/create">Nueva Gauchada</a>
				@endif
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			@foreach ($gauchadas as $gauchada)
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								<a href="#">{{ $gauchada['title'] }}</a>
							</h3>
						</div>
						<div class="panel-body">
							@if (isset($gauchada['photo']))
								<div class="thumbnail">
									<img src="{{ $gauchada['photo'] }}" alt="">
								</div>
							@endif
							{{ $gauchada['description'] }}
						</div>
						<div class="panel-footer">
							<a class="btn btn-orange text-white" href="/gauchadas/{{$gauchada['id']}}">Ver</a>
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