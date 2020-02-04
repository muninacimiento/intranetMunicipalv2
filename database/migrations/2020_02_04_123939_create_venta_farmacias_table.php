<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentaFarmaciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_farmacias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userFarmacia_id'); //FK UsuarioCliente
            $table->unsignedBigInteger('user_id'); //FK Usuario Plataforma
            $table->timestamps();

            $table->foreign('userFarmacia_id')->references('id')->on('usuario_farmacias')->onDelete('cascade');
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
        Schema::dropIfExists('venta_farmacias');
    }
}
