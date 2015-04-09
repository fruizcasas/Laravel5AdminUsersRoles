<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/password/edit.';
?>

@extends('app')

@section('headings')
    <h1>{{trans($VN.'password')}} {{ App\Profile::loginProfile()->user->name }}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('password') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {!! Form::open(['method' => 'PUT',
            'route'  => ['password.update'],
            'class'=>'form-horizontal']) !!}
            <div class="panel panel-primary">
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-4">
                            {!! link_to_route('home','Cancel',[],['class'=>"btn btn-primary"])!!}
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-warning">{{trans($VN.'update')}}</button>
                        </div>
                    </div>
                    @include('partials.errors')
                </div>
                <div class="panel-body">
                    @include('password._form')
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
