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
		<a data-slide-index="{{ $loop->index }}" href=""><img src="{{ $item->getLink('custom', 83, 0) }}" /></a>
		@endforeach
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-6">
	<div class="product-price">
		{{ number_format($product->getLatestPrice(), 0, ',', '.') }} <small>VNĐ</small>
	</div>
	@if($product->inventory_quantity == 0)
	<small class="label label-danger">Đã hết hàng</small>
	@endif
	<div class="product-promotion">
		<a href="#">Chương trình khuyến mãi</a><br>
		<span>(Click để xem chi tiết)</span>
	</div>
	<div class="product-action">
		<div class="row">
			<div class="col-xs-6 col-sm-12 col-md-4">
				<button class="btn btn-default btn-block add-to-cart quick-add-to-cart go-payment" type="button" data-product_id="{{ $product->id }}" data-product_price="{{ $product->getLatestPrice() }}" {{ $product->inventory_quantity == 0 ? 'disabled' : null }}>Mua ngay</button>
				<a href="{{ route('article', ['categorykey' => 'huong-dan', 'key' => 'phuong-thuc-dat-hang']) }}"><span>(Xem phương thức mua hàng)</span></a>
			</div>
			<div class="col-xs-6 col-sm-12 col-md-4 text-center">
				<button class="btn btn-default goshoppingcart btn-block add-to-cart quick-add-to-cart" type="button" data-product_id="{{ $product->id }}" data-product_price="{{ $product->getLatestPrice() }}" {{ $product->inventory_quantity == 0 ? 'disabled' : null }}>
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
	<form role="form" method="POST" id="frmComment" action="{{ route('comment.create') }}">
		<span>Nhận xét về sản phẩm này</span><br><br>
		{{ csrf_field() }}
		<input type="hidden" name="Comment[commentable_id]" value="{{ $product->id }}">
		<input type="hidden" name="Comment[commentable_type]" value="App\product">
		<select id="comment_vote" name="Comment[vote]">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4" selected>4</option>
			<option value="5">5</option>
		</select>
		<br>
		<div class="form-group">
			<label>Tiêu đề đánh giá (tuỳ chọn)</label>
			<input type="text" class="form-control" id="Comment[title]" name="Comment[title]" placeholder="Nhập tiêu đề đánh giá tại đây" maxlength="50">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Mô tả đánh giá</label>
			<textarea class="form-control" id="Comment[content]" name="Comment[content]" placeholder="Nhập mô tả tại đây" maxlength="250" required></textarea>
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
				<select id="comment_vote_avg" data-current-rating="{{ $vote_avg = $product->comments()->where('published', 1)->avg('vote') }}" autocomplete="off">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
				<br>
				<strong style="font-size: 24px;">{{ number_format($vote_avg, 1, ',', '.') }}</strong> trên 5<br>
				{{ $product->comments_count }} đánh giá {{ $product->comments_count }} nhận xét
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8">
			<div class="row">
				@php $product->comments_count = $product->comments_count == 0 ? 1 : $product->comments_count @endphp
				<div class="clearfix">
					<span class="pull-left">5 sao</span>
					<div class="percent-container">
						<div class="inner" style="width: {{ ($fivestar = $product->comments()->where('published', 1)->where('vote', 5)->count()) / $product->comments_count * 100 }}%;">

						</div>
					</div>
					<span class="pull-left">{{ $fivestar }}</span>
				</div>
				<div class="clearfix">
					<span class="pull-left">4 sao</span>
					<div class="percent-container">
						<div class="inner" style="width: {{ ($fourstar = $product->comments()->where('published', 1)->where('vote', 4)->count()) / $product->comments_count * 100 }}%;">

						</div>
					</div>
					<span class="pull-left">{{ $fourstar }}</span>
				</div>
				<div class="clearfix">
					<span class="pull-left">3 sao</span>
					<div class="percent-container">
						<div class="inner" style="width: {{ ($threestar = $product->comments()->where('published', 1)->where('vote', 3)->count()) / $product->comments_count * 100 }}%;">

						</div>
					</div>
					<span class="pull-left">{{ $threestar }}</span>
				</div>
				<div class="clearfix">
					<span class="pull-left">2 sao</span>
					<div class="percent-container">
						<div class="inner" style="width: {{ ($twostar = $product->comments()->where('published', 1)->where('vote', 2)->count()) / $product->comments_count * 100 }}%;">

						</div>
					</div>
					<span class="pull-left">{{ $twostar }}</span>
				</div>
				<div class="clearfix">
					<span class="pull-left">1 sao</span>
					<div class="percent-container">
						<div class="inner" style="width: {{ ($onestar = $product->comments()->where('published', 1)->where('vote', 1)->count()) / $product->comments_count * 100 }}%;">

						</div>
					</div>
					<span class="pull-left">{{ $onestar }}</span>
				</div>
			</div>
		</div>
		<div class="product-reviews clearfix">
			@foreach($product->comments()->where('published', 1)->orderby('id', 'desc')->get() as $comment)
			<div class="clearfix">
				<hr>
				@for ($i = 0; $i < $comment->vote; $i++)
				<span class="glyphicon glyphicon-star text-colored"></span> 
				@endfor
				<strong>{{ empty($comment->title) ? 'Không tiêu đề' : $comment->title }}</strong>
				<p>{{ $comment->content }}</p>
				<small class="pull-right">Nhận xét của <strong>{{ $comment->userCreated->getFullname() }}</strong></small>
			</div>
			@endforeach
			<div class="clearfix hide" id="comment-template">
				<hr>
				{0}
				<strong>{1}</strong>
				<p>{2}</p>
				<small class="pull-right">Nhận xét của <strong>{{ Auth::user()->getFullname() }}</strong></small>
			</div>
		</div>
	</div>
</div>