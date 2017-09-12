<div class="row">
	<!-- <div class="col-xs-12 col-sm-12 col-md-12">
		<a href="#"><img src="/frontend/images/slider.png" alt="slider" class="img-responsive" style="width: 100%;"></a>
	</div> -->
	<div class="col-xs-12 col-sm-12 col-md-12">
	<div class="owl-carousel owl-theme">
	@foreach($sliders as $slider)
		<div class="item"><a href="{{ $slider->link }}"><img src="{{ $slider->getFirstAttachment('custom', 1140, 520) }}" alt="{{ $slider->name }}"></a></div>
		@endforeach
	</div>
	</div>
</div>
