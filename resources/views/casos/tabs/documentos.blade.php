
<!-- Mostrar listado de documentos y botón para mostrar un modal que nos permita subir un nuevo fichero -->
<div class="card">
	<div class="card-header">Documentos</div>
	<div class="card-body">
		<table class="table">
			<thead>
				<tr>
					<th scope>Nombre</th>
					<th scope>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($caso->documentos as $documento)
				<tr>
					<td>{{$documento->nombre}}</td>
					<td>
						<a href="{{ route('ver-documento',['file'=>$documento->path]) }}" target="_blank"><i class="mdi mdi-file-document" style="font-size: 26px"></i></a>
						<a href="#deleteContent{{$documento->id}}" role="button" data-toggle="modal"><i class="mdi mdi-delete-forever" style="font-size: 26px"></i></a>
					</td>
				</tr>
				<!-- Modal para borrar un fichero -->
				<div class="modal fade" id="deleteContent{{$documento->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteContentLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="deleteContentTitle">Eliminar archivo</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<h2>¿Estás seguro de borrar el fichero {{$documento->nombre}}?</h2>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								<a href="{{ route('delete-document',['id' => \Crypt::encrypt($documento->id)]) }}" class="btn btn-danger">Eliminar</a>                                                  	
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</tbody>
		</table>
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#uploadFile">
			Subir archivo
		</button>
		<!-- Modal para subir un fichero nuevo -->
		<div class="modal fade" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="uploadFileTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="uploadFileTitle">Subir archivo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="form" method="post" action="{{ route('caso-save-file') }}" enctype="multipart/form-data">
							{!! csrf_field() !!}
							<div class="input-group">
								<input type="file" id="documento" name="documento" class="form-control">
							</div>
							<div class="input-group mt-2">
								<div class="input-group-prepend">
									<span class="input-group-text">Título</span>
								</div>
								<input type="text" name="title" class="form-control">
							</div>
							<input type="hidden" name="casos_id" value="{{\Crypt::encrypt($caso->id)}}">

							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<button type="submit" class="btn btn-success">Guardar cambios</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>