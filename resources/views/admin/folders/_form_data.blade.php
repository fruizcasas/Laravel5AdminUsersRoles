<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/folders/_form_data.';
?>

<div class="panel-body">
    <div class="form-horizontal">

        <!--- Name Field --->
        <div class="form-group {{$errors->first('name','has-error')}}">
            {!! Form::label('name',  trans($VN.'name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', $model->name, [
                    'class' => 'form-control input-sm',
                    'placeholder' => trans($VN.'name'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <!--- description Field --->
        <div class="form-group {{$errors->first('description','has-error')}}">
            {!! Form::label('description', trans($VN.'description'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                @if ($readonly)
                    <div class="textarea">
                        {!! ($model->description?$model->description:'<br/><br>') !!}
                    </div>
                @else
                    {!! Form::textarea('description',$model->description, [
                        'class' => 'form-control input-sm',
                        'placeholder' => trans($VN.'description'),
                        'style' => 'width:100%;']) !!}
                    {!! $errors->first('description', '<p class="help-block error-msg">:message</p>') !!}
                @endif
            </div>
        </div>


        <!--- order Field --->
        <div class="form-group {{$errors->first('order','has-error')}}">
            {!! Form::label('order',  trans($VN.'order'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-2">
                {!! Form::text('order',$model->order, [
                    'class' => 'form-control input-sm ' .($readonly?'readonly':''),
                    'placeholder' => trans($VN.'order'),
                    'style' => 'width:100%;']+
                    ($readonly?['readonly']:[])) !!}
                {!! $errors->first('order', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        <!--- user_id Field --->
        <div class="form-group {{$errors->first('user_id','has-error')}}">
            {!! Form::label('user_id', trans($VN.'owner'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::select('user_id',$users, $model->user_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['disabled']:[])) !!}
                {!! $errors->first('user_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>


        <!--- path Field --->
        <div class="form-group {{$errors->first('path','has-error')}}">
            {!! Form::label('path',  trans($VN.'path'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('path', $model->Path(), [
                    'class' => 'form-control input-sm',
                    'readonly',
                    'placeholder' =>  trans($VN.'path'),
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('path', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>


        <!--- folder_id Field --->
        <div class="form-group {{$errors->first('folder_id','has-error')}}">
            {!! Form::label('parent', trans($VN.'parent'),
                                ['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::select('folder_id',$folders, $model->folder_id,
                                ['class' => 'form-control input-sm',
                                'style' => 'width:100%;']+
                                ($readonly?['readonly']:[])) !!}
                {!! $errors->first('folder_id', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>

        @if ($readonly)
            <div class="form-group">
                {!! Form::label('children',trans($VN.'children'),['class' =>'col-sm-2 control-label text-right']) !!}
                <div class="col-sm-10">
                    {!! Form::open(['route'=> ['admin.folders.delsubfolders',$model->id],
                                    'method' => 'delete',
                                    'name'=>'del_form']) !!}

                    <table class="table table-hover table-bordered table-condensed" name="children">
                        <col style="width:2em;">
                        <col style="width:4em;">
                        <thead>
                        <tr>
                            <th>{!! Form::submit(trans($VN.'trash'),['class'=>'btn-sm btn-danger'])!!}</th>
                            <th>{{trans($VN.'order')}}</th>
                            <th>{{trans($VN.'name')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model->children()->withTrashed()->orderby('order')->orderby('name')->get() as $children)
                            <tr>
                                <td class="text-center">
                                    @if (! $children->children->count())
                                        {!! Form::checkbox('remove_children',$children->id,false,['form'=>'del_form']) !!}
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    {!! (($children->order!=null)?link_to_route(SHOW_ROUTE,$children->order,['id'=>$children->id,'tab' => 'tab_data']):'') !!}
                                </td>
                                <td>
                                    {!! $children->trashed()?'<del>':'' !!}
                                    {!! link_to_route(SHOW_ROUTE,$children->name,['id'=>$children->id,'tab' => 'tab_data']) !!}
                                    {!! $children->trashed()?'</del>':'' !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! Form::close()!!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('children',trans($VN.'children'),['class' =>'col-sm-2 control-label text-right']) !!}
                <div class="col-sm-10">

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
            </div>

        @endif


        @include('partials.crud.timestamps',['model'=>$model])
    </div>
</div>
