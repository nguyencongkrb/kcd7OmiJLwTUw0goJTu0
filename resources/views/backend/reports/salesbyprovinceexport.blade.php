<table>
	<tr>
		<td>#</td>
		<td>Tên tỉnh thành</td>
		<td>Số đơn hàng</td>
		<td>Tỉ lệ % (đơn hàng)</td>
		<td>Giá trị</td>
		<td>Tỉ lệ % (giá trị)</td>
	</tr>
	@foreach($provinces as $province)
	<tr>
		<td>{{ $loop->iteration }}</td>
		<td>{{ $province->name }}</td>
		<td>{{ $province->shoppingCarts->count() }}</td>
		<td>{{ ($province->shoppingCarts->count() / $totalOrder) * 100  }}</td>
		<td>{{ $province->shoppingCarts->sum('total_payment_amount') }}</td>
		<td>{{ ($province->shoppingCarts->sum('total_payment_amount') / $totalAmount) * 100  }}</td>
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