<?php
const VIEW_NAME    = 'admin.departments.create';
?>

@include('admin.departments._routes')

@extends ('app')

@section('headings')
    <h1>Create Department</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-primary">
            {!! Form::model($model,['route' =>STORE_ROUTE,'class'=>'form-horizontal']) !!}
                @include('partials.crud.create_buttons')
                @include('admin.departments._form',['readonly' => false])
                @include('partials.crud.create_buttons')
            {!! Form::close() !!}
            @if($errors->any())
            <div class="panel-footer">
                @include('partials.errors')
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection

