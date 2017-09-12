@extends('frontend.layouts.master')

@section('customize.js.head')
@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<ul class="breadcrumb">
	<li><a href="/"><i class="fa fa-home"></i></a></li>
	<li><a href="{{ $category->getLink() }}">{{ $category->name }}</a></li>
</ul>
<div class="row">
	<div id="content" class="col-sm-9">
		<h1 class="title">{{ $category->name }}</h1>
		@include('frontend.partials.articles')
	</div>
	@include('frontend.partials.productsidebar')
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection