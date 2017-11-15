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
		<td>{{ $totalOrder > 0 ? ($province->shoppingCarts->count() / $totalOrder) * 100 : 0 }}</td>
		<td>{{ $province->shoppingCarts->sum('total_payment_amount') }}</td>
		<td>{{ $totalAmount > 0 ? ($province->shoppingCarts->sum('total_payment_amount') / $totalAmount) * 100 : 0 }}</td>
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