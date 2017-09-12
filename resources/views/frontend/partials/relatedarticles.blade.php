<h3 class="subtitle">Bài viết liên quan</h3>
<ul class="simple-ul">
	@foreach($article->getVisibleRelatedArticles() as $item)
	<li><a href="{{ $item->getLink() }}">{{ $item->name }}</a></li>
	@endforeach
</ul>