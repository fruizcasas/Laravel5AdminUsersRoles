<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/admin/fileentries/index.';
const VIEW_NAME    = 'admin.fileentries.index';
?>

@include('admin.fileentries._routes')

@extends ('app')

@section('headings')
    <h1>Fileentries</h1>
@endsection


@section('breadcrumbs')
@endsection


@section('content')

    <table class="table table-hover table-condensed table-bordered">
    	<thead>
    		<tr>
    			<th>id</th>
    			<th>original name</th>
    			<th>original mime</th>
    			<th>original extension</th>
    			<th>name</th>
    			<th>mime</th>
    			<th>extension</th>
    			<th>size</th>
    		</tr>
    	</thead>
    	<tbody>
            @foreach($models as $model)
    		<tr>
    			<td>{{$model->id}}</td>
    			<td>{{$model->original_name}}</td>
    			<td>{{$model->original_mime}}</td>
    			<td>{{$model->original_extension}}</td>
    			<td>{{$model->name}}</td>
    			<td>{{$model->mime}}</td>
    			<td>{{$model->extension}}</td>
    			<td>{{$model->size}}</td>
    		</tr>
                @endforeach
    	</tbody>
    </table>

@endsection