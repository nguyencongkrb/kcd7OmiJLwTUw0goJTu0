@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-6">
	<form class="form-horizontal" id="frmLogin" method="POST" action="{{ url('/login') }}">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-4">
				<div class="row">
					<h3>Chào mừng bạn đến cửa hàng quà tặng</h3>
					<h1>SUN MART</h1>
				</div>
			</div>
		</div>
		{{ csrf_field() }}
		@if(session('status'))
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ session('status') }}
		</div>
		@endif
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Tên đăng nhập</label>
			<div class="col-xs-12 col-sm-8">
				<div class="row">
					<input type="text" id="email" name="email" class="form-control" required>
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Mật khẩu</label>
			<div class="col-xs-12 col-sm-8">
				<div class="row">
					<input type="password" id="password" name="password" class="form-control" required>
					@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Mã xác thực</label>
			<div class="col-xs-12 col-sm-4">
				<div class="row">
					<input type="text" class="form-control text-center" id="refer" readonly value="{{ rand(1, 9) }} + {{ rand(1, 9) }}">
				</div>
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="row" style="overflow: hidden;">
					<input type="text" class="form-control verifycode" id="captcha" name="captcha" placeholder="nhập mã xác thực" required>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-12 col-sm-offset-4 col-sm-8">
				<div class="row">
					<button type="submit" class="btn btn-default btn-block">Đăng nhập</button>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="text-right form-link">
					<a href="{{ route('user.resetpassword') }}">Quên mật khẩu</a><br>
					<a href="{{ route('user.register') }}">Tạo tài khoản mới</a>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
@section('plugins.js')
@endsection

@section('customize.js')
<script type="text/javascript">
	$(document).ready(function (argument) {
		$("#frmLogin").validate({
			lang: 'vi',
			errorClass: 'text-danger',
			rules: {
				captcha: {
					captcha: '#refer',
				}
			},
			messages: {
				captcha: {
					captcha: 'Mã xác thực không đúng.'
				}
			}
		});
	});
</script>
@endsection