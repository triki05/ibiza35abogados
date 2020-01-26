<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Personas;
use App\Http\Requests;
use App\Provincias;
use App\Municipios;

class PersonaController extends Controller
{
	public function mostrar($id){
		$p_id = \Crypt::decrypt($id);
		
		$persona = Personas::find($p_id);
		$provincias = Provincias::all();
		$municipioPersona = Municipios::findOrFail($persona->codMunicipio);
		$municipios = Municipios::where('codProvincia',$municipioPersona->codProvincia)->get();
		

		
		return view('personas.persona',['persona' => $persona,'provincias'=>$provincias,'municipios'=>$municipios,'municipioPersona'=>$municipioPersona]);
	}
	
	public function update($persona_id, Request $request){
		$persona = Personas::findOrFail(\Crypt::decrypt($persona_id));
		$this->validate($request,[
			'nombre' => 'required|alpha',
			'apellido1' => 'required|alpha',
			'apellido2' => 'required|alpha',
			'direccion' => 'required',
			'codpostal' => 'required|digits:5',
			'codMunicipio' => 'required',
			'tlfFijo1' => 'digits:9',
			'tlfMovil1' => 'digits:9',
			'email1' => 'email|unique:ib35a_personas,mail1,'.$persona->id.',id'
		]);

		$persona->nombre = $request->input('nombre');
		$persona->apellido1 = $request->input('apellido1');
		$persona->apellido2 = $request->input('apellido2');
		$persona->direccion = $request->input('direccion');
		$persona->codpostal = $request->input('codpostal');
		$persona->codMunicipio = $request->get('codMunicipio');
		$persona->empresa = $request->input('empresa');
		$persona->tlfFijo1 = $request->input('tlfFijo1');
		$persona->tlfMovil1 = $request->input('tlfMovil1');
		$persona->mail1 = $request->input('email1');

		$persona->save();
		
		return redirect()->route('persona',['persona'=>\Crypt::encrypt($persona->id)])->with(['message' => "Cliente guardado correctamente"]);
	}

	public function delete($persona_id){
		$persona = Personas::findOrFail(\Crypt::decrypt($persona_id));
		$tipoPersona = $persona->tipo;
		$persona->delete();
		$ruta = "";
		if($tipoPersona === "Cliente"){
			$ruta = "list-customers";
		}else if($tipoPersona === "Contrario"){
			$ruta = "list-contrarios";
		}else if($tipoPersona === "Procurador"){
			$ruta = "list-procuradores";
		}

		return redirect()->route($ruta);
	}
}
