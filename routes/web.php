<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('backend/login', '\App\Http\Controllers\Backend\UserController@login')->name('backend.login');
Route::get('backend/password/reset', '\App\Http\Controllers\Backend\UserController@resetPassword')->name('backend.password.reset');
Route::get('backend/password/reset/{token}', '\App\Http\Controllers\Backend\UserController@showResetForm');

Route::group(['namespace' => 'Backend', 'prefix' => 'backend', 'middleware' => ['auth', 'backend.check']], function() {
	// Controllers Within The "App\Http\Controllers\Backend" Namespace

	Route::get('users/profile', 'UserController@profile')->name('users.profile');
	Route::post('users/passwordchange', 'UserController@passwordChange')->name('users.passwordchange');
	Route::post('users/filter', 'UserController@filter')->name('users.filter');
	Route::post('users/toggleactive', 'UserController@toggleActive')->name('users.toggleactive');
	Route::get('users/imports', 'UserController@imports')->name('users.importsform');
	Route::post('users/imports', 'UserController@importUsers')->name('users.imports');
	Route::resource('users', 'UserController');

	Route::resource('languages', 'LanguageController');
	Route::resource('uploads', 'UploadController');


	Route::get('dashboard/importprovinces', 'DashboardController@importProvinces')->name('dashboard.importprovinces');
	Route::resource('dashboard', 'DashboardController');
	
	Route::post('configs/filter', 'ConfigController@filter')->name('configs.filter');
	Route::post('configs/sitemap', 'ConfigController@createSitemap')->name('configs.createsitemap');
	Route::resource('configs', 'ConfigController');
	
	Route::post('tags/filter', 'TagController@filter')->name('tags.filter');
	Route::resource('tags', 'TagController');

	Route::post('articles/filter', 'ArticleController@filter')->name('articles.filter');
	Route::resource('articles', 'ArticleController');

	Route::post('articlecategories/filter', 'ArticleCategoryController@filter')->name('articlecategories.filter');
	Route::resource('articlecategories', 'ArticleCategoryController');
	
	Route::post('articletypes/filter', 'ArticleTypeController@filter')->name('articletypes.filter');
	Route::resource('articletypes', 'ArticleTypeController');

	Route::post('products/filter', 'ProductController@filter')->name('products.filter');
	Route::resource('products', 'ProductController');

	Route::post('productcategories/filter', 'ProductCategoryController@filter')->name('productcategories.filter');
	Route::resource('productcategories', 'ProductCategoryController');
	
	Route::post('producttypes/filter', 'ProductTypeController@filter')->name('producttypes.filter');
	Route::resource('producttypes', 'ProductTypeController');

	Route::post('productcolors/filter', 'ProductColorController@filter')->name('productcolors.filter');
	Route::resource('productcolors', 'ProductColorController');

	Route::post('productsizes/filter', 'ProductSizeController@filter')->name('productsizes.filter');
	Route::resource('productsizes', 'ProductSizeController');

	Route::post('producers/filter', 'ProducerController@filter')->name('producers.filter');
	Route::resource('producers', 'ProducerController');

	Route::post('bannercategories/filter', 'BannerCategoryController@filter')->name('bannercategories.filter');
	Route::resource('bannercategories', 'BannerCategoryController');

	Route::post('banners/filter', 'BannerController@filter')->name('banners.filter');
	Route::resource('banners', 'BannerController');

	Route::post('testimonials/filter', 'TestimonialController@filter')->name('testimonials.filter');
	Route::resource('testimonials', 'TestimonialController');

	Route::get('additionalvalues/hiddencontrols.js', 'AdditionalValueController@buildJsHiddenControls')->name('buildJsHiddenControls');
	Route::post('additionalvalues/filter', 'AdditionalValueController@filter')->name('additionalvalues.filter');
	Route::resource('additionalvalues', 'AdditionalValueController');

	Route::post('additionalcategories/filter', 'AdditionalCategoryController@filter')->name('additionalcategories.filter');
	Route::resource('additionalcategories', 'AdditionalCategoryController');

	Route::post('projects/filter', 'ProjectController@filter')->name('projects.filter');
	Route::resource('projects', 'ProjectController');

	Route::post('projectcategories/filter', 'ProjectCategoryController@filter')->name('projectcategories.filter');
	Route::resource('projectcategories', 'ProjectCategoryController');
	
	Route::post('projecttypes/filter', 'ProjectTypeController@filter')->name('projecttypes.filter');
	Route::resource('projecttypes', 'ProjectTypeController');

	Route::post('promotioncodes/filter', 'PromotionCodeController@filter')->name('promotioncodes.filter');
	Route::get('promotioncodes/imports', 'PromotionCodeController@imports')->name('promotioncodes.importsform');
	Route::post('promotioncodes/imports', 'PromotionCodeController@importPromotionCodes')->name('promotioncodes.imports');
	Route::resource('promotioncodes', 'PromotionCodeController');

	Route::post('shoppingcarts/filter', 'ShoppingCartController@filter')->name('shoppingcarts.filter');
	Route::resource('shoppingcarts', 'ShoppingCartController');

	Route::post('shoppingcartstatuses/filter', 'ShoppingCartStatusController@filter')->name('shoppingcartstatuses.filter');
	Route::resource('shoppingcartstatuses', 'ShoppingCartStatusController');

	Route::get('reports/sales', 'ReportController@sales')->name('reports.sales');
	Route::get('reports/salesbycategory', 'ReportController@salesByCategory')->name('reports.salesbycategory');
	Route::get('reports/salesbyproduct', 'ReportController@salesByProduct')->name('reports.salesbyproduct');
	Route::get('reports/salesbypaymentmethod', 'ReportController@salesByPaymentMethod')->name('reports.salesbypaymentmethod');
	Route::get('reports/salesbyprovince', 'ReportController@salesByProvince')->name('reports.salesbyprovince');
	Route::get('reports/inventory', 'ReportController@inventory')->name('reports.inventory');
	Route::resource('reports', 'ReportController');
});


// for multi language site
Route::get('/locate/{locate}.html', '\App\Http\Controllers\Frontend\PageController@locate')->name('locate');

Route::post('kiem-tra-nguoi-dung.html', '\App\Http\Controllers\Frontend\PageController@checkUserExists')->name('user.checkexists');
Route::get('dang-ky.html', '\App\Http\Controllers\Frontend\PageController@register')->name('user.register');
Route::post('dang-ky.html', '\App\Http\Controllers\Frontend\PageController@createUser')->name('user.create');
Route::get('xac-nhan-dang-ky/{confirmationcode}', '\App\Http\Controllers\Frontend\PageController@createVerify')->name('create.verify');
Route::get('dang-nhap.html', '\App\Http\Controllers\Frontend\PageController@login')->name('user.login');
Route::get('khoi-phuc-mat-ma.html', '\App\Http\Controllers\Frontend\PageController@resetPassword')->name('user.resetpassword');
Route::get('tao-mat-mat-moi/{token}', '\App\Http\Controllers\Frontend\PageController@resetPasswordForm')->name('user.resetpasswordform');
Route::post('tao-mat-mat-moi-qua-dien-thoai', '\App\Http\Controllers\Frontend\PageController@resetPasswordPhone')->name('user.resetpasswordphone');
Route::get('province/{province}/districts', '\App\Http\Controllers\Frontend\PageController@getDistrict')->name('province.districts');

Route::group(['namespace' => 'Frontend', 'middleware' => ['auth']], function()
{
	Route::get('/', 'PageController@index')->name('home');

	Route::get('lien-he.html', 'PageController@contact')->name('contact');
	Route::post('lien-he.html', 'PageController@createContact')->name('contact.create');

	Route::get('deliverydetail/{province}', 'PageController@deliveryDetail')->name('delivery.detail');
	Route::get('promotioncodes/{code}', 'PageController@promotionCodeDetail')->name('promotioncode.detail');

	Route::get('gio-hang.html', 'PageController@shoppingCart')->name('shopping.cart');
	Route::get('thong-tin-thanh-toan.html', 'PageController@paymentInfo')->name('payment.info');
	Route::get('xac-nhan-don-hang.html', 'PageController@getPurchaseConfirm')->name('purchase.getconfirm');
	Route::post('xac-nhan-don-hang.html', 'PageController@purchaseConfirm')->name('purchase.confirm');
	Route::post('thanh-toan.html', 'PageController@purchase')->name('purchase');
	Route::get('/paymentprocess/{code}', 'PageController@paymentProcess')->name('payment.process');
	Route::get('/paymentinfo', 'PageController@getInfoPayment')->name('payment.process.info');
	Route::get('mua-hang-thanh-cong.html', 'PageController@purchaseSuccess')->name('purchase.success');
	
	Route::get('thong-tin-thanh-vien.html', 'PageController@profile')->name('user.profile');
	Route::post('thong-tin-thanh-vien.html', 'PageController@updateProfile')->name('user.updateprofile');
	Route::get('thay-doi-mat-ma.html', 'PageController@changePassword')->name('user.changepassword');
	Route::post('thay-doi-mat-ma.html', 'PageController@updatePassword')->name('user.updatepassword');
	
	Route::get('lich-su-mua-hang.html', 'PageController@orderHistory')->name('order.history');
	Route::get('kiem-tra-don-hang.html', 'PageController@orderCheck')->name('order.check');
	Route::get('chi-tiet-don-hang.html', 'PageController@orderDetail')->name('order.detail');
	Route::get('updateorderstatus/{cart_id}/{status_id}', 'PageController@changeOrderStatus')->name('order.updatestatus');

	Route::post('createcomment', 'PageController@createComment')->name('comment.create');
	
	Route::get('tim-kiem.html', 'PageController@search')->name('search');

	// products category
	Route::get('san-pham/{key}', 'PageController@products')->name('products');

	// product detail
	Route::get('san-pham/{categorykey}/{key}.html', 'PageController@product')->name('product');

	// all products
	Route::get('san-pham.html', 'PageController@products')->name('allproducts');

	// products producer
	//Route::get('nha-san-xuat/{key}', 'PageController@producer')->name('producer');

	// articles category
	//Route::get('{key}', 'PageController@articles')->name('articles');

	// article detail
	//Route::get('{categorykey}/{key}.html', 'PageController@article')->name('article');
});
Route::get('{key}', '\App\Http\Controllers\Frontend\PageController@articles')->name('articles');
Route::get('{categorykey}/{key}.html', '\App\Http\Controllers\Frontend\PageController@article')->name('article');
