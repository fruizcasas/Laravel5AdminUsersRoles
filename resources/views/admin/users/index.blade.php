
@extends ('app')

@section('headings')
    <h1>Users</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.users') !!}
@endsection

<?php
 /*
  * |-------------------------------------------------------------
  * |
  * |-------------------------------------------------------------
  */

 const VIEW_NAME    = 'admin.users.index';

 const INDEX_ROUTE  = 'admin.users.index';
 const CREATE_ROUTE = 'admin.users.create';
 const SHOW_ROUTE   = 'admin.users.show';

 const FILTER_ROUTE = 'admin.users.filter';
 const SORT_ROUTE   = 'admin.users.sort';


 const HIDE_TRASH_ROUTE = 'profile.resettrash';
 const SHOW_TRASH_ROUTE = 'profile.settrash';

?>

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
        {!! $records->render()!!}
        </div>
    <br/><br/>

    <table class="table table-striped table-bordered table-compact table-hover">
        <col style="width:6em;">
        <col style="width:5em;">
        <col >
        <col >
        <col style="width:5em;">
        <thead>
        <th>
            {!! link_to_route(SORT_ROUTE,'Reset',[],
                        ['class' => 'btn-sm btn-primary']) !!}

        </th>
        <th class="text-right">
            {!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'id')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'name')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'email')!!}</th>
        <th>{!!App\Traits\SortableTrait::link_to_sorting(SORT_ROUTE,VIEW_NAME,'is_admin','adm')!!}</th>
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
                <!--- filter roles Field --->
                {!! Form::text('roles', null, ['class' => 'form-control input-sm',
                                                         'style' => 'width:100%;',
                                                             'placeholder'=>'roles filter...']) !!}
            </td>
        </tr>

        @foreach($records as $record)
            <tr>
                <td>
                    {!! link_to_route(SHOW_ROUTE,($record->trashed()?'Trash':'Show'),['id'=>$record->id],
                                      ['class' => 'btn-sm '.($record->trashed()?'btn-danger':'btn-primary')]) !!}
                </td>
                <td class="text-right">
                    {!! link_to_route(SHOW_ROUTE,$record->id,['id'=>$record->id]) !!}
                </td>
                <td>
                    {!! link_to_route(SHOW_ROUTE,$record->name,['id'=>$record->id]) !!}
                </td>
                <td>
                    {!! link_to('mailto:' . $record->email,$record->email) !!}
                </td>
                <td class="text-center">
                    {{ $record->is_admin?'X':'-'}}
                </td>
                <td>
                    {{ $record->StrRoles }}
                </td>

            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td class="text-right">
               <small>{{  $records->total() .' recs' }}</small>
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
        {!! $records->render()!!}
    </div>
    {!! Form::close() !!}
@endsection