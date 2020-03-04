<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveSolicituds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_solicituds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('solicitud_id'); //FK Solicitud ID 
            $table->unsignedBigInteger('estadoSolicitud_id'); //FK EstadoSolicitud ID 
            $table->date('fecha'); //Fecha del Movimiento
            $table->unsignedBigInteger('user_id'); //FK User ID

            $table->foreign('solicitud_id')->references('id')->on('solicituds')->onDelete('cascade');
            $table->foreign('estadoSolicitud_id')->references('id')->on('status_solicituds')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('move_solicituds');
    }
}
