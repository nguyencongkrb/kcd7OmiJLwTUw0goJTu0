@extends('backend.layouts.master')

@section('title', 'Danh Sách Bài Viết')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		<span>Danh Sách Bài Viết</span>&nbsp;
		<!-- <small>Optional description</small> -->
		<button type="button" class="btn btn-sm btn-success btn-flat" data-toggle="modal" data-target="#modalEntry">Bài viết mới</button>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li><a href="javascript:;">Bài viết</a></li>
		<li class="active">Danh sách bài viết</li>
	</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<div class="form-group col-xs-3">
					<label for="filter_articles_code">Từ khóa</label>
					<input type="text" class="form-control input-sm" id="filter_articles_code" name="search" placeholder="Từ khóa">
				</div>
				<div class="form-group col-xs-2">
					<label for="filter_created_at_from">Từ ngày</label>
					<input type="text" class="form-control input-sm datepicker" data-date-format="dd/mm/yyyy" value="{{ date_format(new DateTime('- 1 month'), "d/m/Y") }}" id="filter_articles_created_at_from" name="fromdate" placeholder="dd/mm/yyyy">
				</div>
				<div class="form-group col-xs-2">
					<label for="filter_created_at_to">Đến ngày</label>
					<input type="text" class="form-control input-sm datepicker" data-date-format="dd/mm/yyyy" value="{{ date_format(new DateTime(), "d/m/Y") }}" id="filter_articles_created_at_to" name="todate" placeholder="dd/mm/yyyy">
				</div>
				<div class="form-group col-xs-2">
					<label for="filter_articles_categories">Danh mục</label>
					<select class="form-control input-sm" style="width:100%;" id="filter_articles_categories" name="category" placeholder="Danh mục">			
						<option value="">-- Chọn danh mục --</option>
					</select>
				</div>
				<div class="form-group col-xs-2">
					<label for="filter_articles_created_by">Tác giả</label>
					<select class="form-control input-sm" style="width:100%;" id="filter_articles_created_by" name="createdby" placeholder="Tác giả">
						<option value="">-- Tác giả --</option>
					</select>
				</div>
				<input type="hidden" name="type" value="filter">
				<div class="form-group col-xs-1">
					<label style="display:block;">&nbsp;</label>
					<button type="button" id="btn_filter_articles" class="btn btn-success btn-sm btn-flat btn-block">Lọc </button>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="tblEntryList" class="table table-condensed table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>H.ảnh</th>
								<th>Tên bài viết</th>
								<th>Stt</th>
								<th>Danh mục</th>
								<th>Loại</th>
								<th>Tags</th>
								<th>Xuất bản</th>
								<th>Tác giả</th>
								<th>T.tác</th>
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
				<form id="entry-form" class="form-horizontal" action="{{ route('articles.store') }}">
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
	<script src="/backend/js/articles/ketnoimoi.articles.index.js" type="text/javascript"></script>
	@endsection