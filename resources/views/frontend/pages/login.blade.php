@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<section id="user">
	<div class="container">
		<div class="user-tools">
			<h1 class="text-uppercase">Đăng nhập</h1>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<form role="form" method="POST" action="{{ url('/login') }}">
					{{ csrf_field() }}
					@if (session('status'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('status') }}
						</div>
					@else
					<p>Vui lòng nhập tài khoản của bạn!</p>
					@endif
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
						@if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password">Mật mã</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Mật mã" required>
						@if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
					</div>
					<a href="{{ route('user.resetpassword') }}">Quên mật khẩu</a><br>
					<br>
					<button type="submit" class="btn btn-default btn-block text-uppercase">Đăng nhập</button>
				</form>
			</div>
			<div class="col-sm-6 col-md-offset-2 col-md-4">
				<h2 class="text-uppercase">Tạo tài khoản</h2><br>
				<a href="{{ route('user.register') }}" class="btn btn-default btn-block text-uppercase" role="button">Đăng ký</a>
			</div>
		</div>
	</div>
</section>
@endsection
@section('plugins.js')
@endsection

@section('customize.js')
@endsection