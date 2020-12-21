@extends('admin.template.main')

@section('title', 'Lista de artículos')

@section('content')
	<div class="row">
        <div class="col-md-12">
			@include('flash::message')
			<a href="{{ route('articles.create') }}" class="btn btn-outline btn-primary">Nuevo artículo</a>
			<!-- Search tag -->
				{!! Form::open(['route' => 'articles.index', 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}

					<div class="form-group">
						<div class="input-group">
							{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Buscar artículo..', 'aria-describedby' => 'search']) !!}
							<span class="input-group-addon" id="search">
								<span class="glyphicon glyphicon-search"></span>
							</span>
						</div>
					</div>

				{!! Form::close() !!}
			<!-- Search tag*  -->
		</div>
		<div class="col-md-12">
			<hr>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th width="40%">Título</th>
						<th width="15%">Categoría</th>
						<th width="15%">Usuario</th>
						<th width="10%">Comentarios</th>
						<th width="20%">Opciones</th>
					</thead>
					<tbody>
						@if($articles->count() > 0)
							@foreach($articles as $article)
								<tr>
									<td>{{ $article->title }}</td>
									<td class="text-center">{{ $article->category->name }}</td>
									<td class="text-center">{{ $article->user->name }}</td>
									<td class="text-center">{{ $article->comments->count() }}</td>
									<td class="text-center">
										<a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-xs" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
										<a href="{{ route('articles.comments', $article->id) }}" class="btn btn-info btn-xs" title="Comentarios"><i class="fa fa-list"></i></a>
										<a data-id="{{ $article->id }}" data-title="{{ $article->title }}" class="btn btn-danger btn-xs a-remove-article" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
				{!! $articles->render() !!}
			</div>
		</div>
    	<!-- /.col-lg-4 -->
	</div>
@endsection

@section('js')

    <script type="text/javascript">

		$('.a-remove-article').click(function()
		{
			var title = $(this).data('title');
			var id = $(this).data('id');

			swal({
					title: "Eliminar artículo",
					text: "¿Realmente deseas eliminar el artículo \"" + title + "\"?",
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
							"{{ route('articles.destroy') }}",
							{
								_token : "{{ csrf_token() }}",
								id : id
							}
					)
					.done(function(responseCode)
					{
						var statusCode = parseInt(responseCode);

						switch (statusCode)
						{
							case -1: //EXCEPTION
								{
									swal("Error", "¡Ha ocurrido un error al eliminar el artículo!", "error");

									break;
								}

							case 0: //ERROR
								{
									swal("Error", "¡Ha ocurrido un error al eliminar el artículo!", "error");

									break;
								}

							case 1: //SUCCESS
								{
									swal({
											title: "Eliminado!",
											text: "El artículo se ha eliminado con éxito",
											type: "success",
											showCancelButton: false,
											closeOnConfirm: false
										},
										function()
										{
											document.location = "{{ route('articles.index') }}";
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
