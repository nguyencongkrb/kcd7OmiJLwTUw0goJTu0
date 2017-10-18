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
		<form role="form" id="frmProfile" class="form-horizontal" method="POST" action="{{ route('user.updateprofile') }}">
			{{ csrf_field() }}
			@include('frontend.partials.errors')
			@if (session('status'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ session('status') }}
			</div>
			@endif
			<div class="form-group {{ $errors->has('User[username]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Tên đăng nhập <em class="text-danger">*</em></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="username" name="User[username]" value="{{ $user->username }}" placeholder="Họ tên" readonly required>
					@if ($errors->has('User[username]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[username]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('User[first_name]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Họ tên <em class="text-danger">*</em></label>
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
					<input type="email" class="form-control" id="email" name="User[email]" value="{{ $user->email }}" placeholder="Email">
					@if ($errors->has('User[email]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[email]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('User[mobile_phone]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Số điện thoại <em class="text-danger">*</em></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="mobile_phone" name="User[mobile_phone]" value="{{ $user->mobile_phone }}" placeholder="Số điện thoại" required>
					@if ($errors->has('User[mobile_phone]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[mobile_phone]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('User[address]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Địa chỉ <em class="text-danger">*</em></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="address" name="User[address]" value="{{ $user->address }}" placeholder="Địa chỉ" required>
					@if ($errors->has('User[address]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[address]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ ($errors->has('User[province_id]') || $errors->has('User[district_id]')) ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Tỉnh / Huyện <em class="text-danger">*</em></label>
				<div class="col-sm-9">
					<div class="col-md-5">
						<div class="row">
							<select class="form-control province" name="User[province_id]" sub-control="profile_district" required>
								<option value="">Tỉnh/Thành phố</option>
								@foreach($provinces as $province)
								<option value="{{ $province->id }}" {{ $user->province_id == $province->id ? 'selected' : null }}>{{ $province->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-md-5 pull-right">
						<div class="row">
							<select class="form-control" name="User[district_id]" id="profile_district" required>
								<option value="">Quận/Huyện</option>
								@foreach($districts as $district)
								<option value="{{ $district->id }}" {{ $user->district_id == $district->id ? 'selected' : null }}>{{ $district->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
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
<script type="text/javascript">
	$(document).ready(function (argument) {
		$("#frmProfile").validate({
			lang: 'vi',
			errorClass: 'text-danger',
			rules: {
				'User[first_name]': {
					regex: /^[a-zA-Z ]+$/
				},
				'User[email]': {
					remote: {
						url: "/kiem-tra-nguoi-dung.html",
						type: "post"
					}
				},
				'User[mobile_phone]': {
					regex: /^(01[2689]|09)[0-9]{8}$/
				},
				'User[birthday]': {
					regex: /^\d{2}?\/\d{2}?\/\d{4}$/
				}
			},
			messages: {
				'User[first_name]': {
					required: 'Vui lòng nhập họ tên của bạn.',
					regex: 'Họ tên chỉ được phép chức các ký tự a-z, A-Z và khoảng trắng.'
				},
				'User[email]': {
					required: 'Vui lòng nhập email.',
					email: "Vui lòng nhập đúng định dạng email."
				},
				'User[mobile_phone]': {
					regex: 'Vui lòng nhập số điện thoại đúng định đạng.'
				},
				'User[birthday]': {
					regex: 'Vui lòng nhập ngày sinh theo định dạng dd/mm/yyyy.'
				},
				'User[address]': {
					regex: 'Vui lòng nhập đầy đủ địa chỉ.'
				}
			}
		});
	});
</script>
@endsection