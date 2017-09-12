@extends('backend.layouts.master')

@section('title', 'Nhận Xét Khách Hàng')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		Nhận Xét Khách Hàng
		<!-- <small>Optional description</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li class="active">Nhận xét khách hàng</li>
	</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<button type="button" class="btn btn-sm btn-success btn-flat pull-left" data-toggle="modal" data-target="#modalEntry">Nhận xét mới</button>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id="tblEntryList" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Hình ảnh</th>
							<th>Họ tên</th>
							<th>Chức vụ</th>
							<th>Công ty</th>
							<th>Thứ tự</th>
							<th>Xuất bản</th>
							<th>Thao tác</th>
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
			<form id="entry-form" class="form-horizontal" action="{{ route('testimonials.store') }}">
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

@endsection

@section('plugins.js')

@endsection

@section('javascript.customize')
<script src="/backend/js/testimonials/ketnoimoi.testimonials.index.js" type="text/javascript"></script>
@endsection