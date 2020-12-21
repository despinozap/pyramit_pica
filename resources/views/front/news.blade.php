@extends('front.template.main')

@section('title', 'Noticias')

@section('content')
    <section id="news" class="full-width-box">
        <div class="container">
            <div class="row">

				<div class="col-md-12 content blog grid-layout">
					<h2 class="text-color upper">Noticias</h2>
                    <hr>
					<div class="row">
						@foreach($articles as $article)
							<div class="col-md-4">
								<article class="post" style="word-wrap: break-word;">
									<a href="{{ route('front.article', $article->id) }}">
										<div class="post-image text-center"><img src="{{ asset('front/upload/articles/') }}/{{ $article->image->name }}" width="300" title=""></div>
									</a>
								 	<h2 class="entry-title"><a href="{{ route('front.article', $article->id) }}">{{ $article->title }}</a></h2>
								  	<div class="entry-content">
								  		<p class="text-justify">
											{{ $article->description }}
										</p>
								  	</div>
								  	<footer class="entry-meta">
										<span class="autor-name"><b>{{ $article->user->name }}</b></span>
										<span class="time">{{ $article->created_at->diffForHumans() }}</span>
										<span class="comments-link pull-right">
											@if($article->comments->count() === 1)
												1 comentario
											@else
												{{ $article->comments->count() }} comentarios
											@endif
										</span>
								  	</footer>
								</article><!-- .post -->
							</div>
						@endforeach
					</div>

					<div class="pagination-box pull-right">
						{!! $articles->render() !!}
                    </div><!-- .pagination-box -->
		      	</div><!-- .content -->

            </div><!-- .content -->
        </div><!-- .container -->
    </section><!-- #news -->
@endsection
