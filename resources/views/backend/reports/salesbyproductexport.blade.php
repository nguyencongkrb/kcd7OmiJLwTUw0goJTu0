<table>
	<tr>
		<td>#</td>
		<td>Tên sản phẩm</td>
		<td>Số đơn vị sản phẩm</td>
		<td>Giá trị</td>
	</tr>
	@foreach($results as $item)
	<tr>
		<td>{{ $loop->iteration }}</td>
		<td>{{ $item->name }}</td>
		<td>{{ $item->total_quantity }}</td>
		<td>{{ $item->total_amount }}</td>
	</tr>
	@endforeach
</table>