@extends('backend.layouts.master')

@section('title', 'Màn Hình Chính')

@section('content.head')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Màn hình chính
		<small>Optional description</small>
	</h1>
	<ol class="breadcrumb">
		<li class="active"><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Màn hình chính</a></li>
	</ol>
</section>
@endsection
@section('content')

@endsection