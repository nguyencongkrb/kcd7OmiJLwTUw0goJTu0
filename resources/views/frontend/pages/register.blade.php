@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<section id="user">
	<div class="container">
		<div class="user-tools">
			<h1 class="text-uppercase">Tạo tài khoản</h1>
		</div>
		<div class="row">
			@include('frontend.partials.errors')

			<div class="col-sm-6 col-md-4">
				<form role="form" method="POST" action="{{ route('user.register') }}">
					{{ csrf_field() }}
					@if (session('status'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('status') }}
						</div>
					@else
					<p>Vui lòng nhập thông tin bên dưới!</p>
					@endif
					<div class="form-group">
						<label for="first_name">Họ tên</label>
						<input type="text" class="form-control" id="first_name" name="User[first_name]" value="{{ old('User[first_name]') }}" placeholder="Họ tên" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="User[email]" value="{{ old('User[email]') }}" placeholder="Email" required>
					</div>
					<div class="form-group">
						<label for="mobile_phone">Số điện thoại</label>
						<input type="text" class="form-control" id="mobile_phone" name="User[mobile_phone]" value="{{ old('User[mobile_phone]') }}" placeholder="Số điện thoại">
					</div>
					<div class="form-group">
						<label for="password">Mật mã</label>
						<input type="password" class="form-control" id="password" name="User[password]" placeholder="Mật mã" required>
					</div>
					<div class="form-group">
						<label for="password_confirmation">Nhắc lại mật mã</label>
						<input type="password" class="form-control" id="password_confirmation" name="User[password_confirmation]" placeholder="Nhắc lại mật mã" required>
					</div>
					<div class="form-group">
						<label for="gender">Giới tính</label>
						<select id="gender" name="User[gender]" class="form-control">
							<option value="">Giới tính</option>
							<option value="0">Nữ</option>
							<option value="1">Nam</option>
						</select>
					</div>
					<div class="form-group">
						<label for="birthday">Ngày tháng năm sinh</label>
						<input type="text" class="form-control" id="birthday" name="User[birthday]" value="{{ old('User[birthday]') }}" placeholder="ngày/tháng/năm">
					</div>
					<div class="form-group">
						<label for="address">Địa chỉ</label>
						<input type="text" class="form-control" id="address" name="User[address]" value="{{ old('User[address]') }}" placeholder="Địa chỉ">
					</div>
					<button type="submit" class="btn btn-default btn-block text-uppercase">Đăng ký</button>
				</form>
			</div>
			<div class="col-sm-6 col-md-offset-2 col-md-4">
				<h2 class="text-uppercase">Bạn đã có tài khoản?</h2><br>
				<a href="{{ route('user.login') }}" class="btn btn-default btn-block text-uppercase" role="button">Đăng nhập</a>
			</div>
		</div>
	</div>
</section>
@endsection
@section('plugins.js')
@endsection

@section('customize.js')
@endsection