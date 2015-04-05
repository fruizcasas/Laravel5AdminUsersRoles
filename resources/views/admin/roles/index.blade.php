<?php
const VIEW_NAME    = 'admin.roles.index';
?>

@include('admin.roles._routes')

@extends ('app')

@section('headings')
    <h1>Roles</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.roles') !!}
@endsection



@section('content')


    {!! Form::model($filter,['route' => FILTER_ROUTE,
                             'class'=>'form-inline','role'=>'form']) !!}
        <div class="btn-group">
        {!! link_to_route(CREATE_ROUTE,'New',[],
                ['class' => 'btn btn-warning ']) !!}
        @if (App\Profile::loginProfile()->show_trash == '0')
            {!! link_to_route(SHOW_TRASH_ROUTE,'Show Trash',[INDEX_ROUTE],
                              ['class'=>'btn btn-primary']) !!}
        @else
            {!! link_to_route(HIDE_TRASH_ROUTE,'Hide Trash',[INDEX_ROUTE],
                              ['class'=>'btn btn-primary active'])!!}
        @endif
        {!! $models->render()!!}
        </div>
    <br/><br/>

    <table class="table table-striped table-bordered table-compact table-hover">
        <col style="width:6em;">
        <col style="width:5em;">
        <thead>
        <th>
            {!! link_to_route(SORT_ROUTE,'Reset',[],
                        ['class' => 'btn-sm btn-primary']) !!}

        </th>
        <th class="text-right">
            {!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'id')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'name')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'display_name')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'acronym')!!}</th>
        </thead>
        <tbody>
        <tr>
            <td>
                {!! Form::submit('Filter',['class'=>"btn-sm btn-primary"]) !!}
            </td>
            <td>
                <!--- filter id Field --->
                {!! Form::text('id', null, ['class' => 'form-control input-sm',
                                                       'style' => 'width:100%;',
                                                       'placeholder'=>'id filter...']) !!}
            </td>
            <td>
                <!--- filter name Field --->
                {!! Form::text('name', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'name filter...']) !!}
            </td>
            <td>
                <!--- filter display_name Field --->
                {!! Form::text('display_name', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'display name filter...']) !!}
            </td>
            <td>
                <!--- filter acronym Field --->
                {!! Form::text('acronym', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'acronym filter...']) !!}
            </td>
        </tr>

        @foreach($models as $model)
            <tr>
                <td>
                    {!! link_to_route(SHOW_ROUTE,($model->trashed()?'Trash':'Show'),['id'=>$model->id],
                                      ['class' => 'btn-sm '.($model->trashed()?'btn-danger':'btn-primary')]) !!}
                </td>
                <td class="text-right">
                    {!! link_to_route(SHOW_ROUTE,$model->id,['id'=>$model->id]) !!}
                </td>
                <td>
                    {!! link_to_route(SHOW_ROUTE,$model->name,['id'=>$model->id]) !!}
                </td>
                <td>
                    {{  $model->display_name}}
                </td>
                <td>
                    {{ $model->acronym}}
                </td>

            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="text-right">
               <small>{{  $models->total() .' recs' }}</small>
            </td>
            <td colspan="10">
                @if (App\Profile::OrderByLabel(VIEW_NAME) !='')
                    <small>Order by: <strong>{{ App\Profile::OrderByLabel(VIEW_NAME) }}</strong></small>
                @endif
                &nbsp;
                @if (App\Profile::FilterByLabel(VIEW_NAME) !='')
                    <small>Filter by: <strong>{{ App\Profile::FilterByLabel(VIEW_NAME) }}</strong></small>
                @endif

            </td>
        </tr>
        </tfoot>
    </table>
    <div class="btn-group">
        {!! link_to_route(CREATE_ROUTE,'New',[],
                ['class' => 'btn btn-warning ']) !!}
        @if (App\Profile::loginProfile()->show_trash == '0')
            {!! link_to_route(SHOW_TRASH_ROUTE,'Show Trash',[INDEX_ROUTE],
                              ['class'=>'btn btn-primary']) !!}
        @else
            {!! link_to_route(HIDE_TRASH_ROUTE,'Hide Trash',[INDEX_ROUTE],
                              ['class'=>'btn btn-primary active'])!!}
        @endif
        {!! $models->render()!!}
    </div>
    {!! Form::close() !!}
@endsection