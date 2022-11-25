<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResevasVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resevas_vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fechaReserva');
            $table->time('horaInicio');
            $table->time('horaTermino');
            $table->integer('iddocSolicitud');
            $table->unsignedBigInteger('idVehiculo');
            $table->unsignedBigInteger('idConductor');
            $table->string('destino');
            $table->string('materia');
            $table->boolean('estado');
            $table->string('motivoAnulacion');
            $table->date('fecha_termino');
            $table->string('dependencia');
            $table->int('cant_funcionarios');
            $table->int('cant_usuarios_externos');
            $table->unsignedBigInteger('idUser');//Usuario que hace la reserva
            $table->timestamps();

            //Relations
            $table->foreign('idVehiculo')->references('id')->on('vehiculos')->onDelete('cascade');
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('resevas_vehiculos');
    }
}
