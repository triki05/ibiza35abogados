@extends('layouts.app')

@section('content')
@extends('layouts.header')

<div class="container-fluid ml-3">
	<div class="row">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
				<li class="breadcrumb-item"><a href="{{url('/menu-casos')}}">Casos</a></li>
				<li class="breadcrumb-item active"><a href="{{ route('list-periciales') }}">Periciales</a></li>
			</ol>
		</nav>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-10 offset-1">
			<div class="card">
				<div class="card-header"><h1>Periciales</h1></div>
				<div class="card-body">
				<div class="col-12">
    					<table class="table" id="cases_table">
    						<thead>
    							<tr>
    								<th scope="col">Referencia</th>
    								<th scope="col">Jurisdicción</th>
    								<th scope="col">Asunto</th>
    								<th scope="col">Cod. Encargo</th>
    								<th scope="col">Estado</th>
    								<th scope="col">Cliente</th>
    								<th scope="col">Opciones</th>
    							</tr>
    						</thead>
    						<tbody>
    							@foreach($casos as $caso)
    							
    							<tr>
    								<td>{{ $caso->referencia }}</td>
    								<td>{{ $caso->jurisdiccion }}</td>
    								<td>{{ $caso->asunto }}</td>
    								<td>{{ $caso->codigoEncargo }}</td>
    								<td>{{ $caso->estado }}</td>
    								@foreach($caso->casosclientes as $casocliente)
    								<td>{{ $casocliente->clientes->apellido1." ".$casocliente->clientes->apellido2.", ".$casocliente->clientes->nombre }}</td>
    								@endforeach
    								<td>
    									<div class="btn-group dropright">
                                            <button type="button" class="btn btn-small btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-bars"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="">Modificar</a></li>
                                                <li><a href="">Prueba</a></li>
                                            </ul>
                                        </div>
    								</td>
    							</tr>
    						
    							@endforeach
    						</tbody>
    					</table>
    				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	var table = $('#cases_table').DataTable({
		"language":{
			"paginate":{
				"first": "<<",
				"last": ">>",
				"previous": "<",
				"next":">"
			},
			"info": "",
			"lengthMenu": "Mostrar _MENU_ registros",
			"emptyTable": "No hay datos",
			"search": "Buscar:",
			"infoFiltered": "(filtrado de _MAX_ registros totales)",
			"infoEmpty":"Mostrando 0 de 0 entradas",
			"zeroRecords": "No hay resultados"
		},
		"lengthMenu":[5,10,15,20],	
	});
	$(".dataTables_length,.dataTables_filter").addClass('form-inline');
	$(".dataTables_length,.dataTables_filter").css({
		"margin": "1em 0"
	});
	$(".form-control.form-control-sm").css({"margin":"0 0.7em"});
});
</script>
@endsection