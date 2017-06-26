@extends('layouts.app')

@section('added_styles')
    @include('plugins.datepicker.styles')
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">Editar mi perfil</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/users" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" maxlength="42" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                            <label for="surname" class="col-md-4 control-label">Apellido</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" name="surname" maxlength="42" value="{{ $user->surname }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" maxlength="42" placeholder="Alguien@ejemplo.com" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                            <label for="date_of_birth" class="col-md-4 control-label">Fecha de nacimiento</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="text" placeholder="Click aqui para desplegar el calendario" class="form-control datepicker" name="date_of_birth" value="{{ $user->date_of_birth }}" required>

                                @if ($errors->has('date_of_birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Teléfono</label>

                                <div class="col-md-6">
                                    <div class="flex-container">
                                        @php
                                            $phone = explode('-', $user->phone);
                                        @endphp
                                        <input id="caracteristica" type="text" class="form-control" name="caracteristica" placeholder="Codigo de area" required minlength="2" maxlength="4" value="{{ $phone[0] }}">
                                        <input id="phone" type="text" class="form-control" name="phone" placeholder="Numero sin 0 ni 15" value="{{ $phone[1] }}" required minlength="6" maxlength="8">

                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="photo" class="col-md-4 control-label">Foto</label>
                            <div class="col-md-6">
                                @if(isset($user->photo))
                                    <img src="{{ $user->photo }}" alt="">
                                @endif
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
                                    Confirmar cambios
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

@section ('added_scripts')
    @include('plugins.datepicker.scripts')
@endsection