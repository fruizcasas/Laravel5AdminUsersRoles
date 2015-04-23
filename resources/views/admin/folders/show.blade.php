<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/folders/show.';

const VIEW_NAME    = 'admin.folders.show';
?>

@include('admin.folders._routes')

@extends ('app')

@section('headings')
    <h3>{{trans($VN.'title')}}: {{ $model->Path() }}</h3>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-5">
            <div class="panel panel-primary">
                <div class="panel-footer">
                    <h3> {{trans($VN.'title')}}</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::open(['route'=> ['admin.folders.addsubfolders',$model->id],
                                            'method' => 'post']) !!}
                        <table class="table table-hover table-bordered table-condensed" name="children">
                            <col style="width:2em;">
                            <col style="width:4em;">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{{trans($VN.'order')}}</th>
                                <th>{{trans($VN.'name')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td>
                                {!! Form::submit(trans($VN.'add'),['class'=>'btn-sm btn-warning'])!!}
                            </td>
                            <td>
                                <div class="{{$errors->first('addorder','has-error')}}">
                                    {!! Form::text('addorder',null, [
                                    'class' => 'form-control input-sm',
                                    'placeholder' => trans($VN.'order'),
                                    'style' => 'width:100%;']) !!}
                                    {!! $errors->first('addorder', '<p class="help-block error-msg">:message</p>') !!}
                                </div>
                            </td>
                            <td>
                                <div class="{{$errors->first('addname','has-error')}}">
                                    {!! Form::text('addname',null, [
                                    'class' => 'form-control input-sm',
                                    'placeholder' => trans($VN.'name'),
                                    'style' => 'width:100%;']) !!}
                                    {!! $errors->first('addname', '<p class="help-block error-msg">:message</p>') !!}
                                </div>
                            </td>
                            </tbody>
                        </table>
                        {!! Form::close() !!}
                    </div>
                    {!! \App\Models\Admin\Folder::Tree(SHOW_ROUTE,\App\Models\Admin\Folder::ROOT_FOLDER,['tab' => 'tab_data'],$model->id) !!}
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>


        <div class="col-md-7">
            <div class="panel panel-primary">
             @include('partials.crud.show_buttons')

                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" {!! Input::get('tab','tab_data')=='tab_data'?'class="active"':''!!}>
                                <a href="#tab_data" aria-controls="tab_data" role="tab"
                                   data-toggle="tab">{{trans($VN.'tab_data')}}</a></li>
                        <li role="presentation" {!! Input::get('tab','tab_data')=='tab_frontpages'?'class="active"':''!!}>
                            <a href="#tab_frontpages" aria-controls="tab_frontpages" role="tab"
                                  data-toggle="tab">{{trans($VN.'tab_frontpages')}}</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane {!! Input::get('tab','tab_data')=='tab_data'?'active':''!!}" id="tab_data">
                            @include('admin.folders._form_data',['readonly' => true])
                        </div>
                        <div role="tabpanel" class="tab-pane {!! Input::get('tab','tab_data')=='tab_frontpages'?'active':''!!}" id="tab_frontpages">
                            @include('admin.folders._form_frontpages',['readonly' => true])
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

