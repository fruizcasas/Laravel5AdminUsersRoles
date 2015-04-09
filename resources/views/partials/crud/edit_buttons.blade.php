<?php

// -----------------
// Translate Prefix
// -----------------
$VN = 'views/partials/crud/edit_buttons.';
?>

<div class="panel-footer">
    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {!! link_to_route(SHOW_ROUTE,trans($VN.'cancel'),[$model->id],
                             ['class' => 'form-control btn btn-primary']) !!}
        </div>
        <div class="col-md-2">
            {!! Form::submit(trans($VN.'update'), ['class' => 'form-control btn btn-warning','name'=>'update']) !!}
        </div>
    </div>
</div>
