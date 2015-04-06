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
                @include('partials.show_buttons')
                @include('admin.users._form',['readonly' => true])
                @include('partials.show_buttons')
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

