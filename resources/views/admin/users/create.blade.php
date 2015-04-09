<?php
const VIEW_NAME = 'admin.users.create';
?>

@include('admin.users._routes')

@extends ('app')

@section('headings')
    <h1>Create User</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                {!! Form::model($model,['route' =>STORE_ROUTE,'class'=>'form-horizontal']) !!}
                @include('partials.crud.create_buttons')
                @if($errors->any())
                    <div class="panel-footer">
                        @include('partials.errors')
                    </div>
                @endif
                @include('admin.users._form',['readonly' => false])
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
        $('#departments').select2({
            placeholder: 'Select a department'
        });
    </script>
@endsection

