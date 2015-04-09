<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/profiles/edit.';
?>

@extends('app')

@section('headings')
    <h1>{{trans($VN.'profile')}} {{ App\Profile::loginProfile()->user->name }}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('profile') !!}
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        {!! Form::model($model,['method' => 'PUT',
        'route'  => ['profile.update'],
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
                    @include('profiles._form')
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
