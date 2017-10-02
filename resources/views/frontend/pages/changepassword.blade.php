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
		<h1 class="article-title">Cập nhật mật mã</h1>
		<hr>
		<form role="form" class="form-horizontal" method="POST" action="{{ route('user.updatepassword') }}">
			{{ csrf_field() }}
			@include('frontend.partials.errors')
			@if (session('status'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ session('status') }}
			</div>
			@endif
			<div class="form-group {{ $errors->has('User[currentpassword]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Mật khẩu hiện tại</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="currentpassword" name="User[currentpassword]" placeholder="Mật khẩu hiện tại" required>
					@if ($errors->has('User[currentpassword]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[currentpassword]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('User[password]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Mật khẩu mới</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password" name="User[password]" placeholder="Mật khẩu" required>
					@if ($errors->has('User[password]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[password]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('User[password_confirmation]') ? 'has-error' : '' }}">
				<label class="col-sm-3 control-label">Nhắc lại mật khẩu mới</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password_confirmation" name="User[password_confirmation]" placeholder="Nhắc lại mật mã" required>
					@if ($errors->has('User[password_confirmation]'))
					<span class="help-block">
						<strong>{{ $errors->first('User[password_confirmation]') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-9 col-sm-offset-3">
					<button type="submit" class="btn btn-default btn-block">Thay đổi mật khẩu</button>
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