<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignRequestToOCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_request_to_o_c_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year');
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
        Schema::dropIfExists('assign_request_to_o_c_s');
    }
}
