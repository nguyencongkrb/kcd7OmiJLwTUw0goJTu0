<table>
	<tr>
		<td>#</td>
		<td>Tên phương thức</td>
		<td>Số đơn hàng</td>
		<td>Tỉ lệ %(đơn hàng)</td>
		<td>Giá trị</td>
		<td>Tỉ lệ %(giá trị)</td>
	</tr>
	@foreach($paymentMethods as $method)
	<tr>
		<td>{{ $loop->iteration }}</td>
		<td>{{ $method->name }}</td>
		<td>{{ $method->shoppingCarts->count() }}</td>
		<td>{{ $totalOrder > 0 ? ($method->shoppingCarts->count() / $totalOrder) * 100 : 0 }}</td>
		<td>{{ $method->shoppingCarts->sum('total_payment_amount') }}</td>
		<td>{{ $totalAmount > 0 ? ($method->shoppingCarts->sum('total_payment_amount') / $totalAmount) * 100 : 0 }}</td>
	</tr>
	@endforeach
	<tr>
		<td></td>
		<td></td>
		<td>{{ $totalOrder }}</td>
		<td></td>
		<td>{{ $totalAmount }}</td>
		<td></td>
	</tr>
</table>