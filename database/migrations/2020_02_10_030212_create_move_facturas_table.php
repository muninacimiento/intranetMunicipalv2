<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_facturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('factura_id'); //FK Factura ID
            $table->unsignedBigInteger('estadoFactura_id'); //FK EstadoFactura ID
            $table->date('fecha'); //Fecha del Movimiento
            $table->unsignedBigInteger('user_id'); //FK User ID
            $table->string('obsRechazoValidacion')->nullable();
            $table->timestamps();

            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
            $table->foreign('estadoFactura_id')->references('id')->on('status_facturas')->onDelete('cascade');
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
        Schema::dropIfExists('move_facturas');
    }
}
