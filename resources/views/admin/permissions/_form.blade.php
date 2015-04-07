<div class="panel-body">
    <div class="form-horizontal">

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

<!--- display_name Field --->
<div class="form-group {{$errors->first('display_name','has-error')}}">
    {!! Form::label('display_name', 'Display Name:',['class' =>'col-sm-2 control-label text-right']) !!}
    <div class="col-sm-10">
        {!! Form::text('display_name', $model->display_name, [
            'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'readonly':''):''),
            'placeholder' => 'display name',
            'style' => 'width:100%;']) !!}
        {!! $errors->first('display_name', '<p class="help-block error-msg">:message</p>') !!}
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
<!--- description Field --->
<div class="form-group {{$errors->first('description','has-error')}}">
    {!! Form::label('description', 'Description:',['class' =>'col-sm-2 control-label text-right']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('description',$model->description, [
            'class' => 'form-control input-sm']+[(isset($readonly)?($readonly?'readonly':''):''),
            'placeholder' => 'description',
            'style' => 'width:100%;']) !!}
        {!! $errors->first('description', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>

@include('partials.crud.timestamps',['model'=>$model])
    </div>
</div>
