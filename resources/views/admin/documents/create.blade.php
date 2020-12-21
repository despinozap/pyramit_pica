@extends('admin.template.main')

@section('title', 'Nuevo documento')

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
                    Documento
                </div>
                <div class="panel-body">
					{!! Form::open(array('class'=>'frm')) !!}

						<div class="form-group">
							{!! Form::label('title', 'Título') !!}
							{!! Form::text('title', null, ['id' => 'frm_title', 'class' => 'form-control', 'placeholder' => 'Titulo del documento', 'required']) !!}

							<span class="error-text" id="error-text-title" style="font-weight: bold; color: #A94442; display: none;" />
						</div>

						<div class="form-group">
							{!! Form::label('category', 'Categoría') !!}
							{!! Form::select('category', ['biblio' => 'Bibliografía', 'report' => 'Presentación', 'other' => 'Otro'], null, ['id' => 'frm_category', 'class' => 'form-control select-category', 'required']) !!}

							<span class="error-text" id="error-text-category" style="font-weight: bold; color: #A94442; display: none;" />
						</div>

						<div class="form-group">
							{!! Form::label('name', 'Archivo') !!}
							<div class="input-group">
								<span class="input-group-addon" id="btSelect-file" style="cursor: pointer;"><i class="fa fa-folder-open"></i> Seleccionar..</span>
	                        	{!! Form::text('original_name', null, ['id' => 'txtFilename', 'class' => 'form-control', 'placeholder' => 'No se ha seleccionado un archivo', 'required', 'readonly']) !!}
								{!! Form::file('file', ['id' => 'frm_file', 'accept' => '.doc,.docx,.xls,.xlsx,.pdf', 'style' => 'display: none;']) !!}
	                    	</div>

	                    	<span class="error-text" id="error-text-file" style="font-weight: bold; color: #A94442; display: none;" />
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

		$('.select-category')/*.prepend("<option value='' selected></option>")*/.chosen(
										{
											width: "100%",
											placeholder_text_single : 'Seleccione una categoría..'
										}
		);

		$('.textarea-content').trumbowyg(
								{
									 lang: 'es'
								}
		);

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
				width: 300,
				height: 400,
				type: 'square'
			},
			boundary: {
				width: 410,
				height: 410
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

		$('#btSelect-file').click(function(e)
		{
			$('#frm_file').click();
		});

		$('#frm_file').on('change', function ()
		{
			if($(this)[0].files.length > 0)
			{
				$('#txtFilename').val($(this)[0].files[0].name);
			}
			else
			{
				$('#txtFilename').val('');
			}
		});

		$('input[type=submit]').click(function(e)
		{
			if($('#frm_file')[0].files.length > 0)
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
			}
			else
			{
				$('#txtFilename').val('');
			}

		});

		$('.frm').submit(function(e)
        {
            e.preventDefault();

            var title = $('#frm_title').val();

            swal({
                    title: "Guardar documento",
                    text: "¿Realmente deseas registrar el documento \"" + title + "\"?",
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
                    data.append('title', title);
					data.append('category', $('#frm_category').val());
					data.append('file', $('#frm_file')[0].files[0]);
					data.append('image_data', $('#frm_image_data').val());

                    $.ajax(
                    {
                        type: "POST",
                        url: "{{ route('documents.store') }}",
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
                                        swal("Error", "¡Ha ocurrido un error al registrar el documento!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al registrar el documento!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Guardado!",
                                                text: "El documento se ha registrado con éxito",
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
