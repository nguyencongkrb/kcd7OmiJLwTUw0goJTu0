@foreach($articles as $article)
<div class="clearfix">
	<div class="row">
		<div class="col-sm-5 col-xs-12">
			<a href="{{ $article->getLink() }}">
				<img class="img-responsive" src="{{ $article->getFirstAttachment('custom', 414, 177) }}" alt="{{ $article->name }}">
			</a>
		</div>
		<div class="col-sm-7 col-xs-12">
			<h4><a href="{{ $article->getLink() }}">{{ $article->name }}</a></h4>
			<span><i class="fa fa-calendar"></i> {{ date_format(new DateTime($article->published_at), "d/m/Y") }}</span><br>
			{{ $article->summary }}
		</div>
	</div>
</div>
<div class="divider"></div>
@endforeach
<div class="divider"></div>
<div class="text-center">
	{{ $articles->links() }}
</div>