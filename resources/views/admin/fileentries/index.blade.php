<?php
const VIEW_NAME    = 'admin.fileentries.index';
?>

@include('admin.fileentries._routes')

@extends ('app')

@section('headings')
    <h1>Fileentrys</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.fileentries') !!}
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
            {!! link_to_route(SORT_ROUTE,'Reset',[],
                        ['class' => 'btn-sm btn-primary']) !!}

        </th>
        <th class="text-right">
            {!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'id')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'original_name')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'original_mime_type')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'original_extension')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'name')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'mime_type')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'extension')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'size')!!}</th>
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
                {!! Form::text('original_name', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'name filter...']) !!}
            </td>
            <td>
                <!--- filter name Field --->
                {!! Form::text('original_mime_tyoe', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'name filter...']) !!}
            </td>
            <td>
                <!--- filter name Field --->
                {!! Form::text('original_extension', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'name filter...']) !!}
            </td>
            <td>
                <!--- filter name Field --->
                {!! Form::text('name', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'name filter...']) !!}
            </td>
            <td>
                <!--- filter name Field --->
                {!! Form::text('mime_type', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'name filter...']) !!}
            </td>
            <td>
                <!--- filter name Field --->
                {!! Form::text('extension', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'name filter...']) !!}
            </td>
            <td>
                <!--- filter name Field --->
                {!! Form::text('size', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'name filter...']) !!}
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
                    {{ $model->original_name}}
                </td>
                <td>
                    {{ $model->original_mime_type}}
                </td>
                <td>
                    {{ $model->original_extension}}
                </td>
                <td>
                    {{ $model->name}}
                </td>
                <td>
                    {{ $model->mime_type}}
                </td>
                <td>
                    {{ $model->extension}}
                </td>
                <td class="text-right">
                    {{ $model->size}}
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
    @include ('partials.crud.index_buttons')
    {!! Form::close() !!}
@endsection