@extends('admin.template.main')

@section('title', 'Lista de mapas')

@section('content')
	<div class="row">
        <div class="col-md-12">
			@include('flash::message')
			<a href="{{ route('wells.create') }}" class="btn btn-outline btn-primary">Nuevo mapa</a>
		</div>
		<div class="col-md-12">
			<hr>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th width="20%">Nombre</th>
						<th width="30%">Descripción</th>
						<th width="20%">Autor</th>
						<th width="10%">Usuario</th>
						<th width="20%">Opciones</th>
					</thead>
					<tbody>
						@if($wells->count() > 0)
							@foreach($wells as $well)
								<tr>
									<td>{{ $well->name }}</td>
									<td>{{ $well->description }}</td>
									<td class="text-center">{{ $well->author }}</td>
									<td class="text-center">{{ $well->user->name }}</td>
									<td class="text-center">
										<a href="{{ route('wells.edit', $well->id) }}" class="btn btn-warning btn-xs" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
										<a href="{{ $well->link }}" class="btn btn-info btn-xs" title="Link" target="_blank"><i class="fa fa-eye"></i></a>
										<a data-id="{{ $well->id }}" data-name="{{ $well->name }}" class="btn btn-danger btn-xs a-remove-well" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
				{!! $wells->render() !!}
			</div>
		</div>
    	<!-- /.col-lg-4 -->
	</div>
@endsection

@section('js')

    <script type="text/javascript">

		$('.a-remove-well').click(function()
		{
			var name = $(this).data('name');
			var id = $(this).data('id');

			swal({
					title: "Eliminar mapa",
					text: "¿Realmente deseas eliminar el mapa \"" + name + "\"?",
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
							"{{ route('wells.destroy') }}",
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
									swal("Error", "¡Ha ocurrido un error al eliminar el mapa!", "error");

									break;
								}

							case 0: //ERROR
								{
									swal("Error", "¡Ha ocurrido un error al eliminar el mapa!", "error");

									break;
								}

							case 1: //SUCCESS
								{
									swal({
											title: "Eliminado!",
											text: "El mapa se ha eliminado con éxito",
											type: "success",
											showCancelButton: false,
											closeOnConfirm: false
										},
										function()
										{
											document.location = "{{ route('wells.index') }}";
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
