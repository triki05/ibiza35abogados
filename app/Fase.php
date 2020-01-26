<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $table = 'ib35a_fases';

    protected $fillable = [
    	'id','num_fase','descriptor','codTribunal','codProcurador','fecha_inicio','fecha_creacion','tomo','carpeta'
    ];

    public $timestamps = false;

    public function casos(){
    	return $this->belongsTo('App\Casos','descriptor');
    }
}
