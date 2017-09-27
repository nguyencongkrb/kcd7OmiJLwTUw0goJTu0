@extends('frontend.layouts.master')
@inject('config', 'App\Config')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<ul class="list-inline checkout-step">
	<li><span>1</span>Giỏ hàng</li>
	<li><span>2</span>Thanh toán</li>
	<li><span>3</span>Xác nhận</li>
	<li class="active"><span>4</span>Hoàn tất</li>
</ul>
<br><br><br>
<p class="text-center" style="font-size: 18px;">Xin cảm ơn bạn đã đặt hàng tại sunmart-online.com</p>
<br>
<p class="text-center" style="font-size: 18px;">Đơn hàng của bạn có mã số là: <strong class="text-nowrap">
	@if (session('status'))
		{{ session('status') }}
	@endif
</strong><br>
Chi tiết đơn hàng của bạn sẽ được gửi về email hoặc số điện thoại của bạn.<br> Tổng đài CSKH <a href="tel:{{ $config->getValueByKey('hot_line') }}"><strong>{{ $config->getValueByKey('hot_line') }}</strong></a> sẽ gọi cho bạn trong vòng 24h để xác nhận trước khi giao hàng.</p>
<br>
<p class="text-center" style="font-size: 18px;">Xin chào và hẹn gặp lại!</p>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection