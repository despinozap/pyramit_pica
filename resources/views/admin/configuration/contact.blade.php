@extends('admin.template.main')

@section('title', 'Editar contacto')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('flash::message')
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Información de contacto
                </div>
                <div class="panel-body">
                    {!! Form::open(array('class'=>'frm')) !!}

                        <div class="form-group">
                            {!! Form::label('contact_name', 'Nombre') !!}
                            {!! Form::text('contact_name', $contact->name, ['id' => 'frm_name', 'class' => 'form-control', 'placeholder' => 'Nombre del contacto', 'required']) !!}

                            <span class="error-text" id="error-text-contact_name" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('contact_subname', 'Sub-nombre') !!}
                            {!! Form::text('contact_subname', $contact->subname, ['id' => 'frm_subname', 'class' => 'form-control', 'placeholder' => 'Sub-nombre del contacto', 'required']) !!}

                            <span class="error-text" id="error-text-contact_subname" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('contact_email', 'Email') !!}
                            {!! Form::email('contact_email', $contact->email, ['id' => 'frm_email', 'class' => 'form-control', 'placeholder' => 'Email del contacto', 'required']) !!}

                            <span class="error-text" id="error-text-contact_email" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('contact_phone', 'Teléfono') !!}
                            {!! Form::tel('contact_phone', $contact->phone, ['id' => 'frm_phone', 'class' => 'form-control', 'placeholder' => 'Teléfono del contacto', 'required']) !!}

                            <span class="error-text" id="error-text-contact_phone" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('contact_facebook', 'Facebook') !!}
                            {!! Form::url('contact_facebook', $contact->facebook, ['id' => 'frm_facebook', 'class' => 'form-control', 'placeholder' => 'Dirección del perfil de Facebook del contacto', 'required']) !!}

                            <span class="error-text" id="error-text-contact_facebook" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::label('contact_twitter', 'Twitter') !!}
                            {!! Form::url('contact_twitter', $contact->twitter, ['id' => 'frm_twitter', 'class' => 'form-control', 'placeholder' => 'Dirección del perfil de Twitter del contacto', 'required']) !!}

                            <span class="error-text" id="error-text-contact_twitter" style="font-weight: bold; color: #A94442; display: none;" />
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
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
                    title: "Guardar contacto",
                    text: "¿Realmente deseas actualizar el contacto?",
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
                    data.append('name', $('#frm_name').val());
                    data.append('subname', $('#frm_subname').val());
                    data.append('email', $('#frm_email').val());
                    data.append('phone', $('#frm_phone').val());
                    data.append('facebook', $('#frm_facebook').val());
                    data.append('twitter', $('#frm_twitter').val());

                    $.ajax(
                    {
                        type: "POST",
                        url: "{{ route('configuration.updateContact', $contact->id) }}",
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
                                        swal("Error", "¡Ha ocurrido un error al actualizar el contacto!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al actualizar el contacto!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Guardado!",
                                                text: "El contacto se ha actualizado con éxito",
                                                type: "success",
                                                showCancelButton: false,
                                                closeOnConfirm: false
                                            },
                                            function()
                                            {
                                                swal.close();
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
                            console.log(response);
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
