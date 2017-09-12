@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<!-- Breadcrumb Start-->
<ul class="breadcrumb">
	<li><a href="/"><i class="fa fa-home"></i></a></li>
	<li><a href="{{ route('search') }}">Tìm kiếm</a></li>
</ul>
<!-- Breadcrumb End-->
<div class="row">
	<!--Left Part Start -->
	@include('frontend.partials.productsidebar')
	<!--Left Part End -->
	<!--Middle Part Start-->
	@include('frontend.partials.products')
	<!--Middle Part End -->
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection