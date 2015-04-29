<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/author/folders/index.';
const VIEW_NAME = 'author.folders.index';
?>

@include('author.folders._routes')

@extends ('app')

@section('headings')
    <h1>{{trans($VN.'title')}}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('author.folders') !!}
@endsection



@section('content')

    @include('author.folders._index_table',['readonly' => true,'models'=>$models])

@endsection