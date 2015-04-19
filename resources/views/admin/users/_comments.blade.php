<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/users/_comments.';

?>


<div class="panel-body">
    <div class="form-horizontal">
        <!--- comments Field --->
        <div class="form-group {{$errors->first('comments','has-error')}}">
            {!! Form::label('comments', trans($VN.'comments'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                @if ($readonly)
                    <div class="comments">
                    {!! $model->comments !!}
                    </div>
                @else
                {!! Form::textarea('comments', $model->comments, [
                'class' => 'form-control input-sm',
                'placeholder' => 'comments',
                'style' => 'width:100%;']) !!}
                {!! $errors->first('comments', '<p class="help-block error-msg">:message</p>') !!}
                @endif
            </div>
        </div>
    </div>
</div>




