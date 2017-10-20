@inject('config', 'App\Config')
<header>
	@if(Auth::check())
	<div id="topbar">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-8 pull-right text-right">
					<ul class="list-inline">
						<li>
							<a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
							<form id="logout-form" action="{{ url('/logout') }}" method="POST" class="hide">
								{{ csrf_field() }}
							</form>
						</li>
						<li>Xin chào <a href="{{ route('user.profile') }}"><strong>{{ Auth::user()->getFullname() }}</strong></a></li>
						<li>
							<a href="{{ route('shopping.cart') }}">
								<img src="/frontend/images/icon_shopping_cart.png" alt="giỏ hàng"> <span id="cart-total">0</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		@endif
		<div class="container">
			<div class="row">
				<div id="logo" class="col-xs-12 col-sm-12 col-md-4">
					<a href="/"><img src="/frontend/images/logo.png" alt="logo"></a>
				</div>
				@if(Auth::check())
				<div class="col-xs-12 col-sm-12 col-md-8">
					<div class="pull-right">
						<div class="support customer_service">
							<a href="tel:{{ $config->getValueByKey('hot_line') }}">Chăm sóc Khách hàng<br><strong>{{ $config->getValueByKey('hot_line') }}</strong></a>
						</div>
						<div class="support chat_online">
							<a href="#">Tư vấn<br>Trực tuyến</a>
						</div>
						<div class="support question_answer">
							<a href="{{ route('article', ['categorykey' => 've-chung-toi', 'key' => 'cac-cau-hoi-thuong-gap']) }}">Hỏi đáp</a>
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</header>
	@if(Auth::check())
	<nav class="visible-md visible-lg">
		<div class="container text-center">
			<ul class="list-inline">
				<li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
				<li><a href="{{ route('article', ['categorykey' => 've-chung-toi', 'key' => 'gioi-thieu']) }}">Giới thiệu</a></li>
				<li><a href="{{ route('articles', ['categorykey' => 'kien-thuc-qua-tang']) }}">Kiến thức quà tặng</a></li>
				<li><a href="{{ route('articles', ['categorykey' => 'khuyen-mai']) }}">Khuyến mãi</a></li>
				<li><a href="{{ route('contact') }}">Liên hệ</a></li>
				<li><a href="{{ route('order.check') }}" class="last">Kiểm tra đơn hàng</a></li>
			</ul>
		</div>
	</nav>
	<div class="container hidden-md hidden-lg">
		<div class="list-group">
			<a href="/" class="list-group-item {{ Route::currentRouteName() == 'home' ? 'active' : null }}"><span class="glyphicon glyphicon-home"></span> Trang chủ</a>
			<a href="{{ route('article', ['categorykey' => 've-chung-toi', 'key' => 'gioi-thieu']) }}" class="list-group-item {{ Request::is('ve-chung-toi/gioi-thieu.html') ? 'active' : null }}"><span class="glyphicon glyphicon-star"></span> Giới thiệu</a>
			<a href="{{ route('articles', ['categorykey' => 'kien-thuc-qua-tang']) }}" class="list-group-item {{ Request::is('kien-thuc-qua-tang*') ? 'active' : null }}"><span class="glyphicon glyphicon-star"></span> Kiến thức quà tặng</a>
			<a href="{{ route('articles', ['categorykey' => 'khuyen-mai']) }}" class="list-group-item {{ Request::is('khuyen-mai*') ? 'active' : null }}"><span class="glyphicon glyphicon-star"></span> Khuyến mãi</a>
			<a href="{{ route('contact') }}" class="list-group-item {{ Request::is('lien-he.html') ? 'active' : null }}"><span class="glyphicon glyphicon-star"></span> Liên hệ</a>
			<a href="{{ route('order.check') }}" class="list-group-item {{ Request::is('kiem-tra-don-hang.html') ? 'active' : null }}"><span class="glyphicon glyphicon-star"></span> Kiểm tra đơn hàng</a>
		</div>
	</div>
	@endif