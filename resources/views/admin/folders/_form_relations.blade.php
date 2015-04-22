<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/folders/_form_relations.';
?>


<div class="panel-body">

    <div class="panel-footer">
        <h3> {{trans($VN.'title')}}</h3>
    </div>
    <div class="panel-body">
        @if ($model->parent)
            <ul>
                <li>
                    {!! $model->parent->trashed()?'<del>':'' !!}
                    {!! link_to_route(SHOW_ROUTE,$model->parent->name,['id'=>$model->parent->id,'tab' => 'tab_relations']) !!}
                    {!! $model->parent->trashed()?'</del>':'' !!}
                    @endif
                    <ul>
                        <li>
                            {!! $model->trashed()?'<del>':'' !!}
                            <strong>{{$model->name}}</strong>
                            {!! $model->trashed()?'</del>':'' !!}

                            {!! \App\Models\Admin\Folder::Tree(SHOW_ROUTE,$model->id,['tab' => 'tab_relations']) !!}
                        </li>
                    </ul>
                    @if ($model->parent)
                </li>
            </ul>
        @endif
    </div>
    <div class="panel-footer">
    </div>
</div>
