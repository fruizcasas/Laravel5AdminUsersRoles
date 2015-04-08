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
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                @foreach($model->users as $user)
                    <tr>
                        <td>
                            {!! link_to_route('admin.users.show',$user->display_name .'('. $user->name.')',['id'=>$user->id]) !!}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
