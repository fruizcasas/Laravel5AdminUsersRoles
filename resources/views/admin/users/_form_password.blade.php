<?php

use App\Library\HtmlInput;

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/users/_form_password.';

?>

<!--- password Field --->
<div class="form-group {{ HtmlInput::has_feedback($errors,'password')}}">
    {!! Form::label('password', trans($VN.'new_password'),['class' =>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        <div class="input-group  input-group-sm">
            {!! HtmlInput::addon('asterisk') !!}
            {!! Form::password('password', [
                'class' => 'form-control',
                'placeholder' => 'enter password']) !!}
        </div>
        {!! HtmlInput::get_feedback($errors,'password') !!}
    </div>
</div>
<!--- password_confirmation Field   --->
<div class="form-group {{ HtmlInput::has_feedback($errors,'password_confirmation')}}">
    {!! Form::label('password_confirmation', trans($VN.'confirm_password'),['class' =>'col-sm-4 control-label']) !!}
    <div class="col-sm-4">
        <div class="input-group input-group-sm">
            {!! HtmlInput::addon('asterisk') !!}
            {!! Form::password('password_confirmation', [
                'class' => 'form-control',
                'placeholder' => 'enter confirmation password']) !!}
        </div>
        {!! HtmlInput::get_feedback($errors,'confirm_password') !!}
    </div>
</div>

