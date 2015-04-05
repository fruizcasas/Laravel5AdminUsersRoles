@extends('app')

@section('headings')
    <h1>Home</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('home') !!}
@endsection

@section('content')
<div class="row">
    <div class="panel panel-info">
        <div class="panel-body">
            You are logged in!
        </div>
    </div>
</div>
@endsection
