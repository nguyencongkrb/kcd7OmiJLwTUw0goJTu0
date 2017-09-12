@inject('config', '\App\Config')
@inject('productCategory', '\App\ProductCategory')

@php
$productCategories = $productCategory::where('parent_id', 0)->where('published', 1)->orderBy('priority')->get();
@endphp

<div id="header">
	<!-- Top Bar Start-->
	<nav id="top" class="htop">
		<div class="container">
			<div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
				<div class="pull-left flip left-top">
					<div class="links">
						<ul>
							<li class="mobile"><a href="tel:{{ $config->getValuebyKey('hot_line') }}"><i class="fa fa-phone"></i>{{ $config->getValuebyKey('hot_line') }}</a></li>
							<li class="email"><a href="mailto:{{ $config->getValuebyKey('address_received_mail') }}"><i class="fa fa-envelope"></i>{{ $config->getValuebyKey('address_received_mail') }}</a></li>
							<li><a href="{{ route('contact') }}"><i class="fa fa-paper-plane" aria-hidden="true"></i> Liên hệ</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<!-- Top Bar End-->
	<!-- Header Start-->
	<header class="header-row">
		<div class="container">
			<div class="table-container">
				<!-- Logo Start -->
				<div class="col-table-cell col-lg-6 col-md-6 col-sm-12 col-xs-12 inner">
					<div id="logo"><h2><a href="/"><strong>{{ $config->getValuebyKey('site_name') }}</strong></a></h2></div>
				</div>
				<!-- Logo End -->
				<!-- Mini Cart Start-->
				<div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div id="cart">
					<a href="{{ route('shopping.cart') }}" class="heading"> <span class="cart-icon pull-left flip"></span> <span id="cart-total">0 Sản phẩm</span></a>
						</div>
					</div>
					<!-- Mini Cart End-->
					<!-- Search Start-->
					<div class="col-table-cell col-lg-3 col-md-3 col-sm-6 col-xs-12 inner">
						<div id="search" class="input-group">
							<form action="{{ route('search') }}" method="GET">
								<input id="filter_name" type="text" name="keyword" value="" placeholder="Tìm kiếm..." class="form-control input-lg" />
								<button type="button" class="button-search"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
					<!-- Search End-->
				</div>
			</div>
		</header>
		<!-- Header End-->
		<!-- Main Menu Start-->
		<div class="container">
			<nav id="menu" class="navbar">
				<div class="navbar-header"> <span class="visible-xs visible-sm"> Menu <b></b></span></div>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li><a class="home_link" title="Trang chủ" href="/"><span>Trang chủ</span></a></li>
						<li class="dropdown"><a>Danh mục sản phẩm</a>
							<div class="dropdown-menu">
								@foreach($productCategories as $productCategory)
								@if($loop->first)
								<ul>
								@endif
								<li><a href="{{ $productCategory->getLink() }}">{{ $productCategory->name }}</a></li>
								@if($loop->iteration % 4 == 0 && !$loop->last)
								</ul><ul>
								@endif
								@if($loop->last)
								</ul>
								@endif
								@endforeach
							</div>
						</li>
						<li class="custom-link"><a href="{{ route('articles', ['key' => 'tin-cong-nghe']) }}">Tin công nghệ</a></li>
						<li class="contact-link"><a href="{{ route('contact') }}">Liên hệ</a></li>
						<li class="custom-link-right"><a href="tel:{{ $config->getValuebyKey('hot_line') }}"><i class="fa fa-phone"></i> {{ $config->getValuebyKey('hot_line') }}</a></li>
					</ul>
				</div>
			</nav>
		</div>
		<!-- Main Menu End-->
	</div>