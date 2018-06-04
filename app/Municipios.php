<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $table = "ib35a_municipios";
    
    public static function municipios($id){
        return Municipios::where('codProvincia','=',$id)->get();
    }
}
