<?php
use App\Models\Admin\Folder;

?>

<fieldset>
    <table class="table-bordered table-condensed table-hover" style="width: 100%;">
        <col>
        <col style="width: 7em;">
        <col style="width: 9em;">
        <thead>
        <tr>
            <th>Folder</th>
            <th>Owner</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach(Folder::with('owner')->latest()->take(5)->get() as $folder)
            <tr>
                <td>
                    {{ $folder->name }}
                </td>
                <td>
                    {{ $folder->owner->name }}
                </td>
                <td>
                    {{ $folder->updated_at->diffForHumans()}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    {!! \App\Models\Admin\Folder::Tree('admin.folders.show') !!}
</fieldset>