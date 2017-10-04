<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Datetime;
use App\Config;
use App\ShoppingCart;
use App\Http\Requests\ShoppingCartRequest;
use App\Mail\OrderPurchase;
use App\Mail\OrderCancel;
use App\Mail\OrderDelivered;

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
			if(!is_null($request->input('ShoppingCart.shopping_cart_status_id')))
				$cart->shopping_cart_status_id = $request->input('ShoppingCart.shopping_cart_status_id', 0);

			// tăng invetory_quantity products khi huỷ đơn hàng
			if((int)$cart->shopping_cart_status_id == 1){
				foreach($cart->cartDetails()->get() as $item){
					$item->product->increment('inventory_quantity', $item->quantity);
				}
			}

			$cart->updated_by = $user->id;
			$cart->save();
		});

		if((int)$request->input('ShoppingCart.shopping_cart_status_id') == 1){	// huỷ đơn hàng
			$this->sentOrderCancel($cart->id);
		}
		elseif ((int)$request->input('ShoppingCart.shopping_cart_status_id') == 5) {	// đã giao hàng
			$this->sentOrderDelivered($cart->id);
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

	public function filter(ShoppingCartRequest $request)
	{
		$search = $request->input('search', '');
		$fromDate = $request->input('fromdate', '');
		$toDate = $request->input('todate', '');
		$status = $request->input('status', 0);
		$payment_status = $request->input('payment_status', '');

		$query = ShoppingCart::with('status', 'paymentMethod');

		if ($fromDate != '') {
			$query->where('created_at', '>=', DateTime::createFromFormat('d/m/Y', $fromDate));
		}

		if ($toDate != '') {
			$query->where('created_at', '<=', DateTime::createFromFormat('d/m/Y', $toDate));
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
		return response()->json($shoppingCarts->toArray());
	}

	public function sentOrderPurchase($id)
	{
		$cart = ShoppingCart::findOrFail($id);
		Mail::to($cart->customer_email)
		->cc(Config::getValueByKey('address_received_mail'))
		->send(new OrderPurchase($cart));
	}

	public function sentOrderCancel($id)
	{
		$cart = ShoppingCart::findOrFail($id);
		Mail::to($cart->customer_email)
		->cc(Config::getValueByKey('address_received_mail'))
		->send(new OrderCancel($cart));
	}

	public function sentOrderDelivered($id)
	{
		$cart = ShoppingCart::findOrFail($id);
		Mail::to($cart->customer_email)
		->cc(Config::getValueByKey('address_received_mail'))
		->send(new OrderDelivered($cart));
	}
}
