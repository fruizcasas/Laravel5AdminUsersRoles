<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/folders/_form_data.';

$yes_no = ['0' => trans($VN . 'no'), '1' => trans($VN . 'yes')];

?>
<div class="panel-body">
    <div class="form-horizontal">
        <!--- Name Field --->
        <div class="form-group ">
            {!! Form::label('name',  trans($VN.'name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10{{$errors->first('name','has-error')}}">
                {!! Form::text('name', $model->name, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'placeholder_name'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <!--- root_id Field --->
        <div class="form-group">
            {!! Form::label('root_id', trans($VN.'root_id'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('root_id','has-error')}}">
                {!! Form::select('root_id',$roots, $model->root_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('root_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>


        <!--- folder_id Field --->
        <div class="form-group">
            @if ($model->parent)
                <p class="col-sm-2 control-label text-right">
                    <span class="glyphicon glyphicon-backward">&nbsp;</span>{!!link_to_route(SHOW_ROUTE,trans($VN.'parent'),['id'=>$model->parent->id,'tab' => 'tab_data'])!!}
                </p>
            @else
                {!! Form::label('parent',trans($VN.'parent'),['class' =>'col-sm-2 control-label text-right']) !!}
            @endif
            <div class="col-sm-4 {{$errors->first('folder_id','has-error')}}">
                @if ($readonly)
                    @if ($model->parent)
                        <p class="textarea">
                            {!!link_to_route(SHOW_ROUTE,$model->parent->Path(),['id'=>$model->parent->id,'tab' => 'tab_data'])!!}
                        </p>
                    @endif
                @else
                    {!! Form::select('folder_id',$folders, $model->folder_id,
                                    ['class' => 'form-control input-sm',
                                    'style' => 'width:100%;']+
                                    ($readonly?['disabled']:[])) !!}
                    {!! $errors->first('folder_id', '<p class="help-block error-msg">:message</p>') !!}
                @endif
            </div>
            <!--- order Field --->
            {!! Form::label('order',  trans($VN.'order'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::text('order',$model->order, [
                    'class' => 'form-control input-sm ' .($readonly?'readonly':''),
                    'placeholder' => trans($VN.'placeholder_order'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('order', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>


        <!--- user_id Field --->
        <div class="form-group ">
            {!! Form::label('user_id', trans($VN.'owner'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('user_id','has-error')}}">
                {!! Form::select('user_id',$users, $model->user_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('user_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        <!--- private Fields --->
            {!! Form::label('private', trans($VN.'private'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2 {{$errors->first('private','has-error')}}">
                {!! Form::select('private',$yes_no, $model->private, [
                    'class' => 'form-control input-sm',
                    'style' => 'width:100%;']+
                    ($readonly?['disabled']:[])) !!}
                {!! $errors->first('private', '<p class="help-block error-msg">:message</p>') !!}
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
