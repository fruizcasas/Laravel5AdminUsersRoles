<?php
const VIEW_NAME    = 'admin.roles.show';
?>

@include('admin.roles._routes')

@extends ('app')

@section('headings')
    <h1>Role: {{ $model->name }}</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
             @include('partials.show_buttons')
             @include('admin.roles._form',['readonly' => true])
             @include('partials.show_buttons')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection

