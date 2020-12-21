@extends('admin.template.main')

@section('title', 'Editar categoría')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Categoría
                </div>
                <div class="panel-body">
                    {!! Form::open(array('class'=>'frm')) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', $category->name, ['id' => 'frm_name', 'class' => 'form-control', 'placeholder' => 'Nombre de la categoría', 'required']) !!}

                            <span class="error-text" id="error-text-name" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}

                            <a href="{{ route('categories.index') }}" class="btn btn-default pull-right"> Cancelar</a>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- /.col-lg-4 -->
    </div>
@endsection

@section('js')

    <script type="text/javascript">

        $('.frm').submit(function(e)
        {
            e.preventDefault();

            var name =  $('#frm_name').val();

            swal({
                    title: "Guardar categoría",
                    text: "¿Realmente deseas actualizar la categoría \"" + name + "\"?",
                    type: "info",
                    confirmButtonColor: "#337AB7",
                    confirmButtonText: "Sí, ¡actualizar ahora!",
                    cancelButtonText: "Cancelar",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function()
                {
                    $('.has-error').removeClass('has-error');
                    $('.error-text').hide();

                    var data = new FormData();
                    data.append('_method', 'PUT');
                    data.append('_token', "{{ csrf_token() }}");
                    data.append('name', name);

                    $.ajax(
                    {
                        type: "POST",
                        url: "{{ route('categories.update', $category->id) }}",
                        contentType: false,
                        processData: false,
                        data: data,
                        success: function (responseCode)
                        {
                            var statusCode = parseInt(responseCode);

                            switch (statusCode)
                            {
                                case -1: //EXCEPTION
                                    {
                                        swal("Error", "¡Ha ocurrido un error al actualizar la categoría!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al actualizar la categoría!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Guardado!",
                                                text: "La categoría se ha actualizado con éxito",
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
                        },
                        error: function(response)
                        {
                            if(response.responseText)
                            {
                                swal("Error", "Se han encontrado problemas con los datos ingresados. ¡Corrija y vuelva a intentarlo!", "error");

                                var errors = $.parseJSON(response.responseText);

                                $.each(errors, function(key, value)
                                {
                                    var errorText = $('#error-text-' + key);
                                    $(errorText).text(value).show();
                                    $(errorText).parent().addClass('has-error');
                                });
                            }
                            else
                            {
                                swal("Error", "¡Ha ocurrido un problema al intentar actualizar!", "error");
                            }
                        }
                    });
                }
            );
        });

    </script>

@endsection
