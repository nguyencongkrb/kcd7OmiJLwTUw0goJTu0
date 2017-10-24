<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

	<!-- Sidebar user panel (optional) -->
	<div class="user-panel">
		<div class="pull-left image">
			<img src="/backend/img/user2-160x160.jpg" class="img-circle" alt="{{ Auth::user()->getFullname() }}">
		</div>
		<div class="pull-left info">
			<p>{{ Auth::user()->getFullname() }}</p>
			<!-- Status -->
			<a href="#"><i class="fa fa-circle text-success" aria-hidden="true"></i> Online</a>
		</div>
	</div>

	<!-- Sidebar Menu -->
	<ul class="sidebar-menu">
		<li class="header">TRÌNH ĐƠN</li>
		<!-- Optionally, you can add icons to the links -->
		<li><a target="_blank" href="/"><i class="fa fa-globe text-yellow" aria-hidden="true"></i> <span>Xem Online</span></a></li>
		<li class="{{ Request::is('backend/dashboard*') ? 'active' : null }} hide"><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard" aria-hidden="true"></i> <span>Màn hình chính</span></a></li>
		<li class="{{ Route::currentRouteName() == 'shoppingcarts.index' ? 'active' : null }}"><a href="{{ route('shoppingcarts.index') }}"><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Đơn hàng</span></a></li>
		<li class="treeview {{ (Request::is('backend/product*') || Request::is('backend/producers*')) ? 'active' : null }}">
			<a href="#"><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Sản phẩm</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right" aria-hidden="true"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li class="{{ Route::currentRouteName() == 'products.index' ? 'active' : null }}"><a href="{{ route('products.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Danh sách sản phẩm</a></li>
				<li class="{{ Route::currentRouteName() == 'productcategories.index' ? 'active' : null }}"><a href="{{ route('productcategories.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Danh mục sản phẩm</a></li>
				<li class="{{ Route::currentRouteName() == 'producers.index' ? 'active' : null }} hide"><a href="{{ route('producers.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Nhà sản xuất</a></li>
				<li class="{{ Route::currentRouteName() == 'productcolors.index' ? 'active' : null }} hide"><a href="{{ route('productcolors.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Màu sắc</a></li>
				<li class="{{ Route::currentRouteName() == 'productsizes.index' ? 'active' : null }} hide"><a href="{{ route('productsizes.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Kích thước</a></li>
				<li class="{{ Route::currentRouteName() == 'producttypes.index' ? 'active' : null }}"><a href="{{ route('producttypes.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Loại sản phẩm</a></li>
			</ul>
		</li>
		<li class="treeview {{ Request::is('backend/promotioncodes*') ? 'active' : null }}">
			<a href="#"><i class="fa fa-qrcode" aria-hidden="true"></i> <span>Mã khuyến mãi</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right" aria-hidden="true"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li class="{{ Route::currentRouteName() == 'promotioncodes.index' ? 'active' : null }}"><a href="{{ route('promotioncodes.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Danh sách mã khuyến mãi</a></li>
				<li class="{{ Route::currentRouteName() == 'promotioncodes.imports' ? 'active' : null }}"><a href="{{ route('promotioncodes.imports') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Import mã khuyến mãi</a></li>
			</ul>
		</li>
		<li class="treeview {{ Request::is('backend/article*') ? 'active' : null }}">
			<a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Bài viết</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right" aria-hidden="true"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li class="{{ Route::currentRouteName() == 'articles.index' ? 'active' : null }}"><a href="{{ route('articles.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Danh sách bài viết</a></li>
				@can('create', App\ArticleCategory::class)
				<li class="{{ Route::currentRouteName() == 'articlecategories.index' ? 'active' : null }}"><a href="{{ route('articlecategories.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Danh mục bài viết</a></li>
				@endcan
				@can('create', App\ArticleType::class)
				<li class="{{ Route::currentRouteName() == 'articletypes.index' ? 'active' : null }} hide"><a href="{{ route('articletypes.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Loại bài viết</a></li>
				@endcan
			</ul>
		</li>
		<li class="treeview {{ Request::is('backend/project*') ? 'active' : null }} hide">
			<a href="#"><i class="fa fa-flag-checkered" aria-hidden="true"></i> <span>Dự án</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right" aria-hidden="true"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li class="{{ Route::currentRouteName() == 'projects.index' ? 'active' : null }}"><a href="{{ route('projects.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Danh sách dự án</a></li>
				<li class="{{ Route::currentRouteName() == 'projectcategories.index' ? 'active' : null }}"><a href="{{ route('projectcategories.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Danh mục dự án</a></li>
				<li class="{{ Route::currentRouteName() == 'projecttypes.index' ? 'active' : null }}"><a href="{{ route('projecttypes.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Loại dự án</a></li>
			</ul>
		</li>
		<li class="treeview {{ Request::is('backend/banner*') ? 'active' : null }}">
			<a href="#"><i class="fa fa-bookmark-o" aria-hidden="true"></i> <span>Banner &amp; Video</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right" aria-hidden="true"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li class="{{ Route::currentRouteName() == 'banners.index' ? 'active' : null }}"><a href="{{ route('banners.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Danh sách banner &amp; video</a></li>
				@can('create', App\BannerCategory::class)
				<li class="{{ Route::currentRouteName() == 'bannercategories.index' ? 'active' : null }}"><a href="{{ route('bannercategories.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Danh mục banner</a></li>
				@endcan
			</ul>
		</li>
		<li class="{{ Request::is('backend/tag*') ? 'active' : null }} hide"><a href="{{ route('tags.index') }}"><i class="fa fa-tags" aria-hidden="true"></i> <span>Tag</span></a></li>
		<li class="{{ Request::is('backend/testimonials*') ? 'active' : null }} hide"><a href="{{ route('testimonials.index') }}"><i class="fa fa-comments" aria-hidden="true"></i> <span>Nhận xét khách hàng</span></a></li>
		<li class="{{ Request::is('backend/additionalvalues*') ? 'active' : null }} hide"><a href="{{ route('additionalvalues.index') }}"><i class="fa fa-object-group" aria-hidden="true"></i> <span>Giá trị bổ sung</span></a></li>
		<li class="treeview {{ Request::is('backend/reports*') ? 'active' : null }}">
			<a href="#"><i class="fa fa-pie-chart" aria-hidden="true"></i> <span>Thống kê</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right" aria-hidden="true"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li class="{{ Route::currentRouteName() == 'reports.sales' ? 'active' : null }}"><a href="{{ route('reports.sales') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Mua hàng</a></li>
				<li class="{{ Route::currentRouteName() == 'reports.salesbycategory' ? 'active' : null }} hide"><a href="{{ route('reports.salesbycategory') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Doanh số theo danh mục</a></li>
				<li class="{{ Route::currentRouteName() == 'reports.salesbyproduct' ? 'active' : null }}"><a href="{{ route('reports.salesbyproduct') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Doanh số theo sản phẩm</a></li>
				<li class="{{ Route::currentRouteName() == 'reports.salesbypaymentmethod' ? 'active' : null }}"><a href="{{ route('reports.salesbypaymentmethod') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Phương thức thanh toán</a></li>
				<li class="{{ Route::currentRouteName() == 'reports.salesbyprovince' ? 'active' : null }}"><a href="{{ route('reports.salesbyprovince') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Tỉnh thành</a></li>
				<li class="{{ Route::currentRouteName() == 'reports.inventory' ? 'active' : null }}"><a href="{{ route('reports.inventory') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Tồn kho</a></li>
			</ul>
		</li>
		@can('create', App\User::class)
		<li class="treeview {{ Request::is('backend/user*') ? 'active' : null }}">
			<a href="#"><i class="fa fa-users" aria-hidden="true"></i> <span>Người dùng</span>
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right" aria-hidden="true"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li class="{{ Route::currentRouteName() == 'users.index' ? 'active' : null }}"><a href="{{ route('users.index') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Danh sách người dùng</a></li>
				<li class="{{ Route::currentRouteName() == 'users.imports' ? 'active' : null }}"><a href="{{ route('users.imports') }}"><i class="fa fa-circle-o" aria-hidden="true"></i> Import người dùng</a></li>
			</ul>
		</li>
		@endcan
		@can('create', App\Config::class)
		<li class="{{ Request::is('backend/config*') ? 'active' : null }}"><a href="{{ route('configs.index') }}"><i class="fa fa-cogs" aria-hidden="true"></i> <span>Hệ thống</span></a></li>
		@endcan
	</ul>
	<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->