<div id="content" class="col-sm-9">
	<div itemscope itemtype="http://schema.org/Product">
		<h1 class="title" itemprop="name">{{ $product->name }}</h1>
		<div class="row product-info">
			<div class="col-sm-6">
				<div class="image">
					<img class="img-responsive" itemprop="image" id="zoom_01" src="{{ $product->getFirstAttachment('custom', 350, 350) }}" title="{{ $product->name }}" alt="{{ $product->name }}" data-zoom-image="{{ $product->getFirstAttachment('custom', 500, 500) }}" />
				</div>
				<div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> Click image for Gallery</span></div>
				<div class="image-additional" id="gallery_01"> 
					@foreach($product->getVisibleAttachments() as $attachment)
					<a class="thumbnail" href="#" data-zoom-image="{{ $attachment->getLink('custom', 350, 350) }}" data-image="{{ $attachment->getLink('custom', 350, 350) }}" title="{{ $product->name }}"> 
						<img src="{{ $attachment->getLink('custom', 66, 66) }}" title="{{ $product->name }}" alt = "{{ $product->name }}"/>
					</a>
					@endforeach
				</div>
			</div>
			<div class="col-sm-6">
				<ul class="list-unstyled description">
					<li><b>Nhà sản xuất:</b> <a href="{{ $product->producer->getLink() }}"><span itemprop="brand">{{ $product->producer->name }}</span></a></li>
					<li><b>Mã sản phẩm:</b> <span itemprop="mpn">{{ $product->code }}</span></li>
					<li><b>Bảo hành:</b> {{ $product->warranty }}</li>
					<li><b>Tình trạng:</b> <span class="instock">{{ $product->getAvailability() }}</span></li>
				</ul>
				<ul class="price-box">
					<li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
						@if($product->price == 0)
						Liên hệ
						@elseif($product->getSaleRatio() > 0)
						<span class="price-old">{{ number_format($product->price) }} đ</span> <span itemprop="price">{{ number_format($product->getLatestPrice()) }} đ<span itemprop="availability" content="In Stock"></span></span></li>
						@else
						{{ number_format($product->price) }} đ
						@endif
				</ul>
				<div id="product">
					<h3 class="subtitle hide">Available Options</h3>
					<div class="form-group required  hide">
						<label class="control-label">Màu sắc</label>
						<select id="input-color" class="form-control">
							@foreach($product->getVisibleColors() as $color)
							<option value="{{ $color->id }}">{{ $color->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="cart">
						<div>
							<div class="qty">
								<label class="control-label" for="input-quantity">Số lượng</label>
								<input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
								<a class="qtyBtn plus" href="javascript:void(0);">+</a><br />
								<a class="qtyBtn mines" href="javascript:void(0);">-</a>
								<div class="clear"></div>
							</div>
							<button type="button" id="button-cart" class="btn btn-primary btn-lg add-to-cart" data-product_id="{{ $product->id }}" data-product_price="{{ $product->getLatestPrice() }}">Mua hàng ngay</button>
						</div>
						<!-- <div>
							<button type="button" class="wishlist" onClick=""><i class="fa fa-heart"></i> Add to Wish List</button>
							<br />
							<button type="button" class="wishlist" onClick=""><i class="fa fa-exchange"></i> Compare this Product</button>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-description" data-toggle="tab">Mô tả sản phẩm</a></li>
			<li><a href="#tab-specification" data-toggle="tab">Thông tin thêm</a></li>
		</ul>
		<div class="tab-content">
			<div itemprop="description" id="tab-description" class="tab-pane active">
				{!! $product->description !!}
			</div>
			<div id="tab-specification" class="tab-pane">
				{!! $product->additional_information !!}
			</div>
		</div>
		@include('frontend.partials.relatedproducts')
	</div>
</div>