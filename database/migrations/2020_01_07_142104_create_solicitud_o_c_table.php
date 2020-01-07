<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudOCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_o_c', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ordenCompra_id');
            $table->unsignedBigInteger('solicitud_id');
            $table->timestamps();

            $table->foreign('ordenCompra_id')->references('id')->on('orden_compras')->onDelete('cascade');
            $table->foreign('solicitud_id')->references('id')->on('solicituds')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_o_c');
    }
}
