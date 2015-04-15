<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/profiles/_form.';
$yes_no = ['0' => trans($VN.'no'), '1' => trans($VN.'yes')];

?>

<!--- per_page Field --->
<div class="form-group {{$errors->first('per_page','has-error')}}">
    {!! Form::label('per_page', trans($VN.'per_page'),['class' =>'col-sm-4 control-label text-right']) !!}
    <div class="col-sm-2">
        {!! Form::selectRange('per_page',5,100, $model->per_page,
                        ['class' => 'form-control input-sm','style' => 'width:100%;']) !!}
        {!! $errors->first('per_page', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>

<!--- show_trash Field --->
<div class="form-group {{$errors->first('show_trash','has-error')}}">
    {!! Form::label('show_trash', trans($VN.'show_trash'),['class' =>'col-sm-4 control-label text-right']) !!}
    <div class="col-sm-2">
        {!! Form::select('show_trash',$yes_no, $model->show_trash,
                        ['class' => 'form-control input-sm','style' => 'width:100%;']) !!}
        {!! $errors->first('show_trash', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>

<!--- theme Field --->
<div class="form-group {{$errors->first('theme','has-error')}}">
    {!! Form::label('theme', trans($VN.'theme'),
                        ['class' =>'col-sm-4 control-label text-right']) !!}
    <div class="col-sm-3">
        {!! Form::select('theme',$themes, $model->theme,
                        ['class' => 'form-control input-sm',
                        'onchange' =>'theme_changed()',
                        'style' => 'width:100%;']) !!}
        {!! $errors->first('theme', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>
