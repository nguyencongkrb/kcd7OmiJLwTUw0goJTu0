<h3 class="subtitle">Sản phẩm liên quan</h3>
<div class="owl-carousel related_pro">
	@foreach($relatedProducts as $relatedProduct)
	<div class="product-thumb">
		<div class="image"><a href="{{ $relatedProduct->getLink() }}"><img src="{{ $relatedProduct->getFirstAttachment('custom', 350, 350) }}" alt="{{ $relatedProduct->name }}" title="{{ $relatedProduct->name }}" class="img-responsive" /></a></div>
		<div class="caption">
			<h4><a href="{{ $relatedProduct->getLink() }}">{{ $relatedProduct->name }}</a></h4>
			<p class="price">
				@if($relatedProduct->price == 0)
				Liên hệ
				@elseif($relatedProduct->getSaleRatio() > 0)
				<span class="price-new">{{ number_format($relatedProduct->getLatestPrice()) }}</span> 
				<span class="price-old">{{ number_format($relatedProduct->price) }}</span> 
				<span class="saving">-{{ $relatedProduct->getSaleRatio() }}%</span>
				@else
				{{ number_format($relatedProduct->price) }}
				@endif
			</p>
		</div>
	</div>
	@endforeach
</div>