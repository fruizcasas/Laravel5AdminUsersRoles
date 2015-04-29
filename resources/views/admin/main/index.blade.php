<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/main/index.';

?>

@extends('app')

@section('headings')
    <h1>{{trans($VN.'dashboard')}}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin') !!}
@endsection


@section('content')
    <div class="col-sm-1">
        @include('admin.main._menu')
    </div>
    <div class="col-sm-9" style="border-left: solid;">
        <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_users" aria-controls="tab_users" role="tab"
                       data-toggle="tab">Users</a></li>
                <li role="presentation"">
                    <a href="#tab_departments" aria-controls="tab_departments" role="tab"
                       data-toggle="tab">Departments</a></li>
                <li role="presentation">
                    <a href="#tab_roles" aria-controls="tab_roles" role="tab"
                       data-toggle="tab">Roles</a></li>
                <li role="presentation">
                    <a href="#tab_permissions" aria-controls="tab_permissions" role="tab"
                       data-toggle="tab">Permissions</a></li>
                <li role="presentation" >
                    <a href="#tab_folders" aria-controls="tab_folders" role="tab"
                       data-toggle="tab">Folders</a></li>
                <li role="presentation"">
                <a href="#tab_categories" aria-controls="tab_categories" role="tab"
                   data-toggle="tab">Categories</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="tab_users">
                    @include('admin.main.users.widget')
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_departments">
                    @include('admin.main.departments.widget')
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_roles">
                    @include('admin.main.roles.widget')
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_permissions">
                    @include('admin.main.permissions.widget')
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_folders">
                    @include('admin.main.folders.widget')
                </div>
                <div role="tabpanel" class="tab-pane" id="tab_categories">
                    @include('admin.main.categories.widget')
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2" style="border-left: solid;">
    </div>
@endsection
