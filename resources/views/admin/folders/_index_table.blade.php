<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/folders/_index_table.';
?>


{!! Form::model($filter,['route' => FILTER_ROUTE,
                         'class'=>'form-inline',
                         'role'=>'form']) !!}

@include ('partials.crud.index_buttons')

<table class="table table-striped table-bordered table-compact table-hover table-responsive">
    <col style="width:6em;"> {{-- Buttons --}}
    <col style="width:5em;"> {{-- ID --}}
    <col> {{-- name --}}
    <col> {{-- root --}}
    <col> {{-- parent --}}
    <col style="width:5em;"> {{-- order --}}
    <col> {{-- owner --}}
    <col style="width:4em;"> {{-- private --}}
    <col> {{-- description --}}
    <thead>
    <th>
        {!! link_to_route(SORT_ROUTE,trans($VN.'reset'),[],
                    ['class' => 'btn-sm btn-primary']) !!}

    </th>
    <th class="text-right">
        {!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'id',trans($VN.'id'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'name',trans($VN.'name'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'root_id',trans($VN.'root'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'folder_id',trans($VN.'parent'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'order',trans($VN.'order'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'user_id',trans($VN.'owner'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'private',trans($VN.'private'))!!}</th>
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
            <!--- filter root Field --->
            {!! Form::text('root', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>trans($VN.'root')]) !!}
        </td>
        <td>
            <!--- filter folder_id Field --->
            {!! Form::text('parent', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>trans($VN.'parent')]) !!}
        </td>
        <td>
            <!--- filter order Field --->
            {!! Form::text('order', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>trans($VN.'order')]) !!}
        </td>
        <td>
            <!--- filter owner Field --->
            {!! Form::text('owner', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>trans($VN.'owner')]) !!}
        </td>
        <td>
            <!--- filter private Field --->
            {!! Form::text('private', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>trans($VN.'private')]) !!}
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
                @if($model->root)
                    {!! link_to_route(SHOW_ROUTE,$model->root->name,['id'=>$model->root->id]) !!}
                @endif
            </td>
            <td>
                @if($model->parent)
                    {!! link_to_route(SHOW_ROUTE,$model->parent->name,['id'=>$model->parent->id]) !!}
                @endif
            </td>
            <td class="text-right">
                {!! $model->order !!}
            </td>
            <td>
                @if($model->owner)
                    {!! link_to_route('admin.users.show',$model->owner->name,['id'=>$model->owner->id]) !!}
                @endif
            </td>
            <td class="text-center">
                {!! $model->private?'X':'-' !!}
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
            <small>{{ trans($VN.'records',['total'=>$models->total()]) }}</small>
        </td>
        <td colspan="10">
            @if (App\Profile::OrderByLabel(VIEW_NAME) !='')
                <small>{{trans($VN.'order_by')}}: <strong>{{ App\Profile::OrderByLabel(VIEW_NAME) }}</strong>
                </small>
            @endif
            &nbsp;
            @if (App\Profile::FilterByLabel(VIEW_NAME) !='')
                <small>{{trans($VN.'filter_by')}}: <strong>{{ App\Profile::FilterByLabel(VIEW_NAME) }}</strong>
                </small>
            @endif

        </td>
    </tr>
    </tfoot>
</table>
@include ('partials.crud.index_buttons')
{!! Form::close() !!}
