@extends('admin.template.main')

@section('title', 'Nuevo mapa')

@section('style')

	<style>

	.cropit-preview {
	    background-color: #f8f8f8;
	    background-size: cover;
	    border: 1px solid #ccc;
	    border-radius: 3px;
	    margin-top: 7px;
  	}

  	.cropit-preview-image-container {
    	cursor: move;
  	}

	</style>

@endsection

@section('content')

	<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Mapa
                </div>
                <div class="panel-body">
					{!! Form::open(array('class'=>'frm')) !!}

						<div class="form-group">
							{!! Form::label('name', 'Nombre') !!}
							{!! Form::text('name', null, ['id' => 'frm_name', 'class' => 'form-control', 'placeholder' => 'Nombre del mapa', 'required']) !!}

							<span class="error-text" id="error-text-name" style="font-weight: bold; color: #A94442; display: none;" />
						</div>

						<div class="form-group">
							{!! Form::label('description', 'Descripción') !!}
							{!! Form::textarea('description', null, ['id' => 'frm_description', 'class' => 'form-control', 'rows' => '4', 'maxlength' => '500', 'style' => 'resize: none;', 'required']) !!}

							<span class="error-text" id="error-text-description" style="font-weight: bold; color: #A94442; display: none;" />
						</div>

						<div class="form-group">
							{!! Form::label('author', 'Autor (Institución)') !!}
							{!! Form::text('author', null, ['id' => 'frm_author', 'class' => 'form-control', 'placeholder' => 'Nombre del autor', 'required']) !!}

							<span class="error-text" id="error-text-author" style="font-weight: bold; color: #A94442; display: none;" />
						</div>

						<div class="form-group">
							{!! Form::label('link', 'Enlace (link)') !!}
							{!! Form::text('link', 'http://', ['id' => 'frm_link', 'class' => 'form-control', 'placeholder' => 'EJ: http://www.ejemplo.cl/Mapa', 'required']) !!}

							<span class="error-text" id="error-text-link" style="font-weight: bold; color: #A94442; display: none;" />
						</div>

						<div class="form-group" style="overflow-x: auto;">
							<label>Imagen</label>
							<div id="image-preview"></div>
							<span class="image-required" style="font-weight: bold; color: #A94442; display: none;">
								Debes seleccionar una imagen de portada
							</span>
                            <div style="width: 50%; text-align: center; margin: auto;">
                                <div class="col-xs-12">
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                        <span class="btn btn-warning croppie-rotate" data-deg='-90'><i class="fa fa-rotate-left"></i> Rotar</span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                        <span id='btSelect-image' class="btn btn-success"><i class="fa fa-image"></i> Abrir</span>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                        <span class="btn btn-warning croppie-rotate" data-deg='90'><i class="fa fa-rotate-right"></i> Rotar</span>
                                    </div>
                                </div>
                            </div>
                            {!! Form::hidden('image_data', null, ['id' => 'frm_image_data']) !!}
						</div>

						<div class="form-group">
							{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
						</div>

					{!! Form::close() !!}

					<div style="display: none;">
						<input type="file" id="fuImage" value="Choose a file" accept="image/*" />
					</div>

				</div>
        	</div>
    	</div>
        <!-- /.col-lg-4 -->
    </div>

@endsection

@section('js')

	<script type="text/javascript">

		var uploadCrop;

		function readFile(input)
		{
			if (input.files && input.files[0])
			{
				var reader = new FileReader();

				reader.onload = function (e)
				{
					uploadCrop.croppie(
										'bind',
										{
											url: e.target.result
										}
					).then(function()
					{
						//console.log('jQuery bind complete');
					});
				}

				reader.readAsDataURL(input.files[0]);
			}
			else
			{
				//alert("Sorry - you're browser doesn't support the FileReader API");
			}
		}

		uploadCrop = $('#image-preview').croppie(
		{
			viewport: {
				width: 700,
				height: 495,
				type: 'square'
			},
			boundary: {
				width: 710,
				height: 710
			},
			enableOrientation: true
		});

		$('.croppie-rotate').on('click', function(e)
		{
			uploadCrop.croppie(
								'rotate',
								$(this).data('deg')
			);
		});

		$('#btSelect-image').click(function(e)
		{
			$('#fuImage').click();

			e.preventDefault();
		});

		$('#fuImage').on('change', function ()
		{
			if($(this)[0].files.length > 0)
			{
				readFile(this);
			}
			else
			{
				uploadCrop.croppie(
									'bind',
									{
										url: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII='
									}
				);
			}
		});


		$('input[type=submit]').click(function(e)
		{
			if($('#fuImage')[0].files.length > 0)
			{
				$('.image-required').hide();

				uploadCrop.croppie(
					'result',
					{
						type: 'canvas',
						size: 'viewport'
					}
				).then(function (resp)
				{
					$('#frm_image_data').val(resp);
				});
			}
			else
			{
				$('.image-required').show();

				e.preventDefault();
			}

		});

		$('.frm').submit(function(e)
        {
            e.preventDefault();

            var name = $('#frm_name').val();

            swal({
                    title: "Guardar mapa",
                    text: "¿Realmente deseas registrar el mapa \"" + name + "\"?",
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
                    data.append('name', name);
					data.append('description', $('#frm_description').val());
					data.append('author', $('#frm_author').val());
					data.append('link', $('#frm_link').val());
					data.append('image_data', $('#frm_image_data').val());

                    $.ajax(
                    {
                        type: "POST",
                        url: "{{ route('wells.store') }}",
                        contentType: false,
                        processData: false,
                        data: data,
                        success: function (responseCode)
                        {
                            var statusCode = parseInt(responseCode);

                            switch (statusCode)
                            {
								case -2: //ERROR ON IMAGE
                                    {
                                        swal("Error", "¡La imagen seleccionada está defectuosa!", "error");

                                        break;
                                    }
									
                                case -1: //EXCEPTION
                                    {
                                        swal("Error", "¡Ha ocurrido un error al registrar el mapa!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al registrar el mapa!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Guardado!",
                                                text: "El mapa se ha registrado con éxito",
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
