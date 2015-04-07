<?php
const VIEW_NAME    = 'admin.users.show';
?>

@include('admin.users._routes')

@extends ('app')

@section('headings')
    <h1>User: {{ $model->name }}</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                @include('partials.crud.show_buttons')
                @include('admin.users._form',['readonly' => true])
                @include('partials.crud.show_buttons')
            </div>
            <div class="col-sm-10 col-sm-offset-2">
                <h3>Permissions</h3>
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
@endsection

@section('scripts')
    <script src="{{ asset('/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('#roles').select2({
            placeholder: 'Select a role'
        });
    </script>
@endsection

