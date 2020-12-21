@extends('front.template.main')

@section('title', 'SIG')

@section('content')

	<section id="wells" class="full-width-box">
		<div class="container">
    	<div class="row">
        	<div class="col-md-12">
          	<h2 class="text-color upper">Mapas</h2>
          	<hr>
       	  </div>
      </div>
   	</div>
   	<div class="container shop grid-2">
      <div class="row">
        <div class="col-md-12 product-page">

         	@if($wells->count() > 0)

            @foreach($wells as $well)
              <!-- Well -->
              <div class="row">
                 <div class="col-md-4 col-sm-6">
                    <div class="product-item">
                       <div class="product-img">
                          <img src="{{ asset('front/upload/wells') }}/{{ $well->image->name }}" alt="{{ $well->name }}" width="378" />
                          <div class="product-overlay">
                          	<div class="quick-view"> <a href="{{ asset('front/upload/wells') }}/{{ $well->image->name }}" data-rel="prettyPhoto[{{ $well->id }}]"><i class="fa fa-eye"></i> Ver imágen</a></div>
                             	<div class="add-to-cart"><a href="{{ $well->link }}" target="_blank"><i class="fa fa-map-marker"></i> Ir al mapa</a></div>

                          </div>
                       </div>
                       <div class="product-details">
                          <h4>Acceso al SIG</h4>
                          <h5 class="text-color">{{ $well->author }}</h5>
                       </div>
                    </div>
                 </div>
                 <!-- .product -->
                 <div class="col-md-8 col-sm-6">
                    <div class="">
                       <h3>{{ $well->name }}</h3>
                    </div>
                    <div class="description">
                       <p>{{ $well->description }}</p>
					   <hr>
                    </div>
                 </div>
              </div>
              <!-- Well! -->
            @endforeach
          @else

            <div class="col-xs-12">
              <div class="">
                 <h3>No se han encontrado mapas</h3>
                 <hr>
              </div>
            </div>

          @endif

        </div>
      </div>
    </div>
    <!-- .container -->
  </section>
  <!-- #main -->

@endsection
