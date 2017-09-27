@extends('backend.layouts.master')

@section('title', 'Danh Sách Người Dùng')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		Danh Sách Người Dùng
		<!-- <small>Optional description</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li class="active">Người dùng</li>
	</ol>
</section>
@endsection

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<div class="box-header">
				<a href="{{ route('users.create') }}" class="btn btn-sm btn-success btn-flat pull-left">Người dùng mới</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id="tblEntryList" class="table table-condensed table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Hình ảnh</th>
							<th>Tên người dùng</th>
							<th>Mobile</th>
							<th>Email</th>
							<th>Hoạt động</th>
							<th>Quyền hạn</th>
							<!-- <th>Thao tác</th> -->
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('plugins.js')

@endsection

@section('javascript.customize')
<script src="/backend/js/users/ketnoimoi.users.index.js" type="text/javascript"></script>
@endsection