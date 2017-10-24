<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShoppingCart;
use App\ShoppingCartDetail;
use App\Product;
use App\PaymentMethod;
use App\Province;
use DB;
use DateTime;
use App\Http\Requests\ReportRequest;

class ReportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}

	private function buildQuery($request, $query = null, $includeOrderCancel = false)
	{
		$fromDate = $request->input('fromdate', '');
		$toDate = $request->input('todate', '');
		if(is_null($query))
			$query = ShoppingCart::withCount('cartDetails');
		if(!$includeOrderCancel)
			$query = $query->where('shopping_cart_status_id', '<>', 1);

		if ($fromDate != '') {
			$query->where('created_at', '>=', DateTime::createFromFormat('d/m/Y H:i:s', $fromDate.' 00:00:00'));
		}

		if ($toDate != '') {
			$query->where('created_at', '<=', DateTime::createFromFormat('d/m/Y H:i:s', $toDate.' 23:59:59'));
		}

		return $query;
	}

	public function sales(ReportRequest $request)
	{
		$query = $this->buildQuery($request, null, true);
		$orders = $query->get();

		//so don hang
		$totalOrder = $orders->count();
		//so dong hang huy
		$totalOrderCancel = $orders->where('shopping_cart_status_id', 1)->count();
		//so san pham trung binh
		$avgProduct = $orders->where('shopping_cart_status_id', '<>', 1)->avg('cart_details_count');
		//gia tri trung binh
		$avgAmount = $orders->where('shopping_cart_status_id', '<>', 1)->avg('total_payment_amount');
		//tong doanh thu
		$totalAmount = $orders->where('shopping_cart_status_id', '<>', 1)->sum('total_payment_amount');
		//tong doanh thu
		$totalPaidAmount = $orders->where('shopping_cart_status_id', '<>', 1)->where('payment_status', 1)->sum('total_payment_amount');

		return view('backend.reports.sales', compact('totalOrder', 'totalOrderCancel', 'totalAmount', 'avgProduct', 'avgAmount', 'totalPaidAmount'));
	}

	public function salesByCategory(ReportRequest $request)
	{
		$query = $this->buildQuery($request);
		$orders = $query->get();
	}

	public function salesByProduct(ReportRequest $request)
	{
		$query = $this->buildQuery($request, null, false);
		$orderIds = $query->pluck('id')->toArray();

		$results = Product::leftJoin('product_translations', 'products.id', '=', 'product_translations.product_id')
			->leftJoin('shopping_cart_details', 'products.id', '=', 'shopping_cart_details.product_id')
			->groupBy(['products.id', 'product_translations.name'])
			->whereIn('shopping_cart_id', $orderIds)
			->select(DB::raw('products.id, product_translations.name, sum(shopping_cart_details.quantity) as total_quantity, sum(shopping_cart_details.product_price) as total_amount'))
			->get();

		return view('backend.reports.salesbyproduct', compact('results'));
	}

	public function salesByPaymentMethod(ReportRequest $request)
	{
		$paymentMethods = PaymentMethod::with(['shoppingCarts' => function ($query) use($request) {
			$query = $this->buildQuery($request, $query);
		}])->get();

		$totalOrder = 0;
		$totalAmount = 0;
		foreach ($paymentMethods as $method) {
			$totalOrder += $method->shoppingCarts->count();
			$totalAmount += $method->shoppingCarts->sum('total_payment_amount');
		}

		return view('backend.reports.paymentmethods', compact('paymentMethods', 'totalOrder', 'totalAmount'));
	}

	public function salesByProvince(ReportRequest $request)
	{
		$provinces = Province::with(['shoppingCarts' => function ($query) use($request) {
			$query = $this->buildQuery($request, $query);
		}])->get();

		$totalOrder = 0;
		$totalAmount = 0;
		foreach ($provinces as $province) {
			$totalOrder += $province->shoppingCarts->count();
			$totalAmount += $province->shoppingCarts->sum('total_payment_amount');
		}

		return view('backend.reports.salesbyprovince', compact('provinces', 'totalOrder', 'totalAmount'));
	}

	public function inventory(ReportRequest $request)
	{
		$products = Product::all();
		return view('backend.reports.inventory', compact('products'));
	}
}
