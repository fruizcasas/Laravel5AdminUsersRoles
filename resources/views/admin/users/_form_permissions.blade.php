<?php
// -----------------
// View Name Prefix
// -----------------

$VN = 'views/admin/users/_form_permissions.';

?>

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
                        <td>
                        {!! link_to_route('admin.permissions.show',$permission->name,['id'=>$permission->id]) !!}
                        </td>
                        <td>
                            {!! link_to_route('admin.permissions.show',$permission->display_name,['id'=>$permission->id]) !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
