@extends('front.template.main')

@section('title', 'Galería')

@section('content')

	<section id="portfolio" class="full-width-box">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h2 class="text-color upper">Galería de fotos</h2>
                  <hr>
                  <div class="portfolio">
                    <div class="clearfix"></div>

                    <div class="row filter-elements">

                      @if($albums->count() > 0)
                        @foreach($albums as $album)

                          <div class="work-element col-xs-12 col-sm-6 col-md-4">
                            <div class="work work-photo">
                              <!-- Image -->
                              <img src="{{ asset('front/upload/albums') }}/{{ $album->image->name }}" alt="">
                              <span class="shadow"></span>
                              <div class="bg-hover"></div>
                              <div class="work-title">
                                <!-- Title -->
                                <h3 class="title">{{ $album->title }}</h3>
                                <!-- Category -->
                                <div class="description">{{ $album->description }}</div>
                                <!-- Image Popup-->
                                <a href="{{ asset('front/upload/albums') }}/{{ $album->image->name }}" data-rel="prettyPhoto[{{ $album->id }}]">
                                  <i class="fa fa-search"></i>
                                </a>

                                @foreach($album->photos as $photo)
                                  <a href="{{ asset('front/upload/albums') }}/{{ $photo->image->name }}" data-rel="prettyPhoto[{{ $album->id }}]"></a>
                                @endforeach

                                <a href="#" data-id="{{ $album->id }}" data-title="{{ $album->title }}" class="a-download-album">
									<i class="fa fa-cloud-download"></i>
                                </a>
                              </div>
                            </div>
                          </div><!-- .work-element -->

                        @endforeach

                      @else

                        <div class="col-xs-12">
                          <div class="">
                             <h3>No se han encontrado álbmes</h3>
                             <hr>
                          </div>
                        </div>
                      @endif

                    </div>
                  </div>
              </div>
          </div>
      </div>

  </section><!-- #about-us -->

@endsection

@section('js')

  <script type="text/javascript">

	  $('.a-download-album').click(function()
	  {
		  var title = $(this).data('title');
		  var id = $(this).data('id');

		  swal({
				  title: "Descargar álbum",
				  text: "¿Realmente deseas descargar el álbum \"" + title + "\"?. El sistema deberá comprimirlo previamente y esta operación puede tomar unos minutos",
				  imageUrl: "{{ asset('front/img/pages/gallery/photos_folder.png') }}",
				  confirmButtonText: "Sí, ¡descargar ahora!",
				  cancelButtonText: "Cancelar",
				  showCancelButton: true,
				  closeOnConfirm: false,
				  showLoaderOnConfirm: true,
			  },
			  function()
			  {
				  $.post(
						  "{{ route('front.downloadZipAlbum') }}",
						  {
							  _token : "{{ csrf_token() }}",
							  id : id
						  }
				  )
				  .done(
						  function(fileName)
						  {
							  if(fileName.length > 0)
							  {
								  var linkZip = document.createElement('a');
								  $(linkZip)
								  .attr('href', "{{ asset('front/upload/albums') }}" + "/" + fileName)
								  .attr('download', 'Album_' + id + '.zip');

								  linkZip.click();

								  $(linkZip).remove();
							  }
							  else
							  {
								  swal("Error", "No se pudo generar el archivo ZIP", "error");
							  }
						  }
				  )
				  .fail(
						  function()
						  {
							  swal("Error", "Se ha producido un error en el sistema", "error");
						  }
				  )
				  .always(
						  function()
						  {
							  swal.close();
						  }
				  );
			  }
		  );
	  });

  </script>

@endsection
