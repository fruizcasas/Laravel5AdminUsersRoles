<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/users/_form.';

$yes_no = ['0' => trans($VN.'no'), '1' => trans($VN.'yes')];

?>


<div class="panel-body">
    <div class="form-horizontal">

        <!--- Name Field --->
        <div class="form-group {{$errors->first('name','has-error')}}">
            {!! Form::label('name',  trans($VN.'name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4">
                {!! Form::text('name', $model->name, [
                    'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'enter a name',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            @if (isset($readonly) && ($readonly))
                <div class="col-sm-2">
                        {!! link_to_route(EDIT_PASSWORD_ROUTE,trans($VN.'change_password'),[$model->id],
                                         ['class' => 'btn-sm btn-warning']) !!}
                </div>
            @endif
        </div>
        <!--- display_name Field --->
        <div class="form-group {{$errors->first('display_name','has-error')}}">
            {!! Form::label('display_name', trans($VN.'display_name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4">
                {!! Form::text('display_name', $model->display_name, [
                'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                'placeholder' => 'enter a display name',
                'style' => 'width:100%;']) !!}
                {!! $errors->first('display_name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- photo Field --->
        <div class="form-group {{$errors->first('photo','has-error')}}">
            {!! Form::label('photo', trans($VN.'photo'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4">
                {!! Form::file('photo',[
                'class' => 'form-control input-sm',
                'placeholder' => 'enter a display name',
                'style' => 'width:100%;']) !!}
                {!! $errors->first('photo', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- acronym Field --->
        <div class="form-group {{$errors->first('acronym','has-error')}}">
            {!! Form::label('acronym', trans($VN.'acronym'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4">
                {!! Form::text('acronym', $model->acronym, [
                    'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'enter acronym',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('acronym', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- email Field --->
        <div class="form-group {{$errors->first('email','has-error')}}">
            {!! Form::label('email', trans($VN.'email'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::email('email', $model->email, [
                    'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'email',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('email', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- user_id Field --->
        <div class="form-group {{$errors->first('user_id','has-error')}}">
            {!! Form::label('parent', trans($VN.'parent'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::select('user_id',$users, $model->user_id,
                                ['class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'readonly':''):''),
                                'style' => 'width:100%;']) !!}
                {!! $errors->first('user_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <!--- is_admin , is_owner , is_reviewer Fields --->
        <div class="form-group {{$errors->first('is_admin','has-error')}}">
            {!! Form::label('is_author', trans($VN.'author'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_author',$yes_no, $model->is_author, [
                'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
                'style' => 'width:100%;']) !!}
                {!! $errors->first('is_author', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            {!! Form::label('is_reviewer', trans($VN.'reviewer'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_reviewer',$yes_no, $model->is_reviewer, [
                'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
                'style' => 'width:100%;']) !!}
                {!! $errors->first('is_reviewer', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            {!! Form::label('is_admin',  trans($VN.'admin'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_admin',$yes_no, $model->is_admin, [
                'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
                'style' => 'width:100%;']) !!}
                {!! $errors->first('is_admin', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- is_approver , is_signer  Fields --->
        <div class="form-group {{$errors->first('is_approver','has-error')}}">
            {!! Form::label('is_approver', trans($VN.'approver'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_approver',$yes_no,$model->is_approver, [
                'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
                'style' => 'width:100%;']) !!}
                {!! $errors->first('is_approver', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            {!! Form::label('is_publisher', trans($VN.'publisher'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_publisher',$yes_no, $model->is_publisher, [
                'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
                'style' => 'width:100%;']) !!}
                {!! $errors->first('is_publisher', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- roles Field --->
        <div class="form-group {{$errors->first('roles','has-error')}}">
            {!! Form::label('roles', trans($VN.'roles'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::select('roles',$roles,$model_roles,
                            ['id'=>'roles','class'=>'form-control input-sm',
                            'multiple'=>'multiple','name'=>'roles[]',
                            (isset($readonly)?($readonly?'disabled':''):'')])!!}
                {!! $errors->first('roles', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- departments Field --->
        <div class="form-group {{$errors->first('departments','has-error')}}">
            {!! Form::label('departments', trans($VN.'departments'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::select('departments',$departments,$model_departments,
                            ['id'=>'departments','class'=>'form-control input-sm',
                            'multiple'=>'multiple','name'=>'departments[]',
                            (isset($readonly)?($readonly?'disabled':''):'')])!!}
                {!! $errors->first('departments', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        @include('partials.crud.timestamps',['model'=>$model])
    </div>
</div>




