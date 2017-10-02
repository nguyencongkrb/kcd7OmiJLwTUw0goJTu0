@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="row">
	<div class="col-md-3">
		@include('frontend.partials.sidebar')
	</div>
	<div class="col-md-9">
		<h1 class="article-title">Lịch sử mua hàng</h1>
		<hr>
		@include('frontend.partials.errors')
		@if (session('status'))
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ session('status') }}
		</div>
		@endif
		@if(count($shoppingCarts))
		<div class="table-responsive">
			<table class="table table-condensed table-hover table-bordered shoppingcart">
				<tr>
					<td class="head">Mã đơn hàng</td>
					<td class="head">Ngày đặt hàng</td>
					<td class="head">Thành tiền</td>
					<td class="head">Hình thức thanh toán</td>
					<td class="head">Tình trạng</td>
					<td class="head">Thao tác</td>
				</tr>
				@foreach($shoppingCarts as $cart)
				<tr>
					<td class="text-center text-nowrap"><a href="{{ route('order.detail', ['code' => $cart->code]) }}">{{ $cart->code }}</a></td>
					<td class="text-center">{{ $cart->created_at->format('d/m/Y') }}</td>
					<td class="text-right">{{ number_format($cart->getTotalPaymentAmount(), 0, ',', '.') }} <small>VNĐ</small></td>
					<td>{{ $cart->paymentMethod->name }}</td>
					<td class="text-center"><span class="label {{ $cart->shopping_cart_status_id == 1 ? 'label-danger' : ($cart->shopping_cart_status_id == 5 ? 'label-success' : 'label-info') }}">{{ $cart->status->name }}</span></td>
					<td class="text-center">
						@if($cart->shopping_cart_status_id > 1 && $cart->shopping_cart_status_id < 5)
						<a href="{{ route('order.updatestatus', ['cart_id' => $cart->id, 'status_id' => 1]) }}" onclick="return confirm('Bạn thật sự muốn huỷ đơn hàng {{ $cart->code }}?')"><span class="glyphicon glyphicon-remove text-danger" title="Huỷ đơn hàng"></span></a>
						@endif
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		@else
		<center>Bạn chưa có đơn hàng nào.</center>
		@endif
	</div>
</div>
@endsection
@section('plugins.js')
@endsection

@section('customize.js')
@endsection