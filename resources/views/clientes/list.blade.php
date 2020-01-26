@extends('layouts.app')

@section('content')
@extends('layouts.header')

<div class="container-fluid ml-3">
	<div class="row">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
				<li class="breadcrumb-item"><a href="{{url('/menu-clientes')}}">Gestión de clientes</a></li>
				<li class="breadcrumb-item active"><a href="{{ route('list-customers') }}">Listado</a></li>
			</ol>
		</nav>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-10 offset-1">
			<div class="card">
				<div class="card-header"><h1>Listado de clientes</h1></div>
				<div class="card-body">
					<div class="col-12">
						<table class="table" id="customers_table">
							<thead>
								<tr>
									<th scope="col">Nombre</th>
									<th scope="col">Apellidos</th>
									<th scope="col">Tlf fijo</th>
									<th scope="col">Tlf Móvil</th>
									<th scope="col">e-mail</th>
									<th scope="col">Dirección</th>
									<th scope="col">Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($clientes as $cliente)
								<tr>
									<td>{{ $cliente->nombre }}</td>
									<td>{{ $cliente->apellido1." ".$cliente->apellido2 }}</td>
									<td>{{ $cliente->tlfFijo1 }}</td>
									<td>{{ $cliente->tlfMovil1 }}</td>
									<td>{{ $cliente->mail1 }}</td>
									<td>{{ $cliente->direccion }}</td>
									<td>
										<a href="{{route('persona',['persona'=>\Crypt::encrypt($cliente->id)])}}"><i class="mdi mdi-24px mdi-account-edit"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					{{--<div class="pagination">{{ $clientes->links() }}</div>--}}
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#customers_table').DataTable({
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