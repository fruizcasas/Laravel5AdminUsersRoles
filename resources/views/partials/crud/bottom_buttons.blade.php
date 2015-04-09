<?php

// -----------------
// Translate Prefix
// -----------------
$VN = 'views/partials/crud/bottom_buttons.';
?>

<div class="panel-footer">
    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {!! link_to('#top',trans($VN.'go_top'),
                         ['class' => 'form-control btn btn-primary']) !!}
        </div>
        <br/>
    </div>
</div>
