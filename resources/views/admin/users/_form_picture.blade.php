<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/users/_form_picture.';

?>


<div class="panel-body">
    <div class="form-horizontal">
        <!--- comments Field --->
        <div class="form-group {{$errors->first('comments','has-error')}}">
            <div class="col-sm-4">
                <p style="text-align: center; ">
                    <img style="border: solid; border-width: 1px;" src="{{route('admin.users.picture',[$model->id])}}" alt="{{$model->name}}" width="200"
                         height="auto"/>
                </p>
                <!--- photo Field --->
                @if (! $readonly)
                    <div style="text-align: center">
                        <h3>Change Photo</h3>
                        {!! Form::file('photo',[
                            'accept'=>'image/*',
                            'style' => 'text-align: center;']+
                            ($readonly?['disabled']:[])) !!}
                        <small> Maximum filesize
                            <strong>{{ \Symfony\Component\HttpFoundation\File\UploadedFile::getMaxFilesize()/(1024*1024) }}</strong>
                            Mbytes
                        </small>
                    </div>
                @endif

            </div>
            <div class="col-sm-8">
                {!! Form::label('comments', trans($VN.'comments'),[]) !!}
                @if ($readonly)
                    <div class="textarea">
                        {!! $model->comments !!}
                    </div>
                @else
                    {!! Form::textarea('comments', $model->comments, [
                    'class' => 'form-control input-sm',
                    'placeholder' => 'comments',
                    'style' => 'width:100%;height:100%;']) !!}
                    {!! $errors->first('comments', '<p class="help-block error-msg">:message</p>') !!}
                @endif
            </div>
        </div>
    </div>
</div>




