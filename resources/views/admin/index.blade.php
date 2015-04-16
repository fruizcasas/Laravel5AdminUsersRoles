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
        <li> {{trans($VN.'people')}}
            <ul>
                <li>
                    <a href="{{ route('admin.users.index') }}">{{trans($VN.'users')}}</a>
                </li>
                <li>
                    <a href="{{ route('admin.departments.index') }}">{{trans($VN.'departments')}}</a>
                </li>
                <li>
                    <a href="{{ route('admin.roles.index') }}">{{trans($VN.'roles')}}</a>
                </li>
                <li>
                    <a href="{{ route('admin.permissions.index') }}">{{trans($VN.'permissions')}}</a>
                </li>
            </ul>
        </li>
        <li> {{trans($VN.'documents')}}
            <ul>
                <li>
                    <a href="{{ route('admin.folders.index') }}">{{trans($VN.'folders')}}</a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}">{{trans($VN.'categories')}}</a>
                </li>
                <li>
                    <a href="{{ route('admin.documents.index') }}">{{trans($VN.'documents')}}</a>
                </li>
                <li>
                    <a href="{{ route('admin.frontpages.index') }}">{{trans($VN.'frontpages')}}</a>
                </li>
            </ul>
        </li>
    </ul>

@endsection
