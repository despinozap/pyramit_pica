@extends('admin.template.main')

@section('title', 'Inicio')

@section('content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $counters['articles'] }}</div>
                            <div>¡Artículos publicados!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('articles.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Ir a la lista</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-folder-open fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $counters['documents'] }}</div>
                            <div>¡Documentos publicados!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('documents.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Ir a la lista</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-photo fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $counters['albums'] }}</div>
                            <div>¡Álbumes en la galería!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('albums.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Ir a la lista</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-map-marker fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $counters['wells'] }}</div>
                            <div>¡Mapas publicados!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('wells.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Ir a la lista</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="well well-lg">
                <h4>¡Hola <b>{{ Auth::user()->name }}</b>!</h4>
                <hr>
                <p class="text-justify">
                    Te damos la bienvenida a la plataforma <b>Calidad de Aguas Subterráneas, Oasis de Pica</b> desarrollada como sistema de información en el marco del proyecto <b><i>Estudio de la Calidad de las Aguas Subterráneas de la cuenca de Pica, Valle de Quisma y Pica, Región de Tarapacá</i></b>.
                </p>
                <p class="text-justify">
                    Desde aquí podrás gestionar los recursos y contenidos que se publican en el sitio oficial de <a href="http://www.aguasubterraneapica.cl" target="_blank">Agua Subterránea Pica</a>.
                </p>
                <p class="text-justify">
                    Si no conoces las herramientas que te brinda la plataforma y su funcionamiento, te invitamos a descargar el <b>Manual de Uso</b> haciendo <a href="{{ asset('admin/manual/gestor.pdf') }}" target="_blank">click aquí</a>.
                </p>
                <p class="text-justify">
                    Además, si no te queda claro y necesitas ver en mayor detalle el paso a paso para realizar las tareas principales puedes acceder a los <b>Video-tutoriales</b> explicativos haciendo <a href="{{ route('panel.videos') }}">click aquí</a>.
                </p>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script type="text/javascript">

    </script>

@endsection
