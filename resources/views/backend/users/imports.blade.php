@extends('backend.layouts.master')

@section('title', 'Imports người dùng')

@section('plugins.css')

@endsection

@section('content.head')
<section class="content-header">
	<h1>
		Imports người dùng
		<!-- <small>Optional description</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li><a href="javascript:;">Người dùng</a></li>
		<li class="active">Imports người dùng</li>
	</ol>
</section>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-success">
			<!-- <div class="box-header with-border">
				<h3 class="box-title">Imports mã khuyến mãi</h3>
			</div> -->
			<form role="form" id="import-form" method="POST" action="{{ route('users.imports') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="box-body">
					@if(count($errors) > 0)
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					@include('backend.partials.flash')
					<p>Tải file dữ liệu mẫu <a href="{{ Storage::url('user_list.xlsx') }}">tại đây</a>. <!-- Nhập dữ liệu vào file excel với <code>code &amp; name</code> là duy nhất. Tiến hành imports file excel.<br>
						Nhấn vào button <code>Upload hình ảnh</code> và tiến hành upload hình mã khuyến mãi với định dạng <code>code.jpg</code> -->
					</p>
					<div class="form-group">
						<label for="import_file">File imports</label>
						<input type="file" id="import_file" name="User[import_file]">
						<p class="help-block">Bạn có thể tải file import mẫu <a href="{{ Storage::url('user_list.xlsx') }}">tại đây.</a></p>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-success btn-flat">Imports</button>
					<!-- <a href="/elfinder" class="btn btn-success btn-flat" target="_blank">Upload hình ảnh</a> -->
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('plugins.js')

@endsection

@section('javascript.customize')
@endsection