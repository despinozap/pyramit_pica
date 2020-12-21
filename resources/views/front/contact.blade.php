@extends('front.template.main')

@section('title', 'Contacto')

@section('content')
    <section id="portfolio" class="full-width-box">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-color upper">Información de Contacto</h2>
                    <hr>
                    <div class="portfolio">
                      <div class="clearfix"></div>
                      @foreach($contacts as $contact_contact)
                        <div class="row">
                          <address class="col-sm-6 col-md-3">
                            <div class="title">{{ $contact_contact->name }}</div>
                              {{ $contact_contact->subname }}
                            </address>
                            <address class="col-sm-6 col-md-3">
                              <div class="title">Teléfono</div>
                              <div>{{ $contact_contact->phone }}</div>
                            </address>
                            <address class="col-sm-6 col-md-3">
                              <div class="title">Email</div>
                              <div><a href="mailto:{{ $contact_contact->email }}">{{ $contact_contact->email }}</a></div>
                            </address>
                            <address class="col-sm-6 col-md-3">
                              <div class="title">Redes sociales</div>
                              <div><a href="{{ $contact_contact->facebook }}" target="_blank">{{ $contact_contact->facebook }}</a></div>
                              <div><a href="{{ $contact_contact->twitter }}" target="_blank">{{ $contact_contact->twitter }}</a></div>
                            </address>
                        </div>
                        <hr>
                      @endforeach
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <form id="frmContact" class="register-form contact-form">
                          <h3 class="title">Escríbenos un mensaje</h3>
                          <span class="required"><b>*</b> Campos requeridos</span>
                          <select class="form-control" id="frmID" required="">
                            <option value="">Seleccione el contacto *</option>
                            @foreach($contacts as $contact_contact)
                              <option value="{{ $contact_contact->id }}">{{ $contact_contact->name }}</option>
                            @endforeach
                          </select>
                          <input class="form-control" type="text" id="frmName" placeholder="Nombre *" required="">
                          <input class="form-control" type="email" id="frmEmail" placeholder="Email *" required="">
                          <input class="form-control" type="text" id="frmPhone" placeholder="Teléfono">
                          <textarea class="form-control" id="frmComment" placeholder="Mensaje *" required=""></textarea>
                          <div class="clearfix"></div>
                          <div class="buttons-box clearfix">
                            <input type="submit" id="sbmtContact" class="btn btn-default" value="Enviar ahora">
                          </div><!-- .buttons-box -->
                        </form>
                      </div>
                    </div>
                </div>
            </div>
    </section><!-- #about-us -->
@endsection

@section('js')

  <script type="text/javascript">

        $(document).ready(function()
        {
            $('#frmContact').submit(function(e)
            {
                e.preventDefault();

                var contactName = $('#frmID option:selected').text();

                swal({
                        title: "Enviar email",
                        text: "¿Realmente deseas enviar email a \"" + contactName + "\"?",
                        type: "warning",
                        confirmButtonText: "Sí, ¡enviar ahora!",
                        cancelButtonText: "Cancelar",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    },
                    function()
                    {
                        var id = $('#frmID').val();
                        var name = $('#frmName').val();
                        var email = $('#frmEmail').val();
                        var phone = $('#frmPhone').val();
                        var comment = $('#frmComment').val();

                        $.post(
                                "{{ route('front.sendmail') }}",
                                {
                                    _token : "{{ csrf_token() }}",
                                    id : id,
                                    name : name,
                                    email : email,
                                    phone : phone,
                                    comment : comment
                                }
                        )
                        .done(function(responseCode)
                        {
                            var statusCode = parseInt(responseCode);

                            switch (statusCode)
                            {
								case -1: //EXCEPTION
                                    {
                                        swal("Error", "¡Ha ocurrido un error al enviar el email!", "error");

                                        break;
                                    }

                                case 0: //ERROR
                                    {
                                        swal("Error", "¡Ha ocurrido un error al enviar el email!", "error");

                                        break;
                                    }

                                case 1: //SUCCESS
                                    {
                                        swal({
                                                title: "Enviado!",
                                                text: "Atento que pronto recibirás nuestra respuesta",
                                                type: "success",
                                                showCancelButton: false,
                                                closeOnConfirm: true
                                            },
                                            function()
                                            {
                                                $('#frmContact')[0].reset();
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
                            swal("Error", "¡Ha ocurrido un problema al intentar enviar!", "error");
                        });
                    }
                );
            });

        });

    </script>

@endsection
