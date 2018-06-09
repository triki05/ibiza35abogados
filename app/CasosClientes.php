<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasosClientes extends Model
{
    protected $table = 'ib35a_casosclientes';
    protected $fillable = [
        'casos_id','cliente_id','fechaVencimiento','naturaleza','numeroFase','comentarios'
    ];
    
    public $timestamps = false;
    
    public function casos(){
       return $this->belongsTo('App\Casos','casos_id');
    }
    
    public function clientes(){
        return $this->belongsTo('App\Personas','clientes_id');
    }
}
