@inject('articleModel', 'App\Article')

@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<ul class="list-inline checkout-step">
	<li><span>1</span>Giỏ hàng</li>
	<li class="active"><span>2</span>Thanh toán</li>
	<li><span>3</span>Xác nhận</li>
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
		<div class="col-xs-12 col-sm-12 col-md-6">
			<table class="table table-condensed shoppingcart">
				<tr>
					<td class="head" colspan="2">Thông tin Người đặt hàng &amp; Người nhận</td>
				</tr>
				<tr>
					<td colspan="2" class="pl-0 pr-0">
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Họ và tên <em>(*)</em></label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="ShoppingCart[customer_name]" value="{{ Auth::user()->getFullname() }}" placeholder="Họ và tên" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Địa chỉ người đặt hàng <em>(*)</em></label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="ShoppingCart[customer_address]" value="{{ Auth::user()->address }}" placeholder="Địa chỉ người đặt hàng" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">&nbsp;</label>
							<div class="col-sm-7">
								<div class="col-md-6">
									<div class="row">
										<select class="form-control province" name="ShoppingCart[province_id]" sub-control="shoppingcart_district" required>
											<option value="">Tỉnh/Thành phố</option>
											@foreach($provinces as $province)
											<option value="{{ $province->id }}">{{ $province->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<select class="form-control" name="ShoppingCart[district_id]" id="shoppingcart_district" required>
											<option value="">Quận/Huyện</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Di động <em>(*)</em></label>
							<div class="col-sm-7">
								<input type="number" class="form-control" name="ShoppingCart[customer_phone]" value="{{ Auth::user()->mobile_phone }}" placeholder="Di động" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Email</label>
							<div class="col-sm-7">
								<input type="email" class="form-control" name="ShoppingCart[customer_email]" value="{{ Auth::user()->email }}" placeholder="Email" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-8 text-right">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="cboOpenShippingForm" name="ShoppingCart[shipping_address_same_order]" value="0"> Địa chỉ người đặt hàng khác địa chỉ người nhận?
									</label>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr class="shipping-form">
					<td colspan="2" class="pl-0 pr-0">
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Họ và tên người nhận <em>(*)</em></label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="ShoppingCart[shipping_name]" value="{{ old('ShoppingCart[shipping_name]') }}" placeholder="Họ và tên">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Địa chỉ người nhận hàng <em>(*)</em></label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="ShoppingCart[shipping_address]" value="{{ old('ShoppingCart[shipping_address]') }}" placeholder="Địa chỉ người nhận hàng">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">&nbsp;</label>
							<div class="col-sm-7">
								<div class="col-md-6">
									<div class="row">
										<select class="form-control province" name="ShoppingCart[shipping_province_id]" sub-control="shoppingcart_shipping_district_id">
											<option value="">Tỉnh/Thành phố</option>
											@foreach($provinces as $province)
											<option value="{{ $province->id }}">{{ $province->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<select class="form-control" name="ShoppingCart[shipping_district_id]" id="shoppingcart_shipping_district_id">
											<option value="">Quận/Huyện</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Di động <em>(*)</em></label>
							<div class="col-sm-7">
								<input type="number" class="form-control" name="ShoppingCart[shipping_phone]" value="{{ old('ShoppingCart[shipping_phone]') }}" placeholder="Di động">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Email</label>
							<div class="col-sm-7">
								<input type="email" class="form-control" name="ShoppingCart[shipping_email]" value="{{ old('ShoppingCart[shipping_email]') }}" placeholder="Email">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="pl-0 pr-0">
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Ghi chú</label>
							<div class="col-sm-7">
								<textarea class="form-control" name="ShoppingCart[customer_note]" value="{{ old('ShoppingCart[customer_note]') }}" rows="3"></textarea>
							</div>
							<div class="col-sm-12 text-right">
								<em><small>Vui lòng ghi chính xác/chi tiết về địa chỉ giao hàng<br>Chúng tôi sẽ liên lạc với bạn theo thông tin trên để xác nhận giao hàng</small></em>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<table class="table table-condensed shoppingcart no-padding-left-right">
				<tr>
					<td class="head" colspan="2">Chọn phương án giao hàng</td>
				</tr>
				<tr>
					<td style="width: 50%;" class="pl-0">
						<div class="center-block delivery-method active">
							<strong class="text-uppercase">Miễn phí</strong><br>
							<img src="/frontend/images/freeshipping.png" alt="freeshipping"><br>
							<span>Giao hàng tiêu chuẩn</span>
							<input type="radio" value="0" class="hide" name="ShoppingCart[delivery_method_id]">
						</div>
					</td>
					<td style="width: 50%;" class="pr-0">
						<div class="center-block delivery-method">
							<strong class="text-uppercase"><span id="express-delivery-fee">---</span> VNĐ</strong><br>
							<img src="/frontend/images/standardshipping.png" alt="freeshipping"><br>
							<span>Giao hàng nhanh</span>
							<input type="radio" value="1" class="hide" name="ShoppingCart[delivery_method_id]">
						</div>
					</td>
				</tr>
			</table>
			
			<table class="table table-condensed table-bordered shoppingcart">
				<tr>
					<td class="head">Thời gian giao hàng dự kiến</td>
					<td class="text-center"><span id="delivery-time">--/--/----</span></td>
				</tr>
			</table>
			<div class="text-right pb-10"><em><small>Chúng tôi sẽ liên hệ với bạn trong vòng 24h để xác nhận đơn hàng</small></em></div>
			<table class="table table-condensed shoppingcart">
				<tr>
					<td class="head" colspan="2">
						<div class="checkbox">
							<label>
								<input type="checkbox" id="cboOpenInvoiceForm" name="ShoppingCart[invoice_export]" value="1"> Thông tin xuất hoá đơn (Áp dụng cho khách hàng doanh nghiệp)
							</label>
						</div>
					</td>
				</tr>
				<tr class="invoice-form">
					<td colspan="2" class="pl-0 pr-0">
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Tên công ty <em>(*)</em></label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="ShoppingCart[invoiceInfo][company_name]" value="{{ old('ShoppingCart[invoiceInfo[company_name]]') }}" placeholder="Tên công ty">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Địa chỉ <em>(*)</em></label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="ShoppingCart[invoiceInfo][company_address]" value="{{ old('ShoppingCart[invoiceInfo][company_address]') }}" placeholder="Địa chỉ">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label text-right">Mã số thuế <em>(*)</em></label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="ShoppingCart[invoiceInfo][tax_code]" value="{{ old('ShoppingCart[invoiceInfo][tax_code]') }}" placeholder="Mã số thuế">
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6">
			<table class="table table-condensed table-bordered shoppingcart">
				<tr>
					<td class="text-center head">Tên sản phẩm</td>
					<td class="text-center head">Đơn giá</td>
					<td class="text-center head">Số lượng</td>
					<td class="text-center head">Thành tiền</td>
				</tr>
				@foreach($cart->cartDetails as $item)
				<tr>
					<td class="text-left"><a href="{{ $item->product->getLink() }}">{{ $item->product->name }}</a><br />
						<!-- <small>Reward Points: 1000</small> -->
					</td>
					<td class="text-right">{{ number_format($item->product_price, 0, ',', '.') }}</td>
					<td>
						<input type="number" value="{{ $item->quantity }}" min="1" max="{{ $item->product->inventory_quantity }}" data-toggle="tooltip" data-placement="top" title="Số lượng sản phẩm trong kho: {{ $item->product->inventory_quantity }}" size="1" class="form-control quantity text-right"  data-product_id="{{ $item->product_id }}" data-product_price="{{ $item->product_price }}" data-quantity="{{ $item->quantity }}"/>
					</td>
					<td class="text-right"><span class="item-amount">{{ number_format($item->quantity * $item->product_price, 0, ',', '.') }}</span></td>
				</tr>
				@endforeach
			</table>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-9 text-right pb-10">Trị giá hàng hoá</div>
				<div class="col-xs-6 col-sm-6 col-md-3 text-right pb-10"><strong><span class="total-amount">{{ number_format($cart->getTotalAmount(), 0, ',', '.') }}</span></strong> VNĐ</div>
				<div class="col-xs-6 col-sm-6 col-md-9 text-right pb-10">Chiết khấu theo chương trình</div>
				<div class="col-xs-6 col-sm-6 col-md-3 text-right pb-10">0 VNĐ</div>
				<div class="col-xs-6 col-sm-6 col-md-9 text-right pb-10">Phí giao hàng nhanh</div>
				<div class="col-xs-6 col-sm-6 col-md-3 text-right pb-10">
					<span id="express-delivery-fee-pay">0</span> VNĐ
					<input type="hidden" name="ShoppingCart[shipping_fee]" value="0">
				</div>
				<div id="promtion-template" class="hide">
					<div class="col-xs-6 col-sm-6 col-md-9 text-right pb-10 promotion-code-{0}">
						<span class="glyphicon glyphicon-remove remove-promotion-code" onclick="return ketnoimoi.site.removePromotionCode('{0}');" title="Xoá mã thưởng"></span> Mã thưởng: {0}
					</div>
					<div class="col-xs-6 col-sm-6 col-md-3 text-right pb-10 promotion-code-{0}">
						- {1} VNĐ
						<input type="hidden" name="ShoppingCart[promotionCodes][]" value="{2}">
					</div>
				</div>
				<div class="col-xs-8 col-sm-6 col-sm-offset-2 col-md-5 col-md-offset-4 text-right pb-10">
					<input type="text" class="form-control pull-right text-center" id="txtPromotionCode" placeholder="Nhập mã số thưởng (nếu có)">
					<small>(Được áp dụng nhiều mã số thưởng)</small>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-3 pb-10">
					<a class="btn btn-default btn-block pull-right text-uppercase" id="btnApplyPromotionCode">Áp dụng</a>
				</div>
				<div class="col-xs-8 col-sm-6 col-sm-offset-2 col-md-4 col-md-offset-5 text-right pb-10">
					<strong>Trị giá đơn hàng</strong><br>
					<small>(Đã bao gồm VAT)</small>
				</div>
				<div class="col-xs-4 col-sm-4 col-md-3 text-right pb-10">
					<strong><span class="total-payment-amount">{{ number_format($cart->getTotalPaymentAmount(), 0, ',', '.') }}</span></strong> VNĐ
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<small><strong>Chú ý: </strong> <em>*Chương trình khuyến mãi theo giá trị đơn hàng sẽ được áp dụng khi bạn hoàn tất bước xác nhận mua hàng</em></small>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<table class="table table-condensed shoppingcart">
				<tr>
					<td class="head" colspan="{{ Auth::user()->hasRoles('Staffs') ? 5 : 4 }}">
						Phương thức thanh toán
					</td>
				</tr>
				<tr>
					<td style="width: {{ Auth::user()->hasRoles('Staffs') ? 20 : 25 }}%; vertical-align: top;" class="pl-0">
						<div class="text-center payment-method active" data-tab="payment-method-info-1">
							<strong>Thanh toán<br>khi nhận hàng</strong><br>
							<img src="/frontend/images/cash.png" alt="cod"><br>
							<input type="radio" value="1" name="ShoppingCart[payment_method_id]" checked>
						</div>
					</td>
					<td style="width: {{ Auth::user()->hasRoles('Staffs') ? 20 : 25 }}%; vertical-align: top;">
						<div class="text-center payment-method" data-tab="payment-method-info-2">
							<strong>Thẻ tín dụng</strong><br><br>
							<img src="/frontend/images/credit.png" alt="credit"><br>
							<input type="radio" value="2" name="ShoppingCart[payment_method_id]">
						</div>
					</td>
					<td style="width: {{ Auth::user()->hasRoles('Staffs') ? 20 : 25 }}%; vertical-align: top;">
						<div class="text-center payment-method" data-tab="payment-method-info-3">
							<strong>Thẻ ATM nội địa</strong><br>(Internet banking)
							<img src="/frontend/images/atm.png" alt="atm"><br>
							<input type="radio" value="3" name="ShoppingCart[payment_method_id]">
						</div>
					</td>
					<td style="width: {{ Auth::user()->hasRoles('Staffs') ? 20 : 25 }}%; vertical-align: top;" class="{{ Auth::user()->hasRoles('Staffs') ? '' : 'pr-0' }}">
						<div class="text-center payment-method" data-tab="payment-method-info-4">
							<strong>Chuyển khoản</strong><br>(ATM / Ngân hàng)<br>
							<img src="/frontend/images/bank.png" alt="bank"><br>
							<input type="radio" value="4" name="ShoppingCart[payment_method_id]">
						</div>
					</td>
					@if(Auth::user()->hasRoles('Staffs'))
					<td style="width: {{ Auth::user()->hasRoles('Staffs') ? 20 : 25 }}%; vertical-align: top;" class="pr-0">
						<div class="text-center payment-method" data-tab="payment-method-info-5">
							<strong>Thanh toán sau</strong><br>(Dành cho nhân viên)<br>
							<img src="/frontend/images/nhanvien.png" alt="nhanvien"><br>
							<input type="radio" value="5" name="ShoppingCart[payment_method_id]">
						</div>
					</td>
					@endif
				</tr>
			</table>
			<div class="col-xs-10 col-sm-10 col-md-9 payment-method-info" id="payment-method-info-1">
				<br>
				@php
				$article = $articleModel::findByKey('thanh-toan-khi-nhan-hang')->first();
				@endphp
				{!! $article->content !!}
				<br>
			</div>
			<div class="col-xs-10 col-sm-10 col-md-9 payment-method-info hide" id="payment-method-info-2">
				<br>
				@php
				$article = $articleModel::findByKey('the-tin-dung')->first();
				@endphp
				{!! $article->content !!}
				<br>
			</div>
			<div class="col-xs-10 col-sm-10 col-md-9 payment-method-info hide" id="payment-method-info-3">
				<br>
				@php
				$article = $articleModel::findByKey('the-atm-noi-dia')->first();
				@endphp
				{!! $article->content !!}
				<br>
			</div>
			<div class="col-xs-10 col-sm-10 col-md-9 payment-method-info hide" id="payment-method-info-4">
				<br>
				@php
				$article = $articleModel::findByKey('chuyen-khoan-ngan-hang')->first();
				@endphp
				{!! $article->content !!}
				<br>
			</div>
			@if(Auth::user()->hasRoles('Staffs'))
			<div class="col-xs-10 col-sm-10 col-md-9 payment-method-info hide" id="payment-method-info-5">
				<br>
				@php
				$article = $articleModel::findByKey('thanh-toan-sau')->first();
				@endphp
				{!! $article->content !!}
				<br>
			</div>
			@endif
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-3 col-md-offset-9">
		<!-- <a class="btn btn-default btn-block btn-shopping btn-arrow" onclick="return ketnoimoi.site.cart.purchase();">Xác nhận<br>mua hàng <span class="glyphicon glyphicon-play glyphicon-lg"></span></a> -->
		<span id="shoppingcart-notify" class="text-danger"></span>
		<button id="btnConfirmShoppingCart" type="submit" onclick="return ketnoimoi.site.validatePurchase();" class="btn btn-default btn-block btn-shopping btn-arrow" id="button-confirm">
			Xác nhận mua hàng <span class="glyphicon glyphicon-play"></span>
		</button>
	</div>
</form>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection