@extends('layouts.app')

@section('content')
@extends('layouts.header')
<div class="container-fluid ml-3">
	<div class="row">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
				<li class="breadcrumb-item active"><a href="{{url('/menu-casos')}}">Casos</a></li>
			</ol>
		</nav>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-8 offset-sm-2">
			<div class="text-center">
				<h1>Casos</h1>
				<div class="col-md-6 offset-md-3 mb-2"><a href="{{ route('new-case') }}" class="btn btn-danger col-12">Nuevo</a></div>
				<div class="col-md-6 offset-md-3 mb-2"><a href="{{ route('list-case') }}" class="btn btn-danger col-12">Listado</a></div>
				<div class="col-md-6 offset-md-3 mb-2"><a href="#" class="btn btn-danger col-12">Turno de oficio</a></div>
				<div class="col-md-6 offset-md-3 mb-2"><a href="{{ route('list-periciales') }}" class="btn btn-danger col-12">Periciales</a></div>
			</div>
		</div>
	</div>
</div>
@endsection