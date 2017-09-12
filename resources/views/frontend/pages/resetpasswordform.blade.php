@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<section id="user">
	<div class="container">
		<div class="user-tools">
			<h1 class="text-uppercase">Tạo mật mã mới</h1>
		</div>
		<div class="row">
			@include('frontend.partials.errors')

			<div class="col-md-4">
				<form role="form" method="POST" action="{{ url('/password/reset') }}">
					{{ csrf_field() }}
					<input type="hidden" name="token" value="{{ $token }}">
					@if(session('status'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('status') }}
						</div>
					@else
					<p>Vui lòng nhập thông tin bên dưới!</p>
					@endif
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
					</div>
					<div class="form-group">
						<label for="password">Mật mã</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Mật mã" required>
					</div>
					<div class="form-group">
						<label for="password_confirmation">Nhắc lại mật mã</label>
						<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Nhắc lại mật mã" required>
					</div>
					<button type="submit" class="btn btn-default btn-block text-uppercase">Xác nhận mật mã</button>
				</form>
			</div>
			<div class="col-md-offset-2 col-md-4">
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