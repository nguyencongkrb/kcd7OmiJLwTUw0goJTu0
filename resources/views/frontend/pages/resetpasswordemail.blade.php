@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')

<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-8">
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<h1 class="article-title">Khôi phục mật khẩu</h1>
				</div>
			</div>
		</div>
		{{ csrf_field() }}
		@if(session('status'))
		<div class="row alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ session('status') }}
		</div>
		@endif
		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn!" required>
			@if ($errors->has('email'))
			<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
			@endif
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<div class="row">
					<button type="submit" class="btn btn-default btn-block">Yêu cầu khôi phục mật khẩu</button>
					<span class="pull-right pt-10">
						<a href="{{ route('user.login') }}">Đăng nhập</a>
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
@endsection