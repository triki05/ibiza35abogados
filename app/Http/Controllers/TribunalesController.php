<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Provincias;

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
            'codMunicipio' => 'required',
        ]);
    }
}
