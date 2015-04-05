@extends('app')

@section('headings')
    <h1>Administration</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin') !!}
@endsection


@section('content')
    <ul>
        <li>
            <a href="{{ action('Admin\UsersController@index') }}">Users</a>
        </li>
        <li>
            <a href="{{ action('Admin\RolesController@index') }}">Roles</a>
        </li>
    </ul>

@endsection
