@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')

<div class="row">
	@include('frontend.partials.errors')

	<div class="col-xs-12 col-sm-12 col-md-4 pull-right">
		<h1 class="article-title">Tạo mật mã mới</h1>
		@if(session('status'))
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ session('status') }}
		</div>
		@endif
		<form role="form" method="POST" action="{{ url('/password/reset') }}">
			{{ csrf_field() }}
			<input type="hidden" name="token" value="{{ $token }}">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email" required>
			</div>
			<div class="form-group">
				<label for="password">Mật mã</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật mã mới" required>
			</div>
			<div class="form-group">
				<label for="password_confirmation">Nhắc lại mật mã</label>
				<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhắc lại mật mã mới" required>
			</div>
			<button type="submit" class="btn btn-default btn-block">Xác nhận mật mã</button>
			<a href="{{ route('user.login') }}" class="btn btn-default btn-block" role="button">Đăng nhập</a>
			<br><br>
		</form>
	</div>
</div>
@endsection
@section('plugins.js')
@endsection

@section('customize.js')
@endsection