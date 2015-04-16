<div class="panel-body">
    <div class="form-horizontal">
        <div class="col-sm-2 ">
            {!! Form::label('users', 'Users:',['class' =>'col-sm-2 control-label text-right']) !!}
        </div>
        <div class="col-sm-10">
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Display Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($model->users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->display_name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
