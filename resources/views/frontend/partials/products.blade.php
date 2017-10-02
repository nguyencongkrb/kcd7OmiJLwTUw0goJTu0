@foreach($products as $product)
<div class="col-xs-12 col-sm-6 col-md-4 products-item">
	<div class="products-item-thumbnail content">
		<a href="{{ $product->getLink() }}">
			<div class="content-overlay"></div>
			<img src="{{ $product->getFirstAttachment('custom', 360, 0) }}" alt="{{ $product->name }}" class="img-responsive">
			<div class="content-details fadeIn-bottom">
				@if($product->inventory_quantity > 0)
				<div class="col-xs-6 col-sm-6">
					<a href="#" class="btn btn-default btn-block add-to-cart quick-add-to-cart go-payment" data-product_id="{{ $product->id }}" data-product_price="{{ $product->getLatestPrice() }}">Mua ngay</a>
				</div>
				<div class="col-xs-6 col-sm-6">
					<a href="#" class="btn btn-default btn-block goshoppingcart add-to-cart quick-add-to-cart" data-product_id="{{ $product->id }}" data-product_price="{{ $product->getLatestPrice() }}">
						Thêm vào giỏ hàng
					</a>
				</div>
				@endif
			</div>
		</a>
	</div>
	<div class="products-item-name">
		<a href="{{ $product->getLink() }}">{{ $product->name }} - <span class="text-uppercase">{{ $product->code }}</span></a>
	</div>
	<div class="products-item-price">
		{{ number_format($product->getLatestPrice(), 0, ',', '.') }} <small>VNĐ</small>
		@if($product->inventory_quantity == 0)
		<small class="label label-danger">Đã hết hàng</small>
		@endif
	</div>
</div>
@if($loop->iteration % 3 == 0)
<div class="clearfix visible-md visible-lg"></div>
@endif
@endforeach