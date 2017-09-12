@inject('config', 'App\Config')
@extends('frontend.layouts.master')

@section('customize.js.head')
@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<!-- Breadcrumb Start-->
<ul class="breadcrumb">
	<li><a href="/"><i class="fa fa-home"></i></a></li>
	<li><a href="{{ route('contact') }}">Liên hệ</a></li>
</ul>
<!-- Breadcrumb End-->
<div class="row">
	<!--Middle Part Start-->
	<div id="content" class="col-sm-9">
		<h1 class="title">Liên hệ với Chúng tôi</h1>
		<h3 class="subtitle">Vị trí</h3>
		<div class="row">
			<div class="col-sm-4">
				<div class="contact-info">
					<div class="contact-info-icon"><i class="fa fa-map-marker"></i></div>
					<div class="contact-detail">
						<h4>{{ $config->getValueByKey('site_name') }}</h4>
						<address>
							{{ $config->getValueByKey('headquarter_address_street') }},
							{{ $config->getValueByKey('headquarter_address_ward') }},<br />
							{{ $config->getValueByKey('headquarter_address_district') }},
							{{ $config->getValueByKey('headquarter_address_locality') }}
						</address>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="contact-info">
					<div class="contact-info-icon"><i class="fa fa-phone"></i></div>
					<div class="contact-detail">
						<h4>Điện thoại</h4>
						Phone: {{ $config->getValueByKey('headquarter_phone_number') }}<br>
						Fax: {{ $config->getValueByKey('headquarter_fax_number') }} </div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="contact-info">
						<div class="contact-info-icon"><i class="fa fa-clock-o"></i></div>
						<div class="contact-detail">
							<h4>Giờ làm việc</h4>
							{{ $config->getValueByKey('opening_hours') }} </div>
						</div>
					</div>
				</div>
				<form class="form-horizontal">
					<fieldset>
						<h3 class="subtitle">Gửi liên hệ</h3>
						<div class="form-group required">
							<label class="col-md-2 col-sm-3 control-label" for="input-name">Họ tên</label>
							<div class="col-md-10 col-sm-9">
								<input type="text" name="name" value="" id="input-name" class="form-control" />
							</div>
						</div>
						<div class="form-group required">
							<label class="col-md-2 col-sm-3 control-label" for="input-email">Email</label>
							<div class="col-md-10 col-sm-9">
								<input type="text" name="email" value="" id="input-email" class="form-control" />
							</div>
						</div>
						<div class="form-group required">
							<label class="col-md-2 col-sm-3 control-label" for="input-enquiry">Nội dung</label>
							<div class="col-md-10 col-sm-9">
								<textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"></textarea>
							</div>
						</div>
					</fieldset>
					<div class="buttons">
						<div class="pull-right">
							<input class="btn btn-primary" type="button" id="btnSendContact" value="Gửi liên hệ" />
						</div>
					</div>
				</form>
			</div>

			@include('frontend.partials.productsidebar')

			<!--Middle Part End -->
		</div>
		@endsection

		@section('plugins.js')
		@endsection

		@section('customize.js')
		@endsection