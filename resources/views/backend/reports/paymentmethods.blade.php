@extends('backend.layouts.master')

@section('title', 'Thống kê phương thức thanh toán')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		<span>Thống kê phương thức thanh toán</span>&nbsp;
		<!-- <small>Optional description</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li><a href="javascript:;">Thống kê</a></li>
		<li class="active">Thống kê phương thức thanh toán</li>
	</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<form action="{{ route('reports.salesbypaymentmethod') }}" method="GET">
					<div class="form-group col-xs-2">
						<label for="filter_created_at_from">Từ ngày</label>
						<input type="text" class="form-control input-sm datepicker" data-date-format="dd/mm/yyyy" value="{{ date_format(new DateTime('- 1 month'), 'd/m/Y') }}" id="filter_shoppingcarts_created_at_from" name="fromdate" placeholder="dd/mm/yyyy">
					</div>
					<div class="form-group col-xs-2">
						<label for="filter_created_at_to">Đến ngày</label>
						<input type="text" class="form-control input-sm datepicker" data-date-format="dd/mm/yyyy" value="{{ date_format(new DateTime(), 'd/m/Y') }}" id="filter_shoppingcarts_created_at_to" name="todate" placeholder="dd/mm/yyyy">
					</div>
					<input type="hidden" name="type" value="filter">
					<div class="form-group col-xs-1">
						<label style="display:block;">&nbsp;</label>
						<button type="submit" id="btn_filter_shoppingcarts" class="btn btn-success btn-sm btn-flat btn-block">Lọc </button>
					</div>
				</form>
				<div class="box-body">
					<table class="table table-condensed table-bordered table-striped table-hover">
						<tr>
							<td class="text-right"><strong>#</strong></td>
							<td><strong>Tên phương thức</strong></td>
							<td class="text-right"><strong>Số đơn hàng</strong></td>
							<td class="text-right"><strong>Tỉ lệ % (đơn hàng)</strong></td>
							<td class="text-right"><strong>Giá trị</strong></td>
							<td class="text-right"><strong>Tỉ lệ % (giá trị)</strong></td>
						</tr>
						@foreach($paymentMethods as $method)
						<tr>
							<td class="text-right">{{ $loop->iteration }}</td>
							<td>{{ $method->name }}</td>
							<td class="text-right">{{ number_format($method->shoppingCarts->count(), 0, ',', '.') }}</td>
							<td class="text-right">{{ number_format(($method->shoppingCarts->count() / $totalOrder) * 100, 1, ',', '.')  }} %</td>
							<td class="text-right">{{ number_format($method->shoppingCarts->sum('total_payment_amount'), 0, ',', '.') }} <small>VNĐ</small></td>
							<td class="text-right">{{ number_format(($method->shoppingCarts->sum('total_payment_amount') / $totalAmount) * 100, 1, ',', '.')  }} %</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="2"></td>
							<td class="text-right"><strong>{{ number_format($totalOrder, 0, ',', '.') }}</strong></td>
							<td class="text-right"><strong>100%</strong></td>
							<td class="text-right"><strong>{{ number_format($totalAmount, 0, ',', '.') }} <small>VNĐ</small></strong></td>
							<td class="text-right"><strong>100%</strong></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('plugins.js')

@endsection

@section('javascript.customize')
<script src="/backend/js/reports/ketnoimoi.reports.filter.js" type="text/javascript"></script>
@endsection