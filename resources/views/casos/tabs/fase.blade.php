@foreach($fases as $fase)
<form class="form" method="post" action="{{ route('caso-update-fase',['id'=>$fase->id]) }}">
	{!! csrf_field() !!}

	<div class="form-row mt-3">
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Descriptor</span>
			</div>
			<input type="text" name="descriptor" id="descriptor" class="form-control" value="{{$caso->referencia}}">
		</div>
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Num. Autos</span>
			</div>
			<input type="text" name="autos" id="autos" class="form-control">
		</div>
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Tribunal</span>
			</div>
			<select name="tribunal" id="tribunal" class="custom-select">
				@foreach($tribunales as $tribunal)
				<option value="{{ \Crypt::encrypt($tribunal->id) }}">{{ $tribunal->tipo." ".$tribunal->numSeccion }} </option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-row mt-3">
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Procurador</span>
			</div>
			<select name="procurador" id="procurador" class="custom-select">
				@foreach($procuradores as $procurador)
				<option value="{{ \Crypt::encrypt($procurador->id) }}">{{ $procurador->apellido1." ".$procurador->apellido2.", ".$procurador->nombre }}</option>
				@endforeach
			</select>
		</div>
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Fecha incio</span>
			</div>
			<input type="date" class="form-control" name="fecha-inicio" value="{{old('fecha-inicio',$fase->fecha_inicio)}}">
		</div>
		<div class="input-group col">
			<div class="input-group-prepend">
				<span class="input-group-text">Fecha creación</span>
			</div>
			<input type="date" class="form-control" name="fecha-creacion" value="{{old('fecha-creacion',$fase->fecha_creacion)}}">
		</div>
	</div>
	<div class="form-row mt-3">
		<div class="input-group col-5">
			<div class="input-group-prepend">
				<span class="input-group-text">Tomo</span>
			</div>
			<input type="text" name="tomo" class="form-control">	
		</div>
		<div class="input-group col-5">
			<div class="input-group-prepend">
				<span class="input-group-text">Carpeta</span>
			</div>
			<input type="text" name="carpeta" class="form-control">
		</div>
		<div class="input-group col-2 text-center">
			@php
			$i = $fase->num_fase;
			$j = $i+1;
			
			$paginaFinal = $fases->lastPage();
			$enlaceAnterior = "";
			$enlaceSiguiente = $fases->url($j)."&tab=fases";
			
			if($i == $paginaFinal){
				$enlaceSiguiente = route('new-fase-caso',['num_fase' => $j,'descriptor' => $caso->referencia,'caso_id' => \Crypt::encrypt($caso->id)]);		
			}

			if($i>1){
				$enlaceAnterior = $fases->previousPageUrl()."&tab=fases";
			}

			@endphp
			<span class="input-group-text">Nº Fase</span>
			<a href="{{$enlaceAnterior}}"><i class="mdi mdi-24px mdi-menu-left"></i></a>
			<span class="form-control col-4">{{$i}}</span>
			<a href="{{$enlaceSiguiente}}"><i class="mdi mdi-24px mdi-menu-right"></i></a>

		</div>
	</div>
	<div class="form-row mt-3 col-12">
		<div class="col-12 text-center">
			<button type="submit" class="btn btn-danger" name="guardar">Guardar</button>
		</div>
	</div>
</form>
@endforeach