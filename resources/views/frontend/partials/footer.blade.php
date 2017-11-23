@inject('config', 'App\Config')
<footer>
	@if(Auth::check())
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<a href="#"><img src="/frontend/images/logo_asgroup.png" alt="logo ASGroup"></a><br>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				Địa chỉ: {{ $config->getValueByKey('headquarter_address_street') }}, {{ $config->getValueByKey('headquarter_address_ward') }}<br>
				{{ $config->getvalueByKey('headquarter_address_district') }}, {{ $config->getValueByKey('headquarter_address_locality') }}<br>
				Hotline: <a href="tel:{{ $config->getValueByKey('hot_line') }}"><strong>{{ $config->getValueByKey('hot_line') }}</strong></a><br>
				Email: <a href="mailto:{{ $config->getValueByKey('address_received_mail') }}">{{ $config->getValueByKey('address_received_mail') }}</a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<ul class="list-unstyled">
							<li><a href="{{ route('article', ['categorykey' => 've-chung-toi', 'key' => 'gioi-thieu']) }}">Giới thiệu</a></li>
							<li><a href="{{ route('article', ['categorykey' => 've-chung-toi', 'key' => 'cac-cau-hoi-thuong-gap']) }}">Các câu hỏi thường gặp</a></li>
							<li><a href="{{ route('article', ['categorykey' => 've-chung-toi', 'key' => 'dieu-khoan-su-dung']) }}">Điều khoản sử dụng</a></li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<ul class="list-unstyled">
							<li><a href="{{ route('article', ['categorykey' => 'huong-dan', 'key' => 'phuong-thuc-dat-hang']) }}">Phương thức đặt hàng</a></li>
							<li><a href="{{ route('article', ['categorykey' => 'huong-dan', 'key' => 'phuong-thuc-thanh-toan']) }}">Phương thức thanh toán</a></li>
							<li><a href="{{ route('article', ['categorykey' => 'huong-dan', 'key' => 'phuong-thuc-giao-hang']) }}">Phương thức giao hàng</a></li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<ul class="list-unstyled">
							<li><a href="{{ route('article', ['categorykey' => 'chinh-sach', 'key' => 'chinh-sach-bao-mat']) }}">Chính sách bảo mật</a></li>
							<li><a href="{{ route('article', ['categorykey' => 'chinh-sach', 'key' => 'chinh-sach-doi-tra']) }}">Chính sách đổi trả</a></li>
							<li><a href="{{ route('article', ['categorykey' => 'chinh-sach', 'key' => 'chinh-sach-bao-hanh']) }}">Chính sách bảo hành</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	@else
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6">
				<a href="#"><img src="/frontend/images/logo_asgroup.png" alt="logo ASGroup"></a><br>
				Hotline: <a href="tel:{{ $config->getValueByKey('hot_line') }}"><strong>{{ $config->getValueByKey('hot_line') }}</strong></a><br>
				Email: <a href="mailto:{{ $config->getValueByKey('address_received_mail') }}">{{ $config->getValueByKey('address_received_mail') }}</a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<ul class="list-unstyled">
							<li><a href="{{ route('article', ['categorykey' => 've-chung-toi', 'key' => 'gioi-thieu']) }}">Giới thiệu</a></li>
							<li><a href="{{ route('article', ['categorykey' => 've-chung-toi', 'key' => 'cac-cau-hoi-thuong-gap']) }}">Các câu hỏi thường gặp</a></li>
							<li><a href="{{ route('article', ['categorykey' => 've-chung-toi', 'key' => 'dieu-khoan-su-dung']) }}">Điều khoản sử dụng</a></li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<ul class="list-unstyled">
							<li><a href="{{ route('article', ['categorykey' => 'huong-dan', 'key' => 'phuong-thuc-dat-hang']) }}">Phương thức đặt hàng</a></li>
							<li><a href="{{ route('article', ['categorykey' => 'huong-dan', 'key' => 'phuong-thuc-thanh-toan']) }}">Phương thức thanh toán</a></li>
							<li><a href="{{ route('article', ['categorykey' => 'huong-dan', 'key' => 'phuong-thuc-giao-hang']) }}">Phương thức giao hàng</a></li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<ul class="list-unstyled">
							<li><a href="{{ route('article', ['categorykey' => 'chinh-sach', 'key' => 'chinh-sach-bao-mat']) }}">Chính sách bảo mật</a></li>
							<li><a href="{{ route('article', ['categorykey' => 'chinh-sach', 'key' => 'chinh-sach-doi-tra']) }}">Chính sách đổi trả</a></li>
							<li><a href="{{ route('article', ['categorykey' => 'chinh-sach', 'key' => 'chinh-sach-bao-hanh']) }}">Chính sách bảo hành</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
	<div class="register-trade">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					CÔNG TY TNHH THƯƠNG MẠI ĐẦU TƯ ÁNH SAO<br>
					GIẤY CNĐKKD: 0311416956 - Ngày cấp: 15/12/2011.<br>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					Copyright &copy; 2017 AS Group. All Rights Reserved.<br>
					Online: <strong>513</strong> - Truy cập: <strong>1003</strong> - Tổng truy cập: <strong>34237</strong>
				</div>
				<div class="col-xs-6 col-sm-3 col-md-2">
					<a href="https://sealsplash.geotrust.com/splash?&dn=sunmart-online.com" target="_blank"><img src="https://sealsplash.geotrust.com/images/ssl-valid-en-M.gif" alt="geotrust" style="width: 45%" class="img-reponsive"></a>
					<a href="http://online.gov.vn/CustomWebsiteDisplay.aspx?DocId=38603" target="_blank"><img src="http://online.gov.vn/Images/dathongbao.png" alt="geotrust" style="width: 52%" class="img-reponsive"></a>
				</div>
			</div>
		</div>
	</div>
</footer>