<h1 class="article-title">Tài khoản của bạn</h1>
<hr>
<div class="list-group">
	<a href="{{ route('user.profile') }}" class="list-group-item {{ Route::currentRouteName() == 'user.profile' ? 'active' : null }}"><span class="glyphicon glyphicon-menu-right"></span> Thông tin tài khoản</a>
	<a href="{{ route('user.changepassword') }}" class="list-group-item {{ Route::currentRouteName() == 'user.changepassword' ? 'active' : null }}"><span class="glyphicon glyphicon-menu-right"></span> Đổi mật khẩu</a>
	<a href="{{ route('order.history') }}" class="list-group-item {{ Route::currentRouteName() == 'order.history' ? 'active' : null }}"><span class="glyphicon glyphicon-menu-right"></span> Lịch sử mua hàng</a>
</div>