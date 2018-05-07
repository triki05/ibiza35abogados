<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ib35a_fases',function(Blueprint $table){
            $table->increments('id');
            $table->string('descriptor',200)->comment('Referencia de la tabla casos');
            $table->integer('codTribunal');
            $table->integer('codProcurador');
            $table->date('fecha_inicio');
            $table->date('fecha_creacion');
            $table->string('tomo');
            $table->string('carpeta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('ib35a_fases');
    }
}
