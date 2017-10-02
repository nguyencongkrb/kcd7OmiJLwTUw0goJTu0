@extends('frontend.layouts.master')

@section('customize.js.head')
@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="col-md-10 col-md-offset-1">
	<div class="row">
		<div class="col-md-12">
			<h1 class="article-title">{{ $category->name }}</h1>
		</div>
		@include('frontend.partials.articles')
	</div>
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection