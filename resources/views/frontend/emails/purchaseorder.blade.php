@extends('frontend.emails.master')

@section('content')
<?php

$style = [
	/* Layout ------------------------------ */

	'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
	'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

	/* Masthead ----------------------- */

	'email-masthead' => 'padding: 25px 0; text-align: center;',
	'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

	'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
	'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
	'email-body_cell' => 'padding: 35px;',

	'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
	'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

	/* Body ------------------------------ */

	'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
	'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',

	/* Type ------------------------------ */

	'anchor' => 'color: #3869D4;',
	'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
	'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
	'paragraph-sub' => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
	'paragraph-center' => 'text-align: center;',

	/* Buttons ------------------------------ */

	'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
				 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
				 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',

	'button--green' => 'background-color: #22BC66;',
	'button--red' => 'background-color: #dc4d2f;',
	'button--blue' => 'background-color: #3869D4;',

	/* Purchase Order ------------------------------ */
	'purchase-order' => 'margin-top: 0; margin-bottom: 10px; color: #74787E; font-size: 12px; line-height: 1.5em;border-collapse: collapse;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<table style="{{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
	<tr>
		<td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">
			<!-- Greeting -->
			<h1 style="{{ $style['header-1'] }}">
				Xin chào quý khách!
			</h1>

			<!-- Intro -->
			<p style="{{ $style['paragraph'] }}">
				Bên dưới là thông tin mua hàng của quý khách:
			</p>
			<p style="{{ $style['paragraph'] }}">
				Mã đơn hàng: <strong>{{ $cart->code }}</strong><br>
				Họ tên: {{ $cart->customer_name }}<br>
				Điện thoại: {{ $cart->customer_phone }}<br>
				Email: {{ $cart->customer_email }}<br>
				Địa chỉ: {{ $cart->customer_address }}, {{ $cart->customerDistrict->name }}, {{ $cart->customerProvince->name }}
			</p>
			@if(!$cart->shipping_address_same_order)
			<p style="{{ $style['paragraph'] }}">
				Họ tên người nhận: {{ $cart->shipping_name }}<br>
				Điện thoại: {{ $cart->shipping_phone }}<br>
				Email: {{ $cart->shipping_email }}<br>
				Địa chỉ: {{ $cart->shipping_address }}, {{ $cart->shippingDistrict->name }}, {{ $cart->shippingProvince->name }}
			</p>
			@endif
			<p style="{{ $style['paragraph'] }}">
				Trạng thái đơn hàng: {{ $cart->status->name }}<br>
				Phương thức thanh toán: {{ $cart->paymentMethod->name }}<br>
				Thời gian giao hàng dự kiến: {{ $cart->delivery_date->format('d/m/Y') }}
			</p>
			<p style="{{ $style['paragraph'] }}">
				Ghi chú: {{ $cart->customer_note }}
			</p>

			<table width="100%" cellpadding="3" cellspacing="3" align="center" border="1" style="{{ $style['purchase-order'] }}">
				<tr>
					<th>#</th>
					<th>Tên sản phẩm</th>
					<th>Mã sản phẩm</th>
					<th>Kích thước</th>
					<th>Màu sắc</th>
					<th>Số lượng</th>
					<th>Đơn giá</th>
					<th>Thành tiền</th>
				</tr>
				@foreach($cart->cartDetails as $item)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td><a style="{{ $style['anchor'] }}" href="{{ $item->product->getLink() }}">{{ $item->product->name }}</a></td>
					<td>{{ $item->product->code }}</td>
					<td>{{ isset($item->size) ? $item->size->name : null }}</td>
					<td>{{ isset($item->color) ? $item->color->name : null }}</td>
					<td style="text-align:right;">{{ number_format($item->quantity) }}</td>
					<td style="text-align:right;">{{ number_format($item->product_price) }}</td>
					<td style="text-align:right;">{{ number_format($item->product_price * $item->quantity) }}</td>
				</tr>
				@endforeach
				<tr>
					<td colspan="7">Phí vận chuyển</td>
					<td style="text-align:right;">{{ number_format($cart->shipping_fee) }}</td>
				</tr>
				<tr style="font-weight:bold;">
					<td colspan="7">Tổng cộng</td>
					<td style="text-align:right;">{{ number_format($cart->getTotalAmount() + $cart->shipping_fee) }}</td>
				</tr>
			</table>

			<!-- Salutation -->
			<p style="{{ $style['paragraph'] }}">
				Chân thành cảm ơn quý khách đã tin tưởng sử dụng sản phẩm của chúng tôi!
			</p>
		</td>
	</tr>
</table>
@endsection