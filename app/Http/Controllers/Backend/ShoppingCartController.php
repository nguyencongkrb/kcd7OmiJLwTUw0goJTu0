<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Datetime;
use App\Config;
use App\ShoppingCart;
use Excel;
use App\Http\Requests\ShoppingCartRequest;

class ShoppingCartController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('backend.shoppingcarts.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ShoppingCartRequest $request)
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
		$cart = ShoppingCart::findOrFail($id);

		$request = request();
		if((bool)$request->input('export', 0)) {
			// work on the export
			Excel::create('Don hang '. $cart->code, function($excel) use ($cart) {
				// Set the title
				$excel->setTitle('Don hang '. $cart->code);
				$excel->sheet('Don hang '. $cart->code, function($sheet) use ($cart) {
					$sheet->loadView('backend.shoppingcarts.invoiceexport', compact('cart'));

				});
			})->download('xlsx');
		}

		return view('backend.shoppingcarts.show', compact('cart'));
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
	public function update(ShoppingCartRequest $request, $id)
	{
		$cart = ShoppingCart::findOrFail($id);
		$this->authorize('update', $cart);

		$user = Auth::user();

		// sure execute success, if not success rollback
		DB::transaction(function () use ($request, $cart, $user) {
			if(!is_null($request->input('ShoppingCart.payment_status')))
				$cart->payment_status = $request->input('ShoppingCart.payment_status', 0);
			if(!is_null($request->input('ShoppingCart.invoice_exported')))
				$cart->invoice_exported = $request->input('ShoppingCart.invoice_exported', 0);
			if(!is_null($request->input('ShoppingCart.shopping_cart_status_id'))){
				$cart->shopping_cart_status_id = $request->input('ShoppingCart.shopping_cart_status_id', 0);
			}

			// update note
			if(!is_null($request->input('ShoppingCart.delivery_note')))
				$cart->delivery_note = $request->input('ShoppingCart.delivery_note');
			if(!is_null($request->input('ShoppingCart.customer_service_note')))
				$cart->customer_service_note = $request->input('ShoppingCart.customer_service_note');

			// tăng invetory_quantity products khi huỷ đơn hàng
			if((int)$cart->shopping_cart_status_id == 1){
				foreach($cart->cartDetails()->get() as $item){
					$item->product->increment('inventory_quantity', $item->quantity);
				}
			}

			$cart->updated_by = $user->id;
			$cart->save();
		});

		if(!is_null($request->input('ShoppingCart.shopping_cart_status_id'))){
			$cart->sentNotify();
		}

		if (!$request->ajax()) {
			return redirect()->route('shoppingcarts.show', ['id' => $id]);
		}
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

	public function invoice($id)
	{
		$cart = ShoppingCart::findOrFail($id);
		return view('backend.shoppingcarts.invoice', compact('cart'));
	}

	public function filter(ShoppingCartRequest $request)
	{
		$search = $request->input('search', '');
		$fromDate = $request->input('fromdate', '');
		$toDate = $request->input('todate', '');
		$status = $request->input('status', 0);
		$payment_status = $request->input('payment_status', '');

		$query = ShoppingCart::with('status', 'paymentMethod', 'userCreated');

		if ($fromDate != '') {
			$query->where('created_at', '>=', DateTime::createFromFormat('d/m/Y H:i:s', $fromDate.' 00:00:00'));
		}

		if ($toDate != '') {
			$query->where('created_at', '<=', DateTime::createFromFormat('d/m/Y H:i:s', $toDate.' 23:59:59'));
		}

		if ($status > 0) {
			$query->where('shopping_cart_status_id', $status);
		}
		if ($payment_status != '') {
			$query->where('payment_status', $payment_status);
		}

		if ($search != '') {
			$query->where('code', 'LIKE', '%' . $search . '%')
				->orWhere('customer_name', 'LIKE', '%' . $search . '%')
                ->orWhere('customer_phone', 'LIKE', '%' . $search . '%')
                ->orWhere('shipping_name', 'LIKE', '%' . $search . '%')
                ->orWhere('shipping_phone', 'LIKE', '%' . $search . '%');
		}

		$shoppingCarts = $query->get();

		if((bool)$request->input('export', 0)) {
			// work on the export
			Excel::create('Danh sach don hang', function($excel) use($shoppingCarts) {
				// Set the title
				$excel->setTitle('Danh sach don hang');
				$excel->sheet('Danh sach don hang', function($sheet) use($shoppingCarts) {
					$sheet->loadView('backend.shoppingcarts.ordersexport', compact('shoppingCarts'));

				});
			})->download('xlsx');
		}

		return response()->json($shoppingCarts->toArray());
	}
}
