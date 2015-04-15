<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/categories/edit.';

const VIEW_NAME = 'admin.categories.edit';
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
            {!! Form::model($model,['method' =>'PUT',
                    'route'  => [UPDATE_ROUTE, $model->id],
                    'class'=>'form-horizontal']) !!}
            @include('partials.crud.edit_buttons')
            @if($errors->any())
                <div class="panel-footer">
                    @include('partials.errors')
                </div>
            @endif
            @include('admin.categories._form',['readonly' => false])
            @include('partials.crud.bottom_buttons')
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection

