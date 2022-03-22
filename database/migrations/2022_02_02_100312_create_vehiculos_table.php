<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patente');
            $table->unsignedBigInteger('idConductor');
            $table->string('marca');
            $table->string('modelo');
            $table->integer('anio');
            $table->string('noMotor');
            $table->string('noChasis');
            $table->float('rendimiento');
            $table->string('color');
            $table->string('motor');
            $table->integer('estado');//Determina si el auto esta habilitado o no para Cometidos
            $table->timestamps();

            //Relation
            $table->foreign('idConductor')->references('id')->on('conductors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
