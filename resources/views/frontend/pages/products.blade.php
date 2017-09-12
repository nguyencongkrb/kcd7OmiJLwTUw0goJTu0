@extends('frontend.layouts.master')

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<!-- Breadcrumb Start-->
<ul class="breadcrumb">
	<li><a href="/"><i class="fa fa-home"></i></a></li>
	@if(Route::is('allproducts'))
	<li><a href="{{ route('allproducts') }}">Tất cả sản phẩm</a></li>
	@elseif(Route::is('producer'))
	<li><a href="{{ $producer->getLink() }}">{{ $producer->name }}</a></li>
	@elseif(Route::is('search'))
	<li><a href="{{ route('search') }}">Tìm kiếm</a></li>
	@elseif(Route::is('products.byCategoryAndProducer'))
	<li><a href="{{ $category->getLink() }}">{{ $category->name }}</a></li>
	<li><a href="{{ route('products.byCategoryAndProducer', ['categorykey' => $category->key, 'producerkey' => $producer->key]) }}">{{ $producer->name }}</a></li>
	@else
	<li><a href="{{ $category->getLink() }}">{{ $category->name }}</a></li>
	@endif
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