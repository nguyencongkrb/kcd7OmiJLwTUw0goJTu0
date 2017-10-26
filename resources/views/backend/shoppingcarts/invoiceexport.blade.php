@inject('config', 'App\Config')
<table>>
	<tr>
		<td>
			
		</td>
		<td colspan="4" align="center">
			<center><h2>Phiếu Giao Hàng</h2></center>
		</td>
		<td align="right">
			<strong>{{ $config::getValueByKey('site_name') }}</strong>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td align="right">
			Hotline: {{ $config::getValueByKey('hot_line') }}
		</td>
	</tr>
</table>

<table>>
	<tr>
		<td><strong>Họ Tên KH</strong></td>
		<td>{{ $cart->shipping_address_same_order ? $cart->customer_name : $cart->shipping_name }}</td>
		<td></td>
		<td></td>
		<td><strong>Mã đơn hàng:</strong></td>
		<td>{{ $cart->code }}</td>
	</tr>
	<tr>
		<td><strong>Điện thoại</strong></td>
		<td>{{ $cart->shipping_address_same_order ? $cart->customer_phone : $cart->shipping_phone }}</td>
		<td></td>
		<td></td>
		<td><strong>Ngày đặt</strong></td>
		<td>{{ $cart->created_at->format('d/m/Y') }}</td>
	</tr>
	<tr>
		<td><strong>ĐC giao hàng</strong></td>
		<td>{{ $cart->shipping_address_same_order ? $cart->customer_address : $cart->shipping_address }}</td>
		<td></td>
		<td></td>
		<td><strong>PT thanh toán</strong></td>
		<td>{{ $cart->paymentMethod->name }}</td>
	</tr>
	<tr>
		<td><strong>Quận/Thành phố</strong></td>
		<td>{{ $cart->shipping_address_same_order ? $cart->customerDistrict->name : $cart->shippingDistrict->name }}, {{ $cart->shipping_address_same_order ? $cart->customerProvince->name : $cart->shippingProvince->name }}</td>
		<td></td>
		<td></td>
		<td><strong>Xuất hoá đơn:</strong></td>
		<td>{{ $cart->invoice_export ? 'Có' : 'Không' }}</td>
	</tr>
	<tr>
		<td><strong>PT giao hàng</strong></td>
		<td>{{ $cart->delivery_method_id ? 'Giao hàng nhanh' : 'Giao hàng tiêu chuẩn' }}</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>
<table>
	<tr>
		<th>STT</th>
		<th>Tên nhãn hiệu hàng hóa</th>
		<th>Mã hàng</th>
		<th align="right">Số lượng</th>
		<th align="right">Đơn giá</th>
		<th align="right">Thành tiền</th>
	</tr>
	@foreach($cart->cartDetails as $item)
	<tr>
		<td>{{ $loop->iteration }}</td>
		<td>{{ $item->product->name }}</td>
		<td align="left">{{ $item->product->code }}</td>
		<td align="right">{{ $item->quantity }}</td>
		<td align="right">{{ $item->product_price }}</td>
		<td align="right">{{ ($item->product_price * $item->quantity) }}</td>
	</tr>
	@endforeach
	<tr>
		<td colspan="4">
			<strong>Chú ý:</strong>
		</td>
		<td>Chiết khấu</td>
		<td align="right">- {{ 0 }}</td>
	</tr>
	<tr>
		<td colspan="4">
			@if(!empty($cart->delivery_note))
			{{ $cart->delivery_note }}
			@endif	
		</td>
		<td>Mã thưởng</td>
		<td align="right">- {{ $cart->getTotalPromotionAmount() }}</td>
	</tr>
	<tr>
		<td colspan="4"></td>
		<td>Phí vận chuyển</td>
		<td align="right">{{ $cart->shipping_fee }}</td>
	</tr>
	<tr>
		<td colspan="4"></td>
		<td><strong>Tổng cộng</strong></td>
		<td align="right"><strong>{{ $cart->getTotalPaymentAmount() }}</strong></td>
	</tr>
</table>
<table>
	<tr>
		<td colspan="6">
			Vui lòng phản hồi về số lượng và chất lượng hàng hóa trong 05 ngày (nếu có), quá 05 ngày ASGroup không chiu trách nhiệm!
		</td>
	</tr>
	<tr>
		<td></td>
	</tr>
	<tr>
		<td align="center"><strong>Người lập phiếu</strong></td>
		<td align="center"><strong>Người Giao Nhận</strong></td>
		<td align="center"><strong>Người nhận tiền</strong></td>
		<td align="center"><strong>Cty Vận Chuyển</strong></td>
		<td align="center"><strong>Kế toán</strong></td>
		<td align="center"><strong>Người nhận hàng</strong></td>
	</tr>
	<tr>
		<td align="center">(Ghi rõ họ tên)</td>
		<td align="center">(Ghi rõ họ tên)</td>
		<td align="center">(Ghi rõ họ tên)</td>
		<td align="center">(Ghi rõ họ tên)</td>
		<td align="center">(Ghi rõ họ tên)</td>
		<td align="center">(Ghi rõ họ tên)</td>
	</tr>
</table>