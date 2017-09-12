@extends('backend.layouts.master')

@section('title', $user->getFullName())

@section('plugins.css')
@endsection

@section('content.head')
<section class="content-header">
	<h1>
		{{ $user->getFullName() }}
		<!-- <small>Optional description</small> -->
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
		<li><a href="javascript::">Người dùng</a></li>
		<li class="active">{{ $user->getFullName() }}</li>
	</ol>
</section>
@endsection

@section('content')
<div class="row">
	<div class="col-md-3">

		<!-- Profile Image -->
		<div class="box box-success">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="/backend/img/user4-128x128.jpg" alt="{{ Auth::user()->getFullName() }}">

				<h3 class="profile-username text-center">{{ Auth::user()->getFullName() }}</h3>

				<p class="text-muted text-center">{{ Auth::user()->job_title }}</p>

				<!-- <ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Level</b> <a class="pull-right">1,322</a>
					</li>
					<li class="list-group-item">
						<b>Tổng doanh số</b> <a class="pull-right">543</a>
					</li>
				</ul> -->
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

		<!-- About Me Box -->
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Thông tin</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<strong><i class="fa fa-phone margin-r-5"></i> Di động</strong>
				<p class="text-muted">{{ $user->mobile_phone }}</p>
				<hr>
				<strong><i class="fa fa-phone margin-r-5"></i> Điện thoại nhà</strong>
				<p class="text-muted">{{ $user->home_phone }}</p>
				<hr>
				<strong><i class="fa fa-map-marker margin-r-5"></i> Địa chỉ</strong>
				<p class="text-muted">{{ $user->address }}</p>
				<hr>
				<strong><i class="fa fa-lock margin-r-5"></i> Quyền truy cập</strong>
				<p>
					@foreach($user->roles()->get() as $keyRole=>$role)
					<span class="label label-success">{{ $role->name }}</span>
					@endforeach
				</p>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
	<div class="col-md-9">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#settings" data-toggle="tab">Thông tin</a></li>
				<li><a href="#password-change" data-toggle="tab">Thay đổi mật mã</a></li>
			</ul>
			<div class="tab-content">

				<div class="active tab-pane" id="settings">
					<form id="user-form" class="form-horizontal" action="{{ route('users.update', ['id' => $user->id]) }}">
						<input type="hidden" name="_method" value="PATCH">
						<input type="hidden" name="User[id]" value="{{ $user->id }}">
						<div class="form-group">
							<label for="last_name" class="col-sm-2 control-label">Họ <em>*</em></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="last_name" name="User[last_name]" value="{{ $user->last_name }}" placeholder="Họ" required>
							</div>
							<label for="first_name" class="col-sm-2 control-label">Tên <em>*</em></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="first_name" name="User[first_name]" value="{{ $user->first_name }}" placeholder="Tên" required>
							</div>
						</div>
						<div class="form-group">
							<label for="gender" class="col-sm-2 control-label">Giới tính</label>
							<div class="col-sm-4">
								<label>
									<input type="radio" name="User[gender]" value="1" {{ $user->gender == 1 ? 'checked' : null }} class="minimal"> Name
								</label>
								<label>
									<input type="radio" name="User[gender]" value="0" {{ $user->gender == 0 ? 'checked' : null }} class="minimal"> Nữ
								</label>
							</div>
							<label for="birthday" class="col-sm-2 control-label">Ngày sinh</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="birthday" name="User[birthday]" value="{{ date_format(new DateTime($user->birthday), "d/m/Y") }}" placeholder="dd/mm/yyyy">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">Email <em>*</em></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="email" name="User[email]" value="{{ $user->email }}" placeholder="Email" required>
							</div>
							<label for="job_title" class="col-sm-2 control-label">Chức vụ</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="job_title" name="User[job_title]" value="{{ $user->job_title }}" placeholder="Chức vụ" >
							</div>
						</div>
						<div class="form-group">
							<label for="mobile_phone" class="col-sm-2 control-label">Di động</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="mobile_phone" name="User[mobile_phone]" value="{{ $user->mobile_phone }}" placeholder="Di động">
							</div>
							<label for="home_phone" class="col-sm-2 control-label">Nhà</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="home_phone" name="User[home_phone]" value="{{ $user->home_phone }}" placeholder="Điện thoại nhà">
							</div>
						</div>
						<div class="form-group">
							<label for="address" class="col-sm-2 control-label">Địa chỉ</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="address" name="User[address]" value="{{ $user->address }}" placeholder="Địa chỉ">
							</div>
						</div>
						<div class="form-group">
							<label for="website" class="col-sm-2 control-label">Website</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="website" name="User[website]" value="{{ $user->website }}" placeholder="Website">
							</div>
						</div>
						<div class="form-group">
							<label for="facebook" class="col-sm-2 control-label">Facebook</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="facebook" name="User[facebook]" value="{{ $user->facebook }}" placeholder="Facebook">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success btn-flat">Hoàn tất</button>
							</div>
						</div>
					</form>
				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="password-change">
					<form id="user-password-change" class="form-horizontal" action="{{ route('users.passwordchange') }}">
						<div class="form-group">
							<label for="currentpassword" class="col-sm-4 control-label">Mật mã hiện tại <em>*</em></label>
							<div class="col-sm-4">
								<input type="password" class="form-control" id="currentpassword" name="User[currentpassword]" placeholder="Mật mã hiện tại" required>
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="col-sm-4 control-label">Mật mã mới <em>*</em></label>
							<div class="col-sm-4">
								<input type="password" class="form-control" id="password" name="User[password]" placeholder="Mật mã" required>
							</div>
						</div>
						<div class="form-group">
							<label for="password_confirmation" class="col-sm-4 control-label">Nhắc lại mật mã mới <em>*</em></label>
							<div class="col-sm-4">
								<input type="password" class="form-control" id="password_confirmation" name="User[password_confirmation]" placeholder="Nhắc lại mật mã mới" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-10">
								<button type="submit" class="btn btn-success btn-flat">Hoàn tất</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- /.tab-content -->
		</div>
		<!-- /.nav-tabs-custom -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('plugins.js')
@endsection

@section('javascript.customize')
<script type="text/javascript" src="/backend/js/users/ketnoimoi.users.profile.js"></script>
@endsection