<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Fase;
use App\Casos;
use App\Tribunales;
use App\Personas;

class FaseController extends Controller
{

	public function update($fase_id,Request $request){
		/*$this->validate($request,[

		]);*/
		//Encontrar la fase
		$fase = Fase::findOrFail($fase_id);
		$fase->fecha_inicio = $request->input('fecha-inicio');
		$fase->fecha_creacion = $request->input('fecha-creacion');

		$fase->update();

		return redirect()->back();
	}

	public function new($num_fase,$descriptor,$caso_id){
		$fase = new Fase();
		$fase->num_fase = $num_fase;
		$fase->descriptor = $descriptor;
		$fase->codTribunal = Tribunales::first()->id;
		$fase->codProcurador = Personas::where(['tipo'=>'Procurador'])->first()->id;
		$fase->fecha_inicio = date('Y-m-d',time());
		$fase->fecha_creacion = date('Y-m-d',time());

		$fase->save();

		return redirect()->route('caso',['caso_id'=>$caso_id,'fase='.$num_fase."&tab=fases"]);
	}
}
