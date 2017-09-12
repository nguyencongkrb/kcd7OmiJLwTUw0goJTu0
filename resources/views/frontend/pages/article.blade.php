@extends('frontend.layouts.master')

@section('customize.js.head')
<script type="application/ld+json">{!! $article->getJSONLD() !!}</script>
@endsection

@section('plugins.css')
@endsection

@section('customize.css')
@endsection

@section('body')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		@include('frontend.partials.article')
	</div>
</div>
@endsection

@section('plugins.js')
@endsection

@section('customize.js')
@endsection