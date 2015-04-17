<div class="panel-body">
    <div class="form-horizontal">

        <!--- original_name Field --->
        <div class="form-group {{$errors->first('name','has-error')}}">
            {!! Form::label('original_name', 'original_name:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('original_name', $model->name, [
                    'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'original_name',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('original_name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- original_mime_type Field --->
        <div class="form-group {{$errors->first('original_mime_type','has-error')}}">
            {!! Form::label('original_mime_type', 'original_mime_type:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('original_mime_type', $model->name, [
                    'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'original_mime_type',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('original_mime_type', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- original_extension Field --->
        <div class="form-group {{$errors->first('original_extension','has-error')}}">
            {!! Form::label('original_extension', 'original_extension:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('original_extension', $model->name, [
                    'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'original_extension',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('original_extension', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
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
        <!--- mime_type Field --->
        <div class="form-group {{$errors->first('mime_type','has-error')}}">
            {!! Form::label('mime_type', 'mime_type:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('mime_type', $model->name, [
                    'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'mime_type',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('mime_type', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- extension Field --->
        <div class="form-group {{$errors->first('extension','has-error')}}">
            {!! Form::label('extension', 'extension:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('extension', $model->name, [
                    'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'extension',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('extension', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <!--- Name Field --->
        <div class="form-group {{$errors->first('size','has-error')}}">
            {!! Form::label('size', 'size:',['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', $model->name, [
                    'class' => 'form-control input-sm' ]+[(isset($readonly)?($readonly?'readonly':''):''),
                    'placeholder' => 'size',
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('size', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>


        @include('partials.crud.timestamps',['model'=>$model])
    </div>
</div>
