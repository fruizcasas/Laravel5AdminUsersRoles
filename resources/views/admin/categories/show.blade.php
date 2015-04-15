<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/categories/show.';

const VIEW_NAME    = 'admin.categories.show';
?>

@include('admin.categories._routes')

@extends ('app')

@section('headings')
    <h1>{{trans($VN.'title')}}: {{ $model->name }}</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
             @include('partials.crud.show_buttons')

                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#data" aria-controls="data" role="tab"
                                                                  data-toggle="tab">Data</a></li>
                        <li role="presentation"><a href="#relations" aria-controls="relations" role="tab"
                                                   data-toggle="tab">Relations</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="data">
                            @include('admin.categories._form',['readonly' => true])
                        </div>
                        <div role="tabpanel" class="tab-pane" id="relations">
                            @include('admin.categories._relations',['readonly' => true])
                        </div>
                    </div>
                </div>

             @include('partials.crud.bottom_buttons')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection

