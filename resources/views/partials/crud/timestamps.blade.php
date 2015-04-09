<?php

// -----------------
// Translate Prefix
// -----------------
$VN = 'views/partials/crud/timestamps.';
?>


<!--- timestamps()  --->
<div class="form-group">
    <small class="col-sm-10 col-sm-offset-2">
        @if (array_has($model->getAttributes(),'created_at'))
        {{trans($VN.'created')}} <strong>{{$model->created_at}}</strong>
        @endif
        @if (array_has($model->getAttributes(),'updated_at'))
        {{trans($VN.'updated')}} <strong>{{$model->updated_at}}</strong>
        @endif
        @if (array_has($model->getAttributes(),'deleted_at'))
        {{trans($VN.'deleted')}} <strong>{{$model->deleted_at}}</strong>
        @endif
    </small>
</div>
