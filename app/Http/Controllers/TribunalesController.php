<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Provincias;
use App\Tribunales;
use App\Municipios;

class TribunalesController extends Controller
{
	public function index(){
		return view('tribunales.menu');
	}
	
	public function newTribunal(){
		$provincias = Provincias::all();
		return view('tribunales.new')->with([
			'provincias' => $provincias
		]);
	}
	
	public function saveTribunal(Request $request){
		$this->validate($request,[
			'tipo' => 'required',
			'numSeccion' => 'required',
			'direccion' => 'required',
			'codpostal' => 'required',
			'municipio' => 'required',
		]);
		
		$tribunal = new Tribunales();
		
		$tribunal->tipo = $request->input('tipo');
		$tribunal->numSeccion = $request->input('numSeccion');
		$tribunal->direccion = $request->input('direccion');
		$tribunal->codpostal = $request->input('codpostal');
		$tribunal->codMunicipio = $request->get('municipio');
		$tribunal->tlf1 = $request->input('tlf');
		$tribunal->fax1 = $request->input('fax');
		
		$tribunal->save();
		
		return redirect()->route('nuevoTribunal')->with(["message"=>"Tribunal guardado correctamente"]);
	}
	
	public function listTribunales(){
		$tribunales = Tribunales::all();
		
		return view('tribunales.list',[
			'tribunales' => $tribunales
		]);
	}

	public function editTribunal($id){
		$tribunal = Tribunales::findOrFail(\Crypt::decrypt($id));
		$provincias = Provincias::all();
		$municipioTribunal = Municipios::findOrFail($tribunal->codMunicipio);
		$municipios = Municipios::where('codProvincia',$municipioTribunal->codProvincia)->get();

		return view('tribunales.edit',['tribunal' => $tribunal,'provincias'=>$provincias,'municipioTribunal'=>$municipioTribunal,'municipios'=>$municipios]);
	}

	public function update($tribunal_id, Request $request){
		$this->validate($request,[
			'tipo' => 'required',
			'numSeccion' => 'required',
			'direccion' => 'required',
			'codpostal' => 'required',
			'municipio' => 'required',
		]);

		$tribunal = Tribunales::findOrFail(\Crypt::decrypt($tribunal_id));

		$tribunal->tipo = $request->input('tipo');
		$tribunal->numSeccion = $request->input('numSeccion');
		$tribunal->direccion = $request->input('direccion');
		$tribunal->codpostal = $request->input('codpostal');
		$tribunal->codMunicipio = $request->get('municipio');
		$tribunal->tlf1 = $request->input('tlf');
		$tribunal->fax1 = $request->input('fax');
		
		$tribunal->save();

		return redirect()->route('edit-tribunal',['tribunal'=>\Crypt::encrypt($tribunal->id)])->with(["message"=>"Tribunal guardado correctamente"]);
	}
}
