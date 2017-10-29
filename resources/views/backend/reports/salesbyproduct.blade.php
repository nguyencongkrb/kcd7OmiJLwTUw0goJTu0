@extends('backend.layouts.master')

@section('title', 'Thống kê doanh sản phẩm')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		<span>Thống kê doanh sản phẩm</span>&nbsp;
		<!-- <small>Optional description</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li><a href="javascript:;">Thống kê</a></li>
		<li class="active">Thống kê doanh sản phẩm</li>
	</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<form action="{{ route('reports.salesbyproduct') }}" method="GET">
					<div class="form-group col-xs-2">
						<label for="filter_created_at_from">Từ ngày</label>
						<input type="text" class="form-control input-sm datepicker" data-date-format="dd/mm/yyyy" value="{{ date_format(new DateTime('- 1 month'), 'd/m/Y') }}" id="filter_shoppingcarts_created_at_from" name="fromdate" placeholder="dd/mm/yyyy">
					</div>
					<div class="form-group col-xs-2">
						<label for="filter_created_at_to">Đến ngày</label>
						<input type="text" class="form-control input-sm datepicker" data-date-format="dd/mm/yyyy" value="{{ date_format(new DateTime(), 'd/m/Y') }}" id="filter_shoppingcarts_created_at_to" name="todate" placeholder="dd/mm/yyyy">
					</div>
					<input type="hidden" id="txtExport" name="export" value="0">
					<div class="form-group col-xs-2">
						<label style="display:block;">&nbsp;</label>
						<button type="submit" class="btn btn-success btn-sm btn-flat btn-block btn-submit"><i class="fa fa-filter" aria-hidden="true"></i> Lọc </button>
					</div>
					<div class="form-group col-xs-2">
						<label style="display:block;">&nbsp;</label>
						<button type="submit" class="btn btn-success btn-sm btn-flat btn-block btn-submit export"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất Excel </button>
					</div>
				</form>
				<div class="box-body">
					<table class="table table-condensed table-bordered table-striped table-hover">
						<tr>
							<td class="text-right"><strong>#</strong></td>
							<td><strong>Tên sản phẩm</strong></td>
							<td><strong>Mã sản phẩm</strong></td>
							<td class="text-right"><strong>Số đơn vị sản phẩm</strong></td>
							<td class="text-right"><strong>Giá trị</strong></td>
						</tr>
						@foreach($results as $item)
						<tr>
							<td class="text-right">{{ $loop->iteration }}</td>
							<td>{{ $item->name }}</td>
							<td>{{ $item->code }}</td>
							<td class="text-right">{{ number_format($item->total_quantity, 0, ',', '.') }}</td>
							<td class="text-right">{{ number_format($item->total_amount, 0, ',', '.') }} <small>VNĐ</small></td>
						</tr>
						@endforeach
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