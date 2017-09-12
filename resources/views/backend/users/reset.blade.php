@extends('backend.layouts.authencation')

@section('title', 'Tạo Mật Mã Mới')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="/"><b>Admin</b>CMS</a>
	</div>
	<!-- /.login-logo -->
	@include('backend.partials.flash')
	<div class="login-box-body">
		<p class="login-box-msg">Đăng nhập để bắt đầu phiên làm việc</p>

		<form action="{{ url('/password/reset') }}" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="token" value="{{ $token }}">

			<div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
				<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" autofocus autocomplete="off" required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
				<input type="password" name="password" class="form-control" placeholder="Mật mã" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				@if ($errors->has('password'))
				<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
				<input type="password" name="password_confirmation" class="form-control" placeholder="Nhắc lại mật mã" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				@if ($errors->has('password_confirmation'))
				<span class="help-block">
					<strong>{{ $errors->first('password_confirmation') }}</strong>
				</span>
				@endif
			</div>

			<div class="row">
				<div class="col-xs-offset-7 col-xs-5">
					<button type="submit" class="btn btn-success btn-block btn-flat">Hoàn tất</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
		<br>
		<a href="{{ route('backend.login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a>

	</div>
	<br>
	<div class="text-center">
		<p>Hệ thống được phát triển bởi <a href="http://ketnoimoi.com">ketnoimoi.com</a></p>
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection

@section('plugins.js')
@endsection

@section('javascript.customize')
@endsection
