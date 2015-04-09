<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/index.';

?>

@extends('app')

@section('headings')
    <h1>{{trans($VN.'administration')}}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin') !!}
@endsection


@section('content')
    <ul>
        <li>
            <a href="{{ route('admin.users.index') }}">{{trans($VN.'users')}}</a>
        </li>
        <li>
            <a href="{{ route('admin.roles.index') }}">{{trans($VN.'roles')}}</a>
        </li>
        <li>
            <a href="{{ route('admin.permissions.index') }}">{{trans($VN.'permissions')}}</a>
        </li>
        <li>
            <a href="{{ route('admin.departments.index') }}">{{trans($VN.'departments')}}</a>
        </li>
    </ul>

@endsection
