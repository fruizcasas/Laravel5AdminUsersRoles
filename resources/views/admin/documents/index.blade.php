<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/documents/index.';
const VIEW_NAME = 'admin.documents.index';
?>

@include('admin.documents._routes')

@extends ('app')

@section('headings')
    <h1>{{trans($VN.'title')}}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.documents') !!}
@endsection



@section('content')

    @include('admin.documents._index_table',['readonly' => true,'models'=>$models])

@endsection