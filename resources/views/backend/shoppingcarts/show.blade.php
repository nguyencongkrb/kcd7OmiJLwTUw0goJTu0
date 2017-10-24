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
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Chi tiết đơn hàng</h3>
			</div>
			<div class="box-body">
				<table class="table table-condensed table-hover table-bordered">
					<tr>
						<td><strong>#</strong></td>
						<td><strong>Hình ảnh</strong></td>
						<td><strong>Tên sản phẩm</strong></td>
						<td class="text-right"><strong>Số lượng</strong></td>
						<td class="text-right"><strong>Đơn giá</strong></td>
						<td class="text-right"><strong>Thành tiền</strong></td>
					</tr>
					@foreach($cart->cartDetails as $item)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td class="text-center">
							<a target="_blank" href="{{ $item->product->getLink() }}"><img src="{{ $item->product->getFirstAttachment('custom', 70, 0) }}" alt="{{ $item->product->name }}" title="{{ $item->product->name }}" class="img-thumbnail" /></a>
						</td>
						<td><a target="_blank" href="{{ $item->product->getLink() }}">{{ $item->product->name }}</a></td>
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
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Thông tin người mua</h3>
			</div>
			<div class="box-body">
				<dl class="dl-horizontal">
					<dt>Họ tên</dt>
					<dd>{{ $cart->customer_name }}</dd>
					<dt>Số điện thoại</dt>
					<dd>{{ $cart->customer_phone }}</dd>
					<dt>Email</dt>
					<dd>{{ $cart->customer_email }}</dd>
					<dt>Địa chỉ</dt>
					<dd>{{ $cart->customer_address }}<br>
						{{ $cart->customerDistrict->name }}, {{ $cart->customerProvince->name }}
					</dd>
				</dl>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Thông tin người nhận</h3>
			</div>
			<div class="box-body">
				@if($cart->shipping_address_same_order)
				Giống thông tin người mua
				@else
				<dl class="dl-horizontal">
					<dt>Họ tên</dt>
					<dd>{{ $cart->shipping_name }}</dd>
					<dt>Số điện thoại</dt>
					<dd>{{ $cart->shipping_phone }}</dd>
					<dt>Email</dt>
					<dd>{{ $cart->customer_email }}</dd>
					<dt>Địa chỉ</dt>
					<dd>{{ $cart->shipping_email }}<br>
						{{ $cart->shippingDistrict->name }}, {{ $cart->shippingProvince->name }}
					</dd>
				</dl>
				@endif
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Thông tin chung </h3>
			</div>
			<div class="box-body">
				@php
				$cssClass = 'btn-info';
				if($cart->shopping_cart_status_id == 1){
				$cssClass = 'btn-danger';
			}
			elseif($cart->shopping_cart_status_id == 5){
			$cssClass = 'btn-success';
		}
		@endphp

		<dl class="dl-horizontal">
			<dt>Mã đơn hàng</dt>
			<dd>{{ $cart->code }} &nbsp;
				<div class="btn-group">
					<button type="button" class="btn {{ $cssClass }} btn-xs btn-flat">{{ $cart->status->name }}</button>
					<button type="button" class="btn {{ $cssClass }} btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="javascript:void(0);" data-action="updatestatus" data-id="{{ $cart->id }}" data-value="3">Đã xác nhận</a></li>
						<li><a href="javascript:void(0);" data-action="updatestatus" data-id="{{ $cart->id }}" data-value="4">Đang giao hàng</a></li>
						<li><a href="javascript:void(0);" data-action="updatestatus" data-id="{{ $cart->id }}" data-value="5">Đã giao hàng</a></li>
						<li class="divider"></li>
						<li><a href="javascript:void(0);" data-action="updatestatus" data-id="{{ $cart->id }}" data-value="1">Huỷ đơn hàng</a></li>
					</ul>
				</div>
			</dd>
			<dt>Ngày đặt hàng</dt>
			<dd>{{ $cart->created_at->format('d/m/Y') }}</dd>
			<dt>Phương thức giao hàng</dt>
			<dd>{{ $cart->printery_method_id ? 'Giao hàng nhanh' : 'Giao hàng tiêu chuẩn' }}</dd>
			<dt>Ngày giao hàng</dt>
			<dd>{{ DateTime::createFromFormat('Y-m-d', $cart->delivery_date)->format('d/m/Y') }}</dd>
			<dt>Phương thức thanh toán</dt>
			<dd>{{ $cart->paymentMethod->name }}</dd>
			<dt>Trạng thái thanh toán</dt>
			<dd>
				@if($cart->payment_status)
				<div class="btn-group">
					<button type="button" class="btn btn-success btn-xs btn-flat">Đã thanh toán</button>
					<button type="button" class="btn btn-success btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="javascript:void(0);" data-action="updatepaymentstatus" data-id="{{ $cart->id }}" data-value="0">Chưa thanh toán</a></li>
					</ul>
				</div>
				@else
				<div class="btn-group">
					<button type="button" class="btn btn-warning btn-xs btn-flat">Chưa thanh toán</button>
					<button type="button" class="btn btn-warning btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="javascript:void(0);" data-action="updatepaymentstatus" data-id="{{ $cart->id }}" data-value="1">Đã thanh toán</a></li>
					</ul>
				</div>
				@endif
			</dd>
		</dl>
	</div>
	<div class="box-footer text-right">
		<a href="{{ route('shoppingcarts.invoice', ['id' => $cart->id]) }}" target="_blank" class="btn btn-success btn-sm btn-flat"><i class="fa fa-print" aria-hidden="true"></i> In vận đơn</a>
		<button type="button" class="btn btn-success btn-sm btn-flat"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất excel</button>
	</div>
</div>
</div>
<div class="col-md-6">
	<form action="{{ route('shoppingcarts.update', ['id' => $cart->id]) }}" method="post">
		{{ csrf_field() }}
		{{ method_field('PATCH') }}
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Thông tin hoá đơn &amp; Ghi chú</h3>
			</div>
			<div class="box-body">
				@if($cart->invoice_export)
				<dl class="dl-horizontal">
					<dt>Trạng thái</dt>
					<dd>
						@if($cart->invoice_exported)
						<div class="btn-group">
							<button type="button" class="btn btn-success btn-xs btn-flat">Đã xuất</button>
							<button type="button" class="btn btn-success btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="javascript:void(0);" data-action="updateinvoicestatus" data-id="{{ $cart->id }}" data-value="0">Chưa xuất</a></li>
							</ul>
						</div>
						@else
						<div class="btn-group">
							<button type="button" class="btn btn-warning btn-xs btn-flat">Chưa xuất</button>
							<button type="button" class="btn btn-warning btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="javascript:void(0);" data-action="updateinvoicestatus" data-id="{{ $cart->id }}" data-value="1">Đã xuất</a></li>
							</ul>
						</div>
						@endif
					</dd>
					<dt>Tên công ty</dt>
					<dd>{{ $cart->invoiceInfo->company_name }}</dd>
					<dt>Địa chỉ</dt>
					<dd>{{ $cart->invoiceInfo->company_address }}</dd>
					<dt>Mã số thuế</dt>
					<dd>{{ $cart->invoiceInfo->tax_code }}</dd>
				</dl>
				@else
				Không xuất hoá đơn
				@endif
				<div class="form-group">
					<label>Ghi chú của khách hàng</label>
					<p class="form-control-static">{{ $cart->customer_note }}</p>
				</div>
				<div class="form-group">
					<label>Ghi chú cho giao nhận</label>
					<textarea class="form-control" rows="3" name="ShoppingCart[delivery_note]" maxlength="300" placeholder="Ghi chú cho giao nhận">{{ $cart->delivery_note }}</textarea>
				</div>
				<div class="form-group">
					<label>Ghi chú của CSKH</label>
					<textarea class="form-control" rows="3" name="ShoppingCart[customer_service_note]" maxlength="300" placeholder="Ghi chú của CSKH">{{ $cart->customer_service_note }}</textarea>
				</div>
			</div>
			<div class="box-footer text-right">
				<button type="submit" class="btn btn-success btn-sm btn-flat">Lưu ghi chú</button>
			</div>
		</div>
	</form>
</div>
@endsection

@section('plugins.js')

@endsection

@section('javascript.customize')
<script src="/backend/js/shoppingcarts/ketnoimoi.shoppingcarts.show.js" type="text/javascript"></script>
@endsection