<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Municipios;
use App\Personas;
use App\Provincias;

class ClientesController extends Controller
{
    //
    public function index(){
        return view('clientes.menu');
    }
    
    public function newCliente(){
        $provincias = Provincias::all();
        return view('clientes.new')->with("provincias",$provincias);
    }
    
    public function saveCliente(Request $request){
        $this->validate($request,[
            'dni' => 'required|alpha_num|size:9',
            'nombre' => 'required|alpha',
            'apellido1' => 'required|alpha',
            'apellido2' => 'required|alpha',
            'direccion' => 'required',
            'codpostal' => 'required|digits:5',
            'municipio' => 'required',
            'tlfFijo1' => 'digits:9',
            'tlfMovil1' => 'digits:9',
            'email1' => 'email'
        ]);
        
        $cliente = new Personas();
        $cliente->dni = $request->input("dni");
        $cliente->nombre = $request->input("nombre");
        $cliente->apellido1 = $request->input("apellido1");
        $cliente->apellido2 = $request->input("apellido2");
        $cliente->direccion = $request->input("direccion");
        $cliente->codpostal = $request->input("codpostal");
        $cliente->codMunicipio = $request->get('municipio');
        $cliente->tipo = $request->input("tipo");
        $cliente->tlfFijo1 = $request->input("tlfFijo1");
        $cliente->tlfMovil1 = $request->input("tlfMovil1");
        $cliente->mail1 = $request->input("email1");
        
        $cliente->save();
        
        return redirect()->route('nuevoCliente')->with(['message' => "Cliente guardado correctamente"]);
    }
   
    public function listClientes(){
        $clientes = Personas::where(['tipo'=>'Cliente'])->get();
        return view('clientes.list',[
            'clientes' => $clientes
        ]);
    }
    
    
}
