@extends('frontend.layouts.master')
@inject('productModel', 'App\Product')


@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="row">
	<!--Middle Part Start-->
	<div id="content" class="col-xs-12">
		@include('frontend.partials.slider')

		<!-- Bestsellers Product Start-->
		<h3 class="subtitle">Sản phẩm nổi bật</h3>
		<div class="owl-carousel product_carousel">
			@foreach($bestSellers as $product)
			<div class="product-thumb clearfix">
				<div class="image">
					<a href="{{ $product->getLink() }}">
						<img src="{{ $product->getFirstAttachment('custom', 350, 350) }}" alt="{{ $product->name }}" title="{{ $product->name }}" class="img-responsive" />
					</a>
				</div>
				<div class="caption">
					<h4><a href="{{ $product->getLink() }}">{{ $product->name }}</a></h4>
					<p class="price">
						@if($product->price == 0)
						Liên hệ
						@elseif($product->getSaleRatio() > 0)
						<span class="price-new">{{ number_format($product->getLatestPrice()) }}</span> 
						<span class="price-old">{{ number_format($product->price) }}</span> 
						<span class="saving">-{{ $product->getSaleRatio() }}%</span>
						@else
						{{ number_format($product->price) }}
						@endif
					</p>
				</div>
			</div>
			@endforeach
		</div>
		<!-- Featured Product End-->

		@foreach($productCategories as $productCategory)
		<h3 class="subtitle">{{ $productCategory->name }} - <a class="viewall" href="{{ $productCategory->getLink() }}">xem tất cả</a></h3>
		<div class="owl-carousel product_carousel">
			@foreach($productCategory->products()->where('published', 1)->orderBy('id', 'desc')->take(10)->get() as $product)
			<div class="product-thumb clearfix">
				<div class="image">
					<a href="{{ $product->getLink() }}">
						<img src="{{ $product->getFirstAttachment('custom', 350, 350) }}" alt="{{ $product->name }}" title="{{ $product->name }}" class="img-responsive" />
					</a>
				</div>
				<div class="caption">
					<h4><a href="{{ $product->getLink() }}">{{ $product->name }}</a></h4>
					<p class="price">
						@if($product->price == 0)
						Liên hệ
						@elseif($product->getSaleRatio() > 0)
						<span class="price-new">{{ number_format($product->getLatestPrice()) }}</span> 
						<span class="price-old">{{ number_format($product->price) }}</span> 
						<span class="saving">-{{ $product->getSaleRatio() }}%</span>
						@else
						{{ number_format($product->price) }}
						@endif
					</p>
				</div>
			</div>
			@endforeach
		</div>
		@endforeach

		<!-- Banner Start -->
		@if(!is_null($slidersBottom))
		<div class="marketshop-banner">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <a href="{{ $slidersBottom->link }}"><img title="{{ $slidersBottom->name }}" alt="{{ $slidersBottom->name }}" src="{{ $slidersBottom->getFirstAttachment('custom', 1140, 75) }}"></a></div>
			</div>
		</div>
		@endif
		<!-- Banner End -->
	</div>
	<!--Middle Part End-->
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection