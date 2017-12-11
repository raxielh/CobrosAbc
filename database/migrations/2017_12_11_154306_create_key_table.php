<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('key', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('key')->unique();
            $table->integer('cobro_id')->unsigned()->unique();
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
        Schema::dropIfExists('key');
    }
}
