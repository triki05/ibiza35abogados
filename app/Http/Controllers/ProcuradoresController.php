<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Provincias;
use App\Personas;

class ProcuradoresController extends Controller
{
    public function index(){
        return view('procuradores.menu');
    }
    
    public function nuevo(){
        $provincias = Provincias::all();
        
        return view('procuradores.new',[
            'provincias' => $provincias
        ]);
    }
    
    public function guardar(Request $request){
        $this->validate($request,[
            'dni' => 'required|alpha_num|size:9|unique:ib35a_personas,dni',
            'nombre' => 'required|alpha',
            'apellido1' => 'required|alpha',
            'apellido2' => 'required|alpha',
            'direccion' => 'required',
            'codpostal' => 'required|digits:5',
            'codMunicipio' => 'required',
            'tlfFijo1' => 'digits:9',
            'tlfMovil1' => 'digits:9',
            'email1' => 'email|unique:ib35a_personas,mail1'
        ]);
        
        $procurador = new Personas();
        $procurador->dni = $request->input("dni");
        $procurador->nombre = $request->input("nombre");
        $procurador->apellido1 = $request->input("apellido1");
        $procurador->apellido2 = $request->input("apellido2");
        $procurador->direccion = $request->input("direccion");
        $procurador->codpostal = $request->input("codpostal");
        $procurador->codMunicipio = $request->get('municipio');
        $procurador->tipo = $request->input("tipo");
        $procurador->tlfFijo1 = $request->input("tlfFijo1");
        $procurador->tlfMovil1 = $request->input("tlfMovil1");
        $procurador->mail1 = $request->input("email1");
        
        $procurador->save();
        
        return redirect()->route('nuevo-procurador')->with(['message' => "Procurador guardado correctamente"]);
    }
    
    public function listar(){
        $procuradores = Personas::where('tipo','=','Procurador')->get();
        
        return view('procuradores.list',['procuradores'=>$procuradores]);
    }
}
