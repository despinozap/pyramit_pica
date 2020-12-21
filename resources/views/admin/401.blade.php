@extends('admin.template.main')

@section('title', 'Acceso denegado')

@section('content')
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            <img src="{{ asset('front/img/pages/admin/access_denied.png') }}">
        </div>
        <div class="col-md-12" style="text-align: center;">
            <p>
                El tipo de usuario utilizado no tiene acceso al contenido solicitado.
            </p>
        </div>
        <!-- /.col-lg-4 -->
    </div>
@endsection
