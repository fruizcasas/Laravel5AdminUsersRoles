@extends('app')

@section('headings')
@endsection

@section('content')
    <div class="container" style="text-align: center;display: table-cell;vertical-align: middle;">
        <div class="content" style="text-align: center;display: inline-block;">
           {!! Html::image('/images/laravel-logo.png','laravel-logo',['class'=> "img-rounded"]) !!}
        </div>
    </div>
@stop
