@extends('admin.template.main')

@section('title', 'Lista de comentarios pendientes')

@section('content')
	<div class="row">
        <div class="col-md-12">
			@include('flash::message')
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<th width="40%">Artículo</th>
						<th width="20%">Nombre</th>
						<th width="20%">Email</th>
						<th width="10">Fecha</th>
						<th width="10%">Opciones</th>
					</thead>
					<tbody>
						@if($comments->count() > 0)
							@foreach($comments as $comment)
								<tr>
									<td>{{ $comment->article->title }}</td>
									<td class="text-center">{{ $comment->name }}</td>
									<td class="text-center">{{ $comment->email }}</td>
									<td class="text-center">{{ $comment->created_at->format('d-m-Y') }}</td>
									<td class="text-center">
										<a href="{{ route('comments.show', $comment->id) }}" class="btn btn-success btn-xs" title="Ver"><i class="glyphicon glyphicon-zoom-in"></i></a>
									</td>
								</tr>
							@endforeach
						@else
							<tr>
		                        <td colspan="5" class="text-center">
		                            <label>No se encontraron registros</label>
		                        </td>
		                    </tr>
						@endif
					</tbody>
				</table>
			</div>
			<div class="text-center">
				{!! $comments->render() !!}
			</div>
		</div>
    	<!-- /.col-lg-4 -->
	</div>
@endsection

@section('js')

    <script type="text/javascript">
        

    </script>

@endsection