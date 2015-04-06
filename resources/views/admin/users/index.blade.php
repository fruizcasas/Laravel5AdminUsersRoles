<?php
const VIEW_NAME    = 'admin.users.index';
?>

@include('admin.users._routes')

@extends ('app')

@section('headings')
    <h1>Users</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.users') !!}
@endsection


@section('content')


    {!! Form::model($filter,['route' => FILTER_ROUTE,
                             'class'=>'form-inline','role'=>'form']) !!}
        @include ('partials.index_buttons')
        <br/>

    <table class="table table-striped table-bordered table-compact table-hover">
        <col style="width:5.5em;">
        <col style="width:4.5em;">
        <col style="width:5em;">
        <col >
        <col >
        <col style="width:3.5em;">
        <col style="width:3.5em;">
        <col style="width:3.5em;">
        <col style="width:3.5em;">
        <col style="width:3.5em;">
        <thead>
        <th>
            {!! link_to_route(SORT_ROUTE,'Reset',[],
                        ['class' => 'btn-sm btn-primary']) !!}

        </th>
        <th class="text-right">
            {!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'id')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'name')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'display_name')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'email')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_admin','adm')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_owner','own')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_reviewer','rev')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_approver','app')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_signer','sig')!!}</th>
        <th>Roles</th>
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
                'placeholder'=>'display_name filter...']) !!}
            </td>
            <td>
                <!--- filter email Field --->
                {!! Form::text('email', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'email filter...']) !!}
            </td>
            <td>
                <!--- filter is_admin Field --->
                {!! Form::text('is_admin', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'adm filter...']) !!}
            </td>
            <td>
                <!--- filter is_owner Field --->
                {!! Form::text('is_owner', null, ['class' => 'form-control input-sm',
                'style' => 'width:100%;',
                'placeholder'=>'own filter...']) !!}
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
                <!--- filter is_signer Field --->
                {!! Form::text('is_signer', null, ['class' => 'form-control input-sm',
                'style' => 'width:100%;',
                'placeholder'=>'sig filter...']) !!}
            </td>
            <td>
                <!--- filter roles Field --->
                {!! Form::text('roles', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'roles filter...']) !!}
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
                    {!! link_to_route(SHOW_ROUTE,$model->display_name,['id'=>$model->id]) !!}
                </td>
                <td>
                    {!! link_to('mailto:' . $model->email,$model->email) !!}
                </td>
                <td class="text-center">
                    {{ $model->is_admin?'X':'-'}}
                </td>
                <td class="text-center">
                    {{ $model->is_owner?'X':'-'}}
                </td>
                <td class="text-center">
                    {{ $model->is_reviewer?'X':'-'}}
                </td>
                <td class="text-center">
                    {{ $model->is_approver?'X':'-'}}
                </td>
                <td class="text-center">
                    {{ $model->is_signer?'X':'-'}}
                </td>
                <td>
                    {{ $model->StrRoles }}
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
    @include ('partials.index_buttons')
    {!! Form::close() !!}
@endsection