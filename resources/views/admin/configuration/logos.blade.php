@extends('admin.template.main')

@section('title', 'Editar logos')

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
        <div class="col-lg-12">
			@include('flash::message')
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Logos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tabGORE" data-toggle="tab"><b>Gobierno Regional</b></a>
                        </li>
                        <li><a href="#tabCORE" data-toggle="tab"><b>Consejo Regional</b></a>
                        </li>
                        <li><a href="#tabIMP" data-toggle="tab"><b>Ilustre Municipalidad de Pica</b></a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tabGORE">
                            <h3 style="text-align: center;">
								<img align="center" src="{{ asset('front/img/logos/logo_gore.png') }}" style="max-width: 120px;">
							</h3>
                            <hr>
                            {!! Form::open(array('class'=>'frm', 'data-id'=>'0', 'data-name'=>'Gobierno Regional', 'data-prefix'=>'gore')) !!}

        						<div class="form-group" style="overflow-x: auto;">
        							<div id="image-preview-gore"></div>
                                    <span style="font-weight: bold; color: #FF0000; display: none;" class="image-required">
                                        <strong>Debes seleccionar una imagen para el logo</strong>
                                    </span>
                                    <div style="width: 50%; text-align: center; margin: auto;">
                                        <div class="col-xs-12">
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                                <span class="btn btn-warning croppie-rotate" data-index="0" data-deg='-90'><i class="fa fa-rotate-left"></i> Rotar</span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                                <span class="btn btn-success button-select-image" data-index="0"><i class="fa fa-image"></i> Abrir</span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                                <span class="btn btn-warning croppie-rotate" data-index="0" data-deg='90'><i class="fa fa-rotate-right"></i> Rotar</span>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::hidden('image_data', null, ['id' => 'image-data-gore']) !!}
        						</div>

        						<div class="form-group">
        							{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
        						</div>

        					{!! Form::close() !!}
                        </div>

                        <div class="tab-pane fade" id="tabCORE">
                            <h3 style="text-align: center;">
								<img src="{{ asset('front/img/logos/logo_core.png') }}" style="max-height: 120px;">
							</h3>
							<hr>
                            {!! Form::open(array('class'=>'frm', 'data-id'=>'1', 'data-name'=>'Consejo Regional', 'data-prefix'=>'core')) !!}

        						<div class="form-group" style="overflow-x: auto;">
        							<div id="image-preview-core"></div>
                                    <span style="font-weight: bold; color: #FF0000; display: none;" class="image-required">
                                        <strong>Debes seleccionar una imagen para el logo</strong>
                                    </span>
                                    <div style="width: 50%; text-align: center; margin: auto;">
                                        <div class="col-xs-12">
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                                <span class="btn btn-warning croppie-rotate" data-index="1" data-deg='-90'><i class="fa fa-rotate-left"></i> Rotar</span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                                <span class="btn btn-success button-select-image" data-index="1"><i class="fa fa-image"></i> Abrir</span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                                <span class="btn btn-warning croppie-rotate" data-index="1" data-deg='90'><i class="fa fa-rotate-right"></i> Rotar</span>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::hidden('image_data', null, ['id' => 'image-data-core']) !!}
        						</div>

        						<div class="form-group">
        							{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
        						</div>

        					{!! Form::close() !!}
                        </div>

                        <div class="tab-pane fade" id="tabIMP">
                            <h3 style="text-align: center;">
								<img src="{{ asset('front/img/logos/logo_imp.png') }}" style="max-height: 120px;">
							</h3>
							<hr>
                            {!! Form::open(array('class'=>'frm', 'data-id'=>'2', 'data-name'=>'Ilustre Municipalidad de Pica', 'data-prefix'=>'imp')) !!}

        						<div class="form-group" style="overflow-x: auto;">
        							<div id="image-preview-imp"></div>
                                    <span style="font-weight: bold; color: #FF0000; display: none;" class="image-required">
                                        <strong>Debes seleccionar una imagen para el logo</strong>
                                    </span>
                                    <div style="width: 50%; text-align: center; margin: auto;">
                                        <div class="col-xs-12">
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                                <span class="btn btn-warning croppie-rotate" data-index="2" data-deg='-90'><i class="fa fa-rotate-left"></i> Rotar</span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                                <span class="btn btn-success button-select-image" data-index="2"><i class="fa fa-image"></i> Abrir</span>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-bottom: 5px;">
                                                <span class="btn btn-warning croppie-rotate" data-index="2" data-deg='90'><i class="fa fa-rotate-right"></i> Rotar</span>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::hidden('image_data', null, ['id' => 'image-data-imp']) !!}
        						</div>

        						<div class="form-group">
        							{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
        						</div>

        					{!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->

        <div style="display: none;">
            <input type="file" id="fuImage" data-index="-1" value="Choose a file" accept="image/*" />
        </div>
    </div>

@endsection

@section('js')

	<script type="text/javascript">

		var listUploadCrop;
		var listImageData;
		var index;

		$(document).ready(function()
		{
			initUploaders();
		});

		function initUploaders()
		{
			listImageData = new Array();
			listImageData.push($('#image-data-gore'));
			listImageData.push($('#image-data-core'));
			listImageData.push($('#image-data-imp'));

			listUploadCrop = new Array();

			index = -1;

			var uploadCrop = $('#image-preview-gore').croppie(
			{
				viewport: {
					width: 400,
					height: 237,
					type: 'square'
				},
				boundary: {
					width: 410,
					height: 410
				},
				enableOrientation: true
			});

			listUploadCrop.push(uploadCrop);

			uploadCrop = $('#image-preview-core').croppie(
			{
				viewport: {
					width: 309,
					height: 400,
					type: 'square'
				},
				boundary: {
					width: 410,
					height: 410
				},
				enableOrientation: true
			});

			listUploadCrop.push(uploadCrop);

			uploadCrop = $('#image-preview-imp').croppie(
			{
				viewport: {
					width: 350,
					height: 400,
					type: 'square'
				},
				boundary: {
					width: 410,
					height: 410
				},
				enableOrientation: true
			});

			listUploadCrop.push(uploadCrop);
		}

		function readFile(input)
		{
			if (input.files && input.files[0])
			{
				var reader = new FileReader();

				reader.onload = function (e)
				{
					listUploadCrop[index].croppie(
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


		$('.croppie-rotate').on('click', function(e)
		{
			index = $(this).data('index');

			listUploadCrop[index].croppie(
								'rotate',
								$(this).data('deg')
			);
		});

		$('.button-select-image').click(function(e)
		{
			index = $(this).data('index');

			$('#fuImage').val('').click();

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
				listUploadCrop[index].croppie(
												'bind',
												{
													url: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII='
												}
				);
			}
		});

		$('input[type=submit]').click(function(e)
		{
			//if($('#fuImage')[0].files.length > 0)
			{
				//$('.image-required').hide();

				listUploadCrop[index].croppie(
												'result',
												{
													type: 'canvas',
													size: 'viewport'
												}
				).then(function (resp)
				{
					listImageData[index].val(resp);
				});
			}
			/*
			else
			{
				//$('.image-required').show();
				alert('Image required');

				e.preventDefault();
			}
			*/
		});

		$('.frm').submit(function(e)
        {
            e.preventDefault();

            var name = $(this).data('name');
			var id= $(this).data('id');
			var prefix = $(this).data('prefix');

            swal({
                    title: "Guardar logo",
                    text: "¿Realmente deseas actualizar el logo de \"" + name + "\"?",
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
                    var data = new FormData();
                    data.append('_method', 'PUT');
                    data.append('_token', "{{ csrf_token() }}");
					data.append('id', id);
					data.append('image_data', $('#image-data-' + prefix).val());

                    $.ajax(
                    {
                        type: "POST",
                        url: "{{ route('configuration.updateLogo', 0) }}",
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
                                        swal("Error", "¡Ha ocurrido un error al actualizar el logo!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al registrar el logo!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Guardado!",
                                                text: "El logo se ha registrado con éxito",
                                                type: "success",
                                                showCancelButton: false,
                                                closeOnConfirm: false
                                            },
                                            function()
                                            {
                                                document.location = "{{ route('configuration.logos') }}";
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
                                swal("Error", "No se ha seleccionado la imágen del logo", "error");
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
