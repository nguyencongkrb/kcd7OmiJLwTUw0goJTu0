<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SEOMeta;
use OpenGraph;
use DB;
use Log;
use Auth;
use Hash;
use Notification;
use DateTime;
use Cookie;
use Carbon\Carbon;
use App\Notifications\VerifyUser;
use App\Config;
use App\User;
use App\Role;
use App\Product;
use App\ProductCategory;
use App\ProductType;
use App\Producer;
use App\ShoppingCart;
use App\ShoppingCartDetail;
use App\Article;
use App\ArticleCategory;
use App\Http\Requests\Page\PageRequest;
use App\Mail\PurchaseOrder;
use App\Banner;
use App\BannerCategory;
use App\Contact;
use App\Notifications\ContactRequest;
use App\Province;
use App\District;
use App\InvoiceInfo;
use App\PromotionCode;
use App\DeliveryFee;
use App\AreaInfo;

// to return raw query
//DB::enableQueryLog();
//dd(DB::getQueryLog());

class PageController extends Controller
{
	public function __construct()
	{
		//$this->middleware('auth')->except(['locate', 'user.register', 'user.create', 'create.verify', 'user.login', 'user.resetpassword', 'user.resetpasswordform']);
		//$this->middleware('auth');
	}

	// for multi language site
	public function locate($locate)
	{
		Session::put('locale', $locate);
		return back();
	}

	public function index()
	{
		$this->setMetadata();

		$sliders = BannerCategory::findByKey('banner-trang-chu')->first()->banners()->where('published', 1)->orderBy('id', 'desc')->take(5)->get();
		$productCategories = ProductCategory::where('parent_id', 0)->where('published', 1)->orderBy('priority')->get();

		return view('frontend.pages.index', compact('sliders', 'productCategories'));
	}

	public function products($key = '')
	{
		$category = ProductCategory::findByKey($key)->where('published', 1)->first();
		if($category == null){
			abort(404);
		}

		$site_title = $category->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($category->meta_description);
		SEOMeta::setKeywords([$category->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $category->getLink());
		SEOMeta::addAlternateLanguage('en-us', $category->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($category->meta_description);
		OpenGraph::setUrl($category->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($category->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);

		$limit = Config::getValueByKey('rows_per_page_product');
		$products = $category->products()->where('published', 1)->orderBy('id', 'desc')->paginate($limit);

		return view('frontend.pages.products', compact('category', 'products'));
	}

	public function producer($key)
	{
		$producer = Producer::findByKey($key)->where('published', 1)->first();
		if($producer == null){
			abort(404);
		}

		$site_title = $producer->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($producer->meta_description);
		SEOMeta::setKeywords([$producer->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $producer->getLink());
		SEOMeta::addAlternateLanguage('en-us', $producer->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($producer->meta_description);
		OpenGraph::setUrl($producer->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		/*
		foreach ($producer->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		*/

		$limit = Config::getValueByKey('rows_per_page_product');
		$products = $producer->products()->where('published', 1)->orderBy('id', 'desc')->paginate($limit);

		return view('frontend.pages.products', compact('producer', 'products'));
	}

	public function product($categorykey, $key)
	{
		$category = ProductCategory::where('key', $categorykey)->where('published', 1)->first();
		if ($category == null) {
			abort(404);
		}
		$product = $category->products()->where('key', $key)->where('published', 1)->first();
		if ($product == null) {
			abort(404);
		}

		// metadata
		$site_title = $product->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($product->meta_description);
		SEOMeta::setKeywords([$product->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $product->getLink());
		SEOMeta::addAlternateLanguage('en-us', $product->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($product->meta_description);
		OpenGraph::setUrl($product->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'product');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($product->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		// end metadata

		// related products
		$relatedProducts = $product->relatedProducts()->where('published', 1)->take(6)->get();

		return view('frontend.pages.product',compact('product', 'relatedProducts'));
		
		//return response()->view('frontend.pages.product',compact('product', 'shippingInformation', 'relatedProducts', 'viewedProducts'))->withCookie(cookie('ViewedProducts', $cookieViewedProducts, 43200, '/'));
	}

	public function articles($key)
	{
		$category = ArticleCategory::where('key', $key)->where('published', 1)->first();

		if($category == null)
			abort(404);

		$limit = Config::getValueByKey('rows_per_page_article');
		$site_title = $category->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($category->meta_description);
		SEOMeta::setKeywords([$category->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $category->getLink());
		SEOMeta::addAlternateLanguage('en-us', $category->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($category->meta_description);
		OpenGraph::setUrl($category->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($category->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);

		$articles = $category->articles()->where('published', 1)->orderBy('id','desc')->paginate($limit);

		return view('frontend.pages.articles', compact('articles', 'category'));
	}

	public function article($categorykey, $key)
	{
		$category = ArticleCategory::where('key', $categorykey)->where('published', 1)->first();
		if ($category == null) {
			abort(404);
		}
		$article = $category->articles()->where('key', $key)->where('published', 1)->first();
		if ($article == null) {
			abort(404);
		}

		// metadata
		$site_title = $article->name;
		$site_name = Config::getValueByKey('site_name');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($article->meta_description);
		SEOMeta::setKeywords([$article->meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:published_time', $article->published_at, 'property');
		SEOMeta::addMeta('article:author', $facebook_page, 'property');
		SEOMeta::addMeta('article:publisher', $facebook_page, 'property');
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', $article->getLink());
		SEOMeta::addAlternateLanguage('en-us', $article->getLink());

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($article->meta_description);
		OpenGraph::setUrl($article->getLink());
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'article');
		OpenGraph::addProperty('locale', 'vi_VN');
		OpenGraph::addProperty('locale:alternate', ['vi_VN', 'en_US']);
		foreach ($article->getVisibleAttachments() as $attachment) {
			OpenGraph::addImage($attachment->getLink());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		// end metadata

		return view('frontend.pages.article', compact('article', 'category'));
	}

	public function search(PageRequest $request)
	{
		$this->setMetadata('Tìm kiếm', 'search');

		$products = [];
		$limit = Config::getValueByKey('rows_per_page_product');

		$request = request();
		$keyword = strip_tags($request->input('keyword', ''));

		// fillter
		//keyowrd=xxx&tag=tagid&producttype=producttypeid&orderby=price-desc

		$orderBy = explode('-', $request->query('orderby', ''));

		$query = Product::where('published', 1);

		if($request->query('tag', '') != ''){
			$query->whereHas('tags', function ($query) use ($request) {
				$query->where('id', $request->query('tag', ''));
			});
		}

		if($request->query('producttype', '') != ''){
			$query->whereHas('productTypes', function ($query) use ($request) {
				$query->where('id', $request->query('producttype', ''));
			});
		}

		$query->whereTranslationLike('name', '%'. $keyword .'%')->orWhere('code', 'LIKE', '%'. $keyword .'%');

		if (count($orderBy) == 2) {
			$query->orderBy($orderBy[0], $orderBy[1]);
		}

		$products = $query->orderBy('id', 'desc')->orderBy('id', 'desc')->paginate($limit);
		return view('frontend.pages.search', compact('products'));
	}

	public function shoppingCart()
	{
		$this->setMetadata('Giỏ hàng của bạn', 'shopping.cart');
		$cart = new ShoppingCart;
		$cartDetails = [];
		if (isset($_COOKIE['ShoppingCartData'])) {
			foreach (json_decode($_COOKIE['ShoppingCartData'], true) as $key => $value) {
				$cartDetail = new ShoppingCartDetail;
				$cartDetail->fill($value);
				array_push($cartDetails, $cartDetail);
			}
		}
		$cart->cartDetails = $cartDetails;

		return view('frontend.pages.shoppingcart', compact('cart'));
	}

	public function paymentInfo()
	{		
		if (isset($_COOKIE['ShoppingCartData'])) {
			$this->setMetadata('Thông tin thanh toán', 'payment.info');
			$provinces = Province::orderBy('name')->get();
			$districts = District::orderBy('name')->get();


			$cart = new ShoppingCart;
			$cartDetails = [];
			foreach (json_decode($_COOKIE['ShoppingCartData'], true) as $key => $value) {
				$cartDetail = new ShoppingCartDetail;
				$cartDetail->fill($value);
				array_push($cartDetails, $cartDetail);
			}
			$cart->cartDetails = $cartDetails;
			return view('frontend.pages.paymentinfo', compact('cart', 'provinces', 'districts'));
		}
		return redirect()->route('shopping.cart');
	}

	public function promotionCodeDetail($code)
	{
		$promotioncode = PromotionCode::where('code', $code)->whereColumn('quantity', '>', 'quantity_used')->whereDate('effective_date', '<=', Carbon::now())->whereDate('expiry_date', '>=', Carbon::now())->first();
		if(!$promotioncode)
			abort(404);
		return response()->json($promotioncode->toArray());
	}

	public function deliveryDetail($province_id)
	{
		$province = Province::findOrFail($province_id);

		$weight = 0;
		$cartDetails = [];
		if (isset($_COOKIE['ShoppingCartData'])) {
			foreach (json_decode($_COOKIE['ShoppingCartData'], true) as $key => $value) {
				$cartDetail = new ShoppingCartDetail;
				$cartDetail->fill($value);
				array_push($cartDetails, $cartDetail);
			}
		}

		foreach ($cartDetails as $cartDetail) {
			$weight += $cartDetail->quantity * $cartDetail->product->weight;
		}
		return response()->json(['fee' => $province->getDeliveryFee($weight), 'standard_delivery_days' => $province->getStandardDeliveryTime()->format('d/m/Y'), 'express_delivery_days' => $province->getExpressDeliveryTime()->format('d/m/Y')]);
	}

	public function purchase(PageRequest $request)
	{
		//return dd($request->all());
		$cart = new ShoppingCart;
		DB::transaction(function () use ($cart, $request) {
			//$cart->code = uniqid();
			$cart->code = 'SM-' . Carbon::now()->format('my') . '-' . mt_rand(100000,999999);
			$cart->customer_name = $request->input('ShoppingCart.customer_name', '');
			$cart->customer_phone = $request->input('ShoppingCart.customer_phone', '');
			$cart->customer_email = $request->input('ShoppingCart.customer_email', '');
			$cart->customer_address = $request->input('ShoppingCart.customer_address', '');
			$cart->province_id = $request->input('ShoppingCart.province_id');
			$cart->district_id = $request->input('ShoppingCart.district_id');

			$cart->shipping_address_same_order = $request->input('ShoppingCart.shipping_address_same_order', 1);
			if(!$cart->shipping_address_same_order){
				$cart->shipping_name = $request->input('ShoppingCart.shipping_name', '');
				$cart->shipping_phone = $request->input('ShoppingCart.shipping_phone', '');
				$cart->shipping_email = $request->input('ShoppingCart.shipping_email', '');
				$cart->shipping_address = $request->input('ShoppingCart.shipping_address', '');
				$cart->shipping_province_id = $request->input('ShoppingCart.shipping_province_id');
				$cart->shipping_district_id = $request->input('ShoppingCart.shipping_district_id');
			}
			
			$cart->customer_note = $request->input('ShoppingCart.customer_note', '');
			$cart->shopping_cart_status_id = 1;
			$cart->payment_method_id = $request->input('ShoppingCart.payment_method_id');
			$cart->delivery_method_id = (bool)$request->input('ShoppingCart.delivery_method_id');
			$cart->shipping_fee = $request->input('ShoppingCart.shipping_fee');

			if($cart->delivery_method_id){
				if($cart->shipping_address_same_order){
					$cart->delivery_date = Province::findOrFail($cart->province_id)->getExpressDeliveryTime();
				}
				else{
					$cart->delivery_date = Province::findOrFail($cart->shipping_province_id)->getExpressDeliveryTime();
				}
			}
			else{
				if($cart->shipping_address_same_order){
					$cart->delivery_date = Province::findOrFail($cart->province_id)->getStandardDeliveryTime();
				}
				else{
					$cart->delivery_date = Province::findOrFail($cart->shipping_province_id)->getStandardDeliveryTime();
				}
			}

			$cart->invoice_export = (bool)$request->input('ShoppingCart.invoice_export');
			
			if (!is_null(Auth::user())) {
				$cart->customer_id = Auth::user()->id;
				$cart->created_by = Auth::user()->id;
			}

			$cart->save();

			$cartDetails = [];
			foreach ($request->input('ShoppingCart.cartDetails', []) as $key => $value) {
				$cartDetail = new ShoppingCartDetail;
				$cartDetail->fill($value);
				$cartDetail->product_price = $cartDetail->product->getLatestPrice();
				array_push($cartDetails, $cartDetail);
			}
			$cart->cartDetails()->saveMany($cartDetails);

			if($cart->invoice_export){
				$invoice = new InvoiceInfo;
				$invoice->company_name = $request->input('ShoppingCart.invoiceInfo.company_name', '');
				$invoice->company_address = $request->input('ShoppingCart.invoiceInfo.company_address', '');
				$invoice->tax_code = $request->input('ShoppingCart.invoiceInfo.tax_code', '');
				$cart->invoiceInfo()->save($invoice);
			}

			// sync promotionCodes
			$promotionCodes =  $request->input('ShoppingCart.promotionCodes', []);
			$promotionCodes = array_diff($promotionCodes, array('{2}'));
			if (count($promotionCodes) > 0) {
				// validate promotionCodes
				$ids = PromotionCode::whereIn('id', $promotionCodes)->whereColumn('quantity', '>', 'quantity_used')->whereDate('effective_date', '<=', Carbon::now())->whereDate('expiry_date', '>=', Carbon::now())->pluck('id');

				// update used promotion code
				PromotionCode::whereIn('id', $ids)->increment('quantity_used');

				$cart->promotionCodes()->attach($promotionCodes);
			}
		});

		Mail::to($cart->customer_email)
		->cc(Config::getValueByKey('address_received_mail'))
		->send(new PurchaseOrder($cart));

		return redirect()->route('purchase.success')
		->withCookie(Cookie::forget('ShoppingCartData'))
		->with('status', $cart->code);
	}

	public function purchaseSuccess()
	{
		$this->setMetadata('Mua hàng thành công', 'purchase.success');

		return view('frontend.pages.purchasesuccess');
	}

	public function orderCheck()
	{
		$this->setMetadata('Kiểm tra đơn hàng', 'order.check');
		return view('frontend.pages.ordercheck');
	}

	public function register()
	{
		if (Auth::check()) {
			return redirect()->route('home');
		}

		$this->setMetadata('Đăng ký', 'user.register');

		return view('frontend.pages.register');
	}

	public function createUser(PageRequest $request)
	{
		$password = $request->input('User.password');
		$user = new User;
		DB::transaction(function () use ($user, $password, $request) {
			$user->last_name = strip_tags($request->input('User.last_name', ''));
			$user->first_name = strip_tags($request->input('User.first_name', ''));
			$user->birthday = strip_tags($request->input('User.birthday', ''));
			if ($user->birthday == null) {
				$user->birthday = null;
			}
			else{
				$user->birthday = DateTime::createFromFormat('d/m/Y', $user->birthday);
			}
			$user->gender = $request->input('User.gender', '');
			if ($user->gender == null) {
				$user->gender = null;
			}
			$user->job_title = strip_tags($request->input('User.job_title', ''));
			$user->mobile_phone = strip_tags($request->input('User.mobile_phone', ''));
			$user->home_phone = strip_tags($request->input('User.home_phone', ''));
			$user->address = strip_tags($request->input('User.address', ''));
			$user->website = strip_tags($request->input('User.website', ''));
			$user->facebook = strip_tags($request->input('User.facebook', ''));
			$user->email = strip_tags($request->input('User.email', ''));
			$user->password = Hash::make($password);
			$user->confirmation_code = str_random(30);
			$user->type = 0;	// normal user
			$user->save();

			//Role::findByKey('Normal')->first()->users()->attach($user);
		});

		Notification::send($user, new VerifyUser($user));

		return redirect()->back()->with('status', 'Đăng ký tài khoản thành công! Vui lòng kích hoạt tài khoản với email bạn nhận được.');
	}

	public function createVerify($confirmationcode)
	{
		if(!$confirmationcode)
		{
			abort(404);
		}

		$user = User::whereConfirmationCode($confirmationcode)->first();

		if (!$user)
		{
			abort(404);
		}

		$user->active = 1;
		$user->confirmed = 1;
		$user->confirmation_code = null;
		$user->save();

		if ($user->type) {
			return redirect()->route('backend.login')->with('status', 'Tài khoản đã kích hoạt thành công. Vui lòng dùng chức năng khôi phục mật khẩu để tạo mật khẩu cho tài khoản!');
		}

		return redirect()->route('user.login')->with('status', 'Tài khoản đã kích hoạt thành công. Vui lòng đăng nhập!');
	}

	public function login()
	{
		if (Auth::check()) {
			return redirect()->route('home');
		}

		$this->setMetadata('Đăng nhập', 'user.login');

		return view('frontend.pages.login');
	}

	public function profile()
	{
		//if (Auth::check()) {
		//	return redirect()->route('home');
		//}

		$user = Auth::user();

		$this->setMetadata('Thông tin tài khoản', 'user.profile');

		return view('frontend.pages.profile', compact('user'));
	}

	public function updateProfile(PageRequest $request)
	{
		//if (Auth::check()) {
		//	abort('403');
		//}

		$user = Auth::user();
		DB::transaction(function () use ($user, $request) {
			$user->last_name = strip_tags($request->input('User.last_name', ''));
			$user->first_name = strip_tags($request->input('User.first_name', ''));
			$user->birthday = strip_tags($request->input('User.birthday', ''));
			if ($user->birthday == null) {
				$user->birthday = null;
			}
			else{
				$user->birthday = DateTime::createFromFormat('d/m/Y', $user->birthday);
			}
			$user->gender = strip_tags($request->input('User.gender', ''));
			if ($user->gender == null) {
				$user->gender = null;
			}
			$user->job_title = strip_tags($request->input('User.job_title', ''));
			$user->mobile_phone = strip_tags($request->input('User.mobile_phone', ''));
			$user->home_phone = strip_tags($request->input('User.home_phone', ''));
			$user->address = strip_tags($request->input('User.address', ''));
			$user->website = strip_tags($request->input('User.website', ''));
			$user->facebook = strip_tags($request->input('User.facebook', ''));
			$user->save();

			//Role::findByKey('Normal')->first()->users()->attach($user);
		});

		return redirect()->back()->with('status', 'Tài khoản đã cập nhật thành công!');
	}

	public function changePassword()
	{
		return redirect()->route('home');
		//if (Auth::check()) {
		//	abort('403');
		//}

		//$this->setMetadata('Thông tin tài khoản', 'user.profile');

		//return view('frontend.pages.profile');
	}

	public function updatePassword(PageRequest $request)
	{
		//if (Auth::check()) {
		//	abort('403');
		//}

		$password = $request->input('User.password', '');
		
		$user = Auth::user();
		$user->password = Hash::make($password);
		$user->save();
		return redirect()->back()->with('status', 'Mật mã của bạn đã cập nhật thành công!');
	}

	public function resetPassword()
	{
		if (Auth::check()) {
			return redirect()->route('home');
		}
		$this->setMetadata('Khôi phục mật mã', 'user.resetpassword');

		return view('frontend.pages.resetpasswordemail');
	}

	public function resetPasswordForm(Request $request, $token = null)
	{
		if (Auth::check()) {
			return redirect()->route('home');
		}

		$this->setMetadata('Tạo mật mã mới', 'user.resetpasswordform', ['token' => $token]);

		return view('frontend.pages.resetpasswordform')->with(
			['token' => $token, 'email' => $request->email]
		);
	}

	public function orderHistory()
	{

		$this->setMetadata('Lịch sử mua hàng', 'order.history');

		return view('frontend.pages.orderhistory');
	}

	public function orderDetail(PageRequest $request)
	{
		$code = $request->input('code', '');
		$cart = ShoppingCart::where('code', $code)->first();
		if(is_null($cart))
			abort(404);
		$this->setMetadata('Đơn hàng: ' . $code, 'order.check');
		return view('frontend.pages.orderdetail', compact('cart'));
	}

	public function contact()
	{
		$this->setMetadata('Liên hệ', 'contact');
		return view('frontend.pages.contact');
	}

	public function createContact(PageRequest $request)
	{
		$contact = new Contact;

		$contact->full_name = strip_tags($request->input('Contact.full_name', ''));
		$contact->email = strip_tags($request->input('Contact.email', ''));
		$contact->phone = strip_tags($request->input('Contact.phone', ''));
		$contact->subject =strip_tags( $request->input('Contact.subject', ''));
		$contact->content = strip_tags($request->input('Contact.content', ''));
 
		//save data contact
		$contact->save();

		Notification::send(User::where('type', 1)->get(), new ContactRequest($contact));

		if ($request->ajax()) {
			return response()->json($contact->toArray());
		}

		return redirect(route('contact'))->with('status', 'Nội dung liên hệ của quý khách đã được gửi đến ban quản trị. Chúng tôi sẽ phản hồi quý khách trong thời gian sớm nhất. Xin cảm ơn!');
	}

	private function setMetadata($prefix = '', $route = 'home', $routeParams = [])
	{
		// metadata
		$site_name = Config::getValueByKey('site_name');
		$site_title = Config::getValueByKey('site_title');
		if ($prefix != '') {
			$site_title = $prefix . ' - ' . $site_title;
		}
		$meta_description = Config::getValueByKey('meta_description');
		$meta_keywords = Config::getValueByKey('meta_keywords');
		$facebook_page = Config::getValueByKey('facebook_page');
		SEOMeta::setTitle($site_title);
		SEOMeta::setDescription($meta_description);
		SEOMeta::setKeywords([$meta_keywords]);
		SEOMeta::addMeta('copyright', $site_name);
		SEOMeta::addMeta('author', $site_name);
		SEOMeta::addMeta('robots', 'all');
		SEOMeta::addMeta('revisit-after', '1 days');
		SEOMeta::addMeta('article:author', $facebook_page);
		SEOMeta::addMeta('article:publisher', $facebook_page);
		SEOMeta::addMeta('fb:pages', Config::getValueByKey('facebook_fanpage_id'), 'property');
		SEOMeta::addMeta('fb:app_id', Config::getValueByKey('facebook_app_id'), 'property');
		SEOMeta::addAlternateLanguage('vi-vn', route($route, $routeParams));
		SEOMeta::addAlternateLanguage('en-us', route($route, $routeParams));

		OpenGraph::setTitle($site_title);
		OpenGraph::setDescription($meta_description);
		OpenGraph::setUrl(route($route, $routeParams));
		OpenGraph::setSiteName($site_name);
		OpenGraph::addProperty('type', 'website');

		/*
		$social_banner = BannerCategory::findByKey('banner-social')->first()->banners()->where('published', 1)->orderBy('id', 'desc')->take(5)->get();
		foreach ($social_banner as $key => $banner) {
			OpenGraph::addImage($banner->getFirstAttachment());
		}
		OpenGraph::addProperty('image:width', 1200);
		OpenGraph::addProperty('image:height', 628);
		*/
		// end metadata
	}
}
