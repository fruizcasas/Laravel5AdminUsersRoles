<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/categories/_hierarchy.';
?>

<div class="col-md-12 col-md-offset-0">
    <br/>
    <div class="panel panel-primary">
        <div class="panel-footer">
        </div>
        <div class="panel-body">
            {!! \App\Models\Admin\Category::Tree(SHOW_ROUTE) !!}
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>
