@foreach($articles as $article)
	<div class="row article-item">
		<div class="col-xs-12 col-sm-4 col-md-4">
			<a href="{{ $article->getLink() }}">
				<img src="{{ $article->getFirstAttachment('custom', 600, 400) }}" class="img-responsive" alt="{{ $article->name }}">
			</a>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-8 text-justify">
			<h4 class="article-item-title"><a href="{{ $article->getLink() }}">{{ $article->name }}</a></h4>
			{{ $article->summary }}
		</div>
	</div>
@endforeach