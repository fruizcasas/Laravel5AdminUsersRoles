<?php
use App\Models\Admin\Department;

?>

<fieldset>
    <legend>Departments</legend>
    <table class="table-bordered table-condensed table-hover" style="width: 100%;">
        <thead>
        <col style="width: 4em;">
        <col>
        <col style="width: 9em;">
        <tr>
            <th>Users</th>
            <th>Name</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach(Department::latest('updated_at')->take(5)->get() as $model)
            <tr>
                <td>
                    @if($model->children)
                        {{ $model->children->count()}}
                    @endif
                </td>
                <td>
                    {{ $model->name }}
                </td>
                <td>
                    {{ $model->updated_at->diffForHumans()}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</fieldset>