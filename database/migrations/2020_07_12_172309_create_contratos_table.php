<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('nombreContrato');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('ordenCompra_id');
            $table->date('fechaInicio');
            $table->date('fechaTermino');
            $table->string('numeroBoleta');
            $table->string('banco');
            $table->bigInteger('montoBoleta');
            $table->string('motivoAnulacion')->nullable();
            $table->string('tipoContrato');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ordenCompra_id')->references('id')->on('orden_compras')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
