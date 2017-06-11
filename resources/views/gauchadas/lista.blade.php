@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="row">
            	
			<div class="col-md-3">
				<label for="sel1"><p class="lead">Ciudad:</p></label>
                <form class="form-group" role="search" method="GET" action="gauchadas">
                    <div class="input-group">
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
                            <option value="0" selected>Todas</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-btn">
                            <button class="btn btn-orange" type="submit"><i class="glyphicon glyphicon-menu-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>       

            <div class="col-md-9">
                
                <div class="row">
				@foreach ($gauchadas as $gauchada)
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            @if (isset($gauchada['photo']))
                                <a href="/gauchadas/{{$gauchada['id']}}">
                                    <div class="thumbnail">
                                        <img src="{{ $gauchada['photo'] }}" alt="">
                                    </div>
                                </a>
                            @else
                                <img src="http://placehold.it/320x150" alt="">
                            @endif

                            <div class="caption">
                                <h4><a href="/gauchadas/{{$gauchada['id']}}">{{ $gauchada['title'] }}</a>
                                </h4>
                                <p>{{ $gauchada['description'] }}</p>
                            </div>
                        </div>
                        <a class="btn btn-orange text-white" href="/gauchadas/{{$gauchada['id']}}">Ver</a>
                    </div>
                @endforeach
                </div>

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