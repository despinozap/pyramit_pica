@if(Auth::user())
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <img class="img-responsive" src="{{ asset('front/img/logos/logo.png') }}" />
            </li>
            <li>
                <a href="{{ route('panel.index') }}"><i class="fa fa-home fa-fw"></i> Inicio</a>
            </li>
            @if(Auth::user()->type == 'admin')
                <li>
                    <a href="#"><i class="fa fa-file fa-fw"></i> Noticias<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('categories.index') }}"><i class="fa fa-list fa-fw"></i> Categorías</a>
                        </li>
                        <li>
                            <a href="{{ route('articles.index') }}"><i class="fa fa-file-text fa-fw"></i> Artículos</a>
                        </li>
                        <li>
                            <a href="{{ route('comments.index') }}">
                                <i class="fa fa-comments fa-fw"></i> Comentarios

                                @if($comments_count > 0)
                                    <span class="badge">{{ $comments_count }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="{{ route('documents.index') }}"><i class="fa fa-folder-open fa-fw"></i> Documentos</a>
                </li>
                <li>
                    <a href="{{ route('albums.index') }}"><i class="fa fa-photo fa-fw"></i> Álbumes</a>
                </li>
                <li>
                    <a href="{{ route('wells.index') }}"><i class="fa fa-map-marker fa-fw"></i> Mapas</a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"><i class="fa fa-users fa-fw"></i> Usuarios</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cogs fa-fw"></i> Configuración<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('configuration.contact') }}"><i class="fa fa-envelope fa-fw"></i> Contacto</a>
                        </li>
                        <li>
                            <a href="{{ route('configuration.logos') }}"><i class="fa fa-photo fa-fw"></i> Logos</a>
                        </li>
                    </ul>
                </li>
            @elseif(Auth::user()->type == 'editor')
                <li>
                    <a href="#"><i class="fa fa-file fa-fw"></i> Noticias<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('categories.index') }}"><i class="fa fa-list fa-fw"></i> Categorías</a>
                        </li>
                        <li>
                            <a href="{{ route('articles.index') }}"><i class="fa fa-file-text-o fa-fw"></i> Artículos</a>
                        </li>
                        <li>
                            <a href="{{ route('comments.index') }}">
                                <i class="fa fa-comments fa-fw"></i> Comentarios

                                @if($comments_count > 0)
                                    <span class="badge">{{ $comments_count }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="{{ route('albums.index') }}"><i class="fa fa-photo fa-fw"></i> Álbumes</a>
                </li>
            @endif

            <li>
                <a href="{{ route('front.home') }}" target="_blank"><i class="fa fa-eye fa-fw"></i> Ver sitio</a>
            </li>
        </ul>

        <div class="row" style="font-size: 10px; margin-top: 50px; text-align:center;">
            © Desarrollado por <a href="http://www.pyramit.cl" target="_blank">pyramIT Ingeniería Informática</a>
        </div>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
@endif
