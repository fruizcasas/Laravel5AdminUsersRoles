@extends ('app')

@section('headings')
    <h1>User: {{ $model->name }}</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.users.show') !!}
@endsection


@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="form-horizontal">
                        @include('admin.users._form',['readonly' => true])
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                {!! link_to_route('admin.users.index','Cancel',[$model->id],
                                                 ['class' => 'form-control btn btn-primary']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! link_to_action('Admin\UsersController@create','New',[],
                                                ['class' => 'form-control btn btn-warning ']) !!}
                            </div>
                        @if (! $model->trashed() )
                            <div class="col-md-2">
                                {!! link_to_route('admin.users.edit','Edit',[$model->id],
                                                 ['class' => 'form-control btn btn-warning']) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::open(['method' =>'DELETE',
                                                'route'  => ['admin.users.destroy', $model->id]]) !!}
                                {!! Form::submit('Trash', ['class' => 'form-control btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>
                        @else
                            <div class="col-md-2">
                                {!! Form::open(['method' =>'POST',
                                               'route'  => ['admin.users.restore', $model->id]]) !!}
                                {!! Form::submit('Restore', ['class' => 'form-control btn btn-warning']) !!}
                                {!! Form::close() !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::open(['method' =>'DELETE',
                                                'route'  => ['admin.users.forcedelete', $model->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'form-control btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
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

