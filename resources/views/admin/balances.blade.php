@extends('layouts.app')

@section('added_styles')
	@include('plugins.datepicker.styles')
@endsection

@section('content')
	<div class="container-fluid">
		<div class="col-md-9">
			<div class="row">
				<form action="/admin/balances" method="get" style="margin: 10px 0;">
					<div class="input-group" style="display: inline-block; vertical-align: middle;">
						<label for="fecha_inicio">Fecha inicio</label>
						<input type="text" id="fecha_inicio" name="fecha_inicio" class="datepicker form-control">
					</div>
					<div class="input-group" style="display: inline-block; vertical-align: middle;">
						<label for="fecha_fin">Fecha fin</label>
						<input type="text" id="fecha_fin" name="fecha_fin" class="datepicker form-control">
					</div>
					<input type="submit" value="Buscar" style="display: inline-block; vertical-align: middle;">
				</form>
			</div>
			<div class="row">
				@if ($errors->has('0'))
					<span class="help-block">
						<strong>{{ $errors->first('0') }}</strong>
					</span>
				@endif
			</div>
			<div class="row">
			    <div class="container">
		            <div class="row" style="display: flex; align-items: center; background-color:yellow;">
		                <div class="col-md-4" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Nombre</strong></h5>
		                </div>
		                <div class="col-md-4" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Apellido</strong></h5>
		                </div>
		                <div class="col-md-2" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Precio unitario</strong></h5>
		                </div>
		                <div class="col-md-2" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Cantidad</strong></h5>
		                </div>
		                <div class="col-md-2" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;"><strong>Subtotal</strong>
		                    </h5>
		                </div>
		            </div>
					@php
						$total = 0
					@endphp
					@foreach ($compras as $compra)
			            <div class="row" style="display: flex; align-items: center;">
			                <div class="col-md-4" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $compra->usuario->name }}</h5>
			                </div>
			                <div class="col-md-4" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $compra->usuario->surname }}</h5>
			                </div>
			                <div class="col-md-2" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $compra['precio_unitario'] }}</h5>
			                </div>
			                <div class="col-md-2" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $compra['cantidad'] }}</h5>
			                </div>
			                <div class="col-md-2" style="display: flex;">
			                    <h5 style="margin: 10px 20px 10px 0;">{{ $compra['precio_unitario'] * $compra['cantidad'] }}
			                    @php
			                    	$total = $total + $compra['precio_unitario'] * $compra['cantidad']
			                    @endphp
			                    </h5>
			                </div>
			            </div>
					@endforeach
			    </div>
				<hr />
		        <div class="container">
		            <div class="row" style="display: flex; align-items: center;">
		                <div class="col-md-2 col-md-offset-10" style="display: flex;">
		                    <h5 style="margin: 10px 20px 10px 0;">Total: {{ $total }}</h5>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>
@endsection

@section('added_scripts')
	@include('plugins.datepicker.scripts')
@endsection