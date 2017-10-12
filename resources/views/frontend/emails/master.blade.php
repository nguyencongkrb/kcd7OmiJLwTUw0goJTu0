@inject('config', 'App\Config')
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<style type="text/css" rel="stylesheet" media="all">
	/* Media Queries */
	@media only screen and (max-width: 500px) {
		.button {
			width: 100% !important;
		}
	}
</style>
</head>

<?php

$style = [
	/* Layout ------------------------------ */

	'body' => 'margin: 0; padding: 0; width: 100%;',
	'email-wrapper' => 'width: 100%; margin: 0; padding: 0;',

	/* Masthead ----------------------- */

	'email-masthead' => 'padding: 25px 0; text-align: center;',
	'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

	'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #eaab00; border-bottom: 1px solid #eaab00; background-color: #FFF;',
	'email-body_inner' => 'width: auto; max-width: 100%; margin: 0 auto; padding: 0;',
	'email-body_cell' => 'padding: 35px;',

	'email-footer' => 'width: auto; max-width: 100%; margin: 0 auto; padding: 0; text-align: center;',
	'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

	/* Body ------------------------------ */

	'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
	'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #eaab00;',

	/* Type ------------------------------ */

	'anchor' => 'color: #3869D4;text-decoration: none;',
	'header-1' => 'margin-top: 0; color: #2F3133; font-size: 16px; font-weight: normal; text-align: left;',
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
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<body style="{{ $style['body'] }}">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td style="{{ $style['email-wrapper'] }}" align="center">
				<table width="100%" cellpadding="0" cellspacing="0">
					<!-- Logo -->
					<tr>
						<td style="{{ $style['email-masthead'] }}">
							<a style="{{ $fontFamily }} {{ $style['email-masthead_name'] }}" href="{{ url('/') }}" target="_blank">
								<img src="{{ url('/') }}/frontend/images/logo.png" alt="{{ $site_name = $config::getValueByKey('site_name') }}">
							</a>
						</td>
					</tr>

					<!-- Email Body -->
					<tr>
						<td style="{{ $style['email-body'] }}" width="100%">
							@yield('content')
						</td>
					</tr>

					<!-- Footer -->
					<tr>
						<td>
							<table style="{{ $style['email-footer'] }}" align="center" width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td style="{{ $fontFamily }} {{ $style['email-footer_cell'] }}">
										<p style="{{ $style['paragraph-sub'] }}">
											Cửa hàng quà tặng trực tuyến <strong>{{ $site_name }}</strong><br>
											Website: <a style="{{ $style['anchor'] }}" href="{{ url('/') }}" target="_blank">{{ preg_replace('/^https?:\/\//', '', url('/')) }}</a> | Email: <a style="{{ $style['anchor'] }}" href="{{ $config::getValueByKey('address_received_mail') }}">{{ $config::getValueByKey('address_received_mail') }}</a> | Hotline: <a style="{{ $style['anchor'] }}" href="tel:{{ $config::getValueByKey('hot_line') }}">{{ $config::getValueByKey('hot_line') }}</a><br>
											&copy; {{ date('Y') }} Bản quyền thuộc Tập đoàn Ánh Sao.
										</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
