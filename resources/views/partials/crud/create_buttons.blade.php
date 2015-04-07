<div class="panel-footer">
    <div class="form-group">
        <div class="col-md-2 col-md-offset-2">
            {!! link_to_route(INDEX_ROUTE,'Cancel',[],
                         ['class' => 'form-control btn btn-primary']) !!}
        </div>
        <div class="col-sm-2">
            {!! Form::submit('Create new', ['class' => 'form-control btn btn-warning']) !!}
        </div>
    </div>
</div>
