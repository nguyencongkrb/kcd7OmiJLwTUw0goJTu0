@extends('frontend.emails.master')
@inject('config', 'App\Config')

@section('content')
<?php

$style = [
	/* Layout ------------------------------ */

	'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6; font-family: Arial, Helvetica, sans-serif;',
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
	'purchase-order' => 'margin-top: 0; margin-bottom: 10px; color: #74787E; font-size: 14px; line-height: 1.5em;border-collapse: collapse;',

	'fontFamily' => 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;',
];
?>

<table style="{{ $style['fontFamily'] }} {{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
	<tr>
		<td style="{{ $style['fontFamily'] }} {{ $style['email-body_cell'] }}">
			<!-- Greeting -->
			<h1 style="{{ $style['header-1'] }}">
				Xin chào bạn {{ $cart->customer_name }}
			</h1>

			<!-- Intro -->
			<p style="{{ $style['paragraph'] }}">
				Lời đầu tiên cho phép Cửa hàng Quà Tặng <strong>{{ $site_name = $config::getValueByKey('site_name') }}</strong> kính chúc Quý Khách lời chúc sức khỏe
			</p>
			<p style="{{ $style['paragraph'] }}">
				Cảm ơn Quý Khách đã luôn luôn lựa chọn Cửa hàng Quà tặng <strong>{{ $site_name }}</strong> là nơi mua sắm
			</p>
			<p style="{{ $style['paragraph'] }}">
				Cửa hàng Quà tặng <strong>{{ $site_name }}</strong> chúng tôi đã nhận được đơn hàng của bạn ở trên hệ thống vào lúc {{ $cart->created_at->format('H:m') }} ngày {{ $cart->created_at->format('d/m/Y') }}
			</p>
			
			<p style="{{ $style['paragraph'] }}">
				Mã đơn hàng: <strong>{{ $cart->code }}</strong><br>
			</p>

			<table width="100%" cellpadding="3" cellspacing="3" align="center" border="1" style="{{ $style['purchase-order'] }}">
				<tr>
					<th>#</th>
					<th>Tên sản phẩm</th>
					<th>Số lượng</th>
					<th>Đơn giá</th>
					<th>Thành tiền</th>
				</tr>
				@foreach($cart->cartDetails as $item)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td><a style="{{ $style['anchor'] }}" href="{{ $item->product->getLink() }}">{{ $item->product->name }}</a></td>
					<td style="text-align:right;">{{ number_format($item->quantity) }}</td>
					<td style="text-align:right;">{{ number_format($item->product_price) }} <smal>VNĐ</smal></td>
					<td style="text-align:right;">{{ number_format($item->product_price * $item->quantity) }} <smal>VNĐ</smal></td>
				</tr>
				@endforeach
				<tr>
					<td style="text-align:right;" colspan="4">Giá trị đơn hàng</td>
					<td style="text-align:right;">{{ number_format($cart->getTotalAmount()) }} <smal>VNĐ</smal></td>
				</tr>
				<tr>
					<td style="text-align:right;" colspan="4">Chiết khấu</td>
					<td style="text-align:right;">- {{ number_format(0) }} <smal>VNĐ</smal></td>
				</tr>
				<tr>
					<td  style="text-align:right;"colspan="4">Mã thưởng</td>
					<td style="text-align:right;">- {{ number_format($cart->getTotalPromotionAmount()) }} <smal>VNĐ</smal></td>
				</tr>
				<tr>
					<td style="text-align:right;" colspan="4">Phí vận chuyển</td>
					<td style="text-align:right;">{{ number_format($cart->shipping_fee) }} <smal>VNĐ</smal></td>
				</tr>
				<tr style="font-weight:bold;">
					<td style="text-align:right;" colspan="4">Tổng tri giá</td>
					<td style="text-align:right;">{{ number_format($cart->getTotalPaymentAmount()) }} <smal>VNĐ</smal></td>
				</tr>
			</table>

			@if($cart->shipping_address_same_order)
			<p style="{{ $style['paragraph'] }}">
				Họ tên người nhận: {{ $cart->customer_name }}<br>
				<strong>Điện thoại</strong>: {{ $cart->customer_phone }}<br>
				Email: {{ $cart->customer_email }}<br>
				<strong>Địa chỉ nhận hàng</strong>: {{ $cart->customer_address }}, {{ $cart->customerDistrict->name }}, {{ $cart->customerProvince->name }}
			</p>
			@else
			<p style="{{ $style['paragraph'] }}">
				Họ tên người nhận: {{ $cart->shipping_name }}<br>
				<strong>Điện thoại</strong>: {{ $cart->shipping_phone }}<br>
				Email: {{ $cart->shipping_email }}<br>
				<strong>Địa chỉ nhận hàng</strong>: {{ $cart->shipping_address }}, {{ $cart->shippingDistrict->name }}, {{ $cart->shippingProvince->name }}
			</p>
			@endif
			<p style="{{ $style['paragraph'] }}">
				Trong vòng 24 tiếng, Tổng Đài CSKH của chúng tôi sẽ gọi điện cho bạn để xác nhận đơn hàng này.
			</p>
			<p style="{{ $style['paragraph'] }}">
				Nếu có gì thắc mắc xin vui lòng gửi email: <a href="{{ $config::getValueByKey('address_received_mail') }}">{{ $config::getValueByKey('address_received_mail') }}</a> hoặc liên hệ qua số HOTLINE: <a href="tel:{{ $config::getValueByKey('hot_line') }}"><strong>{{ $config::getValueByKey('hot_line') }}</strong></a>
			</p>

			<!-- Salutation -->
			<p style="{{ $style['paragraph'] }}">
				Xin trận trọng cảm ơn và hẹn gặp lại!
			</p>
		</td>
	</tr>
</table>
@endsection