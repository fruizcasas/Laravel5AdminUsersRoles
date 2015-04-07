<?php
const VIEW_NAME    = 'admin.departments.show';
?>

@include('admin.departments._routes')

@extends ('app')

@section('headings')
    <h1>Department: {{ $model->name }}</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
             @include('partials.crud.show_buttons')
             @include('admin.departments._form',['readonly' => true])
             @include('partials.crud.show_buttons')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection

