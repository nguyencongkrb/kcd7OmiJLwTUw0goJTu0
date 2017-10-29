@inject('config', 'App\Config')
@extends('backend.layouts.master')

@section('title', 'Đơn hàng '.$cart->code)

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		<span>Đơn hàng {{ $cart->code }}</span>&nbsp;
		<!-- <small>Optional description</small> -->
		<button type="button" class="btn btn-sm btn-success btn-flat hide" data-toggle="modal" data-target="#modalEntry">Đơn hàng mới</button>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li><a href="{{ route('shoppingcarts.index') }}">Đơn hàng</a></li>
		<li class="active">{{ $cart->code }}</li>
	</ol>
</section>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-4">
		<img src="/frontend/images/logo_asgroup.png" alt="{{ $config::getValueByKey('site_name') }}" style="height: 40px;">
	</div>
	<div class="col-xs-4">
		<h2 class="page-header text-center">
			Phiếu Giao Hàng
		</h2>
	</div>
	<div class="col-xs-4 text-right">
		<small>
			<strong>{{ preg_replace('/^https?:\/\//', '', url('/')) }}</strong><br>
			Hotline: {{ $config::getValueByKey('hot_line') }}
		</small>
	</div>
</div>
<div class="row invoice-info">
	<div class="col-xs-7">
		@if($cart->shipping_address_same_order)
		<strong>Họ Tên KH</strong>: {{ $cart->customer_name }}<br>
		<strong>Điện thoại</strong>: {{ $cart->customer_phone }}<br>
		<strong>ĐC giao hàng</strong>: {{ $cart->customer_address }}<br>
		<strong>Quận/Thành phố</strong>: {{ $cart->customerDistrict->name }}, {{ $cart->customerProvince->name }}<br>
		@else
		<strong>Họ Tên KH</strong>: {{ $cart->shipping_name }}<br>
		<strong>Điện thoại</strong>: {{ $cart->shipping_phone }}<br>
		<strong>ĐC giao hàng</strong>: {{ $cart->shipping_address }}<br>
		<strong>Quận/Thành phố</strong>: {{ $cart->shippingDistrict->name }}, {{ $cart->shippingProvince->name }}<br>
		@endif
		<strong>PT giao hàng:</strong> {{ $cart->delivery_method_id ? 'Giao hàng nhanh' : 'Giao hàng tiêu chuẩn' }}
	</div>
	<div class="col-xs-5">
		<b>Mã đơn hàng:</b> {{ $cart->code }}<br>
		<b>Ngày đặt:</b> {{ $cart->created_at->format('d/m/Y') }}<br>
		<b>PT thanh toán:</b> {{ $cart->paymentMethod->name }}<br>
		<b>Xuất hoá đơn:</b> {{ $cart->invoice_export ? 'Có' : 'Không' }}
	</div>
</div>
<div class="row">
	<div class="col-xs-12 table-responsive">
		<table class="table table-condensed table-hover table-bordered table-striped">
			<tr>
				<th class="text-right">STT</th>
				<th>Tên nhãn hiệu hàng hóa</th>
				<th>Mã hàng</th>
				<th class="text-right">Số lượng</th>
				<th class="text-right">Đơn giá</th>
				<th class="text-right">Thành tiền</th>
			</tr>
			@foreach($cart->cartDetails as $item)
			<tr>
				<td class="text-right">{{ $loop->iteration }}</td>
				<td><a href="{{ $item->product->getLink() }}">{{ $item->product->name }}</a></td>
				<td>{{ $item->product->code }}</td>
				<td class="text-right">{{ number_format($item->quantity, 0, ',', '.') }}</td>
				<td class="text-right">{{ number_format($item->product_price, 0, ',', '.') }}</td>
				<td class="text-right">{{ number_format(($item->product_price * $item->quantity), 0, ',', '.') }}</td>
			</tr>
			@endforeach
			<tr>
				<td colspan="4" rowspan="4">
					<p><strong>Chú ý:</strong></p>
					@if(!empty($cart->delivery_note))
					{{ $cart->delivery_note }}
					@endif
				</td>
				<td class="text-right">Chiết khấu</td>
				<td class="text-right">- {{ number_format(0, 0, ',', '.') }}</td>
			</tr>
			<tr>
				<td class="text-right">Mã thưởng</td>
				<td class="text-right">- {{ number_format($cart->getTotalPromotionAmount(), 0, ',', '.') }}</td>
			</tr>
			<tr>
				<td class="text-right">Phí vận chuyển</td>
				<td class="text-right">{{ number_format($cart->shipping_fee, 0, ',', '.') }}</td>
			</tr>
			<tr>
				<td class="text-right"><strong>Tổng cộng</strong></td>
				<td class="text-right"><strong>{{ number_format($cart->getTotalPaymentAmount(), 0, ',', '.') }}</strong></td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<small>
			Vui lòng phản hồi về số lượng và chất lượng hàng hóa trong 05 ngày (nếu có), quá 05 ngày ASGroup không chiu trách nhiệm!
		</small>
	</div>
</div>

<div class="row text-center">
	<div class="col-xs-2">
		<div class="row">
			Người lập phiếu
		</div>
	</div>
	<div class="col-xs-2">
		<div class="row">
			<small>Người Giao Nhận<br>(Ghi rõ họ tên)</small>
		</div>
	</div>
	<div class="col-xs-2">
		<div class="row">
			<small>Người nhận tiền<br>(Ghi rõ họ tên)</small>
		</div>
	</div>
	<div class="col-xs-2">
		<div class="row">
			<small>Cty Vận Chuyển<br>(Ghi rõ họ tên)</small>
		</div>
	</div>
	<div class="col-xs-2">
		<div class="row">
			<small>Kế toán<br>(Ghi rõ họ tên)</small>
		</div>
	</div>
	<div class="col-xs-2">
		<div class="row">
			<small>Người nhận hàng<br>(Ghi rõ họ tên)</small>
		</div>
	</div>
</div>
<div class="row no-print">
	<div class="col-xs-12">
		<br>
		<button type="button" onclick="window.print();" class="btn btn-success btn-flat pull-right"><i class="fa fa-print"></i> In đơn hàng
		</button>
	</div>
</div>

@endsection

@section('plugins.js')

@endsection

@section('javascript.customize')
<script type="text/javascript">
	$(document).ready(function (argument) {
		$('.content').addClass('invoice');
	});
</script>
@endsection