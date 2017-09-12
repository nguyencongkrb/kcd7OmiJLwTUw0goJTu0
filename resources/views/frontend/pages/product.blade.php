@extends('frontend.layouts.master')

@section('customize.js.head')
<link href="/frontend/vendor/bxslider/jquery.bxslider.min.css" rel="stylesheet" />
<script type="application/ld+json">{!! $product->getJSONLD() !!}</script>
@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="row">
	@include('frontend.partials.product')
</div>
@endsection

@section('plugins.js')
<script src="/frontend/vendor/bxslider/jquery.bxslider.min.js"></script>
@endsection

@section('customize.js')
<script type="text/javascript">
	$(document).ready(function(){
		$('.bxslider').bxSlider({
			pagerCustom: '#bx-pager'
		});
	});
</script>
@endsection