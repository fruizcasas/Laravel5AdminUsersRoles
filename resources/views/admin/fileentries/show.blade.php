<?php
const VIEW_NAME    = 'admin.fileentries.show';
?>

@include('admin.fileentries._routes')

@extends ('app')

@section('headings')
    <h1>Fileentry: {{ $model->name }}-{{ $model->display_name }}</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render(VIEW_NAME) !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
             @include('partials.crud.show_buttons')
             @include('admin.fileentries._form',['readonly' => true])
             @include('partials.crud.bottom_buttons')
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

