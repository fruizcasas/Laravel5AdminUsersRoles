<div class="panel-body">
    <div class="form-horizontal">
        <div class="col-sm-2 ">
            {!! Form::label('Permissions', 'Permissions:',['class' =>'col-sm-2 control-label text-right']) !!}
        </div>
        <div class="col-sm-10">
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Permission</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($model->permissions() as $permission)
                    <tr>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->display_name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
