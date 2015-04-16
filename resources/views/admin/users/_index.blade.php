<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/users/_index.';
?>
{!! Form::model($filter,['route' => FILTER_ROUTE,
                         'class'=>'form-inline','role'=>'form']) !!}
@include ('partials.crud.index_buttons')


<table class="table table-striped table-bordered table-compact table-hover">
    <col style="width:5.5em;">
    <col style="width:4.5em;">
    <col style="width:5em;">
    <col style="width:4em;">
    <col>
    <col style="width:3.5em;">
    <col style="width:3.5em;">
    <col style="width:3.5em;">
    <col style="width:3.5em;">
    <col style="width:3.5em;">
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
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_admin',trans($VN.'adm'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_author',trans($VN.'aut'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_reviewer',trans($VN.'rev'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_approver',trans($VN.'app'))!!}</th>
    <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_publisher',trans($VN.'pub'))!!}</th>
    <th>{{trans($VN.'parent')}}</th>
    <th>{{trans($VN.'roles')}}</th>
    <th>{{trans($VN.'departments')}}</th>
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
                                                   'placeholder'=>'id filter...']) !!}
        </td>
        <td>
            <!--- filter name Field --->
            {!! Form::text('name', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>'name filter...']) !!}
        </td>
        <td>
            <!--- filter acronym Field --->
            {!! Form::text('acronym', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>'acronym filter...']) !!}
        </td>
        <td>
            <!--- filter display_name Field --->
            {!! Form::text('display_name', null, ['class' => 'form-control input-sm',
            'style' => 'width:100%;',
            'placeholder'=>'display_name filter...']) !!}
        </td>
        <td>
            <!--- filter is_admin Field --->
            {!! Form::text('is_admin', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>'adm filter...']) !!}
        </td>
        <td>
            <!--- filter is_author Field --->
            {!! Form::text('is_author', null, ['class' => 'form-control input-sm',
            'style' => 'width:100%;',
            'placeholder'=>'aut filter...']) !!}
        </td>
        <td>
            <!--- filter is_reviewer Field --->
            {!! Form::text('is_reviewer', null, ['class' => 'form-control input-sm',
            'style' => 'width:100%;',
            'placeholder'=>'rev filter...']) !!}
        </td>
        <td>
            <!--- filter is_approver Field --->
            {!! Form::text('is_approver', null, ['class' => 'form-control input-sm',
            'style' => 'width:100%;',
            'placeholder'=>'app filter...']) !!}
        </td>
        <td>
            <!--- filter is_publisher Field --->
            {!! Form::text('is_publisher', null, ['class' => 'form-control input-sm',
            'style' => 'width:100%;',
            'placeholder'=>'pub filter...']) !!}
        </td>
        <td>
            <!--- filter parent Field --->
            {!! Form::text('parent', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>trans($VN.'parent')]) !!}

        </td>
        <td>
            <!--- filter roles Field --->
            {!! Form::text('roles', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>'roles filter...']) !!}
        </td>
        <td>
            <!--- filter departments Field --->
            {!! Form::text('departments', null, ['class' => 'form-control input-sm',
                                                     'style' => 'width:100%;',
                                                         'placeholder'=>'departments filter...']) !!}
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
            <td class="text-center">
                {{ $model->is_admin?'X':'-'}}
            </td>
            <td class="text-center">
                {{ $model->is_author?'X':'-'}}
            </td>
            <td class="text-center">
                {{ $model->is_reviewer?'X':'-'}}
            </td>
            <td class="text-center">
                {{ $model->is_approver?'X':'-'}}
            </td>
            <td class="text-center">
                {{ $model->is_publisher?'X':'-'}}
            </td>
            <td>
                @if($model->parent)
                    {!! link_to_route(SHOW_ROUTE,$model->parent->name,['id'=>$model->parent->id]) !!}
                @endif
            </td>
            <td>
                {{ $model->StrRoles }}
            </td>
            <td>
                {{ $model->StrDepartments }}
            </td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td class="text-right">
            <small>{{  $models->total() .' rec' }}</small>
        </td>
        <td colspan="10">
            @if (App\Profile::OrderByLabel(VIEW_NAME) !='')
                <small>{{trans($VN.'order_by')}}<strong>{{ App\Profile::OrderByLabel(VIEW_NAME) }}</strong>
                </small>                @endif
            &nbsp;
            @if (App\Profile::FilterByLabel(VIEW_NAME) !='')
                <small>{{trans($VN.'filter_by')}} <strong>{{ App\Profile::FilterByLabel(VIEW_NAME) }}</strong></small>
            @endif

        </td>
    </tr>
    </tfoot>
</table>
@include ('partials.crud.index_buttons')
{!! Form::close() !!}
