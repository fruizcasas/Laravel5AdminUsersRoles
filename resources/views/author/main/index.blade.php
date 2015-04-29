<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/author/main/index.';

?>

@extends('app')

@section('headings')
    <h1>{{trans($VN.'dashboard')}}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('author') !!}
@endsection


@section('content')
    <div class="col-sm-1">
        @include('author.main._menu')
    </div>
    <div class="col-sm-9" style="border-left: solid;">
    </div>
    <div class="col-sm-2" style="border-left: solid;">
    </div>
@endsection
