<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/frontpages/_form_data.';

$yes_no = ['0' => trans($VN . 'no'), '1' => trans($VN . 'yes')];

?>
<div class="panel-body">
    <div class="form-horizontal">
        <!--- title Field --->
        <div class="form-group ">
            {!! Form::label('title',  trans($VN.'title'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10{{$errors->first('title','has-error')}}">
                {!! Form::text('title', $model->title, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_title'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('title', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>


        <!--- author_id Field --->
        <div class="form-group ">
            {!! Form::label('author_id', trans($VN.'author'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('author_id','has-error')}}">
                {!! Form::select('author_id',$users, $model->user_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('author_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- creation_date Field --->
            {!! Form::label('creation_date',  trans($VN.'creation_date'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::text('creation_date',$model->creation_date, [
                    'class' => 'form-control input-sm ' .($readonly?'readonly':''),
                    'placeholder' => trans($VN.'placeholder_creation_date'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('creation_date', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>


        <!--- description Field --->
        <div class="form-group">
            {!! Form::label('description', trans($VN.'description'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('description','has-error')}}">
                @if ($readonly)
                    <div class="textarea">
                            {!! ($model->description?$model->description:'<br/><br>') !!}
                    </div>
                @else
                    {!! Form::textarea('description',$model->description, [
                            'class' => 'form-control input-sm',
                            'placeholder' => trans($VN.'description'),
                            'style' => 'width:100%;']) !!}
                    {!! $errors->first('description', '<p class="help-block error-msg">:message</p>') !!}
                @endif
            </div>
         </div>

         @include('partials.crud.timestamps',['model'=>$model])
    </div>
</div>
