<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/categories/create.';

const VIEW_NAME = 'admin.categories.create';
?>

@include('admin.categories._routes')

@extends ('app')

@section('headings')
    <h1> {{trans($VN.'title')}}</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')

<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="panel panel-primary">
            {!! Form::model($model,['route' =>STORE_ROUTE,'class'=>'form-horizontal']) !!}
            @include('partials.crud.create_buttons')
            @if($errors->any())
                <div class="panel-footer">
                    @include('partials.errors')
                </div>
            @endif
            @include('admin.categories._form_data',['readonly' => false])
            @include('partials.crud.bottom_buttons')
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('scripts')
@endsection

