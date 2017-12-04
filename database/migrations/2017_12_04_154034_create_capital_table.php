<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capital', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('monto');
            $table->string('referencia')->nullable();
            $table->integer('cobro_id')->unsigned();
            $table->foreign('cobro_id')->references('id')->on('cobros');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capital');
    }
}
