<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/auth/register.';

?>

@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans($VN.'register')}}</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p style="text-align: center;">
                            {!! Html::image('/images/laravel-logo.png','laravel-logo',['style' => 'align-content:center;']) !!}
                        </p>

						<div class="form-group   {{$errors->first('name','has-error')}}">
							<label class="col-md-4 control-label">{{trans($VN.'name')}}</label>
							<div class="col-md-3">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                {!! $errors->first('name', '<p class="help-block error-msg">:message</p>') !!}
							</div>
						</div>

                        <div class="form-group  {{$errors->first('display_name','has-error')}}">
                            <label class="col-md-4 control-label">{{trans($VN.'display_name')}}</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="display_name" value="{{ old('display_name') }}">
                                {!! $errors->first('display_name', '<p class="help-block error-msg">:message</p>') !!}
                            </div>
                        </div>

						<div class="form-group  {{$errors->first('email','has-error')}}">
							<label class="col-md-4 control-label">{{trans($VN.'email_address')}}</label>
							<div class="col-md-8">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                {!! $errors->first('email', '<p class="help-block error-msg">:message</p>') !!}
                                <p><small>{{trans($VN.'free_register')}}</small></p>
                            </div>
						</div>

						<div class="form-group  {{$errors->first('password','has-error')}}">
							<label class="col-md-4 control-label">{{trans($VN.'password')}}</label>
							<div class="col-md-3">
								<input type="password" class="form-control" name="password">
                                {!! $errors->first('password', '<p class="help-block error-msg">:message</p>') !!}
							</div>
						</div>

						<div class="form-group  {{$errors->first('password_confirmation','has-error')}}">
							<label class="col-md-4 control-label">{{trans($VN.'confirm_password')}}</label>
							<div class="col-md-3">
								<input type="password" class="form-control" name="password_confirmation">
                                {!! $errors->first('password_confirmation', '<p class="help-block error-msg">:message</p>') !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-4 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
                                    {{trans($VN.'register')}}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
