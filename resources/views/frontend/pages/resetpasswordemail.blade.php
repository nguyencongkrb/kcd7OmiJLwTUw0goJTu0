@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4 pull-right">
		<h1 class="article-title">Khôi phục mật mã</h1>
		@if (session('status'))
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ session('status') }}
		</div>
		@endif
		<form role="form" method="POST" action="{{ url('/password/email') }}">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn!" required>
				@if ($errors->has('email'))
				<span class="help-block">
					<strong>{{ $errors->first('email') }}</strong>
				</span>
				@endif
			</div>
			<button type="submit" class="btn btn-default btn-block">Yêu cầu khôi phục mật mã</button>
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