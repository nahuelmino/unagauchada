@extends('layouts.app')

@section('content')
	@if (Auth::user())
		<a class="btn btn-primary" href="/gauchadas/create">Nueva Gauchada</a>
	@endif
	<ul>
		@foreach ($gauchadas as $gauchada)
			<li>
				{{ $gauchada['title'] }}
			</li>
		</ul>
	@endforeach
@endsection