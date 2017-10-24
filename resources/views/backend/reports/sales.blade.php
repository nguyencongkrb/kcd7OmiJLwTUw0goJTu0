@extends('backend.layouts.master')

@section('title', 'Thống kê mua hàng')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		<span>Mua hàng</span>&nbsp;
		<!-- <small>Optional description</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li><a href="javascript:;">Thống kê</a></li>
		<li class="active">Mua hàng</li>
	</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<form action="{{ route('reports.sales') }}" method="GET">
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
							<td>Tổng số đơn hàng trong kỳ</td>
							<td class="text-right">{{ number_format($totalOrder, 0, ',', '.') }}</td>
						</tr>
						<tr>
							<td>Tổng số đơn hàng huỷ trong kỳ</td>
							<td class="text-right">{{ number_format($totalOrderCancel, 0, ',', '.') }}</td>
						</tr>
						<tr>
							<td>Số sản phẩm trung bình trên mỗi đơn hàng</td>
							<td class="text-right">{{ number_format($avgProduct, 0, ',', '.') }}</td>
						</tr>
						<tr>
							<td>Giá trị trung bình trên mỗi đơn hàng</td>
							<td class="text-right">{{ number_format($avgAmount, 0, ',', '.') }} <small>VNĐ</small></td>
						</tr>
						<tr>
							<td>Tổng doanh thu trong kỳ</td>
							<td class="text-right">{{ number_format($totalAmount, 0, ',', '.') }} <small>VNĐ</small></td>
						</tr>
						<tr>
							<td>Tổng số tiền đã thu</td>
							<td class="text-right">{{ number_format($totalPaidAmount, 0, ',', '.') }} <small>VNĐ</small></td>
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