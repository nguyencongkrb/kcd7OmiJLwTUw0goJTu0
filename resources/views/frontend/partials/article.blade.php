<h1 class="title">{{ $article->name }}</h1>
<span><i class="fa fa-calendar"></i> {{ date_format(new DateTime($article->published_at), "d/m/Y") }}</span>
<p>{{ $article->summary }}</p>
<div class="text-center">
	<center>
	<img src="{{ $article->getFirstAttachment('custom', 700, 300) }}" class="img-responsive">
	</center>
</div>
<br>
{!! $article->content !!}
<div class="divider"></div>
@include('frontend.partials.relatedarticles')