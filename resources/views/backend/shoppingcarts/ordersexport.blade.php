<table>
	<tr>
		<td>Mã đơn hàng</td>
		<td>Ngày đặt hàng</td>
		<td>User đặt hàng</td>
		<td>Họ tên</td>
		<td>Số điện thoại</td>
		<td>Thành tiền</td>
		<td>Hình thức thanh toán</td>
	</tr>
	@foreach($shoppingCarts as $cart)
	<tr>
		<td>{{ $cart->code }}</td>
		<td>{{ $cart->created_at->format('d/m/Y') }}</td>
		<td>{{ $cart->userCreated->username }}</td>
		<td>{{ $cart->customer_name }}</td>
		<td>{{ $cart->customer_phone }}</td>
		<td>{{ $cart->getTotalPaymentAmount() }}</td>
		<td>{{ $cart->paymentMethod->name }}</td>
	</tr>
	@endforeach
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>=SUM(F2:F{{ count($shoppingCarts) + 1 }})</td>
		<td></td>
	</tr>
</table>