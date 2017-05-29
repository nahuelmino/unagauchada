@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-header">{{ $gauchada['title'] }}</h3>
            <div>
                @if (isset($gauchada['photo']))
                    <div class="thumbnail">
                        <img src="{{ $gauchada['photo'] }}" alt="">
                    </div>
                @endif
                {{ $gauchada['description'] }}
            </div>
        </div>
    </div>
</div>
@endsection