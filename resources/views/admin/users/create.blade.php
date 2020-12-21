@extends('admin.template.main')

@section('title', 'Nuevo usuario')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Usuario
                </div>
                <div class="panel-body">
                    {!! Form::open(array('class'=>'frm')) !!}

                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', null, ['id' => 'frm_email', 'class' => 'form-control', 'placeholder' => 'Correo electrónico', 'required']) !!}

                            <span class="error-text" id="error-text-email" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('type', 'Tipo') !!}
							{!! Form::select('type', ['editor' => 'Editor', 'admin' => 'Administrador'], null, ['id' => 'frm_type', 'class' => 'form-control select-type', 'required']) !!}

							<span class="error-text" id="error-text-type" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', null, ['id' => 'frm_name', 'class' => 'form-control', 'placeholder' => 'Nombre del usuario', 'required']) !!}

                            <span class="error-text" id="error-text-name" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('phone', 'Teléfono') !!}
                            {!! Form::text('phone', null, ['id' => 'frm_phone', 'class' => 'form-control', 'placeholder' => 'Teléfono del usuario', 'required']) !!}

                            <span class="error-text" id="error-text-phone" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('company', 'Institución') !!}
                            {!! Form::text('company', null, ['id' => 'frm_company', 'class' => 'form-control', 'placeholder' => 'Institución del usuario', 'required']) !!}

                            <span class="error-text" id="error-text-company" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Contraseña') !!}
                            {!! Form::password('password', ['id' => 'frm_password', 'class' => 'form-control', 'placeholder' => '*********', 'required']) !!}

                            <span class="error-text" id="error-text-password" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
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

        $('.select-type').chosen(
                                    {
                                        width: "100%",
                                        placeholder_text_single : 'Seleccione un tipo..'
                                    }
        );

        $('.frm').submit(function(e)
        {
            e.preventDefault();

            var email = $('#frm_email').val();

            swal({
                    title: "Guardar usuario",
                    text: "¿Realmente deseas registrar el usuario \"" + email + "\"?",
                    type: "info",
                    confirmButtonColor: "#337AB7",
                    confirmButtonText: "Sí, ¡registrar ahora!",
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
                    data.append('email', $('#frm_email').val());
                    data.append('type', $('#frm_type').val());
                    data.append('name', $('#frm_name').val());
                    data.append('phone', $('#frm_phone').val());
                    data.append('company', $('#frm_company').val());
                    data.append('password', $('#frm_password').val());

                    $.ajax(
                    {
                        type: "POST",
                        url: "{{ route('users.store') }}",
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
                                        swal("Error", "¡Ha ocurrido un error al registrar el usuario!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al registrar el usuario!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Guardado!",
                                                text: "El usuario se ha registrado con éxito",
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
                                swal("Error", "¡Ha ocurrido un problema al intentar registrar!", "error");
                            }
                        }
                    });
                }
            );

        });

    </script>

@endsection
