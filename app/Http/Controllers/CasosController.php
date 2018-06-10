<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Personas;
use App\Http\Requests;
use App\Casos;
use App\CasosClientes;

class CasosController extends Controller
{
    public function index(){
        return view('casos.menu');
    }
    
    public function nuevo(){
        $clientes = Personas::where(['tipo'=>'Cliente'])->get();
        return view('casos.new',[
            'clientes' => $clientes
        ]);
    }
    
    public function guardar(Request $request){
        $this->validate($request,[
            'referencia' => 'required',
            'asunto' => 'required',
            'estado' => 'required',
            'fecha-creacion' => 'required',
            'codigo-encargo' => 'required',
            'categoria' => 'required',
            'jurisdiccion' => 'required',
            'cliente' => 'required'
        ]);
        
        $caso = new Casos();
        $casoCliente = new CasosClientes();
        
        $caso->referencia = $request->input('referencia');
        $caso->fechaCreacion = $request->input('fecha-creacion');
        $caso->jurisdiccion = $request->input('jurisdiccion');
        $caso->codigoEncargo = $request->input('codigo-encargo');
        $caso->asunto = $request->input('asunto');
        $caso->categoriaCliente = $request->get('categoria');
        $caso->estado = $request->get('estado');
        
        $caso->save();
        
        $casoCliente->casos_id = $caso->id;
        $casoCliente->clientes_id = \Crypt::decrypt($request->get('cliente'));
        
        $casoCliente->save();
        
        return redirect()->route('new-case')->with(['message'=>'Caso creado correctamente']);
    }
    
    public function listar(){
        $casos = Casos::where(['categoriaCliente'=>'particular'])->get();
        return view('casos.list',[
            'casos'=>$casos
        ]);
    }
    
    public function listarPericiales(){
        $casos = Casos::where(['categoriaCliente'=>'pericial'])->get();
        return view('casos.periciales',[
            'casos'=>$casos
        ]);
    }
    
    public function listarTurnoOficio(){
        $casos = Casos::where(['categoriaCliente'=>'turno-oficio'])->get();
        return view('casos.turno-oficio',[
            'casos' => $casos
        ]);
    }
    
    public function caso($caso_id){
        $caso = Casos::find(\Crypt::decrypt($caso_id));
        
        return view('casos.caso',[
            'caso' => $caso
        ]);
    }
}
