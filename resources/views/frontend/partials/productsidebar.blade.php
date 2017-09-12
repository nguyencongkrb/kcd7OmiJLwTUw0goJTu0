@inject('productType', 'App\ProductType')
@inject('bannerCategory', 'App\BannerCategory')
<?php
$bestSellers = $productType::findByKey('san-pham-noi-bat')->first()->products()->where('published', 1)->orderBy('priority')->take(5)->get();
$slidersSidebar = $bannerCategory::findByKey('banner-sidebar')->first()->banners()->where('published', 1)->orderBy('priority')->take(3)->get();
?>

<aside id="column-left" class="col-sm-3 hidden-xs">
	<h3 class="subtitle">Sản phẩm nổi bật</h3>
	<div class="side-item">
		@foreach($bestSellers as $item)
		<div class="product-thumb clearfix">
			<div class="image"><a href="{{ $item->getLink() }}"><img src="{{ $item->getFirstAttachment('custom', 50, 50) }}" alt="{{ $item->name }}" title="{{ $item->name }}" class="img-responsive" /></a></div>
			<div class="caption">
				<h4><a href="{{ $item->getLink() }}">{{ $item->name }}</a></h4>
				<p class="price">
					@if($item->price == 0)
					Liên hệ
					@elseif($item->getSaleRatio() > 0)
					<span class="price-new">{{ number_format($item->getLatestPrice()) }}</span> 
					<span class="price-old">{{ number_format($item->price) }}</span> 
					<span class="saving">-{{ $item->getSaleRatio() }}%</span>
					@else
					{{ number_format($item->price) }}
					@endif
				</p>
			</div>
		</div>
		@endforeach
	</div>
	<div class="banner owl-carousel">
		@foreach($slidersSidebar as $item)
		<div class="item"> <a href="{{ $item->link }}"><img src="{{ $item->getFirstAttachment('custom', 256, 350) }}" alt="{{ $item->name }}" class="img-responsive" /></a> </div>
		@endforeach
	</div>
</aside>