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
            <a href="{{ route('admin.users.index') }}">Users</a>
        </li>
        <li>
            <a href="{{ route('admin.roles.index') }}">Roles</a>
        </li>
        <li>
            <a href="{{ route('admin.permissions.index') }}">Permissions</a>
        </li>
        <li>
            <a href="{{ route('admin.departments.index') }}">Departments</a>
        </li>
    </ul>

@endsection
