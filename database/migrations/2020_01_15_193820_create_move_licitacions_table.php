<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveLicitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_licitacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('licitacion_id'); //FK Solicitud ID 
            $table->unsignedBigInteger('estadoLicitacion_id'); //FK EstadoSolicitud ID 
            $table->date('fecha'); //Fecha del Movimiento
            $table->unsignedBigInteger('user_id'); //FK User ID
            $table->string('obsRechazoValidacion')->nullable();

            $table->foreign('licitacion_id')->references('id')->on('licitacions')->onDelete('cascade');
            $table->foreign('estadoLicitacion_id')->references('id')->on('status_licitacions')->onDelete('cascade');
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
        Schema::dropIfExists('move_licitacions');
    }
}
