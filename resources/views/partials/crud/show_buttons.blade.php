<?php

// -----------------
// Translate Prefix
// -----------------
$VN = 'views/partials/crud/show_buttons.';
?>

<div class="panel-footer">
    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-md-2 col-md-offset-2">
                {!! link_to_route(INDEX_ROUTE,trans($VN.'back'),[],
                                 ['class' => 'form-control btn btn-primary']) !!}
            </div>
            <div class="col-md-2">
                {!! link_to_route(CREATE_ROUTE,trans($VN.'new'),[],
                                ['class' => 'form-control btn btn-warning ']) !!}
            </div>
            @if (! $model->trashed() )
                <div class="col-md-2">
                    {!! link_to_route(EDIT_ROUTE,trans($VN.'edit'),[$model->id],
                                     ['class' => 'form-control btn btn-warning']) !!}
                </div>
                <div class="col-md-2">
                    {!! Form::open(['method' =>'DELETE',
                                    'route'  => [TRASH_ROUTE, $model->id]]) !!}
                    {!! Form::submit(trans($VN.'trash'), ['class' => 'form-control btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            @else
                <div class="col-md-2">
                    {!! Form::open(['method' =>'POST',
                                   'route'  => [RESTORE_ROUTE, $model->id]]) !!}
                    {!! Form::submit(trans($VN.'restore'), ['class' => 'form-control btn btn-warning']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="col-md-2">
                    {!! Form::open(['method' =>'DELETE',
                                    'route'  => [DELETE_ROUTE, $model->id]]) !!}
                    {!! Form::submit(trans($VN.'delete'), ['class' => 'form-control btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            @endif
        </div>
    </div>
</div>
