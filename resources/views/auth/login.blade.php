<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/auth/login.';

?>

@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans($VN.'login')}}</div>
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
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p style="text-align: center;">
                        {!! Html::image('/images/laravel-logo.png','laravel-logo',['style' => 'align-content:center;']) !!}
                        </p>

						<div class="form-group {{$errors->first('email','has-error')}}">
							<label class="col-md-4 control-label">{{trans($VN.'email_address')}}</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                {!! $errors->first('email', '<p class="help-block error-msg">:message</p>') !!}
							</div>
						</div>

						<div class="form-group {{$errors->first('password','has-error')}}">
							<label class="col-md-4 control-label">{{trans($VN.'password')}}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
                                {!! $errors->first('password', '<p class="help-block error-msg">:message</p>') !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> {{trans($VN.'remember_me')}}
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">{{trans($VN.'login')}}</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">{{trans($VN.'forgot_your_password')}}</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
