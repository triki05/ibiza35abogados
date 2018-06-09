<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casos extends Model
{
    protected $table = 'ib35a_casos';
    
    protected $fillable = [
        'referencia','asunto','estado','fechaCreacion','posicion','codigoEncargo','categoriaCliente','jurisdiccion'
    ];
    
    public $timestamps = false;
    
    public function casosclientes(){
        return $this->hasMany('App\CasosClientes','casos_id');
    }
    
}
