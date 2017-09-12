@inject('config', '\App\Config')
@inject('article', '\App\Article')
@inject('bannerCategoty', '\App\BannerCategory')
<?php $featureBox = $article::findByKey('feature-box')->first(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="icon" type="image/png" href="/frontend/image/favicon.png" />
	{!! SEOMeta::generate() !!}
	{!! OpenGraph::generate() !!}
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="application/ld+json">{!! $config->getJSONLD() !!}</script>
	<!-- CSS Part Start-->
	<link rel="stylesheet" type="text/css" href="/frontend/js/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/frontend/css/font-awesome/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/frontend/css/stylesheet.css" />
	<link rel="stylesheet" type="text/css" href="/frontend/css/owl.carousel.css" />
	<link rel="stylesheet" type="text/css" href="/frontend/css/owl.transitions.css" />
	<link rel="stylesheet" type="text/css" href="/frontend/css/responsive.css" />
	<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<!-- CSS Part End-->
	@yield('customize.js.head')

	@yield('plugins.css')
	@yield('customize.css')

	{!! $config->getValuebyKey('embed_script_head') !!}
</head>
<body>
	<!-- Facebook Side Block Start -->
	<div id="facebook" class="fb-left sort-order-1">
		<div class="facebook_icon"><i class="fa fa-facebook"></i></div>
		<div class="fb-page" data-href="{{ $config->getValueByKey('facebook_page') }}" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true" data-show-posts="false">
			<div class="fb-xfbml-parse-ignore">
				<blockquote cite="{{ $config->getValueByKey('facebook_page') }}"><a href="{{ $config->getValueByKey('facebook_page') }}">{{ $config->getValueByKey('site_name') }}</a></blockquote>
			</div>
		</div>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	</div>
	<!-- Facebook Side Block End -->
	{!! $config->getValuebyKey('embed_script_body_top') !!}
	<div class="wrapper-wide">
		@if($config->getValuebyKey('website_maintenance') == '1')
		<div class="alert alert-warning"><i class="fa fa-warning"></i> {{ $config->getValuebyKey('website_maintenance_message') }}</div>
		@endif

		@include('frontend.partials.header')

		<div id="container">
			<!-- Feature Box Start-->
			{!! $featureBox->content !!}
			<!-- Feature Box End-->
			<div class="container">
				@yield('body')
			</div>
		</div>
		<!--Footer Start-->
		@include('frontend.partials.footer')
		<!--Footer End-->
	</div>
	<!-- JS Part Start-->
	<script type="text/javascript" src="/frontend/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/frontend/js/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/frontend/js/jquery.easing-1.3.min.js"></script>
	<script type="text/javascript" src="/frontend/js/jquery.dcjqaccordion.min.js"></script>
	<script type="text/javascript" src="/frontend/js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="/frontend/js/custom.js"></script>
	<script type="text/javascript" src="/frontend/vendor/numbro/numbro.min.js"></script>
	<script type="text/javascript" src="/frontend/vendor/moment/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="/frontend/vendor/cookie/js.cookie.js"></script>
	<script type="text/javascript" src="/frontend/js/ketnoimoi.core.js"></script>
	<script type="text/javascript" src="/frontend/js/ketnoimoi.site.js"></script>
	<!-- JS Part End-->
	@yield('plugins.js')
	@yield('customize.js')

	{!! $config->getValuebyKey('embed_script_body_bottom') !!}
</body>
</html>