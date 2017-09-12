@inject('articleType', 'App\ArticleType')
<?php $populars = $articleType::findByKey('bai-viet-duoc-quan-tam')->first()->articles()->where('published', 1)->orderBy('priority')->orderBy('published_at', 'desc')->take(6)->get(); ?>
<div class="popular-posts col-md-3">
	<h3 class="text-uppercase">Bài viết được quan tâm</h3>
	<div class="seperator"></div>
	<div class="row">
		@foreach($populars as $post)
		<div class="popular-item col-xs-12 col-sm-6 col-md-12 animated flipInX">
			<a href="{{ $post->getLink() }}"><img src="{{ $post->getFirstAttachment() }}" alt="{{ $post->name }}" class="img-responsive"></a>
			<h4>
				<a href="{{ $post->getLink() }}" class="text-uppercase">{{ $post->name }}</a>
			</h4>
		</div>
		@if($loop->iteration % 2 == 0)
		<div class="clearfix"></div>
		@endif
		@endforeach
	</div>
</div>