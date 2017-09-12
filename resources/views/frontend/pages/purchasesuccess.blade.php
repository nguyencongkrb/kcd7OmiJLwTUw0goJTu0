@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="divider"></div>
<!--Feature Box Part Start-->
<h2 class="text-uppercase text-center">Bạn đã đặt hàng thành công!</h2>
<br>
<div class="row">
	<div class="col-sm-offset-3 col-sm-6">
		<div class="featured-box text-center"> <i class="featured-icon fa fa-trophy"></i>
			<h4>Chúc mừng</h4>
			<p>Cảm ơn bạn đã đặt hàng tại Website của chúng tôi. Đơn hàng của bạn sẽ được xác nhận lại qua email. Và chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất!</p>
			<a href="/" class="btn btn-sm btn-primary">Tiếp tục mua hàng</a> 
		</div>
	</div>

</div>
<div class="divider"></div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection