@extends('layouts.app')

@section('content')
@extends('layouts.header')
<div class="container-fluid ml-3">
	<div class="row">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
				<li class="breadcrumb-item"><a href="{{url('/menu-tribunales')}}">Gestión de tribunales</a></li>
				<li class="breadcrumb-item active"><a href="{{route('nuevoTribunal')}}">Nuevo</a>
			</ol>
		</nav>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-10 offset-1">
    		<div class="card">
    			<div class="card-header"><h1>Nuevo Tribunal</h1></div>
    			<div class="card-body">
    				@if(Session::has("message"))
            			<div class="alert alert-success text-center">{{Session::get("message")}}</div>
            		@endif
    				<form action="{{route('save-tribunal')}}" method="post" class="form-inline">
    				{!! csrf_field() !!}
    					@if($errors->has())
    						@foreach($errors->all() as $error)
    							<p class="help-block col-12"><strong>{{$error}}</strong></p>
    						@endforeach
    					@endif
    					<div class="input-group col-md-3 mt-2 mb-2">
    						<input type="text" class="form-control" placeholder="Tipo" name="tipo" value="{{old('tipo')}}">
    					</div>
    					<div class="input-group col-md-3 mt-2 mb-2">
    						<input type="text" class="form-control" placeholder="Número de sección" name="numSeccion" value="{{old('numSeccion')}}">
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
    							<option value="{{$provincia->id}}">{{$provincia->nombre}}</option>
    							@endforeach
    						</select>
    					</div>
    					<div class="input-group col-md-3 mt-2 mb-2">
    						<select name="municipio" id="municipio" class="custom-select">
    							<option selected>Selecciona un municipio</option>
    						</select>
    					</div>
    					<div class="input-group col-md-3 mt-2 mb-2">
    						<input type="text" name="tlf" placeholder="Teléfono" class="form-control" value="{{old('tlf')}}">
    					</div>
    					<div class="input-group col-md-3 mt-2 mb-2">
    						<input type="text" name="fax" placeholder="Fax" class="form-control" value="{{old('fax')}}">
    					</div>
    					<div class="col-12 m-4"></div>
    					<div class="input-group col-md-1 offset-md-5">
    						<button type="submit" class="btn btn-danger">Guardar</button>
    					</div>
    					<div class="input-group col-md-6">
    						<a href="{{url('/menu-tribunales')}}" class="btn btn-danger">Volver</a>
    					</div>
    				</form>
    			</div>
    		</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	   $("#provincia").change(function(event){
	      $.get("/municipios/"+event.target.value,function(response,state){
		      $("#municipio").empty();
		      for(i=0;i<response.length;i++){
			      $("#municipio").append("<option value='"+response[i].codigo+"'>"+response[i].nombre+"</option>");
			  }
		  });
	   });
	});
</script>
@endsection