<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/categories/_form_description.';
?>

<div class="panel-body">
    <div class="form-horizontal">

        <!--- description Field --->
        <div class="form-group {{$errors->first('description','has-error')}}">
            {!! Form::label('description', trans($VN.'description'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                @if ($readonly)
                    <div class="textarea">
                        {!! $model->description!!}
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
