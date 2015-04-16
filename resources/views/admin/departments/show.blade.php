<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/departments/show.';

const VIEW_NAME    = 'admin.departments.show';
?>

@include('admin.departments._routes')

@extends ('app')

@section('headings')
    <h1>{{trans($VN.'title')}}: {{ $model->name }}</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-primary">
             @include('partials.crud.show_buttons')
             @include('admin.departments._form',['readonly' => true])
             @include('partials.crud.bottom_buttons')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection

