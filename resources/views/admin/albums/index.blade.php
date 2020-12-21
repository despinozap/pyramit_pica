@extends('admin.template.main')

@section('title', 'Lista de álbumes')

@section('content')
	<div class="row">
        <div class="col-md-12">
			@include('flash::message')
			<a href="{{ route('albums.create') }}" class="btn btn-outline btn-primary">Nuevo álbum</a>
		</div>
		<div class="col-md-12">
			<hr>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th width="10%">Portada</th>
						<th width="40%">Título</th>
						<th width="15%">Fecha de creación</th>
						<th width="15%">Usuario</th>
						<th width="5%">Fotos</th>
						<th width="15%">Opciones</th>
					</thead>
					<tbody>
						@if($albums->count() > 0)
							@foreach($albums as $album)
								<tr>
									<td class="text-center">
										<img width="100%" src="{{ asset('front/upload/albums') }}/{{ $album->image->name }}">
									</td>
									<td>{{ $album->title }}</td>
									<td class="text-center">{{ $album->created_at }}</td>
									<td class="text-center">{{ $album->user->name }}</td>
									@if($album->photos->count() > 0)
										<td class="text-center"><span class="badge">{{ $album->photos->count() }}</span></td>
									@else
										<td class="text-center"><span class="badge" style="background-color: #d43f3a;">{{ $album->photos->count() }}</span></td>
									@endif

									<td class="text-center">
										<a href="{{ route('albums.edit', $album->id) }}" class="btn btn-warning btn-xs" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
										<a href="{{ route('albums.show', $album->id) }}" class="btn btn-info btn-xs" title="Fotos"><i class="fa fa-list"></i></a>
										@if($album->photos->count() > 0)
											<a data-id="{{ $album->id }}" data-title="{{ $album->title }}" class="btn btn-primary btn-xs a-download-album" title="Descargar como ZIP"><i class="glyphicon glyphicon-cloud-download"></i></a>
										@else
											<a class="btn btn-primary btn-xs" title="Descargar como ZIP" disabled><i class="glyphicon glyphicon-cloud-download"></i></a>
										@endif
										<a data-id="{{ $album->id }}" data-title="{{ $album->title }}" class="btn btn-danger btn-xs a-remove-album" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
									</td>
								</tr>
							@endforeach
						@else
							<tr>
		                        <td colspan="6" class="text-center">
		                            <label>No se encontraron registros</label>
		                        </td>
		                    </tr>
						@endif
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{!! $albums->render() !!}
			</div>
		</div>
    	<!-- /.col-lg-4 -->
	</div>
@endsection

@section('js')

    <script type="text/javascript">

		$('.a-remove-album').click(function()
		{
			var title = $(this).data('title');
			var id = $(this).data('id');

			swal({
					title: "Eliminar álbum",
					text: "¿Realmente deseas eliminar el álbum \"" + title + "\"?",
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
							"{{ route('albums.destroy') }}",
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
									swal("Error", "¡Ha ocurrido un error al eliminar el álbum!", "error");

									break;
								}

							case 0: //ERROR
								{
									swal("Error", "¡Ha ocurrido un error al eliminar el álbum!", "error");

									break;
								}

							case 1: //SUCCESS
								{
									swal({
											title: "Eliminado!",
											text: "El álbum se ha eliminado con éxito",
											type: "success",
											showCancelButton: false,
											closeOnConfirm: false
										},
										function()
										{
											document.location = "{{ route('albums.index') }}";
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

		$('.a-download-album').click(function()
		{
			var title = $(this).data('title');
			var id = $(this).data('id');

			swal({
                    title: "Descargar álbum",
                    text: "¿Realmente deseas descargar el álbum \"" + title + "\"?. El sistema deberá comprimirlo previamente y esta operación puede tomar unos minutos",
                    imageUrl: "{{ asset('front/img/pages/gallery/photos_folder.png') }}",
                    confirmButtonText: "Sí, ¡descargar ahora!",
                    cancelButtonText: "Cancelar",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function()
                {
					$.post(
							"{{ route('front.downloadZipAlbum') }}",
							{
								_token : "{{ csrf_token() }}",
								id : id
							}
					)
					.done(
							function(fileName)
							{
								if(fileName.length > 0)
								{
									var linkZip = document.createElement('a');
									$(linkZip)
									.attr('href', "{{ asset('front/upload/albums') }}" + "/" + fileName)
									.attr('download', 'Album_' + id + '.zip');

									linkZip.click();

									$(linkZip).remove();
								}
								else
								{
									swal("Error", "No se pudo generar el archivo ZIP", "error");
								}
							}
					)
					.fail(
							function()
							{
								swal("Error", "Se ha producido un error en el sistema", "error");
							}
					)
					.always(
							function()
							{
								swal.close();
							}
					);
                }
            );
		});

    </script>

@endsection
