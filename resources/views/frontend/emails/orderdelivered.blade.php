@extends('frontend.emails.master')
@inject('config', 'App\Config')

@section('content')
<?php

$style = [
	/* Layout ------------------------------ */

	'body' => 'margin: 0; padding: 0; width: 100%;',
	'email-wrapper' => 'width: 100%; margin: 0; padding: 0;',

	/* Masthead ----------------------- */

	'email-masthead' => 'padding: 25px 0; text-align: center;',
	'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

	'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #eaab00; border-bottom: 1px solid #eaab00; background-color: #FFF;',
	'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
	'email-body_cell' => 'padding: 35px;',

	'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
	'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

	/* Body ------------------------------ */

	'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
	'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #eaab00;',

	/* Type ------------------------------ */

	'anchor' => 'color: #3869D4;text-decoration: none;',
	'header-1' => 'margin-top: 0; color: #74787E; font-size: 16px; font-weight: normal; text-align: left;',
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
	'purchase-order-list' => 'color: #74787E; font-size: 16px; line-height: 1.5em;',
	'purchase-order-list-span' => 'min-width: 140px; display:inline-block;',
	'purchase-order' => 'background-color:#f9df9c; margin-top: 0; margin-bottom: 10px; color: #74787E; font-size: 14px; line-height: 1.5em;border-collapse: collapse;',
	'purchase-order-head' => 'background-color:#eaab00; color:#333; font-weight: normal;',

	'fontFamily' => 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'
];
?>

<table style="{{ $style['fontFamily'] }} {{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
	<tr>
		<td style="{{ $style['fontFamily'] }} {{ $style['email-body_cell'] }}">
			<!-- Greeting -->
			<h1 style="{{ $style['header-1'] }}">
				Chào <strong>{{ $cart->customer_name }}</strong>,
			</h1>

			<!-- Intro -->
			<p style="{{ $style['paragraph'] }}">
				Cửa hàng quà tặng trực tuyến <strong>{{ $site_name = $config::getValueByKey('site_name') }}</strong> xin thông báo đã giao thành công đơn hàng có thông tin chi tiết như sau:
				<ul>
					<li style="{{ $style['purchase-order-list'] }}"><span style="{{ $style['purchase-order-list-span'] }}">Mã đơn hàng:</span><strong>{{ $cart->code }}</strong></li>
					<li style="{{ $style['purchase-order-list'] }}"><span style="{{ $style['purchase-order-list-span'] }}">Ngày đặt:</span><strong>{{ $cart->created_at->format('d/m/Y') }}</strong></li>
					<li style="{{ $style['purchase-order-list'] }}"><span style="{{ $style['purchase-order-list-span'] }}">Giờ đặt:</span><strong>{{ $cart->created_at->format('H:m') }}</strong></li>
				</ul>
			</p>

			<p style="{{ $style['paragraph'] }}">
				Mong quý khách tiếp tục ủng hộ Cửa hàng quà tặng trực tuyến {{ $site_name }} trong những lần mua sắm tiếp theo.
			</p>

			<!-- Salutation -->
			<p style="{{ $style['paragraph'] }}">
				Chúc quý khách một ngày vui vẻ!
			</p>
		</td>
	</tr>
</table>
@endsection