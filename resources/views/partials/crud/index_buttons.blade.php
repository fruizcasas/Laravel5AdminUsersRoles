<div class="form-horizontal btn-group-sm">
    &nbsp;
    {!! link_to_route(CREATE_ROUTE,'New',[],
            ['class' => 'btn-sm btn-warning ']) !!}
    @if (App\Profile::loginProfile()->show_trash)
        @if (!Session(VIEW_NAME.'.trash',false))
            {!! link_to_route(SHOW_TRASH_ROUTE,'Show Trash',[1],
                              ['class'=>'btn-sm btn-primary']) !!}
        @else
            {!! link_to_route(SHOW_TRASH_ROUTE,'Hide Trash',[0],
                              ['class'=>'btn-sm btn-primary active'])!!}
        @endif
    @endif
    {!! $models->render()!!}
</div>
<br/>
