<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Gastos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ib35a_gastos',function(Blueprint $table){
            $table->increments('id');
            $table->date('fecha');
            $table->decimal('importe_gasto',5,2);
            $table->smallInteger('iva');
            $table->decimal('base_imponible',5,2);
            $table->string('concepto');
            $table->integer('codCaso');
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
        Schema::drop('ib35a_gastos');
    }
}
