@extends('layouts.app')

@section('content')
@extends('layouts.header')
<!-- Migas de pan -->
<div class="container-fluid ml-3">
	<div class="row">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
				<li class="breadcrumb-item"><a href="{{url('/menu-casos')}}">Casos</a></li>
				@if($caso->categoriaCliente == 'particular')
					<li class="breadcrumb-item"><a href="{{ route('list-case') }}">Particulares</a></li>
				@elseif($caso->categoriaCliente == 'pericial')
					<li class="breadcrumb-item"><a href="{{ route('list-periciales') }}">Periciales</a></li>
				@elseif($caso->categoriaCliente == 'turno-oficio')
					<li class="breadcrumb-item"><a href="{{ route('list-turno-oficio') }}">Turno de oficio</a></li>
				@endif
					
				<li class="breadcrumb-item active"><a href="{{ route('caso',['caso_id' => \Crypt::encrypt($caso->id)]) }}">Caso</a></li>
			</ol>
		</nav>
	</div>
</div>

<!-- Formulario correspondiente a la tabla Casos -->
<div class="container-fluid ml-3">
	<div class="row">
		<div class="col-12">
			@if(Session::has('message'))
				<div class="alert alert-success text-center">{{Session::get("message")}}</div>			
			@endif
			<form class="form-inline" method="post" action="{{route('update-caso',['caso_id' => \Crypt::encrypt($caso->id)])}}">
			{!! csrf_field() !!}
			@if($errors->has())
				@foreach($errors->all() as $error)
					<p class="help-block col-12"><strong>{{$error}}</strong></p>
				@endforeach
			@endif
    			<div class="form-row mt-3 mb-3 col-12">
    				<div class="input-group mr-2 col">
    					<div class="input-group-prepend">
    						<span class="input-group-text">Referencia</span>
    					</div>
    					<input type="text" class="form-control" name="referencia" id="referencia" value="{{ $caso->referencia }}">
    				</div>
    				<div class="input-group ml-2 mr-2 col">
    					<div class="input-group-prepend">
    						<span class="input-group-text">Jurisdicción</span>
    					</div>
    					<input type="text" class="form-control" name="jurisdiccion" id="referencia" value="{{ $caso->jurisdiccion }}">
    				</div>
    				<div class="input-group ml-2 mr-2 col">
    					<div class="input-group-prepend">
    						<span class="input-group-text">Estado</span>
    					</div>
    					<select name="estado" id="estado" class="custom-select">
    						@if($caso->estado == "activo")
    						<option value="activo" selected>Activo</option>
    						<option value="resuelto">Resuelto</option>
    						@else
    						<option value="activo">Activo</option>
    						<option value="resuelto" selected>Resuelto</option>
    						@endif
    					</select>
    				</div>
    				<div class="input-group ml-2 mr-2 col">
    					<div class="input-group-prepend">
    						<span class="input-group-text">Cod. Encargo</span>
    					</div>
    					<input type="text" name="codigo-encargo" id="codigo-encargo" class="form-control" value="{{ $caso->codigoEncargo }}">
    				</div>
    			</div>
    			<div class="form-row mt-3 mb-3 col-12">
    				<div class="input-group mr-2 col">
    					<div class="input-group-prepend">
    						<span class="input-group-text">Categoría</span>
    					</div>
    					<select name="categoria" id="categoria" class="custom-select">
    					@if($caso->categoriaCliente == 'particular')
        					<option value="particular" selected>Particular</option>
        					<option value="turno-oficio">Turno de oficio</option>
        					<option value="pericial">Pericial</option>
        				@elseif($caso->categoriaCliente == 'pericial')
        					<option value="particular">Particular</option>
        					<option value="turno-oficio">Turno de oficio</option>
        					<option value="pericial" selected>Pericial</option>
        				@elseif($caso->categoriaCliente == 'turno-oficio')
        					<option value="particular">Particular</option>
        					<option value="turno-oficio" selected>Turno de oficio</option>
        					<option value="pericial">Pericial</option>
        				@endif
    					</select>
    				</div>
    				<div class="input-group ml-2 mr-2 col">
    					<div class="input-group-prepend">
    						<span class="input-group-text">Asunto</span>
    					</div>
    					<input type="text" name="asunto" id="asunto" class="form-control" value="{{ $caso->asunto }}">
    				</div>
    				<div class="input-group ml-2 mr-2 col">
    					<div class="input-group-prepend">
    						<span class="input-group-text">Fecha de creación</span>
    					</div>
    					<input type="date" name="fecha-creacion" id="fecha-creacion" class="form-control" value="{{ $caso->fechaCreacion }}">
    				</div>
				</div>
				<div class="form-row mt-3 mb-3 col-12">
    				<div class="col-12 text-center">
    					<button type="submit" class="btn btn-danger" name="guardar">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pestañas debajo del formulario de casos -->
<div class="container-fluid ml-3">
	<div class="row">
		<div class="col-12">
        	<ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" href="#principal" role="tab" data-toggle="tab">Principal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#fases" role="tab" data-toggle="tab">Fases</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#importes" role="tab" data-toggle="tab">Importes</a>
              </li>
              <li class="nav-item">
              	<a class="nav-link" href="#gastos" role="tab" data-toggle="tab">Gastos</a>
              </li>-->
            </ul>
		</div>
        <!-- Paneles de las pestañas -->
        <div class="col-12">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="principal">
              	<div class="col-12 mt-4">
                  	<div class="col-8" style="display:inline-block">
                  	<!-- Formulario correspondiente a la tabla CasosClientes -->
                  		@foreach($caso->casosclientes as $casocliente)
                  		<form class="form-inline" method="post" action="{{ route('update-casocliente',['id' => \Crypt::encrypt($casocliente->id)]) }}">
                  		{!! csrf_field() !!}
                  		
                  			<div class="form-row mt-2 mb-1">
                      			<div class="input-group">
                      				<div class="input-group-prepend">
                      					<span class="input-group-text">Cliente</span>
                      				</div>
                      				<select name="cliente" id="cliente" class="custom-select">
                      					@foreach($clientes as $cliente)
                          					
                          						@if($casocliente->clientes_id == $cliente->id)
                          							<option value="{{ \Crypt::encrypt($cliente->id) }}" selected>{{ $cliente->apellido1." ".$cliente->apellido2.", ".$cliente->nombre }}</option>
                          						@else
                          							<option value="{{ \Crypt::encrypt($cliente->id) }}">{{ $cliente->apellido1." ".$cliente->apellido2.", ".$cliente->nombre }}</option>
                          						@endif
                          					
                      					@endforeach
                      				</select>
                      			</div>
                      			<div class="input-group col">
                      				<div class="input-group-prepend">
                      					<span class="input-group-text">Contrario</span>
                      				</div>
                      				<select name="contrario" id="contrario" class="custom-select">
                      					
                      						@if($casocliente->contrarios_id == 0)
                      							<option value="" selected>Selecciona un contrario</option>
                      							@foreach($contrarios as $contrario)
                      								<option value="{{\Crypt::encrypt($contrario->id)}}">{{ $contrario->apellido1." ".$contrario->apellido2.", ".$contrario->nombre }}</option>
                      							@endforeach
                      						@else
                      							@foreach($contrarios as $contrario)
                          							@if($casocliente->contrarios_id == $contrario->id)
                          								<option value="{{\Crypt::encrypt($contrario->id)}}" selected>{{ $contrario->apellido1." ".$contrario->apellido2.", ".$contrario->nombre }}</option>
                          							@else
                          								<option value="{{\Crypt::encrypt($contrario->id)}}">{{ $contrario->apellido1." ".$contrario->apellido2.", ".$contrario->nombre }}</option>
                          							@endif
                      							@endforeach
                      						@endif
                      					
                      				</select>
                      			</div>
                  			</div>
                  			<div class="form-row mt-1 mb-1">
                      			<div class="input-group col">
                      				<div class="input-group-prepend">
                      					<span class="input-group-text">Fecha Vencimiento</span>
                      				</div>
                      				<input type="date" class="form-control" name="fecha-vencimiento" id="fecha-vencimiento" value="{{$casocliente->fechaVencimiento}}">
                      			</div>
                      			<div class="input-group col">
                      				<div class="input-group-prepend">
                      					<span class="input-group-text">Naturaleza</span>
                      				</div>
                      				<input type="text" class="form-control" name="naturaleza" id="naturaleza" value="{{$casocliente->naturaleza}}">
                      			</div>
                      			<div class="input-group col-2">
                      				<div class="input-group-prepend">
                      					<span class="input-group-text">Nº Fase</span>
                      				</div>
                      				<input type="text" class="form-control" name="numero-fase" id="numero-fase" value="{{$casocliente->numeroFase}}">
                      			</div>
                  			</div>
                  			<div class="form-row mt-1 mb-1">
                      			<div class="input-group col">
                      				<div class="input-group-prepend">
                      					<span class="input-group-text">Comentarios</span>
                      				</div>
                      				<textarea class="form-control" name="comentarios" id="comentarios" cols="100" rows="8">{{$casocliente->comentarios}}</textarea>
                      			</div>
                  			</div>
                  			
                  			<div class="form-row mt-3 mb-3 col-12">
                				<div class="col-12 text-center">
                					<button type="submit" class="btn btn-danger" name="guardar">Guardar</button>
            					</div>
            				</div>
                  		@endforeach
                  		</form>
                  	</div>
                  	<!-- Mostrar listado de documentos y botón para mostrar un modal que nos permita subir un nuevo fichero -->
                  	<div class="col-3" style="display:inline-block">
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
                  	</div>
              	</div>
              </div>
              <div role="tabpanel" class="tab-pane" id="fases">
              	<div class="col-12 mt-4">
              		<div class="col-8" style="display:inline-block">
              			<form class="form-inline" method="post" action="">
              			{!! csrf_field() !!}
              				<div class="form-row">
                  				<div class="input-group col">
                  					<div class="input-group-prepend">
                  						<span class="input-group-text">Descriptor</span>
                  					</div>
                  					<input type="text" name="descriptor" id="descriptor" class="form-control">
                  				</div>
                  				<div class="input-group col">
                  					<div class="input-group-prepend">
                  						<span class="input-group-text">Num. Autos</span>
                  					</div>
                  					<input type="text" name="autos" id="autos" class="form-control">
                  				</div>
                  				<div class="input-group col">
                  					<div class="input-group-prepend">
                  						<span class="input-group-text">Tribunal</span>
                  					</div>
                  					<select name="tribunal" id="tribunal" class="custom-select">
                  					@foreach($tribunales as $tribunal)
                  						<option value="{{ \Crypt::encrypt($tribunal->id) }}">{{ $tribunal->tipo." ".$tribunal->numSeccion }} </option>
                  					@endforeach
                  					</select>
                  				</div>
              				</div>
              				<div class="form-row mt-3">
                  				<div class="input-group col">
                  					<div class="input-group-prepend">
                  						<span class="input-group-text">Procurador</span>
                  					</div>
                  					<select name="procurador" id="procurador" class="custom-select">
                  					@foreach($procuradores as $procurador)
                  						<option value="{{ \Crypt::encrypt($procurador->id) }}">{{ $procurador->apellido1." ".$procurador->apellido2.", ".$procurador->nombre }}</option>
                  					@endforeach
                  					</select>
                  				</div>
                  				<div class="input-group col">
                  					<div class="input-group-prepend">
                  						<span class="input-group-text">Fecha incio</span>
                  					</div>
                  					<input type="date" class="form-control" name="fecha-inicio">
                  				</div>
                  				<div class="input-group col">
                  					<div class="input-group-prepend">
                  						<span class="input-group-text">Fecha creación</span>
                  					</div>
                  					<input type="date" class="form-control" name="fecha-creacion">
                  				</div>
              				</div>
              				<div class="form-row mt-3">
              					<div class="input-group col">
              						<div class="input-group-prepend">
              							<span class="input-group-text">Tomo</span>
              						</div>
              						<input type="text" name="tomo" class="form-control">	
              					</div>
              					<div class="input-group col">
              						<div class="input-group-prepend">
              							<span class="input-group-text">Carpeta</span>
              						</div>
              						<input type="text" name="carpeta" class="form-control">
              					</div>
              				</div>
              			</form>
              		</div>
              	</div>
              </div>
              <!-- <div role="tabpanel" class="tab-pane" id="importes">ccc</div>
              <div role="tabpanel" class="tab-pane" id="gastos">fff</div>-->
            </div>
        </div>               
	</div>
</div>
@endsection