@extends('layouts.app')

@section('content')
	<div class="container">

        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                  <label for="sel1"><p class="lead">Categoria:</p></label>
                  <select class="form-control" id="sel1">
                    <option>Cualquiera</option>
                    <option>Mascotas</option>
                    <option>Refaccion</option>
                    <option>Ilegales</option>
                    </select>
                </div>

            <div class="form-group">
                <label for="sel1"><p class="lead">Ciudad:</p></label>
                <select class="form-control" id="sel1">
                    <option>Cualquiera</option>
                    <option>La Plata</option>
                    <option>City Bell</option>
                    <option>Gonnet</option>
                    </select>
                </div>


            </div>

            <div class="col-md-9">

                <div class="row">
                    @foreach ($gauchadas as $gauchada)
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                @if (isset($gauchada['photo']))
                                    <img src="http://placehold.it/320x150" alt="">
                                @endif
                                <div class="caption">
                                    <h4><a href="#">{{ $gauchada['title'] }}</a>
                                    <label for="" class="label label-primary bg-orange pull-right">
                                    {{ $gauchada->categoria->name }}
                                </label>
                                    </h4>
                                    <p>{{ $gauchada['description'] }}</p>
                                </div> 
                                <div class="panel-footer">
                            <a class="btn btn-orange text-white" href="/gauchadas/{{$gauchada['id']}}">Ver</a>
                        </div>                           
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
@endsection