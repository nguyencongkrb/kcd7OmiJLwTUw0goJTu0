@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="row">
	<div class="col-md-3">
		@include('frontend.partials.sidebar')
	</div>
	<div class="col-md-9">
		<h1 class="article-title">Thông tin tài khoản</h1>
		<hr>
		<form role="form" class="form-horizontal" method="POST" action="{{ route('user.updateprofile') }}">
			{{ csrf_field() }}
			@include('frontend.partials.errors')
			@if (session('status'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ session('status') }}
			</div>
			@endif
			<div class="form-group {{ $errors->has('User[first_name]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Họ tên</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="first_name" name="User[first_name]" value="{{ $user->first_name }}" placeholder="Họ tên" required>
					@if ($errors->has('User[first_name]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[first_name]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('User[email]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Email</label>
				<div class="col-sm-9">
					<input type="email" class="form-control" id="email" name="User[email]" value="{{ $user->email }}" placeholder="Email" required>
					@if ($errors->has('User[email]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[email]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('User[mobile_phone]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Số điện thoại</label>
				<div class="col-sm-9">
					<input type="number" class="form-control" id="mobile_phone" name="User[mobile_phone]" value="{{ $user->mobile_phone }}" placeholder="Số điện thoại">
					@if ($errors->has('User[mobile_phone]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[mobile_phone]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('User[gender]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Giới tính</label>
				<div class="col-sm-9">
					<select id="gender" name="User[gender]" class="form-control">
						<option value="" {{ is_null($user->gender) ? 'selected' : null }}>Giới tính</option>
						<option value="0" {{ $user->gender == 0 ? 'selected' : null }}>Nữ</option>
						<option value="1" {{ $user->gender == 1 ? 'selected' : null }}>Nam</option>
					</select>
					@if ($errors->has('User[gender]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[gender]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('User[birthday]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Ngày tháng năm sinh</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="birthday" name="User[birthday]" value="{{ date_format(new DateTime($user->birthday), 'd/m/Y') }}" placeholder="ngày/tháng/năm">
					@if ($errors->has('User[birthday]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[birthday]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('User[address]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Địa chỉ</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="address" name="User[address]" value="{{ $user->address }}" placeholder="Địa chỉ">
					@if ($errors->has('User[address]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[address]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3">
					<button type="submit" class="btn btn-default btn-block">Cập nhật</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
@section('plugins.js')
@endsection

@section('customize.js')
@endsection