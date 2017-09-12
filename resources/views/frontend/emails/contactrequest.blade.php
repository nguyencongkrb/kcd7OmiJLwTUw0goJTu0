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
				Bên dưới là thông tin yêu cầu liên hệ của quý khách:
			</p>
			<p style="{{ $style['paragraph'] }}">
				Họ tên: {{ $contact->full_name }}<br>
				Điện thoại: {{ $contact->phone }}<br>
				Email: {{ $contact->email }}<br>
				Chủ đề: {{ $contact->subject }}
			</p>
			<p style="{{ $style['paragraph'] }}">
				Nội dung: {{ $contact->content }}
			</p>

			<!-- Salutation -->
			<p style="{{ $style['paragraph'] }}">
				Chân thành cảm ơn quý khách!
			</p>
		</td>
	</tr>
</table>
@endsection