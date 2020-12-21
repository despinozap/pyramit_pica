@extends('admin.template.main')

@section('title', 'Lista de usuarios')

@section('content')
    <div class="row">
        <div class="col-md-12">
			@include('flash::message')
			<a href="{{ route('users.create') }}" class="btn btn-outline btn-primary">Nuevo usuario</a>
		</div>
		<div class="col-md-12">
			<hr>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th width="15%">Nombre</th>
						<th width="15%">Tipo</th>
						<th width="15%">Email</th>
						<th width="15%">Teléfono</th>
                        <th width="20%">Institución</th>
                        <th width="10%">Activo</th>
						<th width="10%">Opciones</th>
					</thead>
					<tbody>
						@if($users->count() > 0)
							@foreach($users as $user)
								<tr>
									<td class="text-center">{{ $user->name }}</td>
									<td class="text-center">
                                        @if($user->type == 'admin')
                							<span class="label label-danger">{{ $user->type }}</span>
                						@else
                							<span class="label label-primary">{{ $user->type }}</span>
                						@endif
                                    </td>
									<td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">{{ $user->phone }}</td>
                                    <td class="text-center">{{ $user->company }}</td>
                                    <td class="text-center">
                                        @if($user->active)
                                            <input type="checkbox" data-state="checked" data-id="{{ $user->id }}" data-name="{{ $user->name }}" class="check-toggle" checked>
                                        @else
                                            <input type="checkbox" data-state="unchecked" data-id="{{ $user->id }}" data-name="{{ $user->name }}" class="check-toggle">
                                        @endif
                                    </td>
									<td class="text-center">
										<a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-xs" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
										<a data-id="{{ $user->id }}" data-name="{{ $user->name }}" class="btn btn-danger btn-xs a-remove-user" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
				{!! $users->render() !!}
			</div>
		</div>
    	<!-- /.col-lg-4 -->
	</div>
@endsection

@section('js')

    <script type="text/javascript">

        $(document).ready(
                function()
                {
                    $('.check-toggle').bootstrapToggle(
                        {
                            on: 'Si',
                            off: 'No',
                            size: 'mini',
                            onstyle: 'success'
                        }
                    ).change(
                        function()
                        {
                            var id = $(this).data('id');
                            var name = $(this).data('name');
                            var state = $(this).data('state');
                            var checked = $(this).is(':checked');
                            var control = $(this);

                            if((checked == true) && (state === 'checked'))
                            {
                                return;
                            }
                            else if((checked == false) && (state === 'unchecked'))
                            {
                                return;
                            }


                            if(checked == true)
                            {
                                swal({
                                        title: "Activar usuario",
                                        text: "¿Realmente deseas activar el usuario \"" + name + "\"?",
                                        type: "warning",
                                        confirmButtonColor: "#337AB7",
                                        confirmButtonText: "Sí, ¡activar ahora!",
                                        cancelButtonText: "Cancelar",
                                        showCancelButton: true,
                                        closeOnConfirm: false,
                                        showLoaderOnConfirm: true
                                    },
                                    function(isConfirm)
                                    {
                                        if(isConfirm)
                                        {
                                            $.post(
                                                    "{{ route('users.changeState') }}",
                                                    {
                                                        _token : "{{ csrf_token() }}",
                                                        id : id,
                                                        state : 1
                                                    }
                                            )
                                            .done(function(responseCode)
                                            {
                                                var statusCode = parseInt(responseCode);

                                                switch (statusCode)
                                                {
                                                    case -1: //EXCEPTION
                                                        {
                                                            $(control).bootstrapToggle('toggle');
                                                            swal("Error", "¡Ha ocurrido un error al activar el usuario!", "error");

                                                            break;
                                                        }

                                                    case 0: //ERROR
                                                        {
                                                            $(control).bootstrapToggle('toggle');
                                                            swal("Error", "¡Ha ocurrido un error al activar el usuario!", "error");

                                                            break;
                                                        }

                                                    case 1: //SUCCESS
                                                        {
                                                            $(control).data('state', 'checked');
                                                            swal.close();

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
                                                $(control).bootstrapToggle('toggle');
                                                swal("Error", "¡Ha ocurrido un problema al intentar activar!", "error");
                                            });
                                        }
                                        else
                                        {
                                            $(control).bootstrapToggle('toggle');
                                        }
                                    }
                                );
                            }
                            else
                            {
                                swal({
                                        title: "Desactivar usuario",
                                        text: "¿Realmente deseas desactivar el usuario \"" + name + "\"?",
                                        type: "warning",
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "Sí, ¡desactivar ahora!",
                                        cancelButtonText: "Cancelar",
                                        showCancelButton: true,
                                        closeOnConfirm: false,
                                        showLoaderOnConfirm: true
                                    },
                                    function(isConfirm)
                                    {
                                        if(isConfirm)
                                        {
                                            $.post(
                                                    "{{ route('users.changeState') }}",
                                                    {
                                                        _token : "{{ csrf_token() }}",
                                                        id : id,
                                                        state : 0
                                                    }
                                            )
                                            .done(function(responseCode)
                                            {
                                                var statusCode = parseInt(responseCode);

                                                switch (statusCode)
                                                {
                                                    case -2: //LAST ADMIN
                                                        {
                                                            $(control).bootstrapToggle('toggle');
                                                            swal("Error", "No se puede desactivar el usuario. El sistema debe tener al menos 1 administrador activo", "error");

                                                            break;
                                                        }

                                                    case -1: //EXCEPTION
                                                        {
                                                            $(control).bootstrapToggle('toggle');
                                                            swal("Error", "¡Ha ocurrido un error al desactivar el usuario!", "error");

                                                            break;
                                                        }

                                                    case 0: //ERROR
                                                        {
                                                            $(control).bootstrapToggle('toggle');
                                                            swal("Error", "¡Ha ocurrido un error al desactivar el usuario!", "error");

                                                            break;
                                                        }

                                                    case 1: //SUCCESS
                                                        {
                                                            $(control).data('state', 'unchecked');
                                                            swal.close();

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
                                                $(control).bootstrapToggle('toggle');
                                                swal("Error", "¡Ha ocurrido un problema al intentar desactivar!", "error");
                                            });
                                        }
                                        else
                                        {
                                            $(control).bootstrapToggle('toggle');
                                        }
                                    }
                                );
                            }
                        }
                    );
                }
        );

        $('.a-remove-user').click(function()
        {
            var name = $(this).data('name');
            var id = $(this).data('id');

            swal({
                    title: "Eliminar usuario",
                    text: "¿Realmente deseas eliminar el usuario \"" + name + "\"?",
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
                            "{{ route('users.destroy') }}",
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
                            case -2: //LAST ADMIN
                                {
                                    swal("Error", "No se puede eliminar el usuario. El sistema debe tener al menos 1 administrador", "error");

                                    break;
                                }

                            case -1: //EXCEPTION
                                {
                                    swal("Error", "¡Ha ocurrido un error al eliminar el usuario!", "error");

                                    break;
                                }

                            case 0: //ERROR
                                {
                                    swal("Error", "¡Ha ocurrido un error al eliminar el usuario!", "error");

                                    break;
                                }

                            case 1: //SUCCESS
                                {
                                    swal({
                                            title: "Eliminado!",
                                            text: "El usuario se ha eliminado con éxito",
                                            type: "success",
                                            showCancelButton: false,
                                            closeOnConfirm: false
                                        },
                                        function()
                                        {
                                            document.location = "{{ route('users.index') }}";
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
