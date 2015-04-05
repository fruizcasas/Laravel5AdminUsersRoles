<?php
const VIEW_NAME    = 'admin.users.edit';
?>

@include('admin.users._routes')

@extends ('app')

@section('headings')
    <h1>Edit User: {{ $model->name }}</h1>
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
                        'class'=>'form-horizontal']) !!}
                    <div class="panel-body">
                        @include('admin.users._form',['readonly' => false])
                    </div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                {!! link_to_route(SHOW_ROUTE,'Cancel',[$model->id],
                                                 ['class' => 'form-control btn btn-primary']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::submit('Update', ['class' => 'form-control btn btn-warning','name'=>'update']) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
                @if($errors->any())
                    <div class="panel-footer">
                        @include('partials.errors')
                    </div>
                @endif
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

