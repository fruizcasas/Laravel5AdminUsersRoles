<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/folders/index.';
const VIEW_NAME = 'admin.folders.index';
?>

@include('admin.folders._routes')

@extends ('app')

@section('headings')
    <h1>{{trans($VN.'title')}}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.folders') !!}
@endsection



@section('content')

    @include('admin.folders._index_table',['readonly' => true,'models'=>$models])

@endsection