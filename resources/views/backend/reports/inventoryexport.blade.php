<table>
	<tr>
		<td>#</td>
		<td>Tên sản phẩm</td>
		<td>Mã sản phẩm</td>
		<td>Số lượng tồn</td>
		<td>Trị giá chưa giảm</td>
		<td>Trị giá đã giảm</td>
	</tr>
	@foreach($products as $product)
	<tr>
		<td>{{ $loop->iteration }}</td>
		<td>{{ $product->name }}</td>
		<td>{{ $product->code }}</td>
		<td>{{ $product->inventory_quantity }}</td>
		<td>{{ $product->price }}</td>
		<td>{{ $product->getLatestPrice() }}</td>
	</tr>
	@endforeach
</table>