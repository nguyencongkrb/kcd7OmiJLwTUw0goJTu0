@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-6">
	<form class="form-horizontal" method="POST" action="{{ route('user.register') }}">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-4">
				<div class="row">
					<h1 class="article-title">Tạo tài khoản</h1>
				</div>
			</div>
		</div>
		{{ csrf_field() }}
		<div class="row">
			@if(session('status'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ session('status') }}
			</div>
			@endif
			@include('frontend.partials.errors')
		</div>
		<div class="form-group {{ $errors->has('User[first_name]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Họ tên</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="text" class="form-control" id="first_name" name="User[first_name]" value="{{ old('User[first_name]') }}" placeholder="Họ tên" required>
					@if ($errors->has('User[first_name]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[first_name]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[email]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="email" class="form-control" id="email" name="User[email]" value="{{ old('User[email]') }}" placeholder="Email" required>
					@if ($errors->has('User[email]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[email]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[mobile_phone]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Số điện thoại</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="number" class="form-control" id="mobile_phone" name="User[mobile_phone]" value="{{ old('User[mobile_phone]') }}" placeholder="Số điện thoại">
					@if ($errors->has('User[mobile_phone]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[mobile_phone]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[password]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Mật khẩu</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="password" class="form-control" id="password" name="User[password]" placeholder="Mật khẩu" data-toggle="tooltip" data-placement="top" title="Mật khẩu tối thiểu 6 ký tự, bao gồm ký tự đặc biệt & không khoảng trắng" required>
					@if ($errors->has('User[password]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[password]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[password_confirmation]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Nhắc lại mật khẩu</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="password" class="form-control" id="password_confirmation" name="User[password_confirmation]" placeholder="Nhắc lại mật khẩu" required>
					@if ($errors->has('User[password_confirmation]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[password_confirmation]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[gender]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Giới tính</label>
			<div class="col-sm-8">
				<div class="row">
					<select id="gender" name="User[gender]" class="form-control">
						<option value="">Giới tính</option>
						<option value="0">Nữ</option>
						<option value="1">Nam</option>
					</select>
					@if ($errors->has('User[gender]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[gender]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[birthday]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Ngày sinh</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="text" class="form-control" id="birthday" name="User[birthday]" value="{{ old('User[birthday]') }}" placeholder="ngày/tháng/năm">
					@if ($errors->has('User[birthday]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[birthday]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[address]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Địa chỉ</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="text" class="form-control" id="address" name="User[address]" value="{{ old('User[address]') }}" placeholder="Địa chỉ">
					@if ($errors->has('User[address]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[address]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<div class="row text-center">
					<button type="submit" class="btn btn-default btn-block pb-10">Đăng ký</button>
					<span class="pt-10">
						Bạn đã có tài khoản? <a href="{{ route('user.login') }}">Đăng nhập</a>
					</span>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
@section('plugins.js')
@endsection

@section('customize.js')
@endsection