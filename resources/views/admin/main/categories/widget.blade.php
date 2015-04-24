<?php
use App\Models\Admin\Category;

?>

<fieldset>
    <table class="table-bordered table-condensed table-hover" style="width: 100%;">
        <col>
        <col >
        <col style="width: 9em;">
        <thead>
        <tr>
            <th>Category</th>
            <th>Parent</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach(Category::with('parent')->latest()->take(5)->get() as $folder)
            <tr>
                <td>
                    {{ $folder->name }}
                </td>
                <td>
                    @if ($folder->parent)
                        {{ $folder->parent->name }}
                    @endif
                </td>
                <td>
                    {{ $folder->updated_at->diffForHumans()}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br/>
    {!! \App\Models\Admin\Category::Tree('admin.categories.show') !!}
</fieldset>