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
		<td>{{ ($method->shoppingCarts->count() / $totalOrder) * 100  }}</td>
		<td>{{ $method->shoppingCarts->sum('total_payment_amount') }}</td>
		<td>{{ ($method->shoppingCarts->sum('total_payment_amount') / $totalAmount) * 100  }}</td>
	</tr>
	@endforeach
	<tr>
		<td></td>
		<td></td>
		<td>{{ $totalOrder }}</td>
		<td>100</td>
		<td>{{ $totalAmount }}</td>
		<td>100</td>
	</tr>
</table>