@extends('admin.template.main')

@section('title', 'Video-tutoriales')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b id="vidTitle">Video-tutoriales</b>
                </div>
                <div class="panel-body" style="text-align: center;">
                    <div class="col-md-12">
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-file-o fa-fw"></span>
                                Noticias
                                <span>&nbsp;</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="vid-selector" data-src="{{ asset('admin/video/categories.mp4') }}" href="#">Gestión de Categorías</a></li>
                                <li><a  class="vid-selector" data-src="{{ asset('admin/video/articles.mp4') }}" href="#">Gestión de Artículos</a></li>
                                <li><a  class="vid-selector" data-src="{{ asset('admin/video/comments.mp4') }}" href="#">Gestión de Comentarios</a></li>
                            </ul>
                        </div>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-folder-open-o fa-fw"></span>
                                Documentos
                                <span>&nbsp;</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="vid-selector" data-src="{{ asset('admin/video/documents.mp4') }}" href="#">Gestión de Documentos</a></li>
                            </ul>
                        </div>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-photo fa-fw"></span>
                                Álbumes
                                <span>&nbsp;</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="vid-selector" data-src="{{ asset('admin/video/albums.mp4') }}" href="#">Gestión de Álbumes</a></li>
                            </ul>
                        </div>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-map-marker fa-fw"></span>
                                Mapas
                                <span>&nbsp;</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="vid-selector" data-src="{{ asset('admin/video/wells.mp4') }}" href="#">Gestión de Mapas</a></li>
                            </ul>
                        </div>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-users fa-fw"></span>
                                Usuarios
                                <span>&nbsp;</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="vid-selector" data-src="{{ asset('admin/video/users.mp4') }}" href="#">Gestión de Usuarios</a></li>
                            </ul>
                        </div>
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-cogs fa-fw"></span>
                                Configuración
                                <span>&nbsp;</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="vid-selector" data-src="{{ asset('admin/video/contact.mp4') }}" href="#">Contacto</a></li>
                                <li><a class="vid-selector" data-src="{{ asset('admin/video/logos.mp4') }}" href="#">Logos</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
                    <div class="col-md-12">
                        <video id="vid" width="700" height="500" controls>
                        </video>
                    </div>
                </div>
                <!-- .panel-body -->
            </div>
        </div>
        <!-- /.col-lg-4 -->
    </div>

@endsection

@section('js')

    <script type="text/javascript">

        $(document).ready(function()
        {
            $('.vid-selector').click(function()
            {
                var vidSrc = $(this).data('src');
                var vidTitle = $(this).text();

                $('#vidTitle').text(vidTitle);

                var srcContent = "<source src=\"" + vidSrc + "\" type=\"video/mp4\">Tu navegador no soporta la reproducción de videos";

                $('#vid source').remove();
                $('#vid').append(srcContent);
                $("#vid")[0].load();
                $('#vid').get(0).play();
            });
        });

    </script>

@endsection
