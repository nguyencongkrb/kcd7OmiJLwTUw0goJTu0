@extends('frontend.layouts.master')

@section('customize.js.head')
<link href="/frontend/vendor/bxslider/jquery.bxslider.min.css" rel="stylesheet" />
<link href="/frontend/vendor/barrating/themes/bootstrap-stars.css" rel="stylesheet" type="text/css">
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
<script src="/frontend/vendor/barrating/jquery.barrating.min.js"></script>
@endsection

@section('customize.js')
<script type="text/javascript">
	$(document).ready(function(){
		$('.bxslider').bxSlider({
			pagerCustom: '#bx-pager'
		});

		$('#comment_vote').barrating({
			theme: 'bootstrap-stars',
			initialRating: 4,
            showSelectedRating: true
		});

	  	$('#comment_vote_avg').barrating({
			theme: 'bootstrap-stars',
			readonly: true,
			initialRating: Math.floor(parseFloat($('#comment_vote_avg').data('current-rating')))
		});

		$("#frmComment").validate({
			lang: 'vi',
			errorClass: 'text-danger'
		});
	});
</script>
@endsection