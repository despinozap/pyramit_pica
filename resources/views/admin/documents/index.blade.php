@extends('admin.template.main')

@section('title', 'Lista de documentos')

@section('content')

	<div class="row">
        <div class="col-md-12">
			@include('flash::message')
			<a href="{{ route('documents.create') }}" class="btn btn-outline btn-primary">Nuevo documento</a>
			<!-- Search tag -->
				{!! Form::open(['route' => 'documents.index', 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}

					<div class="form-group">
						<div class="input-group">
							{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Buscar documento..', 'aria-describedby' => 'search']) !!}
							<span class="input-group-addon" id="search">
								<span class="glyphicon glyphicon-search"></span>
							</span>
						</div>
					</div>

				{!! Form::close() !!}
			<!-- Search tag*  -->
			<hr>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th width="5%">Portada</th>
						<th width="35%">Título</th>
						<th width="20%">Categoría</th>
						<th width="25%">Usuario</th>
						<th width="20%">Opciones</th>
					</thead>
					<tbody>
						@if($documents->count() > 0)
							@foreach($documents as $document)
								<tr>
									<td class="text-center">
										<img width="100%" src="{{ asset('front/upload/documents') }}/{{ $document->image->name }}">
									</td>
									<td>{{ $document->title }}</td>
									<td class="text-center">{{ $document->category }}</td>
									<td class="text-center">{{ $document->user->name }}</td>
									<td class="text-center">
										<a href="{{ route('documents.edit', $document->id) }}" class="btn btn-warning btn-xs" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
										<a href="{{ asset('front/upload/documents') }}/{{ $document->name }}" class="btn btn-success btn-xs" target="_blank" title="Ver"><i class="glyphicon glyphicon-zoom-in"></i></a>
										<a href="{{ asset('front/upload/documents') }}/{{ $document->name }}" class="btn btn-info btn-xs" title="Descargar" download="{{ $document->original_name }}"><i class="fa fa-download"></i></a>
										<a data-id="{{ $document->id }}" data-title="{{ $document->title }}" class="btn btn-danger btn-xs a-remove-document" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
				{!! $documents->render() !!}
			</div>
		</div>
    	<!-- /.col-lg-4 -->
	</div>
@endsection

@section('js')

    <script type="text/javascript">

		$('.a-remove-document').click(function()
		{
			var title = $(this).data('title');
			var id = $(this).data('id');

			swal({
					title: "Eliminar documento",
					text: "¿Realmente deseas eliminar el documento \"" + title + "\"?",
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
							"{{ route('documents.destroy') }}",
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
									swal("Error", "¡Ha ocurrido un error al eliminar el documento!", "error");

									break;
								}

							case 0: //ERROR
								{
									swal("Error", "¡Ha ocurrido un error al eliminar el documento!", "error");

									break;
								}

							case 1: //SUCCESS
								{
									swal({
											title: "Eliminado!",
											text: "El documento se ha eliminado con éxito",
											type: "success",
											showCancelButton: false,
											closeOnConfirm: false
										},
										function()
										{
											document.location = "{{ route('documents.index') }}";
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
