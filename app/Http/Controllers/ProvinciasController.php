<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Provincias;
use App\Municipios;

class ProvinciasController extends Controller
{
    //
    public function getMunicipios(Request $request, $id){
        if($request->ajax()){
            $municipios = Municipios::municipios($id);
            return response()->json($municipios);
        }
    }
}
