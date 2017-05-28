@extends('layouts.app')

@section('content')
	<a class="btn btn-primary" href="/gauchadas/create">Nueva Gauchada</a>
	<ul>
		@foreach ($gauchadas as $gauchada)
			<li>
				{{ $gauchada['title'] }}
			</li>
		</ul>
	@endforeach
@endsection