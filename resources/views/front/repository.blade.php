@extends('front.template.main')

@section('title', 'Repositorio')

@section('content')

  <section id="repository" class="full-width-box">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h2 class="text-color upper">Documentos</h2>
                  <hr>
                  <div class="portfolio">
                    <div class="btn-group filter-buttons filter-list">
                      <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                        Todos los documentos <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <!-- Filter Tabs -->
                        <li><a href="#" data-filter="*" class="active">Todos</a></li>
                        <li><a href="#" data-filter=".cat-biblio">Bibliografías</a></li>
                        <li><a href="#" data-filter=".cat-report">Presentaciones</a></li>
                          <li><a href="#" data-filter=".cat-other">Otros documentos</a></li>
                      </ul>
                      <div class="clearfix"></div>
                    </div><!-- .filter-buttons -->

                    <div class="clearfix"></div>

                    <div class="row filter-elements">

                      @foreach($documents as $document)
                        <div class="work-element cat-{{ $document->category }} col-xs-12 col-sm-6 col-md-4">
                          <div class="work work-document">
                              <!-- Image -->
                            <img src="{{ asset('front/upload/documents') }}/{{ $document->image->name }}" alt="">
                            <span class="shadow"></span>
                            <div class="bg-hover"></div>
                            <div class="work-title">
                              <!-- Title -->
                              <h3 class="title">{{ $document->title }}</h3>
                              <!-- Description -->
                              <!--<div class="description">Descripción del documento 1</div>-->
                              <!-- Image Popup-->
                              <a href="{{ asset('front/upload/documents') }}/{{ $document->name }}" target="_blank">
                                <i class="fa fa-search"></i>
                              </a>
                              <a href="{{ asset('front/upload/documents') }}/{{ $document->name }}" download="{{ $document->original_name }}">
                                <i class="fa fa-cloud-download"></i>
                              </a>
                            </div>
                          </div>
                        </div><!-- .work-element -->
                      @endforeach
                    </div>
                  </div>
              </div>
          </div>
          <div class="pagination-box pull-right">
            {!! $documents->render() !!}
          </div><!-- .pagination-box -->
      </div>
  </section>
@endsection
