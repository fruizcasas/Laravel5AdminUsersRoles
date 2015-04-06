<div class="form-horizontal btn-group-sm">
    &nbsp;
    {!! link_to_route(CREATE_ROUTE,'New',[],
            ['class' => 'btn-sm btn-warning ']) !!}
    @if (App\Profile::loginProfile()->show_trash == '0')
        {!! link_to_route(SHOW_TRASH_ROUTE,'Show Trash',[INDEX_ROUTE],
                          ['class'=>'btn-sm btn-primary']) !!}
    @else
        {!! link_to_route(HIDE_TRASH_ROUTE,'Hide Trash',[INDEX_ROUTE],
                          ['class'=>'btn-sm btn-primary active'])!!}
    @endif
    {!! $models->render()!!}
</div>
<br/>
