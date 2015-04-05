<!--- per_page Field --->
<div class="form-group {{$errors->first('per_page','has-error')}}">
    {!! Form::label('per_page', 'Lines per page:',['class' =>'col-sm-2 control-label text-right']) !!}
    <div class="col-sm-4">
        {!! Form::selectRange('per_page',5,100, $model->per_page,
                        ['class' => 'form-control input-sm','style' => 'width:100%;']) !!}
        {!! $errors->first('per_page', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>

<!--- show_trash Field --->
<div class="form-group {{$errors->first('show_trash','has-error')}}">
    {!! Form::label('show_trash', 'Show Trash:',['class' =>'col-sm-2 control-label text-right']) !!}
    <div class="col-sm-2">
        {!! Form::select('show_trash',['1' =>'Yes','0' => 'No'], $model->show_trash,
                        ['class' => 'form-control input-sm','style' => 'width:100%;']) !!}
        {!! $errors->first('show_trash', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>

<!--- theme Field --->
<div class="form-group {{$errors->first('theme','has-error')}}">
    {!! Form::label('theme', 'Theme:',['class' =>'col-sm-2 control-label text-right']) !!}
    <div class="col-sm-4">
        {!! Form::select('theme',$themes, $model->theme,
                        ['class' => 'form-control input-sm','style' => 'width:100%;']) !!}
        {!! $errors->first('show_trash', '<p class="help-block error-msg">:message</p>') !!}
    </div>
</div>
