@extends('admin.template.main')

@section('title', 'Lista de categorías')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash::message')
            <a href="{{ route('categories.create') }}" class="btn btn-outline btn-primary">Nueva categoría</a>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th width="80%">Nombre</th>
                        <th width="20%">Opciones</th>
                    </thead>
                    <tbody>
                        @if($categories->count() > 0)
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-xs" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a data-id="{{ $category->id}}" data-name="{{ $category->name }}" class="btn btn-danger btn-xs a-remove-category" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">
                                    <label>No se encontraron registros</label>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {!! $categories->render() !!}
            </div>
        </div>
        <!-- /.col-lg-4 -->
    </div>
@endsection

@section('js')

    <script type="text/javascript">

        $(document).ready(function()
        {
            $('.a-remove-category').click(function()
            {
                var name = $(this).data('name');
                var id = $(this).data('id');

                swal({
                        title: "Eliminar categoría",
                        text: "¿Realmente deseas eliminar la categoría \"" + name + "\"?",
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
                                "{{ route('categories.destroy') }}",
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
                                        swal("Error", "¡Ha ocurrido un error al eliminar la categoría!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al eliminar la categoría!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Eliminado!",
                                                text: "La categoría se ha eliminado con éxito",
                                                type: "success",
                                                showCancelButton: false,
                                                closeOnConfirm: false
                                            },
                                            function()
                                            {
                                                document.location = "{{ route('categories.index') }}";
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
        });


    </script>

@endsection
