<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletaGarantiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boleta_garantias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contrato_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('estado_id');
            $table->string('numeroBoleta');
            $table->string('banco');
            $table->bigInteger('montoBoleta');
            $table->timestamps();

            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('status_boletas')->onDelete('cascade');
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
        Schema::dropIfExists('boleta_garantias');
    }
}
