<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'ib35a_documentos';
    
    
    public function casos(){
        return $this->belongsTo('App\Casos','id_casos');
    }
}
