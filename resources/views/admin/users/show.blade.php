<?php
const VIEW_NAME = 'admin.users.show';

$VN = 'views/admin/users/show.';
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
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-primary">
                @include('partials.crud.show_buttons')

                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_data" aria-controls="tab_data" role="tab"
                                                                  data-toggle="tab">{{trans($VN.'tab_data')}}</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab_data">
                            @include('admin.users._form_data',['readonly' => true])
                        </div>
                    </div>
                </div>

                @include('partials.crud.bottom_buttons')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!
App\Library\Scripts::Select2(
    [
        'roles' => trans($VN.'select_role'),
        'departments' => trans($VN.'select_department'),
    ])
!!}

@endsection

