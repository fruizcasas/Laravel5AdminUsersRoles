<?php

// -----------------
// View Name Prefix
// -----------------
$VN = 'views/auth/password.';

?>

@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{trans($VN.'reset_password')}}</div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p style="text-align: center;">
                            {!! Html::image('/images/laravel-logo.png','laravel-logo',[]) !!}
                        </p>

						<div class="form-group {{$errors->first('email','has-error')}}">
							<label class="col-md-4 control-label">{{trans($VN.'email_address')}}</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                {!! $errors->first('email', '<p class="help-block error-msg">:message</p>') !!}
							</div>
                        </div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
                                    {{trans($VN.'send_password_reset_link')}}
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
