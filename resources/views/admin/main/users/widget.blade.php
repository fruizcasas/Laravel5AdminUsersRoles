<?php
use App\Models\Admin\User;

?>
<fieldset>
    <table class="table-bordered table-condensed table-hover" style="width: 100%;">
        <col style="width: 7em;">
        <col>
        <col>
        <col>
        <col style="width: 9m;">
        <thead>
        <tr>
            <th>User</th>
            <th>Name</th>
            <th>Email</th>
            <th>Report To</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach(User::latest('updated_at')->take(5)->get() as $model)
            <tr>
                <td>
                    {{ $model->name }}
                </td>
                <td>
                    {{ $model->display_name }}
                </td>
                <td>
                    {{ $model->email}}
                </td>
                <td>
                    @if ($model->parent)
                    {{ $model->parent->display_name}}
                        @endif
                </td>
                <td>
                    {{ $model->updated_at->diffForHumans()}}
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    {!! \App\Models\Admin\User::Tree('admin.users.show') !!}
    <hr/>
</fieldset>
