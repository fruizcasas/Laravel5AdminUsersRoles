<?php

use App\Library\HtmlInput;

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/users/_form_data.';

$yes_no = ['0' => trans($VN . 'no'), '1' => trans($VN . 'yes')];

?>


<div class="panel-body">
    <div class="form-horizontal">

        <!--- Name Field --->
        <div class="form-group {{ HtmlInput::has_feedback($errors,'name')}}">
            {!! Form::label('name',  trans($VN.'name'),['class' =>'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                <div class="input-group">
                    {!! HtmlInput::addon('asterisk') !!}
                    {!! Form::text('name', $model->name, [
                        'class' => 'form-control',
                        'placeholder' => trans($VN.'placeholder_name')]+
                        ($readonly?['readonly']:[])) !!}
                </div>
                {!! HtmlInput::get_feedback($errors,'name') !!}
            </div>
            @if ($readonly)
                <div class="col-sm-3 col-sm-offset-2">
                    {!! link_to_route(EDIT_PASSWORD_ROUTE,trans($VN.'change_password'),[$model->id],
                                     ['class' => 'btn form-control btn-warning']) !!}
                </div>
            @endif
        </div>
        <!--- display_name Field --->
        <div class="col-sm-8">
            <div class="form-group {{ HtmlInput::has_feedback($errors,'display_name')}}">
                {!! Form::label('display_name', trans($VN.'display_name'),['class' =>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    <div class="input-group ">
                        {!! HtmlInput::addon('asterisk') !!}
                        {!! Form::text('display_name', $model->display_name,
                            ['class' => 'form-control',
                            'placeholder' =>  trans($VN.'placeholder_display_name')]+
                            ($readonly?['readonly']:[])) !!}
                    </div>
                    {!! HtmlInput::get_feedback($errors,'display_name') !!}
                </div>
            </div>
        </div>
        <!--- acronym Field --->
        <div class="col-sm-4">
            <div class="form-group {{ HtmlInput::has_feedback($errors,'acronym')}}">
                {!! Form::label('acronym', trans($VN.'acronym'),['class' =>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    <div class="input-group ">
                        {!! HtmlInput::addon('asterisk') !!}
                        {!! Form::text('acronym', $model->acronym, [
                            'class' => 'form-control' ,
                            'placeholder' => trans($VN.'placeholder_acronym')]+
                            ($readonly?['readonly']:[])) !!}
                    </div>
                    {!! HtmlInput::get_feedback($errors,'acronym') !!}
                </div>
            </div>
        </div>
        <!--- email Field --->
        <div class="form-group {{ HtmlInput::has_feedback($errors,'email')}}">
            {!! Form::label('email', trans($VN.'email'),['class' =>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <div class="input-group ">
                    {!! HtmlInput::addon(false,'@') !!}
                    {!! Form::email('email', $model->email, [
                        'class' => 'form-control',
                        'placeholder' => trans($VN.'placeholder_email')]+
                        ($readonly?['readonly']:[])) !!}
                </div>
                {!! HtmlInput::get_feedback($errors,'email') !!}
            </div>
        </div>

        <!--- picture Field --->
        <div class="form-group">
            {!! Form::label('picture', trans($VN.'picture'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-3">
                <img style="border: solid; border-width: 1px;" src="{{route('admin.users.picture',[$model->id])}}"
                     alt="{{$model->name}}" width="auto"
                     height="auto"/>
                <!--- photo Field --->
                @if (! $readonly)
            </div>
            <div class="col-sm-4">
                <label for="clear_picture" class="control-label">
                    {{trans($VN.'clear_picture')}}
                </label>
                {!! Form::checkbox('clear_picture',1,false)!!}
                <br/>

                <span class="btn btn-warning btn-file">
                    {{trans($VN.'edit_picture')}}
                    {!! Form::file('photo',[
                        'accept'=>'image/*',
                        'class' => 'form-control']+
                        ($readonly?['disabled']:[])) !!}
                </span>
                <br/>
                <br/>
                {!! trans($VN.'max_filesize',['value' => \Symfony\Component\HttpFoundation\File\UploadedFile::getMaxFilesize()/(1024*1024)]) !!}
                @endif
            </div>
        </div>

        <!--- user_id Field --->
        <div class="form-group {{HtmlInput::has_feedback($errors,'user_id')}}">
            {!! Form::label('parent', trans($VN.'parent'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                <div class="input-group">
                    {!! HtmlInput::addon('user') !!}
                    {!! Form::select('user_id',$users, $model->user_id,
                                    ['class' => 'form-control']+
                                    ($readonly?['disabled']:[])) !!}
                </div>
                {!! HtmlInput::get_feedback($errors,'user_id') !!}
            </div>
        </div>

        <!--- is_author , is_reviewer , is_admin Fields --->
        <div class="col-sm-4">
            <div class="form-group  {{HtmlInput::has_feedback($errors,'is_author')}}">
                {!! Form::label('is_author', trans($VN.'author'),['class' =>'col-sm-6 control-label']) !!}
                <div class="col-sm-6">
                    <div class="input-group">
                        {!! HtmlInput::addon('check') !!}
                        {!! Form::select('is_author',$yes_no, $model->is_author, [
                            'class' => 'form-control']+
                            ($readonly?['disabled']:[])) !!}
                    </div>
                    {!! HtmlInput::get_feedback($errors,'is_author') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group  {{HtmlInput::has_feedback($errors,'is_reviewer')}}">
                {!! Form::label('is_reviewer', trans($VN.'reviewer'),['class' =>'col-sm-6 control-label']) !!}
                <div class="col-sm-6">
                    <div class="input-group">
                        {!! HtmlInput::addon('check') !!}
                        {!! Form::select('is_reviewer',$yes_no, $model->is_reviewer, [
                                'class' => 'form-control']+
                                ($readonly?['disabled']:[])) !!}
                    </div>
                    {!! HtmlInput::get_feedback($errors,'is_reviewer') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group  {{HtmlInput::has_feedback($errors,'is_admin')}}">
                {!! Form::label('is_admin',  trans($VN.'admin'),['class' =>'col-sm-6 control-label']) !!}
                <div class="col-sm-6">
                    <div class="input-group">
                        {!! HtmlInput::addon('check') !!}
                        {!! Form::select('is_admin',$yes_no, $model->is_admin, [
                            'class' => 'form-control']+
                            ($readonly?['disabled']:[])) !!}
                    </div>
                    {!! HtmlInput::get_feedback($errors,'is_admin') !!}
                </div>
            </div>
        </div>
        <!--- is_approver , is_publisher, is_employee Fields --->
        <div class="col-sm-4">
            <div class="form-group  {{HtmlInput::has_feedback($errors,'is_approver')}}">
                {!! Form::label('is_approver', trans($VN.'author'),['class' =>'col-sm-6 control-label']) !!}
                <div class="col-sm-6">
                    <div class="input-group">
                        {!! HtmlInput::addon('check') !!}
                        {!! Form::select('is_approver',$yes_no, $model->is_approver, [
                            'class' => 'form-control']+
                            ($readonly?['disabled']:[])) !!}
                    </div>
                    {!! HtmlInput::get_feedback($errors,'is_approver') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group  {{HtmlInput::has_feedback($errors,'is_publisher')}}">
                {!! Form::label('is_publisher', trans($VN.'reviewer'),['class' =>'col-sm-6 control-label']) !!}
                <div class="col-sm-6">
                    <div class="input-group">
                        {!! HtmlInput::addon('check') !!}
                        {!! Form::select('is_publisher',$yes_no, $model->is_publisher, [
                                'class' => 'form-control']+
                                ($readonly?['disabled']:[])) !!}
                    </div>
                    {!! HtmlInput::get_feedback($errors,'is_publisher') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group  {{HtmlInput::has_feedback($errors,'is_employee')}}">
                {!! Form::label('is_employee',  trans($VN.'admin'),['class' =>'col-sm-6 control-label']) !!}
                <div class="col-sm-6">
                    <div class="input-group">
                        {!! HtmlInput::addon('check') !!}
                        {!! Form::select('is_employee',$yes_no, $model->is_employee, [
                            'class' => 'form-control']+
                            ($readonly?['disabled']:[])) !!}
                    </div>
                    {!! HtmlInput::get_feedback($errors,'is_employee') !!}
                </div>
            </div>
        </div>
        <!--- roles Field --->
        <div class="form-group">
            {!! Form::label('roles', trans($VN.'roles'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::select('roles',$roles,$model_roles,
                            [
                            'id'=>'roles',
                            'class'=>'form-control input-sm',
                            'multiple'=>'multiple',
                            'name'=>'roles[]']+
                            ($readonly?['disabled']:[]))!!}
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
                    'placeholder' => trans($VN.'placeholder_comments'),
                    'style' => 'width:100%;height:100%;']) !!}
                    {!! $errors->first('comments', '<p class="help-block error-msg">:message</p>') !!}
                @endif
            </div>
        </div>

        @include('partials.crud.timestamps',['model'=>$model])
    </div>
</div>




