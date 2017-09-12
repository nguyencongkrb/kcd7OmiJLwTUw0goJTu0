@extends('frontend.layouts.master')
@inject('productCategory', 'App\ProductCategory')
@php
$productCategories = $productCategory::where('parent_id', 0)->where('published', 1)->orderBy('priority')->get();
@endphp

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
	<a href="#"><img src="{{ $category->getAttachmentByPriority(1, 'custom', 1140, 0) }}" alt="allcategories" class="img-responsive"></a>
	</div>
</div>
<div class="row">
	<div class="container text-center">
		<ul class="list-inline categories">
			@foreach($productCategories as $item)
			<li class="{{ Request::is('san-pham/'. $item->key) ? 'active' : null }}"><a href="{{ $item->getLink() }}">{{ $item->name }}</a></li>
			@endforeach
		</ul>
	</div>
</div>

<div class="row">
	@include('frontend.partials.products')
</div>
<div class="row">
		<div class="col-sm-12 text-center">
			{{ $products->links() }}
		</div>
	</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection