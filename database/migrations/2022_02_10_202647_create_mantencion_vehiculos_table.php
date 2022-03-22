<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantencionVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantencion_vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fechaMantencion');
            $table->unsignedBigInteger('idVehiculo');
            $table->string('tipoMantencion');
            $table->string('descripcion');
            $table->integer('noDocumento');//Guia o Factura
            $table->string('ordenCompra');
            $table->string('proveedor');
            $table->integer('total');
            $table->string('observaciones');
            $table->timestamps();

            //Relations
            $table->foreign('idVehiculo')->references('id')->on('vehiculos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantencion_vehiculos');
    }
}
