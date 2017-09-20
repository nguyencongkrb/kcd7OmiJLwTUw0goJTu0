<div class="col-xs-12 col-sm-12 col-md-12">
	<h1 class="product-title">{{ $product->name }}</h1>
</div>
<div class="col-xs-12 col-sm-12 col-md-6 pb-10">
	<div class="product-thumbnail">
		<ul class="bxslider">
			@foreach($product->getVisibleAttachments() as $item)
			<li><img src="{{ $item->getLink('custom', 555, 0) }}" alt="{ $product->name }}"></li>
			@endforeach
		</ul>
	</div>
	<div id="bx-pager" class="product-thumbnail-list">
		@foreach($product->getVisibleAttachments() as $item)
		<a data-slide-index="{{ $loop->index }}" href=""><img src="{{ $item->getLink('custom', 84, 0) }}" /></a>
		@endforeach
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-6">
	<div class="product-price">
		{{ number_format($product->getLatestPrice(), 0, ',', '.') }} <small>VNĐ</small>
	</div>
	<div class="product-promotion">
		<a href="#">Chương trình khuyến mãi</a><br>
		<span>(Click để xem chi tiết)</span>
	</div>
	<div class="product-action">
		<div class="row">
			<div class="col-xs-6 col-sm-12 col-md-4">
				<button class="btn btn-default btn-block add-to-cart quick-add-to-cart go-payment" type="button" data-product_id="{{ $product->id }}" data-product_price="{{ $product->getLatestPrice() }}">Mua ngay</button>
				<a href="{{ route('article', ['categorykey' => 'huong-dan', 'key' => 'phuong-thuc-dat-hang']) }}"><span>(Xem phương thức mua hàng)</span></a>
			</div>
			<div class="col-xs-6 col-sm-12 col-md-4 text-center">
				<button class="btn btn-default goshoppingcart btn-block add-to-cart quick-add-to-cart" type="button" data-product_id="{{ $product->id }}" data-product_price="{{ $product->getLatestPrice() }}">
					<img src="/frontend/images/icon_shoppingcart2.png" alt="Thêm vào giỏ hàng">
				</button>
				<a href="{{ route('article', ['categorykey' => 'huong-dan', 'key' => 'phuong-thuc-dat-hang']) }}"><span>(Thêm vào giỏ hàng)</span></a>
			</div>
		</div>
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 product-description">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Thông tin sản phẩm</a></li>
		<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Quy cách sản phẩm</a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane fade in active" id="home">
			{!! $product->description !!}
		</div>
		<div role="tabpanel" class="tab-pane fade" id="profile">
			{!! $product->additional_information !!}
		</div>
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 product-review">
	<strong>Xin vui lòng chia sẻ đánh giá của bạn về sản phẩm này</strong><br>
	<br>
	<form>
		<span>Nhận xét về sản phẩm này</span><br><br>
		<img src="/frontend/images/start.png" alt=""><br><br>
		<div class="form-group">
			<label>Tiêu đề đánh giá (tuỳ chọn)</label>
			<input type="text" class="form-control" placeholder="Nhập tiêu đề đánh giá tại đây">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Mô tả đánh giá</label>
			<textarea class="form-control" placeholder="Nhập mô tả tại đây"></textarea>
			<span class="help-block text-right">Nhận xét của <strong>{{ Auth::user()->getFullname() }}</strong></span>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 text-right">
					<button type="submit" class="btn btn-default">Gửi nhận xét</button>
				</div>
			</div>
		</div>
	</form>
	<div class="product-review-summary">
		<span>Điểm đánh giá trung bình của sản phẩm</span><br><br>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-12 col-md-4">
			<div class="row">
				<img src="/frontend/images/start2.png" alt=""><br><br>
				<strong style="font-size: 24px;">4.1</strong> trên 5<br>
				10 đánh giá 9 nhận xét
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8">
			<div class="row">
				<div class="clearfix">
					<span class="pull-left">5 sao</span>
					<div style="background: #f1f1f1; width: 150px; height: 12px; float: left; margin: 5px 10px;">
						<div style="width: 30%; height: 100%; background: #faca51">

						</div>
					</div>
					<span class="pull-">14</span>
				</div>
				<div class="clearfix">
					<span class="pull-left">4 sao</span>
					<div style="background: #f1f1f1; width: 150px; height: 12px; float: left; margin: 5px 10px;">
						<div style="width: 30%; height: 100%; background: #faca51">

						</div>
					</div>
					<span class="pull-">9</span>
				</div>
				<div class="clearfix">
					<span class="pull-left">3 sao</span>
					<div style="background: #f1f1f1; width: 150px; height: 12px; float: left; margin: 5px 10px;">
						<div style="width: 40%; height: 100%; background: #faca51">

						</div>
					</div>
					<span class="pull-">6</span>
				</div>
				<div class="clearfix">
					<span class="pull-left">2 sao</span>
					<div style="background: #f1f1f1; width: 150px; height: 12px; float: left; margin: 5px 10px;">
						<div style="width: 67%; height: 100%; background: #faca51">

						</div>
					</div>
					<span class="pull-">3</span>
				</div>
				<div class="clearfix">
					<span class="pull-left">1 sao</span>
					<div style="background: #f1f1f1; width: 150px; height: 12px; float: left; margin: 5px 10px;">
						<div style="width: 15%; height: 100%; background: #faca51">

						</div>
					</div>
					<span class="pull-">5</span>
				</div>
			</div>
		</div>
	</div>
</div>