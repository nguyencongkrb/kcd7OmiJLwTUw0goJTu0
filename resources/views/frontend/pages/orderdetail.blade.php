@extends('frontend.layouts.master')

@section('customize.js.head')

@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<ul class="list-inline checkout-step">
	<li class="{{ $cart->shopping_cart_status_id == 2 ? 'active' : null }}"><span>1</span>Mới đặt hàng</li>
	<li class="{{ $cart->shopping_cart_status_id == 3 ? 'active' : null }}"><span>2</span>Đã xác nhận</li>
	<li class="{{ $cart->shopping_cart_status_id == 4 ? 'active' : null }}"><span>3</span>Đang giao hàng</li>
	<li class="{{ $cart->shopping_cart_status_id == 5 ? 'active' : null }}"><span>4</span>Đã giao hàng</li>
</ul>
<div class="col-sm-12 col-md-12">
	@if(is_null($cart))
	<h1 class="article-title text-center">Đơn hàng không tồn tại!</h1>
	@else
	<h1 class="article-title">Chi tiết đơn hàng: {{ $cart->code }} <small>Mua ngày: {{ $cart->created_at->format('d/m/Y') }}</small></h1>
	@endif
	@if($cart->shopping_cart_status_id == 1)
	<center><span class="label label-danger text-center">Đơn hàng đã huỷ</span></center><br>
	@endif
</div>
@if(!is_null($cart))
<div class="col-sm-12 col-md-6">
	<table class="table table-condensed table-hover table-bordered shoppingcart">
		<tr>
			<td colspan="2" class="head">Thông tin người mua</td>
		</tr>
		<tr>
			<td class="text-nowrap">Họ tên người mua</td>
			<td>{{ $cart->customer_name }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Địa chỉ</td>
			<td>{{ $cart->customer_address }},<br>
				{{ $cart->customerDistrict->name }}, {{ $cart->customerProvince->name }}
			</td>
		</tr>
		<tr>
			<td class="text-nowrap">Số điện thoại</td>
			<td>{{ $cart->customer_phone }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Email</td>
			<td>{{ $cart->customer_email }}</td>
		</tr>
	</table>
</div>
<div class="col-sm-12 col-md-6">
	<table class="table table-condensed table-hover table-bordered shoppingcart">
		<tr>
			<td colspan="2" class="head">Thông tin người nhận</td>
		</tr>
		@if($cart->shipping_address_same_order)
		<tr>
			<td colspan="2">Giống thông tin mua hàng</td>
		</tr>
		@else
		<tr>
			<td class="text-nowrap">Họ tên người mua</td>
			<td>{{ $cart->shipping_name }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Địa chỉ</td>
			<td>{{ $cart->shipping_address }},<br>
				{{ $cart->shippingDistrict->name }}, {{ $cart->shippingProvince->name }}
			</td>
		</tr>
		<tr>
			<td class="text-nowrap">Số điện thoại</td>
			<td>{{ $cart->shipping_phone }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Email</td>
			<td>{{ $cart->shipping_email }}</td>
		</tr>
		@endif
	</table>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-6">
	<table class="table table-condensed table-hover table-bordered shoppingcart">
		<tr>
			<td colspan="2" class="head">Thông tin thanh toán &amp; giao nhận</td>
		</tr>
		<tr>
			<td class="text-nowrap">Phương thức thanh toán</td>
			<td class="text-center">{{ $cart->paymentMethod->name }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Trạng thái thanh toán</td>
			<td class="text-center">{{ $cart->payment_status ? 'Đã thanh toán' : 'Chưa xác nhận' }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Phương thức giao nhận</td>
			<td class="text-center">{{ $cart->delivery_method_id ? 'Giao hàng nhanh' : 'Giao hàng tiêu chuẩn' }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Thời gian giao hàng dự kiến</td>
			<td class="text-center">{{ $cart->delivery_date }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Phí giao hàng</td>
			<td class="text-center">{{ number_format($cart->shipping_fee, 0, ',', '.') }} <small>VNĐ</small></td>
		</tr>
	</table>
</div>
<div class="col-sm-12 col-md-6">
	<table class="table table-condensed table-hover table-bordered shoppingcart">
		<tr>
			<td colspan="2" class="head">Thông tin hoá đơn</td>
		</tr>
		@if($cart->invoice_export)
		<tr>
			<td class="text-nowrap">Tên công ty</td>
			<td>{{ $cart->invoiceInfo->company_name }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Địa chỉ</td>
			<td>{{ $cart->invoiceInfo->company_address }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Mã số thuế</td>
			<td>{{ $cart->invoiceInfo->tax_code }}</td>
		</tr>
		<tr>
			<td class="text-nowrap">Trạng thái</td>
			<td>{{ $cart->invoice_exported ? 'Đã xuất' : 'Chưa xuất' }}</td>
		</tr>
		@else
		<tr>
			<td colspan="2">Không xuất hoá đơn VAT</td>
		</tr>
		@endif
	</table>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 col-md-12">
	<table class="table table-condensed table-hover table-bordered shoppingcart">
		<tr>
			<td class="head">#</td>
			<td class="head">Tên sản phẩm</td>
			<td class="head">Mã sản phẩm</td>
			<td class="head">Số lượng</td>
			<td class="head">Đơn giá</td>
			<td class="head">Thành tiền</td>
		</tr>
		@foreach($cart->cartDetails as $item)
		<tr>
			<td>{{ $loop->iteration }}</td>
			<td><a href="{{ $item->product->getLink() }}">{{ $item->product->name }}</a></td>
			<td>{{ $item->product->code }}</td>
			<td class="text-right">{{ number_format($item->quantity, 0, ',', '.') }}</td>
			<td class="text-right">{{ number_format($item->product_price, 0, ',', '.') }} <small>VNĐ</small></td>
			<td class="text-right">{{ number_format(($item->product_price * $item->quantity), 0, ',', '.') }} <small>VNĐ</small></td>
		</tr>
		@endforeach
		<tr>
			<td colspan="5" class="text-right">Chiết khấu</td>
			<td class="text-right">- {{ number_format(0, 0, ',', '.') }} <small>VNĐ</small></td>
		</tr>
		<tr>
			<td colspan="5" class="text-right">Mã thưởng</td>
			<td class="text-right">- {{ number_format($cart->getTotalPromotionAmount(), 0, ',', '.') }} <small>VNĐ</small></td>
		</tr>
		<tr>
			<td colspan="5" class="text-right">Phí vận chuyển</td>
			<td class="text-right">{{ number_format($cart->shipping_fee, 0, ',', '.') }} <small>VNĐ</small></td>
		</tr>
		<tr>
			<td colspan="5" class="text-right"><strong>Tổng cộng</strong></td>
			<td class="text-right"><strong>{{ number_format($cart->getTotalPaymentAmount(), 0, ',', '.') }} <small>VNĐ</small></strong></td>
		</tr>
	</table>
</div>
@endif
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection