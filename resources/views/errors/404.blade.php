@extends('frontend.layouts.master')

@section('customize.js.head')
@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="row">
	<div id="content" class="col-sm-12">
		<h1 class="title-404 text-center">404</h1>
		<p class="text-center lead">
			Địa chỉ không tồn tại!<br>
			Yêu cầu của bạn không tìm thấy!
		</p>
		<div class="buttons text-center">
			<a class="btn btn-primary btn-lg" href="/">Trang chủ</a>
		</div>
	</div>
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection