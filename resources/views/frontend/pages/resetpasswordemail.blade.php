@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')

<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-8">
	<form id="frmResetPassword" class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
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
			<input type="text" class="form-control" id="email" name="email" placeholder="Nhập email hoặc số điện thoại của bạn!" required>
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
<script type="text/javascript">
	$(document).ready(function (argument) {
		$("#frmResetPassword").validate({
			lang: 'vi',
			errorClass: 'text-danger',
			rules: {
				'email': {
					regex: /(^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$)|(^(01[2689]|09)[0-9]{8}$)/
				}
			},
			messages: {
				'email': {
					regex: 'Vui lòng nhập email hoặc số điện thoại đúng định đạng.'
				}
			},
			submitHandler: function(form) {
				if(/^(01[2689]|09)[0-9]{8}$/.test($('#email').val())){
					$(form).attr('action', '/tao-mat-mat-moi-qua-dien-thoai');
				}
				$('#frmResetPassword')[0].submit();
			}
		});
	});
</script>
@endsection