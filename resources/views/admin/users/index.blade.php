<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/users/index.';
const VIEW_NAME    = 'admin.users.index';
?>

@include('admin.users._routes')

@extends ('app')

@section('headings')
    <h3>{{trans($VN.'title')}}</h3>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.users') !!}
@endsection


@section('content')

    @include('admin.users._index_table',['readonly' => true,'models'=>$models])

@endsection

