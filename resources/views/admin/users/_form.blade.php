
<div class="panel-body">
    <div class="form-horizontal">

        <!--- Name Field --->
        <div class="form-group {{$errors->first('name','has-error')}}">
            {!! Form::label('name', 'Name:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4">
                {!! Form::text('name', $model->name, [
                    'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'enter a name',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- display_name Field --->
        <div class="form-group {{$errors->first('display_name','has-error')}}">
            {!! Form::label('display_name', 'Display name:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-4">
                {!! Form::text('display_name', $model->display_name, [
                'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                'placeholder' => 'enter a display name',
                'style' => 'width:100%;']) !!}
                {!! $errors->first('display_name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- acronym Field --->
        <div class="form-group {{$errors->first('acronym','has-error')}}">
            {!! Form::label('acronym', 'Acronym:',['class' =>'col-sm-2 control-label text-right']) !!}
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
            {!! Form::label('email', 'Email:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::email('email', $model->email, [
                    'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'email',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('email', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- is_admin , is_owner , is_reviewer Fields --->
        <div class="form-group {{$errors->first('is_admin','has-error')}}">
            {!! Form::label('is_author', 'Author:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_author',['1' =>'Yes','0' => 'No'], $model->is_author, [
                'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
                'style' => 'width:100%;']) !!}
                {!! $errors->first('is_author', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            {!! Form::label('is_reviewer', 'Reviewer:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_reviewer',['1' =>'Yes','0' => 'No'], $model->is_reviewer, [
                'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
                'style' => 'width:100%;']) !!}
                {!! $errors->first('is_reviewer', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            {!! Form::label('is_admin', 'Admin:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_admin',['1' =>'Yes','0' => 'No'], $model->is_admin, [
                'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
                'style' => 'width:100%;']) !!}
                {!! $errors->first('is_admin', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- is_approver , is_signer  Fields --->
        <div class="form-group {{$errors->first('is_admin','has-error')}}">
            {!! Form::label('is_approver', 'Approver:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_approver',['1' =>'Yes','0' => 'No'], $model->is_approver, [
                'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
                'style' => 'width:100%;']) !!}
                {!! $errors->first('is_approver', '<p class="help-block error-msg">:message</p>') !!}
            </div>
            {!! Form::label('is_publisher', 'Publisher:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::select('is_publisher',['1' =>'Yes','0' => 'No'], $model->is_publisher, [
                'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
                'style' => 'width:100%;']) !!}
                {!! $errors->first('is_publisher', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- roles Field --->
        <div class="form-group {{$errors->first('roles','has-error')}}">
            {!! Form::label('roles', 'Roles:',['class' =>'col-sm-2 control-label text-right']) !!}
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
            {!! Form::label('departments', 'Departments:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::select('departments',$departments,$model_departments,
                            ['id'=>'departments','class'=>'form-control input-sm',
                            'multiple'=>'multiple','name'=>'departments[]',
                            (isset($readonly)?($readonly?'disabled':''):'')])!!}
                {!! $errors->first('departments', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- comments Field --->
        <div class="form-group {{$errors->first('comments','has-error')}}">
            {!! Form::label('comments', 'Comments:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('comments', $model->comments, [
                'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                'placeholder' => 'comments',
                'style' => 'width:100%;']) !!}
                {!! $errors->first('comments', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        @include('partials.crud.timestamps',['model'=>$model])
    </div>
</div>




