<div class="panel-footer">
    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {!! link_to_route(SHOW_ROUTE,'Cancel',[$model->id],
                             ['class' => 'form-control btn btn-primary']) !!}
        </div>
        <div class="col-md-2">
            {!! Form::submit('Update', ['class' => 'form-control btn btn-warning','name'=>'update']) !!}
        </div>
    </div>
</div>
