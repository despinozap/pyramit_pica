@extends('admin.template.main')

@section('title', 'Revisar comentario')

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
            <div class="panel panel-default">
                <div class="panel-heading">
                    Comentario
                </div>
                <div class="panel-body">
                    <form action="#">
                        <div class="form-group">
                            <label>Nombre</label>
                            <p class="form-control-static">{{ $comment->name }}</p>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <p class="form-control-static">{{ $comment->email }}</p>
                        </div>
                        <div class="form-group">
                            <label>Fecha</label>
                            <p class="form-control-static">{{ $comment->created_at->format('d-m-Y') }} a las {{ $comment->created_at->format('h:i:s A') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="content">Comentario</label>
                            <p class="form-control-static">{{ $comment->content }}</p>
                        </div>

                        <div class="form-group" data-id="{{ $comment->id }}">
                            <span class="btn btn-success pull-left comment-approve"><i class="glyphicon glyphicon-ok"></i> Aprobar</span>
                            <span class="btn btn-danger pull-right comment-reject"><i class="glyphicon glyphicon-remove"></i> Rechazar</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-lg-4 -->
    </div>
@endsection

@section('js')

    <script type="text/javascript">

        $('.comment-approve').click(function()
        {
            var id = $($(this).parent()).data('id');

            swal({
                    title: "Aprobar comentario",
                    text: "¿Realmente deseas aprobar el comentario?",
                    type: "warning",
                    confirmButtonColor: "#337AB7",
                    confirmButtonText: "Sí, ¡aprobar ahora!",
                    cancelButtonText: "Cancelar",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function()
                {
                    $.post(
                            "{{ route('comments.check') }}",
                            {
                                _token : "{{ csrf_token() }}",
                                id : id,
                                approved : 1
                            }
                    )
                    .done(function(responseCode)
                    {
                        console.log(responseCode);
                        var statusCode = parseInt(responseCode);

                        switch (statusCode)
                        {
                            case -1: //EXCEPTION
                                {
                                    swal("Error", "¡Ha ocurrido un error al aprobar el comentario!", "error");

                                    break;
                                }

                            case 0: //ERROR
                                {
                                    swal("Error", "¡Ha ocurrido un error al aprobar el comentario!", "error");

                                    break;
                                }

                            case 1: //SUCCESS
                                {
                                    swal({
                                            title: "Aprobado!",
                                            text: "El comentario se ha aprobado con éxito",
                                            type: "success",
                                            showCancelButton: false,
                                            closeOnConfirm: false
                                        },
                                        function()
                                        {
                                            document.location = "{{ route('comments.index') }}";
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
                        swal("Error", "¡Ha ocurrido un problema al intentar aprobar!", "error");
                    });
                }
            );

        });


        $('.comment-reject').click(function()
        {
            var id = $($(this).parent()).data('id');

            swal({
                    title: "Rechazar comentario",
                    text: "¿Realmente deseas rechazar el comentario?",
                    type: "warning",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Sí, ¡rechazar ahora!",
                    cancelButtonText: "Cancelar",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function()
                {
                    $.post(
                            "{{ route('comments.check') }}",
                            {
                                _token : "{{ csrf_token() }}",
                                id : id,
                                approved : 0
                            }
                    )
                    .done(function(responseCode)
                    {
                        console.log(responseCode);
                        var statusCode = parseInt(responseCode);

                        switch (statusCode)
                        {
                            case -1: //EXCEPTION
                                {
                                    swal("Error", "¡Ha ocurrido un error al rechazar el comentario!", "error");

                                    break;
                                }

                            case 0: //ERROR
                                {
                                    swal("Error", "¡Ha ocurrido un error al rechazar el comentario!", "error");

                                    break;
                                }

                            case 2: //SUCCESS
                                {
                                    swal({
                                            title: "Rechazado!",
                                            text: "El comentario se ha rechazado con éxito",
                                            type: "success",
                                            showCancelButton: false,
                                            closeOnConfirm: false
                                        },
                                        function()
                                        {
                                            document.location = "{{ route('comments.index') }}";
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
                        swal("Error", "¡Ha ocurrido un problema al intentar rechazar!", "error");
                    });
                }
            );

        });

    </script>

@endsection
