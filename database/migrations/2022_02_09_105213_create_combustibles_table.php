<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombustiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combustibles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->interger('anio');
            $table->unsignedBigInteger('idVehiculo');
            $table->integer('odometro');
            $table->float('litros');
            $table->integer('noGuia');
            $table->integer('total');
            $table->string('observaciones');
            $table->timestamps();

             //Relations
             $table->foreign('idVehiculo')->references('id')->on('vehiculos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combustibles');
    }
}
