@extends('backend.layouts.master')

@section('title', 'Danh Sách Đơn hàng')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		<span>Danh Sách Đơn hàng</span>&nbsp;
		<!-- <small>Optional description</small> -->
		<button type="button" class="btn btn-sm btn-success btn-flat hide" data-toggle="modal" data-target="#modalEntry">Đơn hàng mới</button>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li><a href="javascript:;">Đơn hàng</a></li>
		<li class="active">Danh sách đơn hàng</li>
	</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<form action="{{ route('shoppingcarts.filter') }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="export" value="1">
					<div class="form-group col-xs-2">
						<label for="filter_shoppingcarts_code">#, họ tên, sđt</label>
						<input type="text" class="form-control input-sm" id="filter_shoppingcarts_code" name="search" placeholder="Từ khóa">
					</div>
					<div class="form-group col-xs-2">
						<label for="filter_created_at_from">Từ ngày</label>
						<input type="text" class="form-control input-sm datepicker" data-date-format="dd/mm/yyyy" value="{{ date_format(new DateTime('- 1 month'), "d/m/Y") }}" id="filter_shoppingcarts_created_at_from" name="fromdate" placeholder="dd/mm/yyyy">
					</div>
					<div class="form-group col-xs-2">
						<label for="filter_created_at_to">Đến ngày</label>
						<input type="text" class="form-control input-sm datepicker" data-date-format="dd/mm/yyyy" value="{{ date_format(new DateTime(), "d/m/Y") }}" id="filter_shoppingcarts_created_at_to" name="todate" placeholder="dd/mm/yyyy">
					</div>
					<div class="form-group col-xs-2">
						<label for="filter_shoppingcarts_statuses">Trạng thái</label>
						<select class="form-control input-sm" style="width:100%;" id="filter_shoppingcarts_statuses" name="status_id" placeholder="Danh mục">			
							<option value="">-- Chọn trạng thái --</option>
						</select>
					</div>
					<div class="form-group col-xs-2">
						<label for="filter_shoppingcarts_payment_status">Thanh toán</label>
						<select class="form-control input-sm" style="width:100%;" id="filter_shoppingcarts_payment_status" name="payment_status">
							<option value="">-- Tất cả --</option>
							<option value="1">Đã thanh toán</option>
							<option value="0">Chưa thanh toán</option>
						</select>
					</div>
					<input type="hidden" name="type" value="filter">
					<div class="form-group col-xs-2">
						<label style="display:block;">&nbsp;</label>
						<div class="btn-group">
							<button type="button" id="btn_filter_shoppingcarts" class="btn btn-success btn-sm btn-flat"><i class="fa fa-filter" aria-hidden="true"></i> Lọc</button>
							<button type="button" class="btn btn-success btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#" onclick="$(this).closest('form').submit()"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Xuất Excel</a></li>
							</ul>
						</div>
					</div>
				</form>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="tblEntryList" class="table table-condensed table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Mã đơn hàng</th>
								<th class="text-center">Ngày đặt</th>
								<th>User đặt hàng</th>
								<th>Họ tên</th>
								<th>Số điện thoại</th>
								<th class="text-right">Thành tiền</th>
								<th class="text-center">Thanh toán</th>
								<th class="text-right">Trạng thái</th>
								<th class="text-center">Hoá đơn</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalEntry"  tabindex="-1" role="dialog" aria-labelledby="modalEntry" data-backdrop="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form id="entry-form" class="form-horizontal" action="{{ route('shoppingcarts.store') }}">
					<input type="hidden" id="_method" name="_method" value="POST">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="modalEntryHeader">---</h4>
					</div>
					<div class="modal-body">
						<div id="modalEntryContent">
							<!-- body entry -->
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success btn-flat" id="btnSave">Hoàn tất</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
@endsection

@section('plugins.js')

@endsection

@section('javascript.customize')
<script src="/backend/js/shoppingcarts/ketnoimoi.shoppingcarts.index.js" type="text/javascript"></script>
@endsection