@extends('frontend.layouts.master')

@section('customize.js.head')
<script type="application/ld+json">{!! $article->getJSONLD() !!}</script>
@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<ul class="breadcrumb">
	<li><a href="/"><i class="fa fa-home"></i></a></li>
	<li><a href="{{ $category->getLink() }}">{{ $category->name }}</a></li>
	<li><a href="{{ $article->getLink() }}">{{ $article->name }}</a></li>
</ul>
<div class="row">
	<div id="content" class="col-sm-9">
		@include('frontend.partials.article')
	</div>
	@include('frontend.partials.productsidebar')
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection