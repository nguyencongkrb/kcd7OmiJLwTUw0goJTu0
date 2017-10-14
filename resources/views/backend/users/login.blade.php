@extends('backend.layouts.authencation')

@section('title', 'Đăng nhập')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="/"><b>Admin</b>CMS</a>
	</div>
	<!-- /.login-logo -->
	@include('backend.partials.flash')
	<div class="login-box-body">
		<p class="login-box-msg">Đăng nhập để bắt đầu phiên làm việc</p>

		<form action="{{ url('/login') }}" method="post">
			{{ csrf_field() }}

			<div class="form-group has-feedback{{ $errors->has('username') ? ' has-error' : '' }}">
				<input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" value="{{ old('username') }}" autofocus required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				@if ($errors->has('username'))
				<span class="help-block">
					<strong>{{ $errors->first('username') }}</strong>
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

			<div class="row">
				<div class="col-xs-7">
					<div class="checkbox icheck">
						<label>
							<input type="checkbox" name="remember"> Nhớ đăng nhập
						</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-5">
					<button type="submit" class="btn btn-success btn-block btn-flat">Đăng nhập</button>
				</div>
				<!-- /.col -->
			</div>
		</form>

		<a href="{{ route('backend.password.reset') }}"><i class="fa fa-key" aria-hidden="true"></i> Bạn quên mật mã?</a><br>

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
<!-- iCheck -->
<script src="/backend/plugins/iCheck/icheck.min.js"></script>
@endsection

@section('javascript.customize')
<script type="text/javascript">
$(function () {
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
		increaseArea: '20%'
	});
});
</script>
@endsection
