@if(Auth::guest())
<br><br>
@endif
<h1 class="article-title">{{ $article->name }}</h1>
{!! $article->content !!}
@if(Auth::guest())
<br><br>
@endif