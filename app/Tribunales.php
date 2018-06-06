<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tribunales extends Model
{
    //
    protected $table = "ib35a_datostribunales";
    protected $fillable = [
        'tipo','numSeccion','direccion','codpostal','codMunicipio','tlf1','fax1'
    ];
    public $timestamps = false;
    
    //Relacion con municipios
    public function municipios(){
        return $this->belongsTo('App\Municipios','codMunicipio');
    }
}
