<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/users/_form_data.';

$yes_no = ['0' => trans($VN . 'no'), '1' => trans($VN . 'yes')];

?>


<div class="panel-body">
    <div class="form-horizontal">

        <!--- Name Field --->
        <div class="form-group">
            {!! Form::label('name',  trans($VN.'name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4  {{$errors->first('name','has-error')}}">
                {!! Form::text('name', $model->name, [
                    'class' => 'form-control input-sm',
                    'placeholder' => 'enter a name',
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            @if ($readonly)
                <div class="col-sm-2">
                    {!! link_to_route(EDIT_PASSWORD_ROUTE,trans($VN.'change_password'),[$model->id],
                                     ['class' => 'btn form-control btn-warning']) !!}
                </div>
            @endif
        </div>
        <!--- display_name Field --->
        <div class="form-group">
            {!! Form::label('display_name', trans($VN.'display_name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4  {{$errors->first('display_name','has-error')}}">
                {!! Form::text('display_name', $model->display_name,
                    ['class' => 'form-control input-sm',
                    'placeholder' => 'enter a display name',
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('display_name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            <!--- acronym Field --->
            {!! Form::label('acronym', trans($VN.'acronym'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4 {{$errors->first('acronym','has-error') }}">
                {!! Form::text('acronym', $model->acronym, [
                    'class' => 'form-control input-sm' ,
                    'placeholder' => 'enter acronym',
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('acronym', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- email Field --->
        <div class="form-group">
            {!! Form::label('email', trans($VN.'email'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('email','has-error')}}">
                {!! Form::email('email', $model->email, [
                    'class' => 'form-control input-sm',
                    'placeholder' => 'email',
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('email', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <!--- picture Field --->
        <div class="form-group">
            {!! Form::label('picture', trans($VN.'picture'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-3">
                    <img style="border: solid; border-width: 1px;" src="{{route('admin.users.picture',[$model->id])}}" alt="{{$model->name}}" width="200"
                         height="auto"/>
                <!--- photo Field --->
                @if (! $readonly)
                    </div>
                    <div class="col-sm-4">
                        <h3>{{trans($VN.'edit_picture')}}</h3>
                        {!! Form::file('photo',[
                            'accept'=>'image/*',
                            'style' => 'text-align: center;']+
                            ($readonly?['disabled']:[])) !!}
                        <br/>
                        <br/>
                        {!! trans($VN.'max_filesize',['value' => \Symfony\Component\HttpFoundation\File\UploadedFile::getMaxFilesize()/(1024*1024)]) !!}

                @endif
            </div>
        </div>

        <!--- user_id Field --->
        <div class="form-group">
            {!! Form::label('parent', trans($VN.'parent'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('user_id','has-error')}}">
                {!! Form::select('user_id',$users, $model->user_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('user_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <!--- is_admin , is_owner , is_reviewer Fields --->
        <div class="form-group">
            {!! Form::label('is_author', trans($VN.'author'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2 {{$errors->first('is_admin','has-error')}}">
                {!! Form::select('is_author',$yes_no, $model->is_author, [
                    'class' => 'form-control input-sm',
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('is_author', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            {!! Form::label('is_reviewer', trans($VN.'reviewer'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_reviewer',$yes_no, $model->is_reviewer, [
                        'class' => 'form-control input-sm',
                        'style' => 'width:100%;']+
                        ($readonly?['disabled']:[])) !!}
                {!! $errors->first('is_reviewer', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            {!! Form::label('is_admin',  trans($VN.'admin'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_admin',$yes_no, $model->is_admin, [
                    'class' => 'form-control input-sm',
                    'style' => 'width:100%;']+
                    ($readonly?['disabled']:[])) !!}
                {!! $errors->first('is_admin', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- is_approver , is_signer  Fields --->
        <div class="form-group">
            {!! Form::label('is_approver', trans($VN.'approver'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2 {{$errors->first('is_approver','has-error')}}">
                {!! Form::select('is_approver',$yes_no,$model->is_approver, [
                    'class' => 'form-control input-sm',
                    'style' => 'width:100%;']+
                    ($readonly?['disabled']:[])) !!}
                {!! $errors->first('is_approver', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            {!! Form::label('is_publisher', trans($VN.'publisher'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_publisher',$yes_no, $model->is_publisher, [
                'class' => 'form-control input-sm',
                'style' => 'width:100%;']+
                    ($readonly?['disabled']:[])) !!}
                {!! $errors->first('is_publisher', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            {!! Form::label('is_employee',  trans($VN.'employee'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_employee',$yes_no, $model->is_employee, [
                    'class' => 'form-control input-sm',
                    'style' => 'width:100%;']+
                    ($readonly?['disabled']:[])) !!}
                {!! $errors->first('is_employee', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- roles Field --->
        <div class="form-group">
            {!! Form::label('roles', trans($VN.'roles'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('roles','has-error')}}">
                {!! Form::select('roles',$roles,$model_roles,
                            [
                            'id'=>'roles',
                            'class'=>'form-control input-sm',
                            'multiple'=>'multiple',
                            'name'=>'roles[]']+
                            ($readonly?['disabled']:[]))!!}
                {!! $errors->first('roles', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- departments Field --->
        <div class="form-group">
            {!! Form::label('departments', trans($VN.'departments'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('departments','has-error')}}">
                {!! Form::select('departments',$departments,$model_departments,
                            ['id'=>'departments',
                            'class'=>'form-control input-sm',
                            'multiple'=>'multiple',
                            'name'=>'departments[]']+
                            ($readonly?['disabled']:[]))!!}
                {!! $errors->first('departments', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('comments', trans($VN.'comments'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10 {{$errors->first('comments','has-error')}}">
                @if ($readonly)
                    <div class="textarea">
                        @if ($model->comments!='')
                            {!! $model->comments !!}
                        @else
                            <br/><br/>
                        @endif
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

        @include('partials.crud.timestamps',['model'=>$model])
    </div>
</div>




