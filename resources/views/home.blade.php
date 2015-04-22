@extends('app')

@section('headings')
    <h1>Home</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('home') !!}
@endsection

@section('content')
         <div class="headings">
             <h1>You are logged in!</h1>
         </div>
@endsection
