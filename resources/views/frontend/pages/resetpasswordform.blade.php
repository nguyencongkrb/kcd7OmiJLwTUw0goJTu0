@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-6">
	<form class="form-horizontal" method="POST" action="{{ url('/password/reset') }}">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-4">
				<div class="row">
					<h1 class="article-title">Tạo mật mã mới</h1>
				</div>
			</div>
		</div>
		{{ csrf_field() }}
		<input type="hidden" name="token" value="{{ $token }}">
		<div class="row">
			@if(session('status'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ session('status') }}
			</div>
			@endif
			@include('frontend.partials.errors')
		</div>
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Mật khẩu</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" required>
					@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
			<label class="col-sm-4 control-label">Nhắc lại mật khẩu</label>
			<div class="col-sm-8">
				<div class="row">
					<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhắc lại mật khẩu" required>
					@if ($errors->has('password_confirmation'))
					<span class="help-block">
						<strong>{{ $errors->first('password_confirmation') }}</strong>
					</span>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<div class="row">
					<button type="submit" class="btn btn-default btn-block pb-10">Xác nhận mật mã</button>
				</div>
			</div>
		</div>
		<div class="row">
				<div class="text-right form-link">
					<a href="{{ route('user.login') }}">Đăng nhập</a><br>
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