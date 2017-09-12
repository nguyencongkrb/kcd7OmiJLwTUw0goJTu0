<div id="content" class="col-sm-9">
	<h1 class="title">
		@if(Route::is('allproducts'))
		Tất cả sản phẩm
		@elseif(Route::is('producer'))
		{{ $producer->name }}
		@elseif(Route::is('search'))
		Tìm kiếm
		@elseif(Route::is('products.byCategoryAndProducer'))
		{{ $category->name }} - {{ $producer->name }}
		@else
		{{ $category->name }}
		@endif
	</h1>
	@if(Route::is('products'))
	<h3 class="subtitle">Nhà sản xuất</h3>
	<div class="category-list-thumb row">
		@foreach($producers as $item)
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4"> <a href="{{ route('products.byCategoryAndProducer', ['categorykey' => $category->key, 'producerkey' => $item->key]) }}"><img src="{{ $item->getFirstAttachment('custom', 100, 100) }}" alt="{{ $item->name }}" /></a> <a href="{{ route('products.byCategoryAndProducer', ['categorykey' => $category->key, 'producerkey' => $item->key]) }}">{{ $item->name }}</a> </div>
		@endforeach
	</div>
	@endif
	<div class="product-filter hide">
		<div class="row">
			<div class="col-md-4 col-sm-5">
				<div class="btn-group">
					<button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
					<button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
				</div>
			</div>
			<div class="col-md-5 col-sm-2 text-right">
				<label class="control-label" for="input-sort">Sắp xếp:</label>
			</div>
			<div class="col-md-3 col-sm-2 text-right">
				<select id="input-sort" class="form-control col-sm-3">
					<option value="" selected="selected">Mặc định</option>
					<option value="key-asc">Tên sản phẩm (A - Z)</option>
					<option value="key-desc">Tên sản phẩm (Z - A)</option>
					<option value="price-asc">Giá (Thấp &gt; Cao)</option>
					<option value="price-desc">Giá (Cao &gt; Thấp)</option>
				</select>
			</div>
		</div>
	</div>
	<br />
	<div class="row products-category">
		@foreach($products as $product)
		<div class="product-layout product-list col-xs-12">
			<div class="product-thumb">
				<div class="image"><a href="{{ $product->getLink() }}"><img src="{{ $product->getFirstAttachment('custom', 350, 350) }}" alt="{{ $product->name }}" title="{{ $product->name }}" class="img-responsive" /></a></div>
				<div>
					<div class="caption">
						<h4><a href="{{ $product->getLink() }}"> {{ $product->name }}</a></h4>
						<p class="description"> {{ $product->summary }}</p>
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
			</div>
		</div>
		@endforeach
	</div>
	<div class="row">
		<div class="col-sm-12 text-center">
			{{ $products->links() }}
		</div>
	</div>
</div>