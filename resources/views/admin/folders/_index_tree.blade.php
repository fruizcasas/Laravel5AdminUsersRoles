<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/folders/_index_tree.';
?>

<div class="col-md-12 col-md-offset-0">
    <br/>
    <div class="panel panel-primary">
        <div class="panel-footer">
            <h3> {{trans($VN.'title')}}</h3>
        </div>
        <div class="panel-body">
            {!! \App\Models\Admin\Folder::Tree(SHOW_ROUTE) !!}
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>
