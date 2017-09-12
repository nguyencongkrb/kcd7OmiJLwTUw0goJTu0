@extends('frontend.layouts.master')

@section('customize.js.head')
<script type="application/ld+json">{!! $product->getJSONLD() !!}</script>
@endsection

@section('plugins.css')
<link rel="stylesheet" type="text/css" href="/frontend/js/swipebox/src/css/swipebox.min.css">
@endsection

@section('customize.css')
@endsection

@section('body')
<!-- Breadcrumb Start-->
<ul class="breadcrumb">
	<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>
	<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{ $product->productCategories()->first()->getLink() }}" itemprop="url"><span itemprop="title">{{ $product->productCategories()->first()->name }}</span></a></li>
	<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{{ $product->getLink() }}" itemprop="url"><span itemprop="title">{{ $product->name }}</span></a></li>
</ul>
<!-- Breadcrumb End-->
<div class="row">
	@include('frontend.partials.productsidebar')
	@include('frontend.partials.product')
</div>
@endsection

@section('plugins.js')
<script type="text/javascript" src="/frontend/js/jquery.elevateZoom-3.0.8.min.js"></script>
<script type="text/javascript" src="/frontend/js/swipebox/lib/ios-orientationchange-fix.js"></script>
<script type="text/javascript" src="/frontend/js/swipebox/src/js/jquery.swipebox.min.js"></script>
@endsection

@section('customize.js')
<script type="text/javascript">
// Elevate Zoom for Product Page image
$("#zoom_01").elevateZoom({
	gallery:'gallery_01',
	cursor: 'pointer',
	galleryActiveClass: 'active',
	imageCrossfade: true,
	zoomWindowFadeIn: 500,
	zoomWindowFadeOut: 500,
	lensFadeIn: 500,
	lensFadeOut: 500,
	loadingIcon: '/frontend/image/progress.gif'
	}); 
//////pass the images to swipebox
$("#zoom_01").bind("click", function(e) {
  var ez =   $('#zoom_01').data('elevateZoom');
	$.swipebox(ez.getGalleryList());
  return false;
});
</script>
@endsection