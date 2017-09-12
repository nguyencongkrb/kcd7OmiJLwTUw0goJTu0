<div class="row">
	<div class="col-sm-8">
		<!-- Slideshow Start-->
		<div class="slideshow single-slider owl-carousel">
			@foreach($sliders as $slider)
			<div class="item"> <a href="{{ $slider->link }}"><img class="img-responsive" src="{{ $slider->getFirstAttachment('custom', 750, 400) }}" alt="{{ $slider->name }}" /></a></div>
			@endforeach
		</div>
		<!-- Slideshow End-->
	</div>
	<div class="col-sm-4 pull-right flip">
		<div class="marketshop-banner">
			<div class="row">
				@foreach($slidersRight as $slider)
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <a href="{{ $slider->link }}"><img title="{{ $slider->name }}" alt="{{ $slider->name }}" src="{{ $slider->getFirstAttachment('custom', 360, 185) }}"></a></div>
				@endforeach
			</div>
		</div>
	</div>
</div>