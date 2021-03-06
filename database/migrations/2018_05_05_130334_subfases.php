<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subfases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ib35a_subfases',function(Blueprint $table){
            $table->increments('id');
            $table->integer('idFases');
            $table->string('descriptor')->comment('Tipo de recurso');
            $table->string('numero_autos');
            $table->string('tribunal');
            $table->text('descripcion');
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
        Schema::drop('ib35a_subfases');
    }
}
