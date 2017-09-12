@inject('config', 'App\Config')

@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<!-- Breadcrumb Start-->
<ul class="breadcrumb">
	<li><a href="/"><i class="fa fa-home"></i></a></li>
	<li><a href="{{ route('shopping.cart') }}">Giỏ hàng</a></li>
	<li><a href="{{ route('payment.info') }}">Thanh toán</a></li>
</ul>
<!-- Breadcrumb End-->
<div class="row">
	<!--Middle Part Start-->
	<div id="content" class="col-sm-12">
		<h1 class="title">Thanh toán</h1>
		<div class="row">
			@include('frontend.partials.errors')

			<form role="form" method="POST" action="{{ route('purchase') }}">
				{{ csrf_field() }}
				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title"><i class="fa fa-user"></i> Thông tin của bạn</h4>
						</div>
						<div class="panel-body">
							<fieldset id="account">
								<div class="form-group required">
									<label for="customer_name" class="control-label">Họ tên</label>
									<input type="text" class="form-control" id="customer_name" placeholder="Họ tên" value="" name="ShoppingCart[customer_name]" required>
								</div>
								<div class="form-group required">
									<label for="customer_email" class="control-label">E-Mail</label>
									<input type="email" class="form-control" id="customer_email" placeholder="E-Mail" value="" name="ShoppingCart[customer_email]" required>
								</div>
								<div class="form-group required">
									<label for="customer_phone" class="control-label">Điện thoại</label>
									<input type="text" class="form-control" id="customer_phone" placeholder="Điện thoại" value="" name="ShoppingCart[customer_phone]" required>
								</div>
								<div class="form-group required">
									<label for="customer_address" class="control-label">Địa chỉ</label>
									<input type="text" class="form-control" id="customer_address" placeholder="Địa chỉ" value="" name="ShoppingCart[customer_address]" required>
								</div>
							</fieldset>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Giỏ hàng</h4>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<td class="text-center">Hình ảnh</td>
													<td class="text-left">Tên sản phẩm</td>
													<td class="text-left">Mã sản phẩm</td>
													<td class="text-right">Số lượng</td>
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
													<td class="text-left">
														<div class="input-group btn-block quantity">
															<input type="text" name="quantity" value="{{ $item->quantity }}" size="1" class="form-control" />
															<span class="input-group-btn">
																<button type="submit" data-toggle="tooltip" title="Cập nhật" class="btn btn-primary change-quantity" data-product_id="{{ $item->product_id }}" data-product_size_id="{{ $item->product_size_id }}" data-product_color_id="{{ $item->product_color_id }}" data-product_price="{{ $item->product_price }}" data-quantity="{{ $item->quantity }}"><i class="fa fa-refresh"></i></button>
																<button type="button" data-toggle="tooltip" title="Xóa" class="btn btn-danger remove-item"  data-product_id="{{ $item->product_id }}" data-product_size_id="{{ $item->product_size_id }}" data-product_color_id="{{ $item->product_color_id }}" data-product_price="{{ $item->product_price }}" data-quantity="{{ $item->quantity }}"><i class="fa fa-times-circle"></i></button>
															</span>
														</div>
													</td>
													<td class="text-right"><span class="item-amount">{{ number_format($item->quantity * $item->product_price) }}</span></td>
												</tr>
												@endforeach
											</tbody>
											<tfoot>
												<tr>
													<td class="text-right" colspan="4"><strong>Thành tiền:</strong></td>
													<td class="text-right"><span class="total-amount-without-shipping-cost">{{ number_format($cart->getTotalAmount()) }}</span></td>
												</tr>
												<tr>
													<td class="text-right" colspan="4"><strong>Phí vận chuyển:</strong></td>
													<td class="text-right"><span class="shipping-cost">{{ number_format($config->getValueByKey('default_shipping_fee')) }}</span></td>
												</tr>
												<tr>
													<td class="text-right" colspan="4"><strong>Tổng cộng:</strong></td>
													<td class="text-right"><span class="total-amount">{{ number_format($cart->getTotalAmount() + $config->getValueByKey('default_shipping_fee')) }}</span></td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><i class="fa fa-pencil"></i> Ghi chú</h4>
								</div>
								<div class="panel-body">
									<textarea rows="4" class="form-control" id="customer_note" name="ShoppingCart[customer_note]"></textarea>
								<!-- <br>
								<label class="control-label" for="confirm_agree">
									<input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm agree">
									<span>I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> 
								</label> -->
								<div class="buttons">
									<div class="pull-right">
										<input type="submit" onclick="return ketnoimoi.site.cart.purchase();" class="btn btn-primary" id="button-confirm" value="Đặt hàng">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!--Middle Part End -->
</div>														
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection