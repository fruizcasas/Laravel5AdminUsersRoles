<?php
const VIEW_NAME = 'admin.fileentries.edit';
?>

@include('admin.fileentries._routes')

@extends ('app')

@section('headings')
    <h1>Edit Fileentry: {{ $model->name }}-{{ $model->display_name }}</h1>

@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                {!! Form::model($model,['method' =>'PUT',
                        'route'  => [UPDATE_ROUTE, $model->id],
                        'class'=>'form-horizontal',
                        'files'=>'true']) !!}
                @include('partials.crud.edit_buttons')
                @if($errors->any())
                    <div class="panel-footer">
                        @include('partials.errors')
                    </div>
                @endif
                @include('admin.fileentries._form',['readonly' => false])
                @include('partials.crud.bottom_buttons')
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('#roles').select2({
            placeholder: 'Select a role'
        });
    </script>
@endsection

