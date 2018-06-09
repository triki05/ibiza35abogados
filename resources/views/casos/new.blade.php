@extends('layouts.app')

@section('content')
@extends('layouts.header')
<div class="container-fluid ml-3">
	<div class="row">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
				<li class="breadcrumb-item"><a href="{{url('/menu-casos')}}">Casos</a></li>
				<li class="breadcrumb-item active"><a href="{{route('new-case')}}">Nuevo</a>
			</ol>
		</nav>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-12">
			@if(Session::has('message'))
				<div class="alert alert-success text-center">{{Session::get("message")}}</div>			
			@endif
			<div class="card">
				<div class="card-header"><h1>Nuevo caso</h1></div>
				<div class="card-body">
					<form method="post" action="{{route('save-case')}}" class="form-inline">
					{!! csrf_field() !!}
						@if($errors->has())
    						@foreach($errors->all() as $error)
    							<p class="help-block col-12"><strong>{{$error}}</strong></p>
    						@endforeach
    					@endif
						<div class="input-group col-sm-6 mt-3 mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Referencia</span>
							</div>
							<input type="text" class="form-control" name="referencia" id="referencia">
						</div>
						<div class="input-group col-sm-6 mt-3 mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Fecha de creación</span>
							</div>
							<input type="date" class="form-control" name="fecha-creacion" id="fecha-creacion">
						</div>
						<div class="input-group col-sm-6 mt-3 mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Jurisdicción</span>
							</div>
							<input type="text" class="form-control" name="jurisdiccion" id="jurisdiccion">
						</div>
						<div class="input-group col-sm-6 mt-3 mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Código de encargo</span>
							</div>
							<input type="text" name="codigo-encargo" id="codigo-encargo" class="form-control">
						</div>
						<div class="input-group col-sm-6 mt-3 mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Asunto</span>
							</div>
							<input type="text" name="asunto" id="asunto" class="form-control">
						</div>
						<div class="input-group col-sm-6 mt-3 mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Categoría</span>
							</div>
							<select name="categoria" id="categoria" class="custom-select">
								<option value="" selected>Seleccione una opción</option>
								<option value="particular">Particular</option>
								<option value="turno-oficio">Turno de oficio</option>
								<option value="pericial">Pericial</option>
							</select>
						</div>
						<div class="input-group col-sm-6 mt-3 mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Cliente</span>
							</div>
							<select name="cliente" id="cliente" class="custom-select">
								<option value="" selected>Selecciona una opción</option>
								@foreach($clientes as $cliente)
									<option value="{{\Crypt::encrypt($cliente->id)}}">{{$cliente->apellido1." ".$cliente->apellido2.", ".$cliente->nombre}}</option>
								@endforeach
							</select>
						</div>
						<div class="input-group col-sm-6 mt-3 mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">Estado</span>
							</div>
							<select name="estado" id="estado" class="custom-select">
								<option value="" selected>Seleccione una opción</option>
								<option value="activo">Activo</option>
								<option value="resuelto">Resuelto</option>
							</select>
						</div>
						<div class="col-12 text-center mt-5">
							<button type="submit" name="enviar" class="btn btn-danger mr-3">Guardar</button>
							
							<a href="{{ url('/menu-casos') }}" class="btn btn-danger ml-3">Volver</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection