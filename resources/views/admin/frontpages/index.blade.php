<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/frontpages/index.';
const VIEW_NAME = 'admin.frontpages.index';
?>

@include('admin.frontpages._routes')

@extends ('app')

@section('headings')
    <h1>{{trans($VN.'title')}}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.frontpages') !!}
@endsection



@section('content')

    @include('admin.frontpages._index_table',['readonly' => true,'models'=>$models])

@endsection