<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\ShoppingCart;

class OrderPurchase extends Mailable
{
	use Queueable, SerializesModels;

	public $cart;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(ShoppingCart $cart)
	{
		$this->cart = $cart;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->view('frontend.emails.orderpurchase')->subject('Thông Tin Mua Hàng ' . $this->cart->code);
	}
}
