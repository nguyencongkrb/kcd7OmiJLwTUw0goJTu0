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
	<div class="col-xs-6">
		<h2 class="page-header">
			Phiếu Giao Hàng
		</h2>
	</div>
	<div class="col-xs-4 text-right">
		<div>
			<img src="/frontend/images/logo_asgroup.png" alt="{{ $sitename = $config::getValueByKey('site_name') }}" style="height: 40px;">
		</div>
	</div>
	<div class="col-xs-2 text-right">
		<small>
			<strong>{{ $sitename }}</strong><br>
			Hotline: {{ $config::getValueByKey('hot_line') }}
		</small>
	</div>
</div>
<div class="row invoice-info">
	<div class="col-sm-4 invoice-col">
		Người đặt hàng
		<address>
			<strong>{{ $cart->customer_name }}</strong><br>
			{{ $cart->customer_address }}<br>
			{{ $cart->customerDistrict->name }}, {{ $cart->customerProvince->name }}<br>
			Điện thoại: {{ $cart->customer_phone }}<br>
			Email: {{ $cart->customer_email }}
		</address>
	</div>
	<div class="col-sm-4 invoice-col">
		Người nhận
		<address>
			@if($cart->shipping_address_same_order)
			<br>
			Giống thông tin mua hàng
			@else
			<strong>{{ $cart->shipping_name }}</strong><br>
			{{ $cart->shipping_address }}<br>
			{{ $cart->shippingDistrict->name }}, {{ $cart->shippingProvince->name }}<br>
			Điện thoại: {{ $cart->shipping_phone }}<br>
			Email: {{ $cart->shipping_email }}
			@endif
		</address>
	</div>
	<div class="col-sm-4 invoice-col">
		<b>Mã đơn hàng:</b> {{ $cart->code }}<br>
		<br>
		<b>Ngày đặt:</b> {{ $cart->created_at->format('d/m/Y') }}<br>
		<b>PT thanh toán:</b> {{ $cart->paymentMethod->name }}<br>
		<b>Xuất hoá đơn:</b> {{ $cart->invoice_export ? 'Có' : 'Không' }}<br>
		<b>PT giao hàng:</b> {{ $cart->delivery_method_id ? 'Giao hàng nhanh' : 'Giao hàng tiêu chuẩn' }}
	</div>
</div>
<div class="row">
	<div class="col-xs-12 table-responsive">
		<table class="table table-condensed table-hover table-bordered table-striped">
			<tr>
				<th class="text-center">#</th>
				<th>Tên sản phẩm</th>
				<th class="text-right">Số lượng</th>
				<th class="text-right">Đơn giá</th>
				<th class="text-right">Thành tiền</th>
			</tr>
			@foreach($cart->cartDetails as $item)
			<tr>
				<td class="text-right">{{ $loop->iteration }}</td>
				<td><a href="{{ $item->product->getLink() }}">{{ $item->product->name }}</a></td>
				<td class="text-right">{{ number_format($item->quantity, 0, ',', '.') }}</td>
				<td class="text-right">{{ number_format($item->product_price, 0, ',', '.') }} <small>VNĐ</small></td>
				<td class="text-right">{{ number_format(($item->product_price * $item->quantity), 0, ',', '.') }} <small>VNĐ</small></td>
			</tr>
			@endforeach
			<tr>
				<td colspan="4" class="text-right">Chiết khấu</td>
				<td class="text-right">- {{ number_format(0, 0, ',', '.') }} <small>VNĐ</small></td>
			</tr>
			<tr>
				<td colspan="4" class="text-right">Mã thưởng</td>
				<td class="text-right">- {{ number_format($cart->getTotalPromotionAmount(), 0, ',', '.') }} <small>VNĐ</small></td>
			</tr>
			<tr>
				<td colspan="4" class="text-right">Phí vận chuyển</td>
				<td class="text-right">{{ number_format($cart->shipping_fee, 0, ',', '.') }} <small>VNĐ</small></td>
			</tr>
			<tr>
				<td colspan="4" class="text-right"><strong>Tổng cộng</strong></td>
				<td class="text-right"><strong>{{ number_format($cart->getTotalPaymentAmount(), 0, ',', '.') }} <small>VNĐ</small></strong></td>
			</tr>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-xs-6">
		<p class="lead">Ghi chú:</p>
		@if(!empty($cart->delivery_note))
		<p class="text-muted well well-sm no-shadow">
			{{ $cart->delivery_note }}
		</p>
		@endif
	</div>
	<div class="col-xs-6">
		<p class="lead">Lưu ý</p>
		<small>
			Vui lòng phản hồi về số lượng và chất lượng hàng hóa trong 05 ngày (nếu có), quá 05 ngày ASGroup không chiu trách nhiệm!
		</small>
	</div>
</div>

<div class="row text-center">
	<br>
	<div class="col-xs-2">
		Người lập phiếu
	</div>
	<div class="col-xs-2">
		Người Giao Nhận<br><small>(Ghi rõ họ tên)</small>
	</div>
	<div class="col-xs-2">
		Người nhận tiền<br><small>(Ghi rõ họ tên)</small>
	</div>
	<div class="col-xs-2">
		Cty Vận Chuyển<br><small>(Ghi rõ họ tên)</small>
	</div>
	<div class="col-xs-2">
		Kế toán<br><small>(Ghi rõ họ tên)</small>
	</div>
	<div class="col-xs-2">
		Người nhận hàng<br><small>(Ghi rõ họ tên)</small>
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