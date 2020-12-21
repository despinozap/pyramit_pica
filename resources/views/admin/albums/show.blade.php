@extends('admin.template.main')

@section('title', 'Álbum "' . $album->title . '"')

@section('style')

    <style type="text/css">

        textarea{
            resize: none;
        }

    </style>

@endsection

@section('content')
	<div class="row">
        <div class="col-md-12">
			@include('flash::message')
			<hr>
		</div>
		<div id="divList">
			<div class="row">
	            <div class="col-lg-12">
	                <h3 class="page-header">Lista de fotos</h3>
	            </div>
	            <!-- /.col-lg-12 -->
	        </div>
	        <!-- /.row -->
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<th width="20%">Foto</th>
                            <th width="40%">Descripción</th>
							<th width="25%">Fecha de creación</th>
							<th width="15%">Opciones</th>
						</thead>
						<tbody>
							@if($photos->count() > 0)
								@foreach($photos as $photo)
									<tr>
										<td class="text-center">
                                            <img class="img-responsive" style="height: 60px;" src="{{ asset('front/upload/albums') }}/{{ $photo->image->name }}">
                                        </td>
                                        <td>{{ $photo->description }}</td>
										<td>{{ $photo->created_at }}</td>
										<td class="text-center">
                                            <a href="{{ asset('front/upload/albums') }}/{{ $photo->image->name }}" class="btn btn-info btn-xs" title="{{ $photo->description }}" rel="prettyPhoto[{{ $photo->image->name }}]"><i class="fa fa-photo"></i></a>
											<a data-id="{{ $photo->id }}" data-href-photos="{{ route('albums.show', $album->id) }}" class="btn btn-danger btn-xs a-remove-photo" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
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
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info">
                                        <label>Importante:</label> El tamaño máximo permitido por foto es de <label id="lbMaxSize"></label> megabytes (mb)
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <button class="btn btn-success pull-left" onclick="showUploadContainer()"><i class="fa fa-plus"></i> Cargar fotos</button>
                                </td>
                            </tr>
                        </tfoot>
					</table>
				</div>
				<div class="text-center">
					{!! $photos->render() !!}
				</div>
			</div>
	    	<!-- /.col-lg-4 -->
		</div>

		<div id="divUpload" style="display: none;">
			<div class="row">
	            <div class="col-lg-12">
	                <h3 class="page-header">Subir fotos</h3>
	            </div>
	            <!-- /.col-lg-12 -->
	        </div>
	        <!-- /.row -->
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="tbUploads" class="table table-striped">
						<thead>
							<th width="15%" class="text-center">Foto</th>
                            <th width="30%" class="text-center">Descripción</th>
							<th width="20%" class="text-center">Estado</th>
							<th width="20%" class="text-center">Progreso</th>
							<th width="15%" class="text-center">Opciones</th>
						</thead>
						<tbody>
						</tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <input id="fuPhotos" type="file" style="display: none;" multiple="true">
                                    <button class="btn btn-primary pull-left btnUploadAll_Start" onclick="uploadPhotos()">Subir fotos</button>
                                </td>
                                <td colspan="2">
                                    <a href="{{ route('albums.show', $album->id) }}" class="btn btn-default pull-right btnUploadAll_Cancel">Volver</a>
                                </td>
                            </tr>
                        </tfoot>
					</table>
				</div>
			</div>
	    	<!-- /.col-lg-12 -->

            <div class="col-md-12">
                <div id="divDebug"></div>
            </div>
		</div>
	</div>
@endsection

@section('js')

    <script type="text/javascript">

        $(document).ready(function()
        {
            //maxSize_content = 20000000; // 20 mb
            //maxSize_content = 6655000; // 5 mb
            maxSize_content = 12655000; // 10 mb
            maxSize_file = (maxSize_content / 1.33);

            $('#lbMaxSize').text((maxSize_file / 1000000).toFixed(2));

            uploadRecursive = false;

            $('.btnUploadAll_Cancel').click(function(e)
            {
                if($(this).attr('disabled'))
                {
                    e.preventDefault();
                }
            });
        });

        $('a[rel^="prettyPhoto"]').prettyPhoto();

		/*
		*	Container
		*/

    	function showUploadContainer()
    	{
    		newUpload();
    	}

        function showListContainer()
    	{
    		$('#divUpload').hide();
            $('#divList').show();
    	}

    	/*
    	*	Photo list
    	*/

        $('.a-remove-photo').click(function()
            {
                var hrefPhotos = $(this).data('href-photos');
                var id = $(this).data('id');

                swal({
                        title: "Eliminar foto",
                        text: "¿Realmente deseas eliminar la foto?",
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
                                "{{ route('albums.photodestroy') }}",
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
                                        swal("Error", "¡Ha ocurrido un error al eliminar la foto!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al eliminar la foto!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Eliminado!",
                                                text: "La foto se ha eliminado con éxito",
                                                type: "success",
                                                showCancelButton: false,
                                                closeOnConfirm: false
                                            },
                                            function()
                                            {
                                                document.location = hrefPhotos;
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


        /*
        *	Upload
        */

        function newUpload()
        {
            var inputFile = document.createElement('input');

            $(inputFile)
            .attr('type', 'file')
            .attr('multiple', 'true')
            .attr('style', 'display: none;')
            .attr('accept', 'image/*')
            .change(function()
            {
                if($(this)[0].files.length > 0)
                {
                    var files = $(this)[0].files;
                    var index = 0;

                    var reader = new FileReader();

                    reader.onload = function (e)
                    {
                        var data = this.result;

                        addPhotoToUploadList(e.timeStamp, data);

                        if(++index < files.length)
                        {
                            reader.readAsDataURL(files[index]);
                        }
                        else
                        {
                            $('.btnUploadAll_Start').removeAttr('disabled');
                            $('.btnUploadAll_Cancel').removeAttr('disabled');
                        }
                    }

                    $('.btnUploadAll_Start').attr('disabled', 'true');
                    $('.btnUploadAll_Cancel').attr('disabled', 'true');

                    reader.readAsDataURL(files[index]);

                    $('#divUpload').show();
                    $('#divList').hide();
                }
                else
                {
                    alert('Zero files');
                }

            })
            .click();
        }

        function addPhotoToUploadList(id, data)
        {
            if(data.length < maxSize_content) //max post length
            {
                var newRow  =   '<tr data-id="' + id + '" data-uploadable="1">'
                            +   '   <td style="text-align: center;"><img class="img-responsive" style="height: 60px;" src="' + data + '"></td>'
                            +   '   <td style="text-align: center;"><textarea rows="3" class="form-control"></textarea></td>'
                            +   '   <td class="text-center"><i class="glyphicon glyphicon-time"></i> <label class="upload-status">En espera</label></td>'
                            +   '   <td class="text-center">'
                            +   '       <div class="progress" style="width: 100%;"><div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"><label class="progress-percent">0%</label></div></div>'
                            +   '   </td>'
                            +   '   <td class="text-center">'
                            +   '       <button class="btn btn-primary btnUpload_Start" style="display: none;"><i class="glyphicon glyphicon-arrow-up"></i> Reintentar</button>'
                            +   '       <button class="btn btn-danger btnUpload_Remove"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>'
                            +   '   </td>'
                            +   '</tr>';
            }
            else
            {
                var newRow  =   '<tr data-id="' + id + '" data-uploadable="0">'
                            +   '   <td style="text-align: center;"><img class="img-responsive" style="height: 60px;" src="' + data + '"></td>'
                            +   '   <td style="text-align: center;"></td>'
                            +   '   <td class="text-center"><i class="glyphicon glyphicon-warning-sign"></i> <label class="upload-status">No permitido</label></td>'
                            +   '   <td class="text-center">'
                            +   '       <label>El tamaño supera los ' + (maxSize_file / 1000000).toFixed(2) + ' mb</label>'
                            +   '   </td>'
                            +   '   <td class="text-center">'
                            +   '       <button class="btn btn-danger btnUpload_Remove"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>'
                            +   '   </td>'
                            +   '</tr>';
            }

            $('#tbUploads > tbody').append(newRow);

            $($('#tbUploads > tbody > tr:last').find('.btnUpload_Start')[0]).click(function()
            {
                var tr = $(this).parent().parent();
                var id = $(tr).data('id');
                var uploadable = $(tr).data('uploadable');

                if(uploadable > 0)
                {
                    var data = $($($(tr).find('td:first')).find('img')[0]).attr('src');

                    var txtDescription = $(tr).find('td > textarea:first');
                    var icon = $(tr).find('i:first');
                    var status = $(tr).find('.upload-status:first');
                    var progress = $(tr).find('.progress:first');
                    var progressBar = $(tr).find('.progress-bar:first');
                    var progressPercent = $(tr).find('.progress-percent:first');
                    var btnStart = $(tr).find('.btnUpload_Start:first');

                    var form = document.createElement('form');

                    $(form)
                    .attr('action', "{{ route('albums.photoupload', $album->id) }}")
                    .attr('method', 'POST')
                    .attr('enctype', 'multipart/form-data');

                    var token = document.createElement('input');
                    $(token)
                    .attr('type', 'hidden')
                    .attr('name', '_token')
                    .attr('value', '{{ csrf_token() }}');

                    var description = document.createElement('input');
                    $(description)
                    .attr('type', 'hidden')
                    .attr('name', 'description')
                    .attr('value', $(txtDescription).val());

                    var photo = document.createElement('input');
                    $(photo)
                    .attr('type', 'hidden')
                    .attr('name', 'image_data')
                    .attr('value', data);

                    $(form).append(token);

                    $(form).append(description);

                    $(form).append(photo);

                    $(form).ajaxForm(
                        {
                            beforeSend: function()
                            {
                                $(status).text('Preparado');
                                $(icon).attr('class', '').addClass('glyphicon glyphicon-flag');
                                var percentVal = '0%';
                                progressBar.width(percentVal);
                                $(progressBar).attr('aria-valuenow', '0');
                                $(progressBar).removeClass('progress-bar-danger');
                                $(progressBar).removeClass('progress-bar-success');
                                progressPercent.text(percentVal);

                                $(btnStart).attr('disabled', 'true');
                                $(txtDescription).attr('readonly', 'true');
                            },
                            uploadProgress: function(event, position, total, percentComplete)
                            {
                                $(status).text('Subiendo');
                                $(icon).attr('class', '').addClass('glyphicon glyphicon-open');
                                var percentVal = percentComplete + '%';
                                progressBar.width(percentVal);
                                $(progressBar).attr('aria-valuenow', 'percentComplete');
                                progressPercent.text(percentVal);
                            },
                            success: function()
                            {
                                var percentVal = '100%';
                                progressBar.width(percentVal);
                                $(progressBar).attr('aria-valuenow', '100');
                                progressPercent.text(percentVal);
                            },
                            complete: function(xhr)
                            {
                                console.log(xhr);

                                if(xhr.status === 200)
                                {
                                    var response = JSON.parse(xhr.responseText);

                                    if(response.status === 1)
                                    {
                                        $(status).text('Finalizado');
                                        $(icon).attr('class', '').addClass('glyphicon glyphicon-saved');
                                        $(progressBar).addClass('progress-bar-success');

                                        $(btnStart).remove();
                                    }
                                    else
                                    {
                                        $(btnStart).removeAttr('disabled');
                                        $(txtDescription).removeAttr('readonly');

                                        $(status).text('Error');
                                        $(icon).attr('class', '').addClass('glyphicon glyphicon-warning-sign');
                                        $(btnStart).fadeIn();
                                        $(progressBar).addClass('progress-bar-danger');
                                    }

                                    progressPercent.text(response.message);
                                }
                                else
                                {
                                    $(btnStart).removeAttr('disabled');
                                    $(txtDescription).removeAttr('readonly');

                                    $(status).text('Error');
                                    $(icon).attr('class', '').addClass('glyphicon glyphicon-warning-sign');
                                    $(btnStart).fadeIn();
                                    $(progressBar).addClass('progress-bar-danger');

                                    if(xhr.status === 500)
                                    {
                                        progressPercent.text('Error interno del servidor');
                                    }
                                    else
                                    {
                                        progressPercent.text('Error con el servidor');
                                    }
                                }

                                if(uploadRecursive)
                                {
                                    uploadNextPhoto();
                                }
                            }
                        }
                    )
                    .submit();
                }

            });

            $($('#tbUploads > tbody > tr:last').find('.btnUpload_Remove')[0]).click(function()
            {
                var tr = $(this).parent().parent();

                swal({
                        title: "Eliminar foto",
                        text: "¿Realmente deseas eliminar la foto?",
                        type: "warning",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Sí, ¡eliminar ahora!",
                        cancelButtonText: "Cancelar",
                        showCancelButton: true,
                        closeOnConfirm: true,
                        showLoaderOnConfirm: true,
                    },
                    function()
                    {
                        $(tr).remove();

                        if($('#tbUploads > tbody > tr').length < 1)
                        {
                            showListContainer();
                        }
                    }
                );

            });

        }

        function uploadPhotos()
        {
            $('.btnUpload_Remove').fadeOut();
            $('.btnUploadAll_Start').attr('disabled', 'true');
            $('.btnUploadAll_Cancel').attr('disabled', 'true');

            uploadButtons = new Array();
            uploadIndex = 0;
            uploadRecursive = true;

            $('#tbUploads > tbody > tr > td > .btnUpload_Start').each(function()
            {
                uploadButtons.push($(this));
            });

            if(uploadButtons.length > 0)
            {
                swal({
                      title: "Subiendo..",
                      text: "Espera mientras transferimos las fotos",
                      imageUrl: "{{ asset('admin/img/uploading.png') }}",
                      showConfirmButton: false
                });

                uploadNextPhoto();
            }
        }

        function uploadNextPhoto()
        {
            if(uploadIndex < uploadButtons.length)
            {
                $(uploadButtons[uploadIndex++]).click();
            }
            else
            {
                uploadRecursive = false;

                if($('#tbUploads > tbody > tr > td > .btnUpload_Start').length > 0)
                {
                    $('.btnUploadAll_Start').removeAttr('disabled');
                }

                $('.btnUploadAll_Cancel').removeAttr('disabled');

                swal.close();
            }
        }

    </script>

@endsection
