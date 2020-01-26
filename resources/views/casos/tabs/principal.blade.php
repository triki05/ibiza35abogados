@foreach($casosClientes as $casoCliente)
<form class="form-inline" method="post" action="{{ route('update-casocliente',['id'=>\Crypt::encrypt($casoCliente->id)])}}">
	{!! csrf_field() !!}
	<div class="form-row mt-2 mb-1">
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Cliente</span>
			</div>
			<select name="cliente" id="cliente" class="custom-select">
				@foreach($clientes as $cliente)
				@if($casoCliente->clientes_id == $cliente->id)
				<option value="{{ \Crypt::encrypt($cliente->id) }}" selected>{{ $cliente->apellido1." ".$cliente->apellido2.", ".$cliente->nombre }}</option>
				@else
				<option value="{{ \Crypt::encrypt($cliente->id) }}">{{ $cliente->apellido1." ".$cliente->apellido2.", ".$cliente->nombre }}</option>
				@endif
				@endforeach
			</select>
		</div>
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Contrario</span>
			</div>
			<select name="contrario" id="contrario" class="custom-select">
				<option value="" selected>Selecciona un contrario</option>
				@foreach($contrarios as $contrario)
				@if($casoCliente->contrarios_id == $contrario->id)
				<option value="{{\Crypt::encrypt($contrario->id)}}" selected>{{ $contrario->apellido1." ".$contrario->apellido2.", ".$contrario->nombre }}</option>
				@else
				<option value="{{\Crypt::encrypt($contrario->id)}}">{{ $contrario->apellido1." ".$contrario->apellido2.", ".$contrario->nombre }}</option>
				@endif
				@endforeach

			</select>
		</div>
	</div>
	<div class="form-row mt-1 mb-1">
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Fecha Vencimiento</span>
			</div>
			<input type="date" class="form-control" name="fecha-vencimiento" id="fecha-vencimiento" value="{{$casoCliente->fechaVencimiento}}">
		</div>
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Naturaleza</span>
			</div>
			<input type="text" class="form-control" name="naturaleza" id="naturaleza" value="{{$casoCliente->naturaleza}}">
		</div>
		<div class="input-group col-2 text-center">
			<span class="input-group-text col-12">Nº Fase</span>
			@php
			$i = $casoCliente->numeroFase;
			$j = $i+1;
			
			$paginaFinal = $casosClientes->lastPage();
			$enlaceAnterior = "";
			$enlaceSiguiente = $casosClientes->url($j)."&tab=principal";
			
			if($i == $paginaFinal){
				$enlaceSiguiente = route('new-fase-general',['num'=>$j,'caso_id'=>$caso->id,'cliente_id'=>$cliente->id]);							
			}

			if($i>1){
				$enlaceAnterior = $casosClientes->previousPageUrl()."&tab=principal";
			}

			@endphp
			<a href="{{$enlaceAnterior}}" class="col-4"><i class="mdi mdi-24px mdi-menu-left"></i></a>
			<span class="form-control col-4">{{$i}}</span>

			<a href="{{$enlaceSiguiente}}" class="col-4"><i class="mdi mdi-24px mdi-menu-right p-0"></i></a>
			<input type="hidden" class="form-control" name="numero-fase" id="numero-fase" value="{{$i}}">

		</div>
	</div>
	<div class="form-row mt-1 mb-1">
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Comentarios</span>
			</div>
			<textarea class="form-control" name="comentarios" id="comentarios" cols="100" rows="8">{{$casoCliente->comentarios}}</textarea>
		</div>
	</div>

	<div class="form-row mt-3 mb-3 col-12">
		<div class="col-12 text-center">
			<button type="submit" class="btn btn-danger" name="guardar">Guardar</button>
		</div>
	</div>
	<input type="hidden" name="num_pag" value="{{$casosClientes->currentPage()}}">
</form>
@endforeach