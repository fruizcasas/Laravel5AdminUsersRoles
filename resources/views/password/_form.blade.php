<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/password/_form.';
?>

<!--- password Field --->
<div class="form-group {{$errors->first('old_password','has-error')}}">
    {!! Form::label('old_password', trans($VN.'old_password'),['class' =>'col-sm-4 control-label text-right']) !!}
    <div class="col-sm-4">
        {!! Form::password('old_password', null, [
            'class' => 'form-control input-sm',
            'placeholder' => 'enter old password',
            'style' => 'width:100%;']) !!}
        {!! $errors->first('old_password', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>

<!--- password Field --->
<div class="form-group {{$errors->first('password','has-error')}}">
    {!! Form::label('password', trans($VN.'new_password'),['class' =>'col-sm-4 control-label text-right']) !!}
    <div class="col-sm-4">
        {!! Form::password('password', null, [
            'class' => 'form-control input-sm',
            'placeholder' => 'enter password',
            'style' => 'width:100%;']) !!}
        {!! $errors->first('password', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>
<!--- password_confirmation Field --->
<div class="form-group {{$errors->first('password_confirmation','has-error')}}">
    {!! Form::label('password_confirmation', trans($VN.'confirm_password'),['class' =>'col-sm-4 control-label text-right']) !!}
    <div class="col-sm-4">
        {!! Form::password('password_confirmation', null, [
            'class' => 'form-control input-sm',
            'placeholder' => 'enter confirmation password',
            'style' => 'width:100%;']) !!}
        {!! $errors->first('password_confirmation', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>
