@extends('backend.layouts.master')

@section('title', 'Thống kê tồn kho')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		<span>Thống kê tồn kho</span>&nbsp;
		<!-- <small>Optional description</small> -->
		<a href="{{ route('reports.inventory').'?export=1' }}" target="_blank" class="btn btn-success btn-sm btn-flat"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất Excel </a>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li><a href="javascript:;">Thống kê</a></li>
		<li class="active">Thống kê tồn kho</li>
	</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<div class="box-body">
					<table class="table table-condensed table-bordered table-striped table-hover">
						<tr>
							<td class="text-right"><strong>#</strong></td>
							<td><strong>Tên sản phẩm</strong></td>
							<td><strong>Mã sản phẩm</strong></td>
							<td class="text-right"><strong>Số lượng tồn</strong></td>
							<td class="text-right"><strong>Trị giá chưa giảm</strong></td>
							<td class="text-right"><strong>Trị giá đã giảm</strong></td>
						</tr>
						@foreach($products as $product)
						<tr>
							<td class="text-right">{{ $loop->iteration }}</td>
							<td>{{ $product->name }}</td>
							<td>{{ $product->code }}</td>
							<td class="text-right">{{ number_format($product->inventory_quantity, 0, ',', '.') }}</td>
							<td class="text-right">{{ number_format($product->price, 0, ',', '.') }} <small>VNĐ</small></td>
							<td class="text-right">{{ number_format($product->getLatestPrice(), 0, ',', '.') }} <small>VNĐ</small></td>
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