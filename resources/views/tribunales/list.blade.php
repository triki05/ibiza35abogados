@extends('layouts.app')

@section('content')
@extends('layouts.header')

<div class="container-fluid ml-3">
	<div class="row">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
				<li class="breadcrumb-item"><a href="{{url('/menu-tribunales')}}">Gestión de tribunales</a></li>
				<li class="breadcrumb-item active"><a href="{{ route('list-tribunales') }}">Listado</a></li>
			</ol>
		</nav>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-10 offset-1">
			<div class="card">
				<div class="card-header"><h1>Listado de tribunales</h1></div>
				<div class="card-body">
				<div class="col-12">
						<table class="table" id="tribunales_table">
							<thead>
								<tr>
									<th scope="col">Tipo</th>
									<th scope="col">Número de sección</th>
									<th scope="col">Dirección</th>
									<th scope="col">Código postal</th>
									<th scope="col">Muncipio</th>
									<th scope="col">Teléfono</th>
									<th scope="col">Fax</th>
									<th scope="col">Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($tribunales as $tribunal)
								<tr>
									<td>{{ $tribunal->tipo }}</td>
									<td>{{ $tribunal->numSeccion}}</td>
									<td>{{ $tribunal->direccion }}</td>
									<td>{{ $tribunal->codpostal }}</td>
									<td>{{ $tribunal->municipios->nombre }}</td>    								
									<td>{{ $tribunal->tlf1 }}</td>
									<td>{{ $tribunal->fax1 }}</td>
									<td>
										<a href="{{route('edit-tribunal',['tribunal'=>\Crypt::encrypt($tribunal->id)])}}"><i class="mdi mdi-24px mdi-pencil"></i></a>
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
<script type="text/javascript">
$(document).ready(function(){
	var table = $('#tribunales_table').DataTable({
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