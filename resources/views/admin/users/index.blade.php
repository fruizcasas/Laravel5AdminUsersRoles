<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/users/index.';
const VIEW_NAME    = 'admin.users.index';
?>

@include('admin.users._routes')

@extends ('app')

@section('headings')
    <h1>{{trans($VN.'title')}}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.users') !!}
@endsection


@section('content')

    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" {!! Input::get('tab','hierarchy')=='hierarchy'?'class="active"':''!!}><a href="#hierarchy" aria-controls="hierarchy" role="tab"
                                                                                                             data-toggle="tab">{{trans($VN.'hierarchy')}}</a></li>
            <li role="presentation" {!! Input::get('tab','hierarchy')=='data'?'class="active"':''!!}><a href="#data" aria-controls="data" role="tab"
                                                                                                        data-toggle="tab">{{trans($VN.'data')}}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane {!! Input::get('tab','hierarchy')=='hierarchy'?'active':''!!}" id="hierarchy">
                @include('admin.users._hierarchy')
            </div>
            <div role="tabpanel" class="tab-pane {!! Input::get('tab','hierarchy')=='data'?'active':''!!}" id="data">
                <br/>
                @include('admin.users._index',['readonly' => true,'models'=>$models])
            </div>
        </div>
    </div>
@endsection