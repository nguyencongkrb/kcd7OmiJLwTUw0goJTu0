@inject('config', 'App\Config')

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
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
		<table class="table table-condensed shoppingcart">
			<tr>
				<td class="head" colspan="2">Thông tin Người đặt hàng &amp; Người nhận</td>
			</tr>
			<tr>
				<td class="text-right no-border">Họ và tên <em>(*)</em></td>
				<td class="no-border"><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td class="text-right no-border">Địa chỉ người đặt hàng <em>(*)</em></td>
				<td class="no-border">
					<input type="text" class="form-control">
				</td>
			</tr>
			<tr>
				<td class="text-right no-border"></td>
				<td class="no-border">
					<div class="col-md-6">
						<div class="row">
							<select class="form-control">
								<option>Tỉnh/Thành phố</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<select class="form-control">
								<option>Quận/Huyện</option>
							</select>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class="text-right no-border">Di động <em>(*)</em></td>
				<td class="no-border"><input type="text" class="form-control"></td>
			</tr>
			<tr>
				<td class="text-right no-border">Email</td>
				<td class="no-border"><input type="email" class="form-control"></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right no-border">
					<div class="checkbox">
						<label>
							<input type="checkbox"> Địa chỉ người đặt hàng khác địa chỉ người nhận?
						</label>
					</div>
				</td>
			</tr>
			<tr>
				<td class="text-right no-border">Ghi chú</td>
				<td class="no-border"><textarea class="form-control"></textarea></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right no-border"><strong><em><small>Vui lòng ghi chính xác/chi tiết về địa chỉ giao hàng<br>Chúng tôi sẽ liên lạc với bạn theo thông tin trên để xác nhận giao hàng</small></em></strong></td>
			</tr>
		</table>
		<table class="table table-condensed shoppingcart">
			<tr>
				<td class="head" colspan="2">Chọn phương án giao hàng</td>
			</tr>
			<tr>
				<td class="text-center">
					<div class="center-block delivery-method">
						<strong class="text-uppercase">Miễn phí</strong><br>
						<img src="/frontend/images/freeshipping.png" alt="freeshipping"><br>
						<span>Giao hàng tiêu chuẩn</span>
					</div>
				</td>
				<td class="text-center">
					<div class="center-block delivery-method active">
						<strong class="text-uppercase">22.000 VNĐ</strong><br>
						<img src="/frontend/images/standardshipping.png" alt="freeshipping"><br>
						<span>Giao hàng nhanh</span>
					</div>
				</td>
			</tr>
		</table>
		<table class="table table-condensed table-bordered shoppingcart">
			<tr>
				<td class="head">Thời gian giao hàng dự kiến</td>
				<td class="text-center">10/12/2017</td>
			</tr>
		</table>
		<div class="text-right pb-10"><strong><small>Chúng tôi sẽ liên hệ với bạn trong vòng 24h để xác nhận đơn hàng</small></strong></div>
		<table class="table table-condensed shoppingcart">
			<tr>
				<td class="head">
					<div class="checkbox">
						<label>
							<input type="checkbox"> Thông tin xuất hoá đơn (Áp dụng cho khách hàng doanh nghiệp)
						</label>
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
				<td class="text-right">{{ number_format($item->product_price) }}</td>
				<td>
					<input type="number" name="quantity" value="{{ $item->quantity }}" size="1" class="form-control quantity text-right"  data-product_id="{{ $item->product_id }}" data-product_price="{{ $item->product_price }}" data-quantity="{{ $item->quantity }}"/>
				</td>
				<td class="text-right"><span class="item-amount">{{ number_format($item->quantity * $item->product_price) }}</span></td>
			</tr>
			@endforeach
		</table>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-9 text-right pb-10">Trị giá hàng hoá</div>
			<div class="col-xs-6 col-sm-6 col-md-3 text-right pb-10"><strong><span class="total-amount">{{ number_format($cart->getTotalAmount()) }}</span></strong> VNĐ</div>
			<div class="col-xs-6 col-sm-6 col-md-9 text-right pb-10">Phí giao hàng nhanh</div>
			<div class="col-xs-6 col-sm-6 col-md-3 text-right pb-10">0 VNĐ</div>
			<div class="col-xs-6 col-sm-6 col-md-9 text-right pb-10">Chiết khấu theo chương</div>
			<div class="col-xs-6 col-sm-6 col-md-3 text-right pb-10">0 VNĐ</div>
			<div class="col-xs-8 col-sm-6 col-sm-offset-2 col-md-5 col-md-offset-4 text-right pb-10">
				<input type="text" class="form-control pull-right text-center" placeholder="Nhập mã số thưởng (nếu có)">
				<small>(Được áp dụng nhiều mã số thưởng)</small>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-3 pb-10">
				<button class="btn btn-default btn-block pull-right text-uppercase">Áp dụng</button>
			</div>
			<div class="col-xs-8 col-sm-6 col-sm-offset-2 col-md-4 col-md-offset-5 text-right pb-10">
				<strong>Trị giá đơn hàng</strong><br>
				<small>(Đã bao gồm VAT)</small>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-3 text-right pb-10">
				<strong><span class="total-amount">{{ number_format($cart->getTotalAmount()) }}</span></strong> VNĐ
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
				<td class="head">
					Phương thức thanh toán
				</td>
			</tr>
		</table>
		<div class="col-xs-2 col-sm-2 col-md-2 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 text-center payment-method active">
			<strong>Thanh toán<br>khi nhận hàng</strong><br>
			<img src="/frontend/images/cash.png" alt="cod"><br>
			<input type="checkbox" name="paymentmethod" checked>
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 text-center payment-method">
			<strong>Thẻ tín dụng</strong><br><br>
			<img src="/frontend/images/credit.png" alt="credit"><br>
			<input type="checkbox" name="paymentmethod">
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 text-center payment-method">
			<strong>Thẻ ATM nội địa</strong><br>(Internet banking)
			<img src="/frontend/images/atm.png" alt="atm"><br>
			<input type="checkbox" name="paymentmethod">
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 text-center payment-method">
			<strong>Chuyển khoản</strong><br>(ATM/Ngân hàng)<br>
			<img src="/frontend/images/bank.png" alt="bank"><br>
			<input type="checkbox" name="paymentmethod">
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 text-center payment-method">
			<strong>Thanh toán sau</strong><br>(Dành cho nhân viên)<br>
			<img src="/frontend/images/nhanvien.png" alt="nhanvien"><br>
			<input type="checkbox" name="paymentmethod">
		</div>
		<div class="col-xs-10 col-sm-10 col-md-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
			<br>
			<p>Bạn sẽ thanh toán tiền mặt khi nhận hàng tại nhà</p>
			<p><u>Lưu ý:</u><br>
				<ul>
					<li>Bạn kiểm tra kỹ thông tin đơn hàng bên tay phải (địa chỉ giao hàng, sản phẩm &amp; số lượng, đơn giá, thành tiền)</li>
					<li>Thông tin này sẽ không thể thay đổi khi đơn hàng được xác nhận thành công</li>
				</ul>
			</p>
			<br>
		</div>
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-10">
	<a class="btn btn-default btn-block btn-shopping btn-arrow">Xác nhận<br>mua hàng <span class="glyphicon glyphicon-play glyphicon-lg"></span></a>
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection