@extends('frontend.layouts.master')

@section('customize.js.head')

@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="col-sm-4 col-md-4 col-md-offset-4">
	<h1 class="article-title">Trạng thái đơn hàng</h1>
	<form role="form" id="frmCheckOrder" method="GET" action="{{ route('order.detail') }}">
		<div class="form-group">
			<label>Nhập mã đơn hàng</label>
			<input type="text" class="form-control" name="code"  placeholder="Mã đơn hàng" required>
		</div>
		<button type="submit" class="btn btn-default btn-block">Kiểm tra</button>
	</form>
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
<script type="text/javascript">
	$(document).ready(function (argument) {
		$("#frmCheckOrder").validate({
			lang: 'vi',
			errorClass: 'text-danger'
		});
	});
</script>
@endsection