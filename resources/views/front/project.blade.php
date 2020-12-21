@extends('front.template.main')

@section('title', 'Proyecto')

@section('content')
    <section id="my-video" class="full-width-box">			
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-color upper"></h2>
                    <!-- Video -->			
                    <div id="bg-video">
                        <div class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=SXSTsdX0_2c',containment:'#my-video',startAt:0, mute:false, autoPlay:true, showControls:false}"></div>
                    </div> 

                    <div id="video-controls" style="display: block;">
                        <a class="fa fa-pause text-color color-border" id="video-play" href="#"></a>
                    </div>  
                </div>
            </div>
        </div><!-- .additional-info--> 
    </section><!-- #My-video -->

    <section id="additional" class="full-width-box">		
        <div class="container">
          <div class="row">      	
                <div class="col-md-4 text-center" data-appear-animation="fadeInLeft">
                 <!-- Image -->
                 <img src="{{ asset('front/img/pages/project/1.jpg') }}" width="300" alt="">
                </div>
                <div class="col-md-8" data-appear-animation="fadeInRight"> 
                    <div class="title-box">	
                      <!-- Title -->
                      <h2 class="title">Estudio de la Calidad de las Aguas Subterráneas del Acuífero de Pica, Valle de Quisma y Pica, Región de Tarapacá </h2>
                    </div>     
                    <!-- Content -->
                    <p class="text-justify">El proyecto tiene su origen en las inquietudes formuladas por diferentes grupos de agricultores de la comuna de Pica, basadas sobre la posibilidad de conocer el actual estado de la calidad físico química de las aguas subterráneas, recurso fundamental para el riego de los cultivos, y potencial desarrollo agrícola del territorio.</p>
                    <p class="text-justify">El proyecto tiene como principal objetivo, estudiar la calidad de las aguas subterráneas del acuífero de Pica, Valle de Quisma y Pica, a través de una red de monitoreo de más de 30 pozos de extracción.  </p>
                    <!-- Features -->
                    <div class="row responsive-features top-pad">
                    <!-- Features 1 -->
                    <div data-animation-delay="700" data-animation="fadeInUp" class="col-md-4 animated fadeInUp visible">
                        <!-- Title And Content -->
                        <span class="myicon-rss2"></span><h4>Red de monitoreo</h4>
                        <p class="text-justify" style="color: #555555;">La red de monitoreo ha sido seleccionada con el fin de conocer adecuadamente la calidad química de las aguas subterráneas en toda la extensión del acuífero de Pica. Asimismo, se han seleccionado pozos actualmente perforados a distintas profundidades del subsuelo, con el objetivo de identificar las diferentes calidades de aguas basados en la profundidad. </p>
                    </div><!-- Features 1 -->

                    <!-- Features 2 -->
                    <div data-animation-delay="900" data-animation="fadeInUp" class="col-md-4 animated fadeInUp visible" >
                        <!-- Title And Content -->
                        <span class="myicon-earth2"></span><h4>Hidrogeología</h4>
                        <p class="text-justify" style="color: #550000;">La hidrogeología es el estudio de las aguas subterráneas, y ayuda a entender cómo son los recursos hídricos en el subsuelo, permite saber cuanta y que calidad de agua se puede obtener a través de pozos de captación. El estudio hidrogeológico del acuífero de Pica y la caracterización de su calidad química, constituye una pieza clave para gestionar de forma sostenible las aguas que se utilizan para el riego en Pica, y la protección de sus acuíferos.</p>
                    </div><!-- Features 2 -->

                    <!-- Features 3 -->
                    <div data-animation-delay="1100" data-animation="fadeInUp" class="col-md-4 animated fadeInUp visible">
                        <!-- Title And Content -->
                        <span class="myicon-map-pin-alt"></span><h4>Plataforma SIG</h4>
                        <p class="text-justify" style="color: #000055;"> Esta plataforma permitirá a la comunidad y a la institucionalidad asociada  conocer  información sobre la red de monitoreo, visualizar y descargar mapas interactivos,  conocer los análisis físico químicos realizados a cada pozo seleccionado y los resultados generados en el desarrollo el proyecto.</p>
                    </div><!-- Features 3 -->
                </div><!-- Features -->
            </div>
          </div>

          <div class="clearfix"></div>
        </div><!-- .welcome -->
    </section>

    <section id="photos" class="full-width-box bg-light-gray border">
      <div class="band-13"><div class="overlay"></div></div>	  
      <div class="container-fluid">
         <div class="title-box text-center">
          <!-- Heading -->
          <h2 class="title">Fotografías del proyecto</h2>
        </div>
        <div class="portfolio">

          <div class="clearfix"></div>

          <div class="row filter-elements">

            @foreach($photos as $photo)

              <div class="work-element web-design col-xs-12 col-sm-6 col-md-3">
                <div class="work work-photo">
                    <!-- Image -->
                  <img src="{{ asset('front/upload/albums') }}/{{ $photo->image->name }}"  width="270" height="197" alt="">
                  <span class="shadow"></span>
                  <div class="bg-hover"></div>
                  <div class="work-title">				  
                    <!-- Image Popup-->
                    <a href="{{ asset('front/upload/albums') }}/{{ $photo->image->name }}" data-rel="prettyPhoto[{{ $photo->image->name }}}]">
                      <i class="fa fa-search"></i>
                    </a>
                  </div>
                </div>
              </div><!-- .work-element -->

            @endforeach


          </div>
        </div>
      </div>
    </section><!-- .full-width-box -->

    <section id="team" class="full-width-box">
      <div class="container our-team">
         <div class="title-box text-center">
            <!-- Heading -->
            <h2 class="title">Nuestro equipo</h2>
         </div>
         <div class="row text-center">
            <div class="col-sm-6 col-md-3 team-member" data-appear-animation="fadeInLeft">
               <div class="default">
                  <div class="image">
                    <!-- Image -->
                    <img src="{{ asset('front/img/pages/project/team/bck/natalia_gutierrez.jpg') }}" alt="" title="" width="270" height="270">
                  </div>
                  <div class="description text-center">
                    <div class="vertical">
                      <!-- Name -->
                      <h3 class="name">Natalia Gutiérrez</h3>
                      <!-- Designation -->
                      <div class="role">Directora de Proyecto</div>	
                    </div>
                  </div>
                </div>
                <p class="text-center">Ing. Agrícola</p>
            </div>
            <!-- .employee  -->

            <div class="col-sm-6 col-md-3 team-member" data-appear-animation="fadeInLeft">
               <div class="default">
                  <div class="image">
                    <!-- Image -->
                    <img src="{{ asset('front/img/pages/project/team/jose_luque.jpg') }}" alt="" title="" width="270" height="270">
                  </div>
                  <div class="description text-center">
                    <div class="vertical">
                      <!-- Name -->
                      <h3 class="name">José Luque</h3>
                      <!-- Designation -->
                      <div class="role">Investigador Hidrogeólogo</div>	
                    </div>
                  </div>
                </div>
                <p class="text-center">Dr. en Geología</p>
            </div>
            <!-- .employee  -->

            <div class="col-sm-6 col-md-3 team-member" data-appear-animation="fadeInLeft">
               <div class="default">
                  <div class="image">
                    <!-- Image -->
                    <img src="{{ asset('front/img/pages/project/team/maria_ildefonso.jpg') }}" alt="" title="" width="270" height="270">
                  </div>
                  <div class="description text-center">
                    <div class="vertical">
                      <!-- Name -->
                      <h3 class="name">María Ildefonso</h3>
                      <!-- Designation -->
                      <div class="role">Analista Químico</div>	
                    </div>
                  </div>
                </div>
                <p class="text-center">Licenciada en Química</p>
            </div>
            <!-- .employee  -->

            <div class="col-sm-6 col-md-3 team-member" data-appear-animation="fadeInLeft">
               <div class="default">
                  <div class="image">
                    <!-- Image -->
                    <img src="{{ asset('front/img/pages/project/team/salome_cordova.jpg') }}" alt="" title="" width="270" height="270">
                  </div>
                  <div class="description text-center">
                    <div class="vertical">
                      <!-- Name -->
                      <h3 class="name">Salomé Córdova</h3>
                      <!-- Designation -->
                      <div class="role">Ing. de Proyecto</div>	
                    </div>
                  </div>
                </div>
                <p class="text-center">Ing. Civil Ambiental</p>
            </div>
            <!-- .employee  -->

            <div class="col-sm-6 col-md-3 team-member" data-appear-animation="fadeInLeft">
               <div class="default">
                  <div class="image">
                    <!-- Image -->
                    <img src="{{ asset('front/img/pages/project/team/maria_carvajal.png') }}" alt="" title="" width="270" height="270">
                  </div>
                  <div class="description text-center">
                    <div class="vertical">
                      <!-- Name -->
                      <h3 class="name">María Angélica Carvajal</h3>
                      <!-- Designation -->
                      <div class="role">Gestor Financiero</div>	
                    </div>
                  </div>
                </div>
                <p class="text-center">Secretaria Ejecutiva Computacional</p>
            </div>
            <!-- .employee  -->

            <div class="col-sm-6 col-md-3 team-member" data-appear-animation="fadeInLeft">
               <div class="default">
                  <div class="image">
                    <!-- Image -->
                    <img src="{{ asset('front/img/pages/project/team/alejandro_flores.jpg') }}" alt="" title="" width="270" height="270">
                  </div>
                  <div class="description text-center">
                    <div class="vertical">
                      <!-- Name -->
                      <h3 class="name">Alejandro Flores</h3>
                      <!-- Designation -->
                      <div class="role">Ing. de Proyecto</div>	
                    </div>
                  </div>
                </div>
                <p class="text-center">Ing. Agrícola</p>
            </div>
            <!-- .employee  -->

            <div class="col-sm-6 col-md-3 team-member" data-appear-animation="fadeInLeft">
               <div class="default">
                  <div class="image">
                    <!-- Image -->
                    <img src="{{ asset('front/img/pages/project/team/felipe_paiva.jpg') }}" alt="" title="" width="270" height="270">
                  </div>
                  <div class="description text-center">
                    <div class="vertical">
                      <!-- Name -->
                      <h3 class="name">Felipe Paiva</h3>
                      <!-- Designation -->
                      <div class="role">Profesional de Apoyo</div>	
                    </div>
                  </div>
                </div>
                <p class="text-center">Geólogo</p>
            </div>
            <!-- .employee  -->

            <div class="col-sm-6 col-md-3 team-member" data-appear-animation="fadeInLeft">
               <div class="default">
                  <div class="image">
                    <!-- Image -->
                    <img src="{{ asset('front/img/pages/project/team/leonor_bustillos.jpg') }}" alt="" title="" width="270" height="270">
                  </div>
                  <div class="description text-center">
                    <div class="vertical">
                      <!-- Name -->
                      <h3 class="name">Leonor Bustillos</h3>
                      <!-- Designation -->
                      <div class="role">Secretaria</div>	
                    </div>
                  </div>
                </div>
                <p class="text-center">Secretaria Ejecutiva Computacional</p>
            </div>
            <!-- .employee  -->

<div class="col-sm-6 col-md-3 team-member" data-appear-animation="fadeInLeft">
               <div class="default">
                  <div class="image">
                    <!-- Image -->
                    <img src="{{ asset('front/img/pages/project/team/venecia_herrera.png') }}" alt="" title="" width="270" height="270">
                  </div>
                  <div class="description text-center">
                    <div class="vertical">
                      <!-- Name -->
                      <h3 class="name">Venecia Herrera</h3>
                      <!-- Designation -->
                      <div class="role">Asesora Química</div>	
                    </div>
                  </div>
                </div>
                <p class="text-center">Licenciada en Química</p>
            </div>
            <!-- .employee  -->

            <div class="col-sm-6 col-md-3 team-member" data-appear-animation="fadeInLeft">
               <div class="default">
                  <div class="image">
                    <!-- Image -->
                    <img src="{{ asset('front/img/pages/project/team/christian_herrera.png') }}" alt="" title="" width="270" height="270">
                  </div>
                  <div class="description text-center">
                    <div class="vertical">
                      <!-- Name -->
                      <h3 class="name">Christian Herrera</h3>
                      <!-- Designation -->
                      <div class="role">Asesor Hidrogeólogo</div>	
                    </div>
                  </div>
                </div>
                <p class="text-center">Dr. en Geología</p>
            </div>
            <!-- .employee  -->
         </div>
      </div>
    </section>
    <!-- .full-width-box -->
@endsection