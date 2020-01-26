@extends('layouts.app')

@section('content')
@extends('layouts.header')
<!-- Migas de pan -->
<div class="container-fluid ml-3">
	<div class="row">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
				@if($persona->tipo == "Cliente")
				<li class="breadcrumb-item"><a href="{{url('/menu-clientes')}}">Gestión de clientes</a></li>
				<li class="breadcrumb-item active"><a href="{{route('persona',['persona'=>\Crypt::encrypt($persona->id)])}}">Cliente</a></li>
				@elseif($persona->tipo == "Contrario")
				<li class="breadcrumb-item"><a href="{{url('/menu-contrarios')}}">Gestión de contrarios</a></li>
				<li class="breadcrumb-item active"><a href="{{route('persona',['persona'=>\Crypt::encrypt($persona->id)])}}">Contrario</a></li>
				@elseif($persona->tipo == "Procurador")
				<li class="breadcrumb-item"><a href="">Gestión de procuradores</a></li>
				<li class="breadcrumb-item active"><a href="{{route('persona',['persona'=>\Crypt::encrypt($persona->id)])}}">Procurador</a></li>
				@endif
			</ol>
		</nav>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-10 offset-1">
			<div class="card">
				<div class="card-header"><h1>Editar {{strtolower($persona->tipo)}}</h1></div>
				<div class="card-body">
					@if(Session::has("message"))
						<div class="alert alert-success text-center">{{Session::get("message")}}</div>
					@endif
					<form action="{{route('update-persona',['persona_id'=>\Crypt::encrypt($persona->id)])}}" method="post" class="form-inline">
					{!! csrf_field() !!}
						@if($errors->has())
							@foreach($errors->all() as $error)
								<p class="help-block col-12"><strong>{{$error}}</strong></p>
							@endforeach
						@endif
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="DNI" name="dni" value="{{$persona->dni}}" disabled="disabled">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="Nombre" name="nombre" value="{{$persona->nombre}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="Primer apellido" name="apellido1" value="{{$persona->apellido1}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="Segundo apellido" name="apellido2" value="{{$persona->apellido2}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="Dirección" name="direccion" value="{{$persona->direccion}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="Código Postal" name="codpostal" value="{{$persona->codpostal}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<select name="provincia" id="provincia" class="custom-select">
								<option selected>Selecciona una provincia</option>
								@foreach($provincias as $provincia)
									@if($provincia->id == $municipioPersona->codProvincia)
										<option value="{{\Crypt::encrypt($provincia->id)}}" selected>{{$provincia->nombre}}</option>
									@else
										<option value="{{\Crypt::encrypt($provincia->id)}}">{{$provincia->nombre}}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<select name="codMunicipio" id="municipio" class="custom-select">
								@foreach($municipios as $municipio)
									@if($municipio->codigo == $municipioPersona->codigo)
										<option value="{{$municipio->codigo}}" selected>{{$municipio->nombre}}</option>
									@else
										<option value="{{$municipio->codigo}}">{{$municipio->nombre}}</option>
									@endif
								@endforeach
							</select>
						</div>
						@if($persona->tipo != "Procurador")
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" name="empresa" class="form-control" placeholder="Empresa" value="{{$persona->empresa}}">
						</div>
						@endif
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" name="tlfFijo1" placeholder="Teléfono fijo" class="form-control" value="{{$persona->tlfFijo1}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" name="tlfMovil1" placeholder="Teléfono móvil" class="form-control" value="{{$persona->tlfMovil1}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="email" name="email1" placeholder="e-mail" class="form-control" value="{{$persona->mail1}}">
						</div>
						<input type="hidden" name="tipo" value="{{$persona->tipo}}">
						<div class="col-12 m-4"></div>
						<div class="input-group col-md-1 offset-md-5">
							<button type="submit" class="btn btn-danger">Guardar</button>
						</div>
						<div class="input-group col-md-6">
							@if($persona->tipo == "Cliente")
							<a href="{{route('list-customers')}}" class="btn btn-danger">Volver</a>
							@elseif($persona->tipo == "Contrario")
							<a href="{{route('list-contrarios')}}" class="btn btn-danger">Volver</a>
							@elseif($persona->tipo == "Procurador")
							<a href="{{route('list-procuradores')}}" class="btn btn-danger">Volver</a>
							@endif
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	   $("#provincia").change(function(event){
		  $.get("/municipios/"+event.target.value,function(response,state){
			  $("#municipio").empty();
			  $("#municipio").append("<option value=''>Selecciona un municipio</option>");
			  for(i=0;i<response.length;i++){
				  $("#municipio").append("<option value='"+response[i].codigo+"'>"+response[i].nombre+"</option>");
			  }
		  });
	   });
	});
</script>
@endsection