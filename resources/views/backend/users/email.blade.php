@extends('backend.layouts.authencation')

@section('title', 'Khôi Phục Mật Mã')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="/"><b>Admin</b>CMS</a>
	</div>
	<!-- /.login-logo -->
	@include('backend.partials.flash')
	<div class="login-box-body">
		<p class="login-box-msg">Khôi phục mật mã của bạn</p>

		<form action="{{ url('/password/email') }}" method="post">
			{{ csrf_field() }}

			<div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
				<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" autofocus autocomplete="off" required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>

			<div class="row">
				<div class="col-xs-12">
					<button type="submit" class="btn btn-success btn-block btn-flat">Tiến hành khôi phục</button>
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
