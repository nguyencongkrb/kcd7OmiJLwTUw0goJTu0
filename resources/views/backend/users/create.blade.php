@extends('backend.layouts.master')

@section('title', 'Người Dùng Mới')

@section('plugins.css')
@endsection

@section('content.head')
<section class="content-header">
	<h1>
		Người Dùng Mới
		<!-- <small>Optional description</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li><a href="javascript::">Người dùng</a></li>
		<li class="active">Người dùng mới</li>
	</ol>
</section>
@endsection

@section('content')
<div class="row">
	<form id="user-form" class="form-horizontal" action="{{ route('users.store') }}">
		<div class="col-md-8">
			<div class="box box-success">
				<div class="box-header with-border">
					<i class="fa fa-user"></i>
					<h3 class="box-title">Thông tin</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label for="last_name" class="col-sm-2 control-label">Họ <em>*</em></label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="last_name" name="User[last_name]" placeholder="Họ" required>
						</div>
						<label for="first_name" class="col-sm-2 control-label">Tên <em>*</em></label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="first_name" name="User[first_name]" placeholder="Tên" required>
						</div>
					</div>
					<div class="form-group">
						<label for="gender" class="col-sm-2 control-label">Giới tính</label>
						<div class="col-sm-4">
							<label>
								<input type="radio" name="User[gender]" value="1" class="minimal"> Name
							</label>
							<label>
								<input type="radio" name="User[gender]" value="0" class="minimal"> Nữ
							</label>
						</div>
						<label for="birthday" class="col-sm-2 control-label">Ngày sinh</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="birthday" name="User[birthday]" placeholder="dd/mm/yyyy">
						</div>
					</div>
					<div class="form-group">
						<label for="job_title" class="col-sm-2 control-label">Chức vụ</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="job_title" name="User[job_title]" placeholder="Chức vụ">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email <em>*</em></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="email" name="User[email]" placeholder="Email" required>
						</div>
					</div>
					<div class="form-group">
						<label for="mobile_phone" class="col-sm-2 control-label">Di động</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="mobile_phone" name="User[mobile_phone]" placeholder="Di động">
						</div>
						<label for="home_phone" class="col-sm-2 control-label">Nhà</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="home_phone" name="User[home_phone]" placeholder="Điện thoại nhà">
						</div>
					</div>
					<div class="form-group">
						<label for="address" class="col-sm-2 control-label">Địa chỉ</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="address" name="User[address]" placeholder="Địa chỉ">
						</div>
					</div>
					<div class="form-group">
						<label for="website" class="col-sm-2 control-label">Website</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="website" name="User[website]" placeholder="Website">
						</div>
					</div>
					<div class="form-group">
						<label for="facebook" class="col-sm-2 control-label">Facebook</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="facebook" name="User[facebook]" placeholder="Facebook">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success btn-flat">Hoàn tất</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-success">
				<div class="box-header with-border">
					<i class="fa fa-lock"></i>
					<h3 class="box-title">Quyền truy cập</h3>
				</div>
				<div class="box-body">
					@foreach($roles as $key=>$role)
					<label>
						<input type="checkbox" name="User[roles][]" value="{{ $role->id }}" class="minimal"> {{ $role->name }}
					</label>
					<br>
					@endforeach
				</div>
			</div>
		</div>
	</form>
</div>
@endsection

@section('plugins.js')
@endsection

@section('javascript.customize')
<script type="text/javascript" src="/backend/js/users/ketnoimoi.users.create.js"></script>
@endsection