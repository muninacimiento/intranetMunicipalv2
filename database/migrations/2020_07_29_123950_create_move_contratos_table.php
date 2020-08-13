<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contrato_id'); //FK Contrató ID
            $table->unsignedBigInteger('estadoContrato_id'); //FK EstadoContrato ID
            $table->date('fecha'); //Fecha del Movimiento
            $table->unsignedBigInteger('user_id'); //FK User ID
            $table->string('observacion')->nullable();
            $table->timestamps();

            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');
            $table->foreign('estadoContrato_id')->references('id')->on('status_contratos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('move_contratos');
    }
}
