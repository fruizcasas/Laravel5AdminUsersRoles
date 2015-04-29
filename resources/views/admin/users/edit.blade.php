<?php

$VN = 'views/admin/users/edit.';

const VIEW_NAME = 'admin.users.edit';
?>

@include('admin.users._routes')

@extends ('app')

@section('headings')
    <h3>{{trans($VN.'title')}} {{$model->display_name .'('.$model->name .')'}}</h3>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')

    <div class="row">
        {!! Form::model($model,['method' =>'PUT',
                'route'  => [UPDATE_ROUTE, $model->id],
                'class'=>'form-horizontal',
                'enctype'=>'multipart/form-data']) !!}
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary">

                @include('partials.crud.edit_buttons')
                @if($errors->any())
                    <div class="panel-footer">
                        @include('partials.errors')
                    </div>
                @endif
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_data" aria-controls="tab_data" role="tab"
                                                                  data-toggle="tab">{{trans($VN.'tab_data')}}</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab_data">
                            @include('admin.users._form_data',['readonly' => false])
                        </div>
                    </div>
                </div>

                @include('partials.crud.bottom_buttons')
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('scripts')
    {!!App\Library\Scripts::Select2(
    [
        'roles' => trans($VN.'select_role'),
        'departments' => trans($VN.'select_department'),
    ])!!}

    @include('partials.crud.script_textarea',['fields' => ['comments']]);
@endsection

