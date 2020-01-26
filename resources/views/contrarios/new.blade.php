@extends('layouts.app')

@section('content')
@extends('layouts.header')
<div class="container-fluid ml-3">
	<div class="row">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
				<li class="breadcrumb-item"><a href="{{url('/menu-contrarios')}}">Gestión de contrarios</a></li>
				<li class="breadcrumb-item active"><a href="{{route('nuevoContrario')}}">Nuevo</a></li>
			</ol>
		</nav>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-10 offset-1">
			<div class="card">
				<div class="card-header"><h1>Nuevo contrario</h1></div>
				<div class="card-body">
					@if(Session::has("message"))
					<div class="alert alert-success text-center">{{Session::get("message")}}</div>
					@endif
					<form action="{{route('save-contrario')}}" method="post" class="form-inline">
						{!! csrf_field() !!}
						@if($errors->has())
						@foreach($errors->all() as $error)
						<p class="help-block col-12"><strong>{{$error}}</strong></p>
						@endforeach
						@endif
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="DNI" name="dni" value="{{old('dni')}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="Nombre" name="nombre" value="{{old('nombre')}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="Primer apellido" name="apellido1" value="{{old('apellido1')}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="Segundo apellido" name="apellido2" value="{{old('apellido2')}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="Dirección" name="direccion" value="{{old('direccion')}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" class="form-control" placeholder="Código Postal" name="codpostal" value="{{old('codpostal')}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<select name="provincia" id="provincia" class="custom-select">
								<option selected>Selecciona una provincia</option>
								@foreach($provincias as $provincia)
								<option value="{{\Crypt::encrypt($provincia->id)}}">{{$provincia->nombre}}</option>
								@endforeach
							</select>
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<select name="municipio" id="municipio" class="custom-select">
								<option value="" selected>Selecciona un municipio</option>
							</select>
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" name="empresa" class="form-control" placeholder="Empresa" value="{{old('empresa')}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" name="tlfFijo1" placeholder="Teléfono fijo" class="form-control" value="{{old('tlfFijo1')}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="text" name="tlfMovil1" placeholder="Teléfono móvil" class="form-control" value="{{old('tlfMovil1')}}">
						</div>
						<div class="input-group col-md-3 mt-2 mb-2">
							<input type="email" name="email1" placeholder="e-mail" class="form-control" value="{{old('email1')}}">
						</div>
						<input type="hidden" name="tipo" value="Contrario">
						<div class="col-12 m-4"></div>
						<div class="input-group col-md-1 offset-md-5">
							<button type="submit" class="btn btn-danger">Guardar</button>
						</div>
						<div class="input-group col-md-6">
							<a href="{{url('/menu-contrarios')}}" class="btn btn-danger">Volver</a>
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