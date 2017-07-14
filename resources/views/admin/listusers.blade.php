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
		        <div class="container">
		            <div class="row" style="display: flex;">
		                <div class="col-md-8" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Email</strong></h5>
		                </div>
		                <div class="col-md-4" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Nombre</strong></h5>
		                </div>
		                <div class="col-md-4" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Apellido</strong></h5>
		                </div>
		                <div class="col-md-4" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Fecha de nacimiento</strong></h5>
		                </div>
		                <div class="col-md-4" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Teléfono</strong></h5>
		                </div>
		                <div class="col-md-2" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Créditos</strong></h5>
		                </div>
		                <div class="col-md-2" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Puntuación</strong></h5>
		                </div>
		                <div class="col-md-4" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Fecha de registro</strong></h5>
		                </div>
		            </div>
                	@foreach ($users as $user)
			            <div class="row" style="display: flex;">
			                <div class="col-md-8" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $user['email'] }}</h5>
			                </div>
			                <div class="col-md-4" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $user['name'] }}</h5>
			                </div>
			                <div class="col-md-4" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $user['surname'] }}</h5>
			                </div>
			                <div class="col-md-4" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $user['date_of_birth'] }}</h5>
			                </div>
			                <div class="col-md-4" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $user['phone'] }}</h5>
			                </div>
			                <div class="col-md-2" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $user['credits'] }}</h5>
			                </div>
			                <div class="col-md-2" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $user['score'] }}</h5>
			                </div>
			                <div class="col-md-4" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $user['created_at'] }}</h5>
			                </div>
			            </div>
					@endforeach
			    </div>
			</div>
		</div>
	</div>
@endsection