<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoveBoletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('move_boletas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('boleta_id');
            $table->unsignedBigInteger('estadoBoleta_id');
            $table->unsignedBigInteger('user_id');
            $table->string('observacion')->nullable();
            $table->timestamps();

            $table->foreign('boleta_id')->references('id')->on('boleta_garantias')->onDelete('cascade');
            $table->foreign('estadoBoleta_id')->references('id')->on('status_boletas')->onDelete('cascade');
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
        Schema::dropIfExists('move_boletas');
    }
}
