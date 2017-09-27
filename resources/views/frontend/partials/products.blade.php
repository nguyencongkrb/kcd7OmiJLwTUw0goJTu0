@foreach($products as $product)
<div class="col-xs-12 col-sm-6 col-md-4 products-item">
	<div class="products-item-thumbnail content">
		<a href="{{ $product->getLink() }}">
			<div class="content-overlay"></div>
			<img src="{{ $product->getFirstAttachment('custom', 360, 0) }}" alt="{{ $product->name }}" class="img-responsive">
			<div class="content-details fadeIn-bottom">
				<div class="col-xs-5 col-sm-5">
				<a href="#" class="btn btn-default btn-block add-to-cart quick-add-to-cart go-payment" data-product_id="{{ $product->id }}" data-product_price="{{ $product->getLatestPrice() }}">Mua ngay</a>
			</div>
			<div class="col-xs-7 col-sm-7">
				<a href="#" class="btn btn-default btn-block goshoppingcart add-to-cart quick-add-to-cart" data-product_id="{{ $product->id }}" data-product_price="{{ $product->getLatestPrice() }}">
					Thêm vào giỏ hàng
				</a>
			</div>
			</div>
		</a>
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






<!-- <div class="container">
	<h3 class="title">Text fadeIn bottom</h3>
	<div class="content">
		<a href="https://unsplash.com/photos/HkTMcmlMOUQ" target="_blank">
			<div class="content-overlay"></div>
			<img class="content-image" src="https://images.unsplash.com/photo-1433360405326-e50f909805b3?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&w=1080&fit=max&s=359e8e12304ffa04a38627a157fc3362">
			<div class="content-details fadeIn-bottom">
				<h3 class="content-title">This is a title</h3>
				<p class="content-text">This is a short description</p>
			</div>
		</a>
	</div>
</div> -->