@inject('config', 'App\Config')
@extends('frontend.layouts.master')

@section('customize.js.head')
@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="row">
	<div class="col-md-4 col-md-offset-1">
		<h1 class="article-title">Thông tin liên hệ</h1>
		<p class="lead">
			<span class="glyphicon glyphicon-map-marker"></span> 
			{{ $config->getValueByKey('headquarter_address_street') }},
			{{ $config->getValueByKey('headquarter_address_ward') }},<br>
			&nbsp;&nbsp;&nbsp;&nbsp;{{ $config->getValueByKey('headquarter_address_district') }},
			{{ $config->getValueByKey('headquarter_address_locality') }}
			<br>
			<span class="glyphicon glyphicon-earphone"></span>
			<a href="tel:{{ $config->getValueByKey('hot_line') }}">{{ $config->getValueByKey('hot_line') }}</a>
			<br>
			<span class="glyphicon glyphicon-envelope"></span> 
			<a href="mailto:{{ $config->getValueByKey('address_received_mail') }}">{{ $config->getValueByKey('address_received_mail') }}</a>
			<br>
			<span class="glyphicon glyphicon-calendar"></span>
			{{ $config->getValueByKey('opening_hours') }}
		</p>
	</div>
	<div class="col-md-6">
		<h1 class="article-title">Gửi liên hệ</h1>
		@if(session('status'))
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ session('status') }}
		</div>
		@endif
		<form class="form-horizontal" method="POST" action="{{ route('contact.create') }}">
		 {{ csrf_field() }}
			<div class="form-group">
				<label class="col-md-3 col-sm-3 control-label">Chủ đề</label>
				<div class="col-md-9 col-sm-9">
					<input type="text" name="Contact[subject]" class="form-control" required >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 col-sm-3 control-label">Họ &amp; tên</label>
				<div class="col-md-9 col-sm-9">
					<input type="text" name="Contact[full_name]" class="form-control" required >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 col-sm-3 control-label">Email</label>
				<div class="col-md-9 col-sm-9">
					<input type="email" name="Contact[email]" class="form-control" required >
				</div>
				
			</div>
			<div class="form-group">
				<label class="col-md-3 col-sm-3 control-label">Điện thoại</label>
				<div class="col-md-9 col-sm-9">
					<input type="text" name="Contact[phone]" class="form-control" required >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 col-sm-3 control-label">Nội dung</label>
				<div class="col-md-9 col-sm-9">
					<textarea name="Contact[content]" rows="5" class="form-control" required></textarea>
				</div>
			</div>
			<div class="form-group">
			<div class="col-md-12">
					<button type="submit" class="btn btn-default pull-right">Gửi liên hệ</button>
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