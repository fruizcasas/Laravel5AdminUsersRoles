<?php

// -----------------
// Translate Prefix
// -----------------
$VN = 'views/partials/crud/index_buttons.';
?>

<div class="form-horizontal btn-group-sm">
    &nbsp;
    {!! link_to_route(CREATE_ROUTE,trans($VN.'new'),[],
            ['class' => 'btn-sm btn-warning ']) !!}
    @if (App\Profile::loginProfile()->show_trash)
        @if (!Session(VIEW_NAME.'.trash',false))
            {!! link_to_route(SHOW_TRASH_ROUTE,trans($VN.'show_trash'),[1],
                              ['class'=>'btn-sm btn-primary']) !!}
        @else
            {!! link_to_route(SHOW_TRASH_ROUTE,trans($VN.'hide_trash'),[0],
                              ['class'=>'btn-sm btn-primary active'])!!}
        @endif
    @endif
    {!! $models->appends(['tab' => 'data'])->render()!!}
    &nbsp;
    {!! link_to_route(EXCEL_ROUTE,trans($VN.'excel'),[],
            ['class' => 'btn-sm btn-success ']) !!}
</div>
<br/>
