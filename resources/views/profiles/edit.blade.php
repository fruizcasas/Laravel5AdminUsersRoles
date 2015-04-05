@extends('app')

@section('headings')
    <h1>Profile: {{ App\Profile::loginProfile()->user->name }}</h1>
@endsection


@section('breadcrumbs')
    {!! Breadcrumbs::render('profile') !!}
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        {!! Form::model($model,['method' => 'PUT',
        'route'  => ['profile.update'],
        'class'=>'form-horizontal']) !!}
            <div class="panel panel-primary">
                <div class="panel-body">
                    @include('profiles._form')
                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-sm-2 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    @include('partials.errors')
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
