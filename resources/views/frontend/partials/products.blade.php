@foreach($products as $product)
<div class="col-xs-12 col-sm-6 col-md-4 products-item">
	<div class="products-item-thumbnail">
		<a href="{{ $product->getLink() }}"><img src="{{ $product->getFirstAttachment('custom', 360, 0) }}" alt="{{ $product->name }}" class="img-responsive"></a>
	</div>
	<div class="products-item-name">
		<a href="{{ $product->getLink() }}">{{ $product->name }} - <span class="text-uppercase">{{ $product->code }}</span></a>
	</div>
	<div class="products-item-price">
		{{ number_format($product->getLatestPrice(), 0, ',', '.') }} <small>VNĐ</small>
	</div>
</div>
@if($loop->iteration % 3 == 0)
<div class="clearfix visible-md visible-lg"></div>
@endif
@endforeach