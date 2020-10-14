<?php

/*
 *  JFuentealba @itux
 *  created at October 04, 2019 - 09:52 am
 *  updated at October 24, 2019 - 05:07 pm
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id'); //foreing key users
            $table->integer('iddoc')->nullable(); //id sistema de gestion documental
            $table->text('motivo'); // motivo de la solicitud
            $table->string('compradorTitular')->nullable(); //foreing key users??
            $table->string('compradorSuplencia')->nullable(); //foreing key users??
            $table->string('tipoSolicitud');
            $table->string('categoriaSolicitud');
            $table->string('decretoPrograma')->nullable();
            $table->string('nombrePrograma')->nullable();
            $table->unsignedBigInteger('estado_id'); //foreing key estadoSolicitud
            $table->integer('total')->nullable(); // Total de la Solicitud

            //Actividad
            $table->text('nombreActividad')->nullable();
            $table->date('fechaActividad')->nullable();
            $table->time('horaActividad')->nullable();
            $table->text('lugarActividad')->nullable();
            $table->text('objetivoActividad')->nullable();
            $table->text('descripcionActividad')->nullable();
            $table->text('participantesActividad')->nullable();
            $table->string('cuentaPresupuestaria')->nullable();
            $table->string('cuentaComplementaria')->nullable();
            $table->text('obsActividad')->nullable();
            $table->string('obsRechazo')->nullable();
            $table->text('motivoAnulacion')->nullable(); // razón por la cual se anulará la solicitud

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('status_solicituds')->onDelete('cascade');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicituds');
    }
}
