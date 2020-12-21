@extends('front.template.main')

@section('title', $article->title)

@section('content')
    <section id="article" class="full-width-box">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-color upper">{{ $article->title }}</h2>
                    <hr>
                    <div>
                      	<div class="clearfix"></div>
                      	<div class="post-image opacity news-header-photo text-center">
                        	<img src="{{ asset('front/upload/articles/') }}/{{ $article->image->name }}" alt="" title="" style="width: 60%;">
                      	</div>
                      	<hr>
                      	<div class="post-content top-pad-20">
                        	{!! $article->content !!}
                      	</div>
                      	<br>
                      	<div class="post-meta">
	                        <!-- Author  -->
	                        <span class="author"><i class="fa fa-user"></i> {{ $article->user->name }} &nbsp;&nbsp;</span>
	                        <!-- Meta Date -->
	                        <span class="time"><i class="fa fa-calendar"></i> {{ $article->created_at->format('d-m-Y') }} {{ $article->created_at->format('h:i:s A') }} &nbsp;&nbsp;</span>
	                        <!-- Category -->
	                        <span class="category "><i class="fa fa-heart"></i> {{ $article->category->name }}</span>
	                        <!-- Comments -->
	                        <span class="comments pull-right"><i class="fa fa-comments"></i>
                                @if($article->comments->count() === 1)
                                    1 Comentario
                                @else
                                    {{ $article->comments->count() }} Comentarios
                                @endif
                            </span>
                      	</div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 top-pad-20">
                    <h4>Comentarios</h4>
                </div>
            </div>
            @if($article->comments->count() > 0)
                @foreach($article->comments as $comment)
                    <div class="row">
                        <div class="col-md-12 top-pad-20">

                                <div class="comment-item">
                                    <div class="pull-left author-img" style="padding-right: 10px;"><img src="{{ asset('front/img/pages/article/usercomment.png') }}" width="80" height="80" alt="" title=""></div>
                                    <p>"{{ $comment->content }}"</p>
                                    <div class="post-meta">
                                        <!-- Author  -->
                                        <span class="author"><i class="fa fa-user"></i> {{ $comment->name }} &nbsp;&nbsp;</span>
                                        <!-- Meta Date -->
                                        <span class="time"><i class="fa fa-clock-o"></i> {{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            @else
                <div class="row">
                    <div class="col-md-12 top-pad-20 text-center">
                            <div class="comment-item">
                                <span style="border: 1px dashed #555; padding: 20px 10px 20px 10px;">El artículo aún no tiene comentarios</span>
                            </div>
                    </div>
                </div>
            @endif
            <br>
            <h4>Escribe un comentario</h4>
            <div class="row">

                <form id="frmComment">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="comment_name">Nombre</label>
                            <input type="text" name="comment_name" id="comment_name" class="input-name form-control" placeholder="Ingresa tu nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" name="comment_email" id="comment_email" class="input-name form-control" placeholder="Ingresa tu email" required>
                        </div>

                        <div class="form-group">
                            <label for="comment_content">Comentario</label>
                            <textarea name="commment_content" id="comment_content" class="textarea-message form-control" placeholder="Escribe tu comentario" rows="4" style="resize: none;" required></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" id="sbmtComment" class="btn btn-default" value="Enviar ahora">
                        </div>

                    </div>
                </form>
            </div>
        </div><!-- .container -->
    </section><!-- #news -->
@endsection

@section('js')

	<script type="text/javascript">

		$(document).ready(function()
		{
            $('#frmComment').submit(function(e)
            {
                e.preventDefault();

                swal({
                        title: "Enviar comentario",
                        text: "¿Realmente deseas enviar el comentario al artículo \"{{ $article->title }}\"?",
                        type: "warning",
                        confirmButtonText: "Sí, ¡enviar ahora!",
                        cancelButtonText: "Cancelar",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    },
                    function()
                    {
                        var name = $('#comment_name').val();
                        var email = $('#comment_email').val();
                        var content = $('#comment_content').val();

                        $.post(
                                "{{ route('front.commentArticle') }}",
                                {
                                    _token : "{{ csrf_token() }}",
                                    article_id : "{{ $article->id }}",
                                    name : name,
                                    email : email,
                                    content : content
                                }
                        )
                        .done(function(responseCode)
                        {
                            var statusCode = parseInt(responseCode);

                            switch (statusCode)
                            {
								case -1: //EXCEPTION
                                    {
                                        swal("Error", "¡Ha ocurrido un error al enviar el comentario!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al enviar el comentario!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Enviado!",
                                                text: "Nuestro personal evaluará el comentario para ser publicado",
                                                type: "success",
                                                showCancelButton: false,
                                                closeOnConfirm: true
                                            },
                                            function()
                                            {
                                                $('#frmComment')[0].reset();
                                            }
                                        );

                                        break;
                                    }

                                default:
                                    {

                                        break;
                                    }
                            }
                        })
                        .fail(function()
                        {
                            swal("Error", "¡Ha ocurrido un problema al intentar enviar!", "error");
                        });
                    }
                );
            });
        });

	</script>

@endsection
