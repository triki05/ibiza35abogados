<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Personas;
use App\Provincias;
use App\Http\Requests;

class ContrariosController extends Controller
{
    //Función para devolver la página principal
    public function index(){
        return view('contrarios.menu');
    }
    
    //Función para devolver la página para crear un nuevo contrario
    public function newContrario(){
        $provincias = Provincias::all();
        return view('contrarios.new')->with("provincias",$provincias);
    }
    
    //Función para guardar un contrario en la base de datos
    public function saveContrario(Request $request){
        //Validación de los datos recibidos por post
        $this->validate($request,[
            'dni' => 'required|alpha_num|size:9|unique:ib35a_personas,dni',
            'nombre' => 'required|alpha',
            'apellido1' => 'required|alpha',
            'apellido2' => 'required|alpha',
            'direccion' => 'required',
            'codpostal' => 'required|digits:5',
            'municipio' => 'required',
            'tlfFijo1' => 'digits:9',
            'tlfMovil1' => 'digits:9',
            'email1' => 'email|unique:ib35a_personas,mail1'
        ]);
        
        //Creación del objeto, asignación de valores y guardado en la base de datos
        $contrario = new Personas();
        $contrario->dni = $request->input("dni");
        $contrario->nombre = $request->input("nombre");
        $contrario->apellido1 = $request->input("apellido1");
        $contrario->apellido2 = $request->input("apellido2");
        $contrario->direccion = $request->input("direccion");
        $contrario->codpostal = $request->input("codpostal");
        $contrario->codMunicipio = $request->get('municipio');
        $contrario->empresa = $request->get('empresa');
        $contrario->tipo = $request->input("tipo");
        $contrario->tlfFijo1 = $request->input("tlfFijo1");
        $contrario->tlfMovil1 = $request->input("tlfMovil1");
        $contrario->mail1 = $request->input("email1");
        
        $contrario->save();
        
        //Redirección a a la página de nuevo contrario con mensaje flash
        return redirect()->route('nuevoContrario')->with(['message' => "Contrario guardado correctamente"]);
    }
    
    //Función para listar los contrarios
    public function listContrarios(){
        $contrarios = Personas::where(['tipo'=>'Contrario'])->get();
        return view('contrarios.list',[
            'contrarios' => $contrarios
        ]);
    }
}
