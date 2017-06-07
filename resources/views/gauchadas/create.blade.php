@extends('layouts.app')

@section('added_styles')
    @include('plugins.datepicker.styles')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Publicar nueva gauchada</div>
                <div class="panel-body">

                    @if ($errors->has('0'))
                    <div class="form-group{{ $errors->has('0') ? ' has-error' : '' }}">
                        <span class="help-block">
                            <strong>{!! $errors->first('0') !!}</strong>
                        </span>
                    </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="/gauchadas/create" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Título</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Descripción</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description" value="{{ old('description') }}" required></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Ubicación (ciudad)</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required>

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ends_at') ? ' has-error' : '' }}">
                            <label for="ends_at" class="col-md-4 control-label">Abierta hasta: </label>

                            <div class="col-md-6">
                                <input id="ends_at" type="text" class="form-control datepicker" name="ends_at" value="{{ old('ends_at') }}" required>

                                @if ($errors->has('ends_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ends_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
                            <label for="categoria" class="col-md-4 control-label">Categoría</label>

                            <div class="col-md-6">
                                <select id="categoria" class="form-control" name="categoria_id">
                                    <option value="0" disabled selected>-- Seleccione una --</option>
                                    <?php

                                    foreach ($categorias as $categoria) {
                                        $sel = '';
                                        if (old('categoria') == $categoria->id) {
                                            $sel = ' selected';
                                        }
                                        ?>
                                        <option value="{{ $categoria->id }}{{ $sel }}">{{ $categoria->name }}</option>
                                    <?php } ?>
                                </select>

                                @if ($errors->has('categoria'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('categoria') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="photo" class="col-md-4 control-label">Foto (opcional)</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" name="photo" value="{{ old('photo') }}">

                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-orange">
                                    Publicar
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

@section('added_scripts')
    @include('plugins.datepicker.scripts')
@endsection
