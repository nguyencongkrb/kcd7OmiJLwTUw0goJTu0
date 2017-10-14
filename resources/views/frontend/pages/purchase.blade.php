@inject('articleModel', 'App\Article')

@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<ul class="list-inline checkout-step">
	<li><span>1</span>Giỏ hàng</li>
	<li><span>2</span>Thanh toán</li>
	<li class="active"><span>3</span>Xác nhận</li>
	<li><span>4</span>Hoàn tất</li>
</ul>

<form class="form-horizontal" id="fromCheckout" method="POST" action="{{ route('purchase') }}">
	{{ csrf_field() }}
	<div class="row">
		@if($errors->any())
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
		@endif
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif
		<div class="col-xs-12 col-sm-8 col-md-8">
			<table class="table table-condensed table-hover table-bordered shoppingcart">
				<tr>
					<td class="text-center head"></td>
					<td class="text-center head">Tên sản phẩm</td>
					<td class="text-center head">Đơn giá</td>
					<td class="text-center head">Số lượng</td>
					<td class="text-center head">Thành tiền</td>
				</tr>
				
				@foreach($cart->cartDetails as $item)
				<tr>
					<td class="text-center"><a href="{{ $item->product->getLink() }}"><img src="{{ $item->product->getFirstAttachment('custom', 94) }}" class="img-thumbnail" alt="{{ $item->product->name }}"></a></td>
					<td class="text-left"><a href="{{ $item->product->getLink() }}">{{ $item->product->name }}</a><br />
					</td>
					<td class="text-right">{{ number_format($item->product_price, 0, ',', '.') }}</td>
					<td class="text-center">
						{{ number_format($item->quantity, 0, ',', '.') }}
						<input type="hidden" value="{{ $item->quantity }}" min="1" max="{{ $item->product->inventory_quantity }}" data-toggle="tooltip" data-placement="top" title="Số lượng sản phẩm trong kho: {{ $item->product->inventory_quantity }}" size="1" class="form-control quantity text-right"  data-product_id="{{ $item->product_id }}" data-product_price="{{ $item->product_price }}" data-quantity="{{ $item->quantity }}"/>
					</td>
					<td class="text-right">{{ number_format($item->quantity * $item->product_price, 0, ',', '.') }}</td>
				</tr>
				@endforeach
			</table>
			<div class="col-xs-12 col-sm-9 col-sm-push-3 col-md-9 col-md-push-3">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-9 text-right pt-10">Trị giá hàng hoá</div>
					<div class="col-xs-6 col-sm-6 col-md-3 text-right pt-10">
						<div class="row">
							<strong>{{ number_format($cart->getTotalAmount(), 0, ',', '.') }}</strong> VNĐ
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-9 text-right pt-10">Phí giao hàng nhanh</div>
					<div class="col-xs-6 col-sm-6 col-md-3 text-right pt-10">
						<div class="row">
							0 VNĐ
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-9 text-right pt-10">Tổng giá trị chiết khấu</div>
					<div class="col-xs-6 col-sm-6 col-md-3 text-right pt-10">
						<div class="row">
							0 VNĐ
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-sm-offset-2 col-md-4 col-md-offset-5 text-right pt-10">
						<strong>Trị giá đơn hàng</strong><br>
						<small>(Đã bao gồm VAT)</small>
					</div>
					<div class="col-xs-6 col-sm-4 col-md-3 text-right pt-10">
						<div class="row">
							<strong>{{ number_format($cart->getTotalPaymentAmount(), 0, ',', '.') }}</strong> VNĐ
						</div>
					</div>
				</div>

			</div>
			<div class="col-xs-6 hidden-xs col-sm-3 col-sm-pull-9 col-md-3 col-md-pull-9">
				<div class="row">
					<a class="btn btn-default btn-block btn-shopping" href="{{ route('payment.info') }}">Thay đổi</a>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4">
			<table class="table table-condensed table-bordered shoppingcart">
				<tr>
					<td class="head" colspan="2">Thông tin giao hàng <a  href="{{ route('payment.info') }}" class="pull-right"><small>Thay đổi</small></a></th>
					</tr>
					<tr>
						<td class="no-border">Họ tên</td>
						<td class="no-border">Lê Uy Minh</td>
					</tr>
					<tr>
						<td class="no-border">Địa chỉ</td>
						<td class="no-border">11 Trần Não</td>
					</tr>
					<tr>
						<td class="no-border">Tỉnh/TP</td>
						<td class="no-border">Hồ Chí Minh</td>
					</tr>
					<tr>
						<td class="no-border">Quyện/Huyện</td>
						<td class="no-border">Quận 2</td>
					</tr>
					<tr>
						<td class="no-border">Điện thoại</td>
						<td class="no-border">0909 24 7179</td>
					</tr>
					<tr>
						<td class="no-border">Email</td>
						<td class="no-border">email@gmail.com</td>
					</tr>
				</table>

				<table class="table table-condensed table-bordered shoppingcart">
					<tr>
						<td class="head">Thời gian giao hàng dự kiến</td>
						<td class="text-center">
							10/12/2017
						</td>
					</tr>
				</table>

				<table class="table table-condensed shoppingcart">
					<tr>
						<td class="head">Phương thức thanh toán<a  href="{{ route('payment.info') }}" class="pull-right"><small>Thay đổi</small></a></td>
					</tr>
					<tr>
						<td class="no-border">Thanh toán khi nhận hàng</td>
					</tr>
					<tr>
						<td class="no-border text-muted">Thẻ tín dụng</td>
					</tr>
					<tr>
						<td class="no-border text-muted">Thẻ ATM nội địa (Internet Banking)</td>
					</tr>
					<tr>
						<td class="no-border text-muted">Chuyển khoản (ATM/Ngân hàng)</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="row">				
			<div class="col-xs-12 col-sm-4 col-sm-offset-8 col-md-2 col-md-offset-10">
				<a class="btn btn-default btn-block btn-shopping btn-arrow">Giao hàng <span class="glyphicon glyphicon-play"></span></a>
			</div>
		</div>
	</div>
</form>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection