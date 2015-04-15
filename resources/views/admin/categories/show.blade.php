<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/categories/show.';

const VIEW_NAME    = 'admin.categories.show';
?>

@include('admin.categories._routes')

@extends ('app')

@section('headings')
    <h1>{{trans($VN.'title')}}: {{ $model->name }}</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
             @include('partials.crud.show_buttons')
             @include('admin.categories._form',['readonly' => true])
             @include('partials.crud.bottom_buttons')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection

