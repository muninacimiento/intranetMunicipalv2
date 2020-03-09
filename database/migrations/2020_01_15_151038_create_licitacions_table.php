<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licitacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('licitacion_id');
            $table->string('ordenCompra_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('iddoc');
            $table->datetime('fechaPublicacion')->nullable();
            $table->date('fechaCierre')->nullable();
            $table->date('fechaResolucion')->nullable();
            $table->unsignedBigInteger('estado_id');
            $table->string('valorEstimado');
            $table->string('proposito');
            $table->text('motivoAnulacion')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('status_licitacions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licitacions');
    }
}
