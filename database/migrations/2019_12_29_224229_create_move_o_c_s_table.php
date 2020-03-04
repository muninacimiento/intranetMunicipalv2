<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveOCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_o_c_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ordenCompra_id'); //FK Solicitud ID 
            $table->unsignedBigInteger('estadoOrdenCompra_id'); //FK EstadoSolicitud ID 
            $table->date('fecha'); //Fecha del Movimiento
            $table->unsignedBigInteger('user_id'); //FK User ID
            $table->string('obsRechazoValidacion')->nullable();

            $table->foreign('ordenCompra_id')->references('id')->on('orden_compras')->onDelete('cascade');
            $table->foreign('estadoOrdenCompra_id')->references('id')->on('status_o_c_s')->onDelete('cascade');
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
        Schema::dropIfExists('move_o_c_s');
    }
}
