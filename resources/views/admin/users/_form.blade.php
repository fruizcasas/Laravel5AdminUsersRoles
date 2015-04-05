<!--- Name Field --->
<div class="form-group {{$errors->first('name','has-error')}}">
    {!! Form::label('name', 'Name:',['class' =>'col-sm-2 control-label text-right']) !!}
    <div class="col-sm-10">
        {!! Form::text('name', $model->name, [
            'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
            'placeholder' => 'name',
            'style' => 'width:100%;']) !!}
        {!! $errors->first('name', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>

<!--- email Field --->
<div class="form-group {{$errors->first('email','has-error')}}">
    {!! Form::label('email', 'email:',['class' =>'col-sm-2 control-label text-right']) !!}
    <div class="col-sm-10">
        {!! Form::email('email', $model->email, [
            'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'readonly':''):''),
            'placeholder' => 'email',
            'style' => 'width:100%;']) !!}
        {!! $errors->first('email', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>

<!--- is_admin Field --->
<div class="form-group {{$errors->first('email','has-error')}}">
    {!! Form::label('is_admin', 'Is Admin:',['class' =>'col-sm-2 control-label text-right']) !!}
    <div class="col-sm-2">
        {!! Form::select('is_admin',['1' =>'Yes','0' => 'No'], $model->is_admin, [
            'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'disabled':''):''),
            'placeholder' => 'email',
            'style' => 'width:100%;']) !!}
        {!! $errors->first('is_admin', '<p class="help-block error-msg">:message</p>') !!}
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





