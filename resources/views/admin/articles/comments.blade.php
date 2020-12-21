@extends('admin.template.main')

@section('title', 'Lista de comentarios')

@section('content')
	<div class="row">
        <div class="col-md-12">
			@include('flash::message')
			<hr>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th width="40%">Comentario</th>
						<th width="20%">Nombre</th>
						<th width="20%">Email</th>
						<th width="10%">Fecha</th>
						<th width="10%">Opciones</th>
					</thead>
					<tbody>
						@if($comments->count() > 0)
							@foreach($comments as $comment)
								<tr>
									<td>{{ $comment->content }}</td>
									<td>{{ $comment->name }}</td>
									<td>{{ $comment->email }}</td>
									<td>{{ $comment->created_at->format('d-m-Y') }}</td>
									<td class="text-center">
										<a data-id="{{ $comment->id }}" data-article="{{ $article->id }}" data-name="{{ $comment->name }}" data-href-comments="{{ route('articles.comments', $article->id) }}" class="btn btn-danger btn-xs a-remove-comment" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
									</td>
								</tr>
							@endforeach
						@else
							<tr>
		                        <td colspan="5" class="text-center">
		                            <label>No se encontraron registros</label>
		                        </td>
		                    </tr>
						@endif
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{!! $comments->render() !!}
			</div>
		</div>
    	<!-- /.col-lg-4 -->
	</div>
@endsection

@section('js')

    <script type="text/javascript">

		$('.a-remove-comment').click(function()
		{
			var hrefComments = $(this).data('href-comments');
			var name = $(this).data('name');
			var articleId = $(this).data('article');
			var id = $(this).data('id');

			swal({
					title: "Eliminar comentario",
					text: "¿Realmente deseas eliminar el comentario de \"" + name + "\"?",
					type: "warning",
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Sí, ¡eliminar ahora!",
					cancelButtonText: "Cancelar",
					showCancelButton: true,
					closeOnConfirm: false,
					showLoaderOnConfirm: true,
				},
				function()
				{
					$.post(
							"{{ route('articles.comments.destroy') }}",
							{
								_token : "{{ csrf_token() }}",
								id : id,
								article_id : articleId
							}
					)
					.done(function(responseCode)
					{
						var statusCode = parseInt(responseCode);

						switch (statusCode)
						{
							case -1: //EXCEPTION
								{
									swal("Error", "¡Ha ocurrido un error al eliminar el comentario!", "error");

									break;
								}

							case 0: //ERROR
								{
									swal("Error", "¡Ha ocurrido un error al eliminar el comentario!", "error");

									break;
								}

							case 1: //SUCCESS
								{
									swal({
											title: "Eliminado!",
											text: "El comentario se ha eliminado con éxito",
											type: "success",
											showCancelButton: false,
											closeOnConfirm: false
										},
										function()
										{
											document.location = hrefComments;
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
						swal("Error", "¡Ha ocurrido un problema al intentar eliminar!", "error");
					});
				}
			);

		});

    </script>

@endsection
