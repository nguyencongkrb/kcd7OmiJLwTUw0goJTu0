@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-6">
	<form class="form-horizontal" id="frmRegister" method="POST" action="{{ route('user.register') }}">
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
		<div class="form-group {{ $errors->has('User[username]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Tên đăng nhập <em class="text-danger">*</em></label>
			<div class="col-sm-8">
				<div class="row">
					<input type="text" class="form-control" id="username" name="User[username]" value="{{ old('User.username') }}" placeholder="Tên đăng nhập" data-toggle="tooltip" data-placement="top" title="Vui lòng đặt tên tài khoản gồm số và ký tự, không có khoảng trắng và không có dấu" maxlength="50" required>
					@if ($errors->has('User[username]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[username]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[password]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Mật khẩu <em class="text-danger">*</em></label>
			<div class="col-sm-8">
				<div class="row">
					<input type="password" class="form-control" id="User[password]" name="User[password]" placeholder="Mật khẩu" data-toggle="tooltip" data-placement="top" title="Mật khẩu tối thiểu 6 ký tự, bao gồm ký tự đặc biệt & không khoảng trắng" required>
					@if ($errors->has('User[password]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[password]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[password_confirmation]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Nhắc lại mật khẩu <em class="text-danger">*</em></label>
			<div class="col-sm-8">
				<div class="row">
					<input type="password" class="form-control" id="User[password_confirmation]" name="User[password_confirmation]" placeholder="Nhắc lại mật khẩu" required>
					@if ($errors->has('User[password_confirmation]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[password_confirmation]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[first_name]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Họ tên <em class="text-danger">*</em></label>
			<div class="col-sm-8">
				<div class="row">
					<input type="text" class="form-control" id="first_name" name="User[first_name]" value="{{ old('User.first_name') }}" placeholder="Họ tên" required>
					@if ($errors->has('User[first_name]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[first_name]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[mobile_phone]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Số điện thoại <em class="text-danger">*</em></label>
			<div class="col-sm-8">
				<div class="row">
					<input type="text" class="form-control" id="User[mobile_phone]" name="User[mobile_phone]" value="{{ old('User.mobile_phone') }}" placeholder="Số điện thoại" required>
					@if ($errors->has('User[mobile_phone]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[mobile_phone]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[email]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="email" class="form-control" id="User[email]" name="User[email]" value="{{ old('User.email') }}" placeholder="Email">
					@if ($errors->has('User[email]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[email]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('User[address]') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Địa chỉ <em class="text-danger">*</em></label>
			<div class="col-sm-8">
				<div class="row">
					<input type="text" class="form-control" id="address" name="User[address]" value="{{ old('User.address') }}" placeholder="Địa chỉ" required>
					@if ($errors->has('User[address]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[address]') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ ($errors->has('User[province_id]') || $errors->has('User[district_id]')) ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Tỉnh / Huyện <em class="text-danger">*</em></label>
			<div class="col-sm-8">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<select class="form-control province" name="User[province_id]" sub-control="register_district" required>
								<option value="">Tỉnh/Thành phố</option>
								@foreach($provinces as $province)
								<option value="{{ $province->id }}">{{ $province->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-md-6 pull-right">
						<div class="row">
							<select class="form-control" name="User[district_id]" id="register_district" required>
								<option value="">Quận/Huyện</option>
							</select>
						</div>
					</div>
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
<script type="text/javascript">
	$(document).ready(function (argument) {
		$("#frmRegister").validate({
			lang: 'vi',
			errorClass: 'text-danger',
			rules: {
				'User[username]': {
					regex: /^[a-zA-Z0-9_-]+$/,
					remote: {
						url: "/kiem-tra-nguoi-dung.html",
						type: "post"
					}
				},
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
				'User[password]': {
					regex: /\S{6,60}/
				},
				// 'User[password_confirmation]': {
				// 	equalTo: '#User[password]'
				// },
				'User[birthday]': {
					regex: /^\d{2}?\/\d{2}?\/\d{4}$/
				}
			},
			messages: {
				'User[username]': {
					required: 'Vui lòng nhập tên đăng nhập của bạn.'
				},
				'User[first_name]': {
					required: 'Vui lòng nhập họ tên của bạn.',
					regex: 'Họ tên chỉ được phép chứa các ký tự a-z, A-Z và khoảng trắng.'
				},
				'User[email]': {
					required: 'Vui lòng nhập email đăng ký tài khoản.',
					email: "Vui lòng nhập đúng định dạng email."
				},
				'User[mobile_phone]': {
					regex: 'Vui lòng nhập số điện thoại đúng định đạng.'
				},
				'User[password]': {
					required: 'Vui lòng nhập mật khẩu.',
					regex: 'Vui lòng mật khẩu theo định dạng đã gợi ý.'
				},
				'User[password_confirmation]': {
					required: 'Vui lòng xác nhận lại mật khẩu.',
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