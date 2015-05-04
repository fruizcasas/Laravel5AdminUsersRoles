<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/documents/_index_table.';
?>


{!! Form::model($filter,['route' => FILTER_ROUTE,
                         'class'=>'form-inline',
                         'role'=>'form']) !!}

@include ('partials.crud.index_buttons')

<table class="table table-striped table-bordered table-compact table-hover table-responsive">
    <col style="width:6em;"> {{-- Buttons --}}
    <col style="width:4em;"> {{-- id --}}
    <col> {{-- title --}}
    <col> {{-- name --}}
    <col> {{-- mime_type --}}
    <col> {{-- extension --}}
    <col> {{-- original_name --}}
    <col> {{-- original_mime_type --}}
    <col> {{-- original_extension --}}
    <col> {{-- size --}}
    <col> {{-- sha1 --}}
    <col> {{-- owner --}}
    <col> {{-- description --}}
    <thead>
    <th>
        {!! link_to_route(SORT_ROUTE,trans($VN.'reset'),[],
                    ['class' => 'btn-sm btn-primary']) !!}

    </th>
    <th class="text-right">
        {!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'id',trans($VN.'id'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'title',trans($VN.'title'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'name',trans($VN.'name'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'mime_type',trans($VN.'mime_type'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'extension',trans($VN.'extension'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'original_name',trans($VN.'original_name'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'original_mime_type',trans($VN.'original_mime_type'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'original_extension',trans($VN.'original_extension'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'size',trans($VN.'size'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'sha1',trans($VN.'sha1'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'user_id',trans($VN.'owner'))!!}</th>
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
            <!--- title Field --->
            {!! Form::text('title', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                     'placeholder'=>trans($VN.'title')]) !!}
        </td>
        <td>
            <!--- name Field --->
            {!! Form::text('name', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                     'placeholder'=>trans($VN.'name')]) !!}
        </td>
        <td>
            <!--- mime_type Field --->
            {!! Form::text('mime_type', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                     'placeholder'=>trans($VN.'mime_type')]) !!}
        </td>
        <td>
            <!--- extension Field --->
            {!! Form::text('extension', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                     'placeholder'=>trans($VN.'extension')]) !!}
        </td>
        <td>
            <!--- original_name Field --->
            {!! Form::text('original_name', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                     'placeholder'=>trans($VN.'original_name')]) !!}
        </td>
        <td>
            <!--- original_mime_type Field --->
            {!! Form::text('original_mime_type', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                     'placeholder'=>trans($VN.'original_mime_type')]) !!}
        </td>
        <td>
            <!--- original_extension Field --->
            {!! Form::text('original_extension', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                     'placeholder'=>trans($VN.'original_extension')]) !!}
        </td>
        <td>
            <!--- size Field --->
            {!! Form::text('size', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                     'placeholder'=>trans($VN.'size')]) !!}
        </td>
        <td>
            <!--- sha1 Field --->
            {!! Form::text('sha1', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                     'placeholder'=>trans($VN.'sha1')]) !!}
        </td>
        <td>
            <!--- owner Field --->
            {!! Form::text('owner', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                     'placeholder'=>trans($VN.'owner')]) !!}
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
                {!! link_to_route(SHOW_ROUTE,$model->title,['id'=>$model->id]) !!}
            </td>
            <td>
                {!! link_to_route(SHOW_ROUTE,$model->name,['id'=>$model->id]) !!}
            </td>
            <td>
                {{$model->mime_type}}
            </td>
            <td>
                {{$model->extension}}
            </td>
            <td>
                {{$model->original_name}}
            </td>
            <td>
                {{$model->original_mime_type}}
            </td>
            <td>
                {{$model->original_extension}}
            </td>
            <td class="text-right">
                {{$model->size}}
            </td>
            <td>
                {{$model->sha1}}
            </td>
            <td>
                @if($model->owner)
                    {{ $model->owner->acronym }}
                @endif
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
