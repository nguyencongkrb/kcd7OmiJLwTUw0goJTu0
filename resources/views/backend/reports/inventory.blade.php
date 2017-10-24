@extends('backend.layouts.master')

@section('title', 'Thống kê tồn kho')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		<span>Thống kê tồn kho</span>&nbsp;
		<!-- <small>Optional description</small> -->
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
							<td class="text-right">#</td>
							<td>Tên sản phẩm</td>
							<td>Mã sản phẩm</td>
							<td class="text-right">Số lượng tồn</td>
							<td class="text-right">Trị giá chưa giảm</td>
							<td class="text-right">Trị giá đã giảm</td>
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