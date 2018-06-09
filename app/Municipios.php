<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Municipios extends Model
{
    protected $table = "ib35a_municipios";
    
    protected $primaryKey = "codigo";
    
    public static function municipios($id){
        return Municipios::where('codProvincia','=',$id)->get();
    }
    
  
    public function tribunales(){
        return $this->hasMany("App\Tribunales",'codMuncipio');
    }
}
