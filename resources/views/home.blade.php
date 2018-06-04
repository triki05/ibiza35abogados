@extends('layouts.app')

@section('content')
@extends('layouts.header')
<div class="container">
    <div class="row">
    	<div class="col-sm-8 offset-sm-2">
    		<div class="text-center">
    			<h1>¿Qué quieres hacer?</h1>
    			<div class="col-md-6 offset-md-3 mb-2"><a href="{{ url('/menu-clientes') }}" class="btn btn-danger col-12" >Gestionar clientes</a></div>
    			<div class="col-md-6 offset-md-3 mb-2"><a href="{{ url('/menu-contrarios') }}" class="btn btn-danger col-12" >Gestionar contrarios</a></div>
    			<div class="col-md-6 offset-md-3 mb-2"><a href="{{ url('/menu-tribunales') }}" class="btn btn-danger col-12" >Gestionar tribunales</a></div>
    			<div class="col-md-6 offset-md-3 mb-2"><a href="{{ url('/menu-procuradores') }}" class="btn btn-danger col-12">Procuradores</a></div>
    			<div class="col-md-6 offset-md-3 mb-2"><a href="{{ url('/menu-casos') }}" class="btn btn-danger col-12">Casos</a></div>
    			<div class="col-md-6 offset-md-3 mb-2"><a href="{{ url('/menu-cobros') }}" class="btn btn-danger col-12">Cobros</a></div>
    			<div class="col-md-6 offset-md-3 mb-2"><a href="{{ url('/agenda') }}" class="btn btn-danger col-12">Agenda</a></div>
    		</div>
    	</div>
    </div>
</div>
@endsection
