@extends('layouts.app')

@section('added_styles')
    @include('plugins.datepicker.styles')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Agregar nuevo rango</div>
                <div class="panel-body">

                    @if ($errors->has('0'))
                    <div class="form-group{{ $errors->has('0') ? ' has-error' : '' }}">
                        <span class="help-block">
                            <strong>{!! $errors->first('0') !!}</strong>
                        </span>
                    </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="/admin/rangos/add" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre del rango</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('valor') ? ' has-error' : '' }}">
                            <label for="valor" class="col-md-4 control-label">Valor mínimo para pertenecer</label>

                            <div class="col-md-6">
                                <input id="valor" type="number" class="form-control" name="valor" value="{{ old('valor') }}" required min="2">

                                @if ($errors->has('valor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('valor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-orange">
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
