<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    protected $table = "ib35a_personas";
    
    public $timestamps = false;
    
    protected $fillable = [
        'nombre','apellido1','apellido2','dni','tlfFijo1','tlfMovil1','mail1','direccion','codpostal','codMunicipio','empresa','tipo',
    ];
}
