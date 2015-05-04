<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/documents/_form_data.';

$yes_no = ['0' => trans($VN . 'no'), '1' => trans($VN . 'yes')];

?>
<div class="panel-body">
    <div class="form-horizontal">
        <!--- title Field --->
        <div class="form-group ">
            {!! Form::label('title',  trans($VN.'title'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('title','has-error')}}">
                {!! Form::text('title', $model->title, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_title'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('title', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <div class="form-group ">
            <!--- name Field --->
            {!! Form::label('name',  trans($VN.'name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('name','has-error')}}">
                {!! Form::text('name', $model->name, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_name'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <div class="form-group ">
            <!---user_id Field --->
            {!! Form::label('user_id', trans($VN.'owner'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('user_id','has-error')}}">
                {!! Form::select('user_id',$users, $model->user_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('user_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <div class="form-group ">
            <!--- mime_type Field --->
            {!! Form::label('mime_type',  trans($VN.'mime_type'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('mime_type','has-error')}}">
                {!! Form::text('mime_type', $model->mime_type, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_mime_type'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('mime_type', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- extension Field --->
            {!! Form::label('extension',  trans($VN.'extension'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('extension','has-error')}}">
                {!! Form::text('extension', $model->extension, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_extension'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('extension', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <div class="form-group ">
            <!--- size Field --->
            {!! Form::label('size',  trans($VN.'size'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('size','has-error')}}">
                {!! Form::text('size', $model->size, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_size'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('size', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- sha1 Field --->
            {!! Form::label('sha1',  trans($VN.'sha1'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('sha1','has-error')}}">
                {!! Form::text('sha1', $model->sha1, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_sha1'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('sha1', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>


        <hr/>
        @if (! $readonly)
            <!--- file_upload Field --->
            <div class="form-group {{$errors->first('file_upload','has-error')}}">
                {!! Form::label('file_upload', 'file_upload',['class' =>'col-sm-2 control-label text-right']) !!}
                <div class="col-sm-10">
                    {!! Form::file('file_upload',
                        [
                            'class' => 'form-control input-sm',
                            'style' => 'width:100%;'
                        ]) !!}
                    <small> Maximum filesize <strong>{{ \Symfony\Component\HttpFoundation\File\UploadedFile::getMaxFilesize()/(1024*1024) }}</strong> Mbytes</small>
                    {!! $errors->first('file_upload', '<p class="help-block error-msg">:message</p>') !!}
                </div>
            </div>
        @endif


        <div class="form-group ">
            <!--- original_name Field --->
            {!! Form::label('original_name',  trans($VN.'original_name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('original_name','has-error')}}">
                {!! Form::text('original_name', $model->original_name, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_original_name'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('original_name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <div class="form-group ">
            <!--- original_mime_type Field --->
            {!! Form::label('original_mime_type',  trans($VN.'original_mime_type'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('original_mime_type','has-error')}}">
                {!! Form::text('original_mime_type', $model->original_mime_type, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_original_mime_type'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('original_mime_type', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- original_extension Field --->
            {!! Form::label('original_extension',  trans($VN.'original_extension'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('original_extension','has-error')}}">
                {!! Form::text('original_extension', $model->original_extension, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_original_extension'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('original_extension', '<p class="help-block error-msg">:message</p>') !!}
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
