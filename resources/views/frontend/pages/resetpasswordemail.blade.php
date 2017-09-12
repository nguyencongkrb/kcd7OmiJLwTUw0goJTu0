@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<section id="user">
	<div class="container">
		<div class="user-tools">
			<h1 class="text-uppercase">Khôi phục mật mã</h1>
		</div>
		<div class="row">
			<div class="col-md-4">
				<form role="form" method="POST" action="{{ url('/password/email') }}">
					{{ csrf_field() }}
					@if (session('status'))
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							{{ session('status') }}
						</div>
					@else
					<p>Nhập email của bạn!</p>
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

					<button type="submit" class="btn btn-default btn-block text-uppercase">Yêu cầu khôi phục mật mã</button>
				</form>
			</div>
			<div class="col-md-offset-2 col-md-4">
				<h2 class="text-uppercase">Đăng nhập</h2><br>
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