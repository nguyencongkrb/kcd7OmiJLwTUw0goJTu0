@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<section id="user">
	<div class="container">
		<div class="user-tools">
			<h1 class="text-uppercase">Thông tin tài khoản</h1>
		</div>
		<div class="row">
			@include('frontend.partials.errors')
			@if (session('status'))
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{ session('status') }}
				</div>
			@endif

			<div class="col-sm-6 col-md-4">
				<form role="form" method="POST" action="{{ route('user.updateprofile') }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="first_name">Họ tên</label>
						<input type="text" class="form-control" id="first_name" name="User[first_name]" value="{{ $user->first_name }}" placeholder="Họ tên" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="User[email]" value="{{ $user->email }}" placeholder="Email" required>
					</div>
					<div class="form-group">
						<label for="mobile_phone">Số điện thoại</label>
						<input type="text" class="form-control" id="mobile_phone" name="User[mobile_phone]" value="{{ $user->mobile_phone }}" placeholder="Số điện thoại">
					</div>
					<div class="form-group">
						<label for="gender">Giới tính</label>
						<select id="gender" name="User[gender]" class="form-control">
							<option value="" {{ is_null($user->gender) ? 'selected' : null }}>Giới tính</option>
							<option value="0" {{ $user->gender == 0 ? 'selected' : null }}>Nữ</option>
							<option value="1" {{ $user->gender == 1 ? 'selected' : null }}>Nam</option>
						</select>
					</div>
					<div class="form-group">
						<label for="birthday">Ngày tháng năm sinh</label>
						<input type="text" class="form-control" id="birthday" name="User[birthday]" value="{{ date_format(new DateTime($user->birthday), 'd/m/Y') }}" placeholder="ngày/tháng/năm">
					</div>
					<div class="form-group">
						<label for="address">Địa chỉ</label>
						<input type="text" class="form-control" id="address" name="User[address]" value="{{ $user->address }}" placeholder="Địa chỉ">
					</div>
					<button type="submit" class="btn btn-default btn-block text-uppercase">Cập nhật</button>
				</form>
			</div>
			<div class="col-sm-6 col-md-offset-2 col-md-4">
				<h2 class="text-uppercase">Cập nhật mật mã</h2><br>
				<form role="form" method="POST" action="{{ route('user.updatepassword') }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="currentpassword">Mật mã hiện tại</label>
						<input type="password" class="form-control" id="currentpassword" name="User[currentpassword]" placeholder="Mật mã hiện tại" required>
					</div>
					<div class="form-group">
						<label for="password">Mật mã mới</label>
						<input type="password" class="form-control" id="password" name="User[password]" placeholder="Mật mã" required>
					</div>
					<div class="form-group">
						<label for="password_confirmation">Nhắc lại mật mã mới</label>
						<input type="password" class="form-control" id="password_confirmation" name="User[password_confirmation]" placeholder="Nhắc lại mật mã" required>
					</div>
					<button type="submit" class="btn btn-default btn-block text-uppercase">Thay đổi mật mã</button>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection
@section('plugins.js')
@endsection

@section('customize.js')
@endsection