<?php

$VN = 'views/admin/users/create.';

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
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary">
                {!! Form::model($model,['route' =>STORE_ROUTE,'class'=>'form-horizontal']) !!}
                @include('partials.crud.create_buttons')
                @if($errors->any())
                    <div class="panel-footer">
                        @include('partials.errors')
                    </div>
                @endif
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#data" aria-controls="tab_data" role="tab"
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
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    {!!App\Library\Scripts::Select2(
    [
        'roles' => trans($VN.'select_role'),
        'departments' => trans($VN.'select_department'),
    ])!!}

@endsection

