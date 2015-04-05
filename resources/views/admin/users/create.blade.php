@extends ('app')

@section('headings')
    <h1>Create User</h1>
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin.users.create') !!}
@endsection


@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-primary">
            {!! Form::model($model,['action' =>'Admin\UsersController@store','class'=>'form-horizontal']) !!}
                <div class="panel-body">
                    @include('admin.users._form',['readonly' => false])
                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-2">
                            {!! link_to_route('admin.users.index','Cancel',[],
                                         ['class' => 'form-control btn btn-primary']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::submit('Create new', ['class' => 'form-control btn btn-warning']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            @if($errors->any())
            <div class="panel-footer">
                @include('partials.errors')
            </div>
            @endif
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

