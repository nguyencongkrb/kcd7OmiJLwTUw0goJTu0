@extends('frontend.layouts.master')
@inject('productModel', 'App\Product')


@section('plugins.css')
<link href="/frontend/vendor/OwlCarousel2/dist/assets/owl.carousel.min.css" rel="stylesheet">
<link href="/frontend/vendor/OwlCarousel2/dist/assets/owl.theme.default.min.css" rel="stylesheet">
@endsection

@section('customize.css')
@endsection

@section('body')

@include('frontend.partials.slider')
<div class="row">
	@foreach($productCategories as $category)
	@if($loop->iteration % 5 == 1)
	<div class="col-xs-12 col-sm-6 col-md-6 categories-link">
		@elseif($loop->iteration % 5 == 3)
	</div>
	<div class="col-xs-12 col-sm-6 col-md-6 categories-link">
		@elseif($loop->iteration % 5 == 0)
	</div>
	<div class="col-xs-12 col-sm-6 col-md-12 categories-link">
		@endif
		@if($loop->iteration % 5 == 0)
		<a href="{{ $category->getLink() }}"><img src="{{ $category->getFirstAttachment('custom', 1140, 0) }}" alt="{{ $category->name }}" class="img-responsive"></a>
		@else
		<a href="{{ $category->getLink() }}"><img src="{{ $category->getFirstAttachment('custom', 555, 0) }}" alt="{{ $category->name }}" class="img-responsive"></a>
		@endif

		@if($loop->last)
	</div>
	@endif
	@endforeach
</div>
@endsection

@section('plugins.js')
<script src="/frontend/vendor/jquery/jquery.min.js"></script>
<script src="/frontend/vendor/OwlCarousel2/dist/owl.carousel.min.js"></script>
@endsection

@section('customize.js')
<script type="text/javascript">
	$(document).ready(function(argument) {
		$('.owl-carousel').owlCarousel({
			items: 1,
			loop:true,
			lazyLoad: true,
			autoplay: true
		});
	});
</script>
@endsection