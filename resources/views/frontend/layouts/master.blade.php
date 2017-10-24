@inject('config', '\App\Config')
@inject('bannerCategoty', '\App\BannerCategory')
@php
$linkbg = '';
$bg = $bannerCategoty::findByKey('banner-dang-nhap')->first()->banners()->where('published', 1)->orderBy('id', 'desc')->first();
if($bg && Route::currentRouteName() != 'article')
$linkbg = $bg->getFirstAttachment('custom', 1920, 1280);
@endphp

<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link rel="icon" type="image/png" href="/frontend/images/favicon.png" />
	{!! SEOMeta::generate() !!}
	{!! OpenGraph::generate() !!}
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="application/ld+json">{!! $config->getJSONLD() !!}</script>

	<!-- Bootstrap -->
	<link href="/frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/frontend/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link href="/frontend/css/style.css" rel="stylesheet">
	<link href="/frontend/css/responsive.css" rel="stylesheet">
	@yield('customize.js.head')

	@yield('plugins.css')
	@yield('customize.css')

	{!! $config->getValuebyKey('embed_script_head') !!}
</head>
<body class="{{ Auth::guest() ? 'loginpage' : '' }} {{ Route::currentRouteName() == 'user.register' ? 'register' : null }}" style="background-image: url('{{ Auth::guest() ? $linkbg : null }}')">
	@include('frontend.partials.header')
	<section>
		<div class="container">
			@yield('body')
		</div>
	</section>
	@include('frontend.partials.footer')

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="/frontend/vendor/jquery/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/frontend/vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="/frontend/vendor/numbro/numbro.min.js"></script>
	<script src="/frontend/vendor/numbro/languages.min.js"></script>
	<script src="/frontend/vendor/moment/moment-with-locales.min.js"></script>
	<script src="/frontend/vendor/cookie/js.cookie.js"></script>
	<script src="/frontend/vendor/validate/jquery.validate.min.js"></script>
	<script src="/frontend/vendor/validate/additional-methods.min.js"></script>
	<script src="/frontend/vendor/validate/localization/messages_vi.min.js"></script>
	

	<script type="text/javascript">
		numbro.culture('vi-VN');
		moment.locale('vi');
	</script>

	<script src="/frontend/js/ketnoimoi.core.js"></script>
	<script src="/frontend/js/ketnoimoi.site.js"></script>
	@yield('plugins.js')
	@yield('customize.js')
	{!! $config->getValuebyKey('embed_script_body_bottom') !!}
</body>
</html>