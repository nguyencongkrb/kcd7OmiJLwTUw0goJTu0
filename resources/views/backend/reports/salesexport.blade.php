<table>
	<tr>
		<td>Tổng số đơn hàng trong kỳ</td>
		<td>{{ $totalOrder }}</td>
	</tr>
	<tr>
		<td>Tổng số đơn hàng huỷ trong kỳ</td>
		<td>{{ $totalOrderCancel }}</td>
	</tr>
	<tr>
		<td>Số sản phẩm trung bình trên mỗi đơn hàng</td>
		<td>{{ $avgProduct }}</td>
	</tr>
	<tr>
		<td>Giá trị trung bình trên mỗi đơn hàng</td>
		<td>{{ $avgAmount }}</td>
	</tr>
	<tr>
		<td>Tổng doanh thu trong kỳ</td>
		<td>{{ $totalAmount }}</td>
	</tr>
	<tr>
		<td>Tổng số tiền đã thu</td>
		<td>{{ $totalPaidAmount }}</td>
	</tr>
</table>