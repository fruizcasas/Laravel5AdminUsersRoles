<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/categories/_form_data.';
?>

<div class="panel-body">
    <div class="form-horizontal">

        <!--- Name Field --->
        <div class="form-group {{$errors->first('name','has-error')}}">
            {!! Form::label('name',  trans($VN.'name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', $model->name, [
                    'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => trans($VN.'name'),
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <!--- acronym Field --->
        <div class="form-group {{$errors->first('acronym','has-error')}}">
            {!! Form::label('acronym',  trans($VN.'acronym'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::text('acronym',$model->acronym, [
                    'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => trans($VN.'acronym'),
                    'maxlength' => '6',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('acronym', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <!--- display_name Field --->
        <div class="form-group {{$errors->first('display_name','has-error')}}">
            {!! Form::label('display_name',  trans($VN.'display_name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('display_name', $model->display_name, [
                    'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' =>  trans($VN.'display_name'),
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('display_name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <!--- path Field --->
        <div class="form-group {{$errors->first('path','has-error')}}">
            {!! Form::label('path',  trans($VN.'path'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('path', $model->Path(), [
                    'class' => 'form-control input-sm',
                    'readonly',
                    'placeholder' =>  trans($VN.'display_name'),
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('path', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>


        <!--- category_id Field --->
        <div class="form-group {{$errors->first('category_id','has-error')}}">
            {!! Form::label('parent', trans($VN.'parent'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::select('category_id',$categories, $model->category_id,
                                ['class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'readonly':''):''),
                                'style' => 'width:100%;']) !!}
                {!! $errors->first('category_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        @include('partials.crud.timestamps',['model'=>$model])
    </div>
</div>
