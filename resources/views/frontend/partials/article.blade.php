@if(Auth::guest())
<br><br>
@endif
<h1 class="article-title">{{ $article->name }}</h1>
<p>{{ $article->summary }}</p>
<div class="text-center">
	<center>
	<img src="{{ $article->getFirstAttachment('custom', 600, 400) }}" class="img-responsive">
	</center>
</div>
<br>
{!! $article->content !!}
@if(Auth::guest())
<br><br>
@endif