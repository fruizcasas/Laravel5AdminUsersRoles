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

                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" {!! Input::get('tab','data')=='data'?'class="active"':''!!}><a href="#data" aria-controls="data" role="tab"
                                                                                                               data-toggle="tab">{{trans($VN.'data')}}</a></li>
                        <li role="presentation" {!! Input::get('tab','data')=='relations'?'class="active"':''!!}><a href="#relations" aria-controls="relations" role="tab"
                                                                                                                    data-toggle="tab">{{trans($VN.'relations')}}</a></li>
                        <li role="presentation" {!! Input::get('tab','data')=='users'?'class="active"':''!!}><a href="#users" aria-controls="users" role="tab"
                                                                                                                     data-toggle="tab">{{trans($VN.'users')}}</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane {!! Input::get('tab','data')=='data'?'active':''!!}" id="data">
                            @include('admin.departments._form',['readonly' => true])
                        </div>
                        <div role="tabpanel" class="tab-pane {!! Input::get('tab','data')=='relations'?'active':''!!}" id="relations">
                            @include('admin.departments._relations',['readonly' => true])
                        </div>
                        <div role="tabpanel" class="tab-pane {!! Input::get('tab','data')=='users'?'active':''!!}" id="users">
                            @include('admin.departments._users',['readonly' => true])
                        </div>
                    </div>
                </div>


             @include('partials.crud.bottom_buttons')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection

