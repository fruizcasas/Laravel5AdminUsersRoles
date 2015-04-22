<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/categories/_form_relations.';
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
                    'placeholder' =>  trans($VN.'path'),
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
                    <col style="width:4em;">
                    <thead>
                    <tr>
                        <th>{{trans($VN.'order')}}</th>
                        <th>{{trans($VN.'name')}}</th>
                        <th>{{trans($VN.'display_name')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($model->parent()->get() as $parent)
                        <tr>
                            <td style="width:4em;text-align: right;">
                                {!! (($parent->order)?link_to_route(SHOW_ROUTE,$parent->order,['id'=>$parent->id,'tab' => 'tab_relations']):'') !!}
                            </td>
                            <td>
                                {!! link_to_route(SHOW_ROUTE,$parent->name,['id'=>$parent->id,'tab' => 'tab_relations']) !!}
                            </td>
                            <td>
                                {!! $parent->trashed()?'<del>':'' !!}
                                {!! link_to_route(SHOW_ROUTE,$parent->display_name,['id'=>$parent->id,'tab' => 'tab_relations']) !!}
                                {!! $parent->trashed()?'</del>':'' !!}
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
                    <col style="width:4em;">
                    <thead>
                    <tr>
                        <th>{{trans($VN.'order')}}</th>
                        <th>{{trans($VN.'name')}}</th>
                        <th>{{trans($VN.'display_name')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($model->children()->orderby('order')->orderby('name')->get() as $children)
                        <tr>
                            <td style="text-align: right;">
                                {!! (($children->order!=null)?link_to_route(SHOW_ROUTE,$children->order,['id'=>$children->id,'tab' => 'tab_relations']):'') !!}
                            </td>
                            <td>
                                {!! link_to_route(SHOW_ROUTE,$children->name,['id'=>$children->id,'tab' => 'tab_relations']) !!}
                            </td>
                            <td>
                                {!! $children->trashed()?'<del>':'' !!}
                                {!! link_to_route(SHOW_ROUTE,$children->display_name,['id'=>$children->id,'tab' => 'tab_relations']) !!}
                                {!! $children->trashed()?'</del>':'' !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
