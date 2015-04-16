<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/departments/_relations.';
?>


<div class="panel-body">
    <div class="form-horizontal">

        <!--- path Field --->
        <div class="form-group {{$errors->first('path','has-error')}}">
            {!! Form::label('path',  trans($VN.'path'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('path', $model->Path(), [
                    'class' => 'form-control input-sm',
                    'readonly',
                    'placeholder' =>  trans($VN.'display_name'),
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('path', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <hr/>
        <div class="form-group">
            <div class="col-sm-2 ">
                {!! Form::label('parent', trans($VN.'parent'),['class' =>'col-sm-2 control-label text-right']) !!}
            </div>
            <div class="col-sm-10">
                <table class="table table-hover table-bordered table-condensed" name="parent">
                    <thead>
                    <tr>
                        <th>{{trans($VN.'name')}}</th>
                        <th>{{trans($VN.'display_name')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($model->parent()->get() as $parent)
                        <tr>
                            <td>
                                {!! link_to_route('admin.departments.show',$parent->name,['id'=>$parent->id,'tab' => 'relations']) !!}
                            </td>
                            <td>
                                {!! link_to_route('admin.departments.show',$parent->display_name,['id'=>$parent->id,'tab' => 'relations']) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr/>
        <!--- Name Field --->
        <div class="form-group {{$errors->first('name','has-error')}}">
            {!! Form::label('name',  trans($VN.'name'),['class' =>'col-sm-2 control-label text-right']) !!}
            <div class="col-sm-10">
                {!! Form::text('name', $model->name, [
                    'class' => 'form-control input-sm',
                    'readonly',
                    'placeholder' => trans($VN.'name'),
                    'style' => 'width:100%;']) !!}
                {!! $errors->first('name', '<p class="help-block error-msg">:message</p>') !!}
            </div>
        </div>
        <hr/>
        <div class="form-group">
            <div class="col-sm-2 ">
                {!! Form::label('children',trans($VN.'children'),['class' =>'col-sm-2 control-label text-right']) !!}
            </div>
            <div class="col-sm-10">
                <table class="table table-hover table-bordered table-condensed" name="children">
                    <thead>
                    <tr>
                        <th>{{trans($VN.'name')}}</th>
                        <th>{{trans($VN.'display_name')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($model->children()->get() as $children)
                        <tr>
                            <td>
                                {!! link_to_route('admin.departments.show',$children->name,['id'=>$children->id,'tab' => 'relations']) !!}
                            </td>
                            <td>
                                {!! link_to_route('admin.departments.show',$children->display_name,['id'=>$children->id,'tab' => 'relations']) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
