<?php

const VIEW_NAME = 'admin.users.edit_password';

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/users/edit_password.';
?>

@include('admin.users._routes')


@extends('app')

@section('headings')
    <h3>{{trans($VN.'password')}} {{$model->display_name .'('.$model->name .')'}}</h3>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.users.password') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['method' => 'PUT',
            'route'  => [UPDATE_PASSWORD_ROUTE,$model->id],
            'class'=>'form-horizontal']) !!}
            <div class="panel panel-primary">
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-4">
                            {!! link_to_route(SHOW_ROUTE,trans($VN.'cancel'),[$model->id],['class'=>"btn btn-primary form-control"])!!}
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-warning form-control">{{trans($VN.'update')}}</button>
                        </div>
                    </div>
                    @include('partials.errors')
                </div>
                <div class="panel-body">
                    @include('admin.users._form_password')
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
