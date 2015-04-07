<!--- timestamps()  --->
<div class="form-group">
    <small class="col-sm-10 col-sm-offset-2">
        @if (array_has($model->getAttributes(),'created_at'))
        Created at: <strong>{{$model->created_at}}</strong>
        @endif
        @if (array_has($model->getAttributes(),'updated_at'))
        Updated at: <strong>{{$model->updated_at}}</strong>
        @endif
        @if (array_has($model->getAttributes(),'deleted_at'))
        Deleted at: <strong>{{$model->deleted_at}}</strong>
        @endif
    </small>
</div>
