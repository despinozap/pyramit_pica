@extends('admin.template.main')

@section('title', 'Cambiar password')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash::message')
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Usuario
                </div>
                <div class="panel-body">
                    {!! Form::open(array('class'=>'frm')) !!}

                        <div class="form-group">
                            {!! Form::label('current_password', 'Password') !!}
                            {!! Form::password('current_password', ['id' => 'frm_current_password', 'class' => 'form-control', 'placeholder' => 'Ingrese su password actual', 'required']) !!}

                            <span class="error-text" id="error-text-current_password" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('new_password', 'Nuevo password') !!}
                            {!! Form::password('new_password', ['id' => 'frm_new_password', 'class' => 'form-control', 'placeholder' => 'Ingrese el nuevo password', 'required']) !!}

                            <span class="error-text" id="error-text-new_password" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('re_password', 'Repita nuevo password') !!}
                            {!! Form::password('re_password', ['id' => 'frm_re_password', 'class' => 'form-control', 'placeholder' => 'Repita el nuevo password', 'required']) !!}

                            <span class="error-text" id="error-text-re_password" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Cambiar', ['class' => 'btn btn-primary']) !!}
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

            swal({
                    title: "Guardar password",
                    text: "¿Realmente deseas actualizar el password?",
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
                    data.append('_method', 'POST');
                    data.append('_token', "{{ csrf_token() }}");
                    data.append('current_password', $('#frm_current_password').val());
                    data.append('new_password', $('#frm_new_password').val());
                    data.append('re_password', $('#frm_re_password').val());

                    $.ajax(
                    {
                        type: "POST",
                        url: "{{ route('users.changePassword') }}",
                        contentType: false,
                        processData: false,
                        data: data,
                        success: function (responseCode)
                        {
                            var statusCode = parseInt(responseCode);

                            switch (statusCode)
                            {
                                case -2: //DIFFERNT PASSWORDS
                                    {
                                        swal("Error", "¡El nuevo password y su repetición no coinciden!", "error");

                                        break;
                                    }

                                case -1: //EXCEPTION
                                    {
                                        swal("Error", "¡El password actual ingresado no es válido!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al actualizar el password!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Guardado!",
                                                text: "El password se ha actualizado con éxito",
                                                type: "success",
                                                showCancelButton: false,
                                                closeOnConfirm: false
                                            },
                                            function()
                                            {
                                                document.location = "{{ route('panel.index') }}";
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
