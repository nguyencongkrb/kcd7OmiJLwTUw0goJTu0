@inject('config', 'App\Config')
@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<ul class="list-inline checkout-step">
	<li class="active"><span>1</span>Giỏ hàng</li>
	<li><span>2</span>Thanh toán</li>
	<li><span>3</span>Xác nhận</li>
	<li><span>4</span>Hoàn tất</li>
</ul>
<table class="table table-condensed table-hover table-bordered shoppingcart">
	<tr>
		<td class="text-center head"></td>
		<td class="text-center head">Tên sản phẩm</td>
		<td class="text-center head">Đơn giá</td>
		<td class="text-center head">Số lượng</td>
		<td class="text-center head">Thành tiền</td>
		<td class="text-center head">Xoá</td>
	</tr>
	@foreach($cart->cartDetails as $item)
	<tr>
		<td class="text-center">
			<a href="{{ $item->product->getLink() }}"><img src="{{ $item->product->getFirstAttachment('custom', 94, 0) }}" alt="{{ $item->product->name }}" title="{{ $item->product->name }}" class="img-thumbnail" /></a>
		</td>
		<td>
			<a href="{{ $item->product->getLink() }}" title="{{ $item->product->name }}">{{ $item->product->name }}</a>
		</td>
		<td class="text-right">
			{{ number_format($item->product_price, 0, ',', '.') }} <small>VNĐ</small>
		</td>
		<td class="text-center">
			<input type="number" value="{{ $item->quantity }}" min="1" max="{{ $item->product->inventory_quantity }}" data-toggle="tooltip" data-placement="top" title="Số lượng sản phẩm trong kho: {{ $item->product->inventory_quantity }}" class="form-control quantity text-right" data-product_id="{{ $item->product_id }}" data-product_price="{{ $item->product_price }}" data-quantity="{{ $item->quantity }}">
		</td>
		<td class="text-right">
			<span class="item-amount">{{ number_format($item->quantity * $item->product_price, 0, ',', '.') }}</span> <small>VNĐ</small>
		</td>
		<td class="text-center">
			<a href="#"><span class="glyphicon glyphicon-trash glyphicon-20 remove-item" data-product_id="{{ $item->product_id }}" data-product_price="{{ $item->product_price }}" data-quantity="{{ $item->quantity }}"></span></a>
		</td>
	</tr>
	@endforeach
</table>
<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-md-push-3">
		<div class="col-xs-8 col-sm-6 col-sm-offset-2 col-md-4 col-md-offset-5 text-right pb-10">
			<strong>Trị giá hàng hoá</strong><br>
			<small>(Đã bao gồm VAT)</small>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-3 text-right pb-10">
			<strong><span class="total-amount">{{ number_format($cart->getTotalAmount(), 0, ',', '.') }}</span></strong> <small>VNĐ</small>
		</div>
	</div>
	<div class="col-xs-6 col-sm-3 col-md-3 col-md-pull-9">
		<a class="btn btn-default btn-block btn-shopping" href="/">Tiếp tục mua hàng</a>
	</div>
	<div class="col-xs-6 col-sm-3 col-md-3 col-md-offset-9 text-center">
		<span id="shoppingcart-notify" class="text-danger"></span>
		<a id="btnDeliveryAndPayment" class="btn btn-default btn-block btn-shopping btn-arrow" href="{{ route('payment.info') }}">Giao hàng &amp; thanh toán <span class="glyphicon glyphicon-play hidden-xs"></span></a>
	</div>
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection