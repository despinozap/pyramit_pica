@extends('front.template.main')

@section('title', 'Inicio')

@section('content')
	<section class="slider rs-slider">
      <div class="tp-banner-container">
         <div class="tp-banner">
            <ul>
               <!-- Slide -->
               <li data-delay="7000" data-transition="fade" data-slotamount="7" data-masterspeed="2000">
                  <div class="elements">
                     <div class="tp-caption lfb"
                        data-x="0"
                        data-y="135"
                        data-speed="1000"
                        data-start="2040"
                        data-easing="Power4.easeOut"
                        data-endspeed="500"
                        data-endeasing="Power1.easeIn"
                        style="z-index: 4">
                        <img src="{{ asset('front/img/pages/home/home-sig.png') }}" width="400" alt="">
                     </div>
                     <h2 class="tp-caption lft skewtotop title bold"
                        data-x="502"
                        data-y="201"
                        data-speed="1000"
                        data-start="1700"
                        data-easing="Power4.easeOut"
                        data-endspeed="500"
                        data-endeasing="Power1.easeIn">
                        <strong>Sistema de Informaci&oacute;n Geogr&aacute;fica <br>SIG</strong>
                     </h2>
                     <h2 class="tp-caption lft skewtotop title "
                        data-x="502"
                        data-y="361"
                        data-speed="1000"
                        data-start="1700"
                        data-easing="Power4.easeOut"
                        data-endspeed="500"
                        data-endeasing="Power1.easeIn">
                     </h2>
                     <div class="tp-caption lfr skewtoright description black hidden-xs"
                        data-x="492"
                        data-y="425"
                        data-speed="1000"
                        data-start="1500"
                        data-easing="Power4.easeOut"
                        data-endspeed="500"
                        data-endeasing="Power1.easeIn"
                        style="max-width: 600px;">
                        <p>Podrás visualizar y descargar mapas interactivos y también información referente al estudio de las aguas subterráneas. </p>
                     </div>
                     <a href="{{ route('front.sig') }}" class="tp-caption lfb btn btn-default hidden-xs"
                        data-x="502"
                        data-y="532"
                        data-speed="1000"
                        data-start="1700"
                        data-easing="Power4.easeOut"
                        data-endspeed="500"
                        data-endeasing="Power1.easeIn">
                     Ingresar
                     </a>
                  </div>
                  <img src="{{ asset('front/img/pages/home/slider/rs-slider1-bg.png') }}" alt="" data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
               </li>
               <!-- Slide Ends -->
               <!-- Slide -->
               <li data-delay="7000" data-transition="fade" data-slotamount="7" data-masterspeed="2000">
                  <div class="elements">
                     <h2 class="tp-caption sft skewtotop title bold"
                        data-x="240"
                        data-y="201"
                        data-speed="1000"
                        data-start="500"
                        data-easing="Power4.easeOut"
                        data-endspeed="400"
                        data-endeasing="Power1.easeIn">
                        Documentos
                     </h2>
                     <div class="tp-caption lfr skewtoright description text-center hidden-xs"
                        data-x="290"
                        data-y="300"
                        data-speed="1000"
                        data-start="800"
                        data-easing="Power4.easeOut"
                        data-endspeed="500"
                        data-endeasing="Power1.easeIn"
                        style="max-width: 600px">
                        <p class="text-center">Ingresa al repositorio de documentos y encontrarás antecedentes relevantes del proyecto, informes de análisis fisico químico de las aguas subterráneas e interesante bibliografía descargable. </p>
                     </div>
                      <a href="{{ route('front.repository') }}" class="tp-caption lfb btn btn-default hidden-xs"
                        data-x="502"
                        data-y="532"
                        data-speed="1000"
                        data-start="1700"
                        data-easing="Power4.easeOut"
                        data-endspeed="500"
                        data-endeasing="Power1.easeIn">
                     Ingresar
                     </a>
                  </div>
                  <img src="{{ asset('front/img/pages/home/slider/rs-slider2-bg.png') }}" alt="" data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
               </li>
               <!-- Slide Ends -->
               <!-- Slide -->
               <li data-delay="{{ ($albums->count() * 2000) }}" data-transition="fade" data-slotamount="3" data-masterspeed="2000" class="slid2">
                  <div class="elements">
                     <h2 class="tp-caption sft skewtotop title bold"
                        data-x="15"
                        data-y="241"
                        data-speed="1000"
                        data-start="1100"
                        data-easing="Power4.easeOut"
                        data-endspeed="400"
                        data-endeasing="Power1.easeIn">
                        Galer&iacute;a de fotos
                     </h2>
                     <div class="tp-caption lfl skewtoleft description col-xs-5 hidden-xs"
                        data-x="0"
                        data-y="329"
                        data-speed="1000"
                        data-start="1000"
                        data-easing="Power4.easeOut"
                        data-endspeed="400"
                        data-endeasing="Power1.easeIn"
                        style="max-width: 520px;">
                        <p class="text-center">Visita la galería de fotos para visualizar los albumes de las distintas actividades realizadas durante el proyecto. </p>
                     </div>
                     <a href="{{ route('front.gallery') }}" class="btn btn-default tp-caption customin hidden-xs"
                        data-x="15"
                        data-y="522"
                        data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                        data-speed="1200"
                        data-start="1000"
                        data-easing="Power3.easeInOut"
                        data-endspeed="300"
                        style="z-index: 5">
                     Ingresar
                     </a>
                     <div class="tp-caption lfb skewtobottom customin"
                        data-x="650"
                        data-hoffset="150"
                        data-y="200"
                        data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                        data-speed="1000"
                        data-start="1000"
                        data-easing="Power4.easeOut"
                        data-end="{{ ($albums->count() * 2000) + 1000 }}"
                        data-endspeed="500"
                        data-endeasing="Power1.easeIn"
                        style="z-index: 4">
                        <img src="{{ asset('front/img/pages/home/slider/gallery-frame.png') }}" width="400" height="400" alt="">
                     </div>
					 @foreach ($albums as $album)
						 <div class="tp-caption customin customout gallery-frame-photo"
						 data-x="677"
						 data-hoffset="-208"
						 data-y="228"
						 data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:1;transformPerspective:600;transformOrigin:50% 50%;"
						 data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
						 data-speed="1"
						 data-start="{{ (($loop->index) * 2000) + 1000 }}"
						 data-easing="Power0.easeOut"
						 data-end="{{ (($loop->index + 1) * 2000) + 1000 }}"
						 data-endspeed="1"
						 data-endeasing="Power0.easeIn"
						 data-captionhidden="on"
						 style="z-index: 3">
							 <div class="polaroid-photo">
								 <img src="{{ asset('front/upload/albums') }}/{{ $album->image->name }}" alt="">
							 </div>
						 </div>
                     @endforeach
                  </div>
                  <img src="{{ asset('front/img/pages/home/slider/rs-slider3-bg.png') }}" alt="" data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat">
               </li>
               <!-- Slide Ends -->
            </ul>
            <div class="tp-bannertimer"></div>
         </div>
      </div>
    </section>
    <!-- .rs-slider -->
    <section id="about-us" class="full-width-box">
      <div class="container">
         <div class="title-box">
            <!-- Heading -->
            <h1 class="title">Plataforma Proyecto Aguas Subterráneas</h1>
         </div>
         <div class="row" data-appear-animation="fadeInUp">
            <div class="col-md-12 text-center">
               <!-- Text -->
               <p class="title-description" style="font-size: 20px;"> Esta plataforma permitirá a la comunidad y a la institucionalidad asociada  conocer  información sobre la red de monitoreo, visualizar y descargar mapas interactivos,  conocer los análisis físico químicos realizados a cada pozo seleccionado y los resultados generados en el desarrollo el proyecto.</p>
            </div>
         </div>
         <div class="row special-feature">
            <!-- Special Feature Box 1 -->
            <a href="{{ route('front.sig') }}">
                <div class="col-md-4">
                   <div class="s-feature-box text-center" data-appear-animation="fadeInLeft">
                      <div class="mask-top">
                         <!-- Icon -->
                         <i class="fa fa-map-marker"></i>
                         <!-- Title -->
                         <h4>Sistema de Informaci&oacute;n Geogr&aacute;fica</h4>
                      </div>
                      <div class="mask-bottom">
                         <!-- Icon -->
                         <i class="fa fa-location-arrow"></i>
                         <!-- Title -->
                         <h4>SIG</h4>
                         <!-- Text -->
                         <p>Sistema mapas interactivos, que permiten visualizar y consultar diferentes coberturas de la comuna de Pica.</p>
                      </div>
                   </div>
                </div>
            </a>
            <!-- Special Feature Box 2 -->
            <a href="{{ route('front.repository') }}">
                <div class="col-md-4">
                   <div class="s-feature-box text-center" data-appear-animation="fadeInLeft">
                      <div class="mask-top">
                         <!-- Icon -->
                         <i class="fa fa-copy"></i>
                         <!-- Title -->
                         <h4>Documentos</h4>
                      </div>
                      <div class="mask-bottom">
                         <!-- Icon -->
                         <i class="fa fa-folder-open"></i>
                         <!-- Title -->
                         <h4>Repositorio de archivos</h4>
                         <!-- Text -->
                         <p>Antecedentes del proyecto, informes técnicos y bibliografía.</p>
                      </div>
                   </div>
                </div>
            </a>
            <!-- Special Feature Box 3 -->
            <a href="{{ route('front.gallery') }}">
                <div class="col-md-4">
                   <div class="s-feature-box text-center" data-appear-animation="fadeInRight">
                      <div class="mask-top">
                         <!-- Icon -->
                         <i class="fa fa-camera"></i>
                         <!-- Title -->
                         <h4>Galer&iacute;a de fotos</h4>
                      </div>
                      <div class="mask-bottom">
                         <!-- Icon -->
                         <i class="fa fa-group"></i>
                         <!-- Title -->
                         <h4>Álbumes</h4>
                         <!-- Text -->
                         <p>Fotos de las diversas actividades realizadas en el marco del proyecto.</p>
                      </div>
                   </div>
                </div>
            </a>
         </div>
      </div>
    </section>

    <!-- .full-width-box -->
    <section id="news" class="full-width-box">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-9" data-appear-animation="fadeInLeft">
                    <div class="title-box">
                        <!-- Heading -->
                        <h2 class="title">&Uacute;ltimas noticias</h2>
                    </div>
                    <ul class="latest-posts">
                        @foreach($articles as $article)
                            <li>
                                <img class="image" src="{{ asset('front/upload/articles/') }}/{{ $article->image->name }}" alt="" title="" width="20" height="20">
                                <div class="meta" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <!-- Title -->
                                    <a href="{{ route('front.article', $article->id) }}" title="{{ $article->title }}"><span style="font-size: 24px; color: #000000;">{{ $article->title }}</span></a>
                                    <br>
                                    <!-- Author -->
                                    <span>Publicado por <b>{{ $article->user->name }}</b></span>
                                    <!-- Meta Date -->
                                    <span class="time">{{ $article->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="description" style="word-wrap: break-word;">
                                    <p class="text-justify">
                                       <!-- Text -->
                                       {{ $article->description }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                        <!-- M O S T R A R  3  N O T I C I A S -->
                    </ul>
                </div>
                <div id="sidebar" class="sidebar col-sm-12 col-md-3">
                    <aside class="widget menu">
                        <header>
                            <h3 class="title">Sitios de interés</h3>
                        </header>
                        <nav>
                            <ul>
                                <!--
                                <li><a href="#">Pica</a></li>
                                <li class="parent">
                                    <a href="#"><span class="open-sub"></span>Municipalidad de Pica</a>
                                    <ul class="sub">
                                        <li><a href="#">Facebook</a></li>
                                        <li><a href="#">Twitter</a></li>
                                    </ul>
                                </li>
                                -->
                                <li><a href="http://www.ceitsaza.cl" target="_blank">Ceitsaza</a></li>
                                <li><a href="http://www.sanidadvegetal.cl" target="_blank">Portal de información sobre plagas y enfermedades de importancia silvoagrícolas</a></li>
                                <li><a href="http://www.minagri.gob.cl" target="_blank">Ministerio de Agricultura</a></li>
                                <li><a href="http://www.fao.org/chile/es/" target="_blank">Organización para las naciones unidas para la alimentación y la agricultura</a></li>
                                <li><a href="http://www.goretarapaca.gov.cl" target="_blank">Gobierno Regional de Tarapacá</a></li>
                                <li><a href="http://www.portalfruticola.com" target="_blank">Portal Frutícola</a></li>
                                <li><a href="http://www.rimisp.org" target="_blank">Centro Latinoamericano para el desarrollo rural (RIMISP)</a></li>
                                <li><a href="http://www.agromet.cl" target="_blank">Red agroclimática nacional</a></li>
                                <li><a href="http://www.cnr.cl/Paginas/Home.aspx" target="_blank">Comisión Nacional de Riego (CNR)</a></li>
                                <li><a href="http://www.iica.int/es" target="_blank">Instituto Interamericano de Cooperación para la Agricultura</a></li>
                            </ul>
                        </nav>
                    </aside><!-- .menu-->
                </div><!-- .sidebar -->
            </div>
        </div>
    </section>
    <!-- .full-width-box -->
@endsection
