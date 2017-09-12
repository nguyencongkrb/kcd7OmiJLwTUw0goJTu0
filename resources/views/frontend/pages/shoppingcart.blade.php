@inject('config', 'App\Config')
@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<!-- Breadcrumb Start-->
<ul class="breadcrumb">
	<li><a href="index.html"><i class="fa fa-home"></i></a></li>
	<li><a href="{{ route('shopping.cart') }}">Giỏ hàng</a></li>
</ul>
<!-- Breadcrumb End-->
<div class="row">
	<!--Middle Part Start-->
	<div id="content" class="col-sm-12">
		<h1 class="title">Giỏ hàng</h1>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td class="text-center">Hình ảnh</td>
						<td class="text-left">Tên sản phẩm</td>
						<td class="text-left">Mã sản phẩm</td>
						<td class="text-left">Số lượng</td>
						<td class="text-right">Giá</td>
						<td class="text-right">Thành tiền</td>
					</tr>
				</thead>
				<tbody>
					@foreach($cart->cartDetails as $item)
					<tr>
						<td class="text-center"><a href="{{ $item->product->getLink() }}"><img src="{{ $item->product->getFirstAttachment('custom', 50, 50) }}" alt="{{ $item->product->name }}" title="{{ $item->product->name }}" class="img-thumbnail" /></a></td>
						<td class="text-left"><a href="{{ $item->product->getLink() }}">{{ $item->product->name }}</a><br />
							<!-- <small>Reward Points: 1000</small> -->
						</td>
						<td class="text-left">{{ $item->product->code }}</td>
						<td class="text-left"><div class="input-group btn-block quantity">
							<input type="text" name="quantity" value="{{ $item->quantity }}" size="1" class="form-control" />
							<span class="input-group-btn">
								<button type="submit" data-toggle="tooltip" title="Cập nhật" class="btn btn-primary change-quantity" data-product_id="{{ $item->product_id }}" data-product_size_id="{{ $item->product_size_id }}" data-product_color_id="{{ $item->product_color_id }}" data-product_price="{{ $item->product_price }}" data-quantity="{{ $item->quantity }}"><i class="fa fa-refresh"></i></button>
								<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger remove-item"  data-product_id="{{ $item->product_id }}" data-product_size_id="{{ $item->product_size_id }}" data-product_color_id="{{ $item->product_color_id }}" data-product_price="{{ $item->product_price }}" data-quantity="{{ $item->quantity }}"><i class="fa fa-times-circle"></i></button>
							</span></div></td>
							<td class="text-right">{{ number_format($item->product_price) }}</td>
							<td class="text-right"><span class="item-amount">{{ number_format($item->quantity * $item->product_price) }}</span></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-8">
					<table class="table table-bordered">
						<tr>
							<td class="text-right"><strong>Thành tiền:</strong></td>
							<td class="text-right"><span class="total-amount-without-shipping-cost">{{ number_format($cart->getTotalAmount()) }}</span></td>
						</tr>
						<tr>
							<td class="text-right"><strong>Phí vận chuyển:</strong></td>
							<td class="text-right"><span class="shipping-cost">{{ number_format($config->getValueByKey('default_shipping_fee')) }}</span></td>
						</tr>
				<!-- <tr>
				  <td class="text-right"><strong>VAT (20%):</strong></td>
				  <td class="text-right">$188.00</td>
				</tr> -->
				<tr>
					<td class="text-right"><strong>Tổng cộng:</strong></td>
					<td class="text-right"><span class="total-amount">{{ number_format($cart->getTotalAmount() + $config->getValueByKey('default_shipping_fee')) }}</span></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="buttons">
		<div class="pull-left"><a href="/" class="btn btn-default">Tiếp tục mua hàng</a></div>
		<div class="pull-right"><a href="{{ route('payment.info') }}" class="btn btn-primary">Thanh toán</a></div>
	</div>
</div>
<!--Middle Part End -->
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection