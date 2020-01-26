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
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a href="#principal" data-target="#principal" class="nav-link {{(!isset($_GET['tab']) || (isset($_GET['tab']) && $_GET['tab'] == 'principal'))?'active' : ''}}" role="tab" data-toggle="tab">Principal</a>
		</li>
		<li class="nav-item">
			<a href="#fases" data-target="#fases" class="nav-link {{(isset($_GET['tab']) && $_GET['tab'] == 'fases')? 'active' : ''}}" role="tab" data-toggle="tab">Fases</a>
		</li>
		<li class="nav-item">
			<a href="#importes" data-target="#importes" class="nav-link" role="tab" data-toggle="tab">Importes</a>
		</li>
		<li class="nav-item">
			<a href="#gastos" data-target="#gastos" class="nav-link" role="tab" data-toggle="tab">Gastos</a>
		</li>
	</ul>
	<div class="tab-content">
		<!-- Contenido de la pestaña principal -->
		<div class="tab-pane fade {{(!isset($_GET['tab']) || (isset($_GET['tab']) && $_GET['tab'] == 'principal'))?'active show' : ''}} " id="principal">
			<div class="col-8" style="display: inline-block;">
				@include('casos.tabs.principal')
			</div>
			<div class="col-3" style="display: inline-block;">
				@include('casos.tabs.documentos')
			</div>
		</div>
		<!-- Pestaña de fases -->
		<div class="tab-pane fade {{(isset($_GET['tab']) && $_GET['tab'] == 'fases')? 'active show' : ''}}" id="fases">
			<div class="col-12">
				@include('casos.tabs.fase')
			</div>
		</div>
		<!-- Pestaña de importes -->
		<div class="tab-pane fade" id="importes">

		</div>
		<!-- Pestaña de gastos -->
		<div class="tab-pane fade" id="gastos">

		</div>
	</div>
</div>

@endsection