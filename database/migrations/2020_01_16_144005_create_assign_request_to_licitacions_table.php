<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignRequestToLicitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_request_to_licitacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year');
            $table->unsignedBigInteger('licitacion_id');
            $table->unsignedBigInteger('solicitud_id');
            $table->timestamps();

            $table->foreign('licitacion_id')->references('id')->on('licitacions')->onDelete('cascade');
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
        Schema::dropIfExists('assign_request_to_licitacions');
    }
}
