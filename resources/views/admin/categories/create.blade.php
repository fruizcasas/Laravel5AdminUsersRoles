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

            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" {!! Input::get('tab','tab_data')=='tab_data'?'class="active"':''!!}>
                        <a href="#tab_data" aria-controls="tab_data" role="tab"
                           data-toggle="tab">{{trans($VN.'tab_data')}}</a></li>
                    <li role="presentation" {!! Input::get('tab','tab_data')=='tab_description'?'class="active"':''!!}>
                        <a href="#tab_description" aria-controls="tab_description" role="tab"
                           data-toggle="tab">{{trans($VN.'tab_description')}}</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane {!! Input::get('tab','tab_data')=='tab_data'?'active':''!!}" id="tab_data">
                        @include('admin.categories._form_data',['readonly' => false])
                    </div>
                    <div role="tabpanel" class="tab-pane {!! Input::get('tab','tab_data')=='tab_descripton'?'active':''!!}" id="tab_description">
                        @include('admin.categories._form_description',['readonly' => false])
                    </div>
                </div>
            </div>

            @include('partials.crud.bottom_buttons')
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('scripts')

    @include('partials.crud.script_textarea',['fields' => ['description']]);

@endsection

