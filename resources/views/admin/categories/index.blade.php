<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/categories/index.';
const VIEW_NAME    = 'admin.categories.index';
?>

@include('admin.categories._routes')

@extends ('app')

@section('headings')
    <h1>{{trans($VN.'title')}}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.categories') !!}
@endsection



@section('content')


    {!! Form::model($filter,['route' => FILTER_ROUTE,
                             'class'=>'form-inline','role'=>'form']) !!}
    @include ('partials.crud.index_buttons')

    <table class="table table-striped table-bordered table-compact table-hover">
        <col style="width:6em;">
        <col style="width:5em;">
        <thead>
        <th>
            {!! link_to_route(SORT_ROUTE,trans($VN.'reset'),[],
                        ['class' => 'btn-sm btn-primary']) !!}

        </th>
        <th class="text-right">
            {!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'id',trans($VN.'id'))!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'name',trans($VN.'name'))!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'acronym',trans($VN.'acronym'))!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'display_name',trans($VN.'display_name'))!!}</th>
        <th>{{trans($VN.'path')}}</th>
        <th>{{trans($VN.'description')}}</th>
        </thead>
        <tbody>
        <tr>
            <td>
                {!! Form::submit(trans($VN.'filter'),['class'=>"btn-sm btn-primary"]) !!}
            </td>
            <td>
                <!--- filter id Field --->
                {!! Form::text('id', null, ['class' => 'form-control input-sm',
                                                       'style' => 'width:100%;',
                                                       'placeholder'=>trans($VN.'id')]) !!}
            </td>
            <td>
                <!--- filter name Field --->
                {!! Form::text('name', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>trans($VN.'name')]) !!}
            </td>
            <td>
                <!--- filter acronym Field --->
                {!! Form::text('acronym', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>trans($VN.'acronym')]) !!}
            </td>
            <td>
                <!--- filter display_name Field --->
                {!! Form::text('display_name', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>trans($VN.'display_name')]) !!}
            </td>
            <td>
            </td>
            <td>
                <!--- filter description Field --->
                {!! Form::text('description', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>trans($VN.'description')]) !!}
            </td>
        </tr>

        @foreach($models as $model)
            <tr>
                <td>
                    {!! link_to_route(SHOW_ROUTE,($model->trashed()?trans($VN.'trash'):trans($VN.'show')),['id'=>$model->id],
                                      ['class' => 'btn-sm '.($model->trashed()?'btn-danger':'btn-primary')]) !!}
                </td>
                <td class="text-right">
                    {!! link_to_route(SHOW_ROUTE,$model->id,['id'=>$model->id]) !!}
                </td>
                <td>
                    {!! link_to_route(SHOW_ROUTE,$model->name,['id'=>$model->id]) !!}
                </td>
                <td>
                    {!! link_to_route(SHOW_ROUTE,$model->acronym,['id'=>$model->id]) !!}
                </td>
                <td>
                    {!! link_to_route(SHOW_ROUTE,$model->display_name,['id'=>$model->id]) !!}
                </td>
                <td>
                    {{ $model->Path()}}
                </td>
                <td>
                    {{ $model->ShortDescription}}
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
                    <small>{{trans($VN.'order_by')}}: <strong>{{ App\Profile::OrderByLabel(VIEW_NAME) }}</strong></small>
                @endif
                &nbsp;
                @if (App\Profile::FilterByLabel(VIEW_NAME) !='')
                    <small>{{trans($VN.'filer_by')}}: <strong>{{ App\Profile::FilterByLabel(VIEW_NAME) }}</strong></small>
                @endif

            </td>
        </tr>
        </tfoot>
    </table>
    @include ('partials.crud.index_buttons')
    {!! Form::close() !!}
@endsection